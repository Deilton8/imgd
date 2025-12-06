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
            'from_email' => $_ENV['FROM_EMAIL'] ?? 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'localhost'),
            'from_name' => $_ENV['FROM_NAME'] ?? 'Painel Administrativo',
            'use_file_log' => $_ENV['USE_FILE_LOG'] ?? true,
        ];
    }

    public function sendRecoveryEmail(string $to, string $link): bool
    {
        if ($this->config['use_file_log']) {
            return $this->saveEmailToFile($to, $link);
        }

        return $this->sendRealEmail($to, $link);
    }

    private function sendRealEmail(string $to, string $link): bool
    {
        $subject = "Redefinição de Senha - Painel Administrativo";
        $message = $this->createEmailTemplate($link);
        $headers = $this->createEmailHeaders();

        try {
            return mail($to, $subject, $message, $headers);
        } catch (\Exception $exception) {
            error_log("Erro ao enviar email: " . $exception->getMessage());
            return $this->saveEmailToFile($to, $link);
        }
    }

    private function createEmailTemplate(string $link): string
    {
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
            "-->\n\n";
    }

    private function appendToTextLog(string $directory, string $to, string $link, string $timestamp): void
    {
        $logEntry = "[" . date('Y-m-d H:i:s') . "] Email de recuperação para: {$to}\n" .
            "Link: {$link}\n" .
            "Arquivo: " . self::EMAIL_PREFIX . "{$timestamp}.html\n" .
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
            if (preg_match('/Link: (.*?)\n/', $content, $matches)) {
                $recoveryLinks[basename($file)] = $matches[1];
            }
        }

        return $recoveryLinks;
    }
}