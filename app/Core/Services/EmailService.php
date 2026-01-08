<?php
namespace App\Core\Services;

class EmailService
{
    private const EMAIL_PREFIX = 'recovery_';
    private const EMAIL_LOGFILE = 'emails.log';
    private const LOG_DIRECTORY = '/../../../storage/logs/emails/';

    private array $config;

    public function __construct()
    {
        $this->config = $this->loadConfiguration();
    }

    private function loadConfiguration(): array
    {
        return [
            'from_email' => $_ENV['EMAIL_FROM'] ?? 'admin@imgd.org.mz',
            'from_name' => $_ENV['EMAIL_FROM_NAME'] ?? 'Painel Administrativo',
            'use_file_log' => filter_var($_ENV['EMAIL_USE_FILE_LOG'] ?? true, FILTER_VALIDATE_BOOLEAN),
            'smtp_host' => $_ENV['SMTP_HOST'] ?? '',
            'smtp_port' => $_ENV['SMTP_PORT'] ?? 587,
            'smtp_username' => $_ENV['SMTP_USERNAME'] ?? '',
            'smtp_password' => $_ENV['SMTP_PASSWORD'] ?? '',
            'smtp_secure' => $_ENV['SMTP_SECURE'] ?? 'tls',
            'use_smtp' => filter_var($_ENV['EMAIL_USE_SMTP'] ?? false, FILTER_VALIDATE_BOOLEAN),
        ];
    }

    public function sendRecoveryEmail(string $to, string $link): bool
    {
        // Se estiver em desenvolvimento ou configurado para usar arquivo, salva em arquivo
        if ($this->config['use_file_log'] || $this->config['use_smtp'] === false) {
            $this->saveEmailToFile($to, $link);
            
            // Em desenvolvimento, retorna true mesmo salvando em arquivo
            // Em produção, você pode querer tentar enviar o email real
            if ($this->config['use_file_log'] && !$this->config['use_smtp']) {
                error_log("Email de recuperação salvo em arquivo para: {$to}");
                return true;
            }
        }

        // Tenta enviar email real
        if ($this->config['use_smtp']) {
            return $this->sendEmailViaSMTP($to, $link);
        } else {
            return $this->sendEmailViaMail($to, $link);
        }
    }

    private function sendEmailViaMail(string $to, string $link): bool
    {
        $subject = "Redefinição de Senha - Painel Administrativo";
        $message = $this->createEmailTemplate($link);
        $headers = $this->createEmailHeaders();

        try {
            $result = mail($to, $subject, $message, $headers);
            if (!$result) {
                error_log("Falha ao enviar email via mail() para: {$to}");
                return $this->saveEmailToFile($to, $link);
            }
            return $result;
        } catch (\Exception $exception) {
            error_log("Erro ao enviar email: " . $exception->getMessage());
            return $this->saveEmailToFile($to, $link);
        }
    }

    private function sendEmailViaSMTP(string $to, string $link): bool
    {
        try {
            // Implementação básica de SMTP usando PHPMailer (recomendado instalar via composer)
            // Como alternativa, uso fsockopen para envio SMTP direto
            return $this->sendSMTPDirect($to, $link);
        } catch (\Exception $exception) {
            error_log("Erro ao enviar email via SMTP: " . $exception->getMessage());
            
            // Fallback para mail() nativo
            if ($this->config['use_file_log']) {
                $this->saveEmailToFile($to, $link);
            }
            
            return $this->sendEmailViaMail($to, $link);
        }
    }

    private function sendSMTPDirect(string $to, string $link): bool
    {
        // Verifica se as configurações SMTP estão definidas
        if (empty($this->config['smtp_host']) || empty($this->config['smtp_username'])) {
            error_log("Configurações SMTP incompletas. Usando fallback.");
            return false;
        }

        // Implementação simplificada de envio SMTP
        $subject = "Redefinição de Senha - Painel Administrativo";
        $message = $this->createEmailTemplate($link);
        $headers = $this->createEmailHeaders();
        
        // Adiciona cabeçalhos adicionais para SMTP
        $headers .= "\r\nX-Mailer: PHP/" . phpversion();
        $headers .= "\r\nMIME-Version: 1.0";
        $headers .= "\r\nContent-Type: text/html; charset=UTF-8";

        // Para uma implementação completa de SMTP, considere usar:
        // 1. PHPMailer (recomendado) - via composer: composer require phpmailer/phpmailer
        // 2. SwiftMailer
        // 3. Ou implementação nativa com fsockopen (mais complexa)
        
        // Por enquanto, usamos ini_set para configurar o mail() para SMTP
        if (!empty($this->config['smtp_host'])) {
            ini_set("SMTP", $this->config['smtp_host']);
            ini_set("smtp_port", $this->config['smtp_port']);
            ini_set("sendmail_from", $this->config['from_email']);
        }

        return mail($to, $subject, $message, $headers);
    }

    private function createEmailTemplate(string $link): string
    {
        // Mantém o mesmo template HTML...
        $currentYear = date('Y');
        return <<<HTML
        <!DOCTYPE html>
        <html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Redefinição de Senha</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    line-height: 1.6; 
                    color: #333; 
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container { 
                    max-width: 600px; 
                    margin: 0 auto; 
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                    overflow: hidden;
                }
                .header { 
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    padding: 30px;
                    text-align: center;
                }
                .content { 
                    padding: 30px;
                }
                .button { 
                    display: inline-block;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    padding: 12px 24px;
                    text-decoration: none;
                    border-radius: 5px;
                    font-weight: bold;
                    margin: 20px 0;
                }
                .footer { 
                    background: #f8f9fa;
                    padding: 20px;
                    text-align: center;
                    color: #666;
                    font-size: 12px;
                }
                .warning {
                    background: #fff3cd;
                    border: 1px solid #ffeaa7;
                    border-radius: 5px;
                    padding: 15px;
                    margin: 20px 0;
                    color: #856404;
                }
                .link-box {
                    word-break: break-all;
                    background: #f8f9fa;
                    padding: 15px;
                    border-radius: 5px;
                    border: 1px solid #ddd;
                    font-family: monospace;
                    font-size: 12px;
                    margin: 15px 0;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🔐 Redefinição de Senha</h1>
                    <p>Painel Administrativo</p>
                </div>
                
                <div class='content'>
                    <h2>Olá,</h2>
                    <p>Você solicitou a redefinição de sua senha no <strong>Painel Administrativo</strong>.</p>
                    <p>Clique no botão abaixo para criar uma nova senha:</p>
                    
                    <div style='text-align: center;'>
                        <a href='{$link}' class='button' style='color: white; text-decoration: none;'>Redefinir Minha Senha</a>
                    </div>
                    
                    <div class='warning'>
                        <strong>⚠️ Importante:</strong> Este link expira em 2 horas. 
                        Se você não solicitou esta redefinição, ignore este e-mail.
                    </div>
                    
                    <p>Se o botão não funcionar, copie e cole o link abaixo no seu navegador:</p>
                    <div class='link-box'>{$link}</div>
                </div>
                
                <div class='footer'>
                    <p>Este é um e-mail automático, por favor não responda.</p>
                    <p>© {$currentYear} Painel Administrativo. Todos os direitos reservados.</p>
                </div>
            </div>
        </body>
        </html>
        HTML;
    }

    private function createEmailHeaders(): string
    {
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "From: {$this->config['from_name']} <{$this->config['from_email']}>\r\n";
        $headers .= "Reply-To: {$this->config['from_email']}\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        $headers .= "X-Priority: 1 (Highest)\r\n";
        $headers .= "Importance: High\r\n";

        return $headers;
    }

    private function saveEmailToFile(string $to, string $link): bool
    {
        try {
            $logDirectory = __DIR__ . self::LOG_DIRECTORY;
            $this->ensureLogDirectoryExists($logDirectory);

            $timestamp = date('Y-m-d_H-i-s');
            $filename = $logDirectory . self::EMAIL_PREFIX . "{$timestamp}.html";

            $content = $this->createEmailTemplate($link);
            $logInfo = $this->createLogInfo($to, $link, $timestamp);

            file_put_contents($filename, $logInfo . $content);
            $this->appendToTextLog($logDirectory, $to, $link, $timestamp);

            return true;
        } catch (\Exception $exception) {
            error_log("Erro ao salvar email em arquivo: " . $exception->getMessage());
            return false;
        }
    }

    private function ensureLogDirectoryExists(string $directory): void
    {
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    private function createLogInfo(string $to, string $link, string $timestamp): string
    {
        return "<!--\n" .
            "Email para: {$to}\n" .
            "Data: " . date('d/m/Y H:i:s') . "\n" .
            "Link: {$link}\n" .
            "De: {$this->config['from_email']}\n" .
            "SMTP: " . ($this->config['use_smtp'] ? 'Sim' : 'Não') . "\n" .
            "-->\n\n";
    }

    private function appendToTextLog(string $directory, string $to, string $link, string $timestamp): void
    {
        $logEntry = "[" . date('Y-m-d H:i:s') . "] Email de recuperação para: {$to}\n" .
            "De: {$this->config['from_email']}\n" .
            "Link: {$link}\n" .
            "Arquivo: " . self::EMAIL_PREFIX . "{$timestamp}.html\n" .
            "SMTP: " . ($this->config['use_smtp'] ? 'Sim' : 'Não') . "\n" .
            "----------------------------------------\n";

        file_put_contents($directory . self::EMAIL_LOGFILE, $logEntry, FILE_APPEND);
    }

    public function getLatestRecoveryLinks(int $limit = 10): array
    {
        $logDirectory = __DIR__ . self::LOG_DIRECTORY;
        $recoveryLinks = [];

        if (!is_dir($logDirectory)) {
            return $recoveryLinks;
        }

        $files = glob($logDirectory . self::EMAIL_PREFIX . '*.html');
        rsort($files);

        foreach (array_slice($files, 0, $limit) as $file) {
            $content = file_get_contents($file);
            if (preg_match('/Email para: (.*?)\n/', $content, $emailMatch) &&
                preg_match('/Link: (.*?)\n/', $content, $linkMatch)) {
                $recoveryLinks[] = [
                    'file' => basename($file),
                    'email' => $emailMatch[1],
                    'link' => $linkMatch[1],
                    'date' => date('d/m/Y H:i:s', filemtime($file))
                ];
            }
        }

        return $recoveryLinks;
    }

    public function getEmailConfig(): array
    {
        return [
            'from_email' => $this->config['from_email'],
            'from_name' => $this->config['from_name'],
            'use_file_log' => $this->config['use_file_log'],
            'use_smtp' => $this->config['use_smtp'],
            'smtp_configured' => !empty($this->config['smtp_host']),
        ];
    }
}