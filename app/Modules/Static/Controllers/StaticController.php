<?php
namespace App\Modules\Static\Controllers;

use App\Core\Controller;
use App\Core\View;

class StaticController extends Controller
{
    private const CHURCH_NAME = "IMGD";

    public function imgd(): void
    {
        $data = [
            "title" => "Igreja Ministério da Graça de Deus - " . self::CHURCH_NAME
        ];

        View::render("Static/Views/imgd", $data);
    }

    public function declaracaoFe(): void
    {
        $data = [
            "title" => "Declaração de Fé - " . self::CHURCH_NAME
        ];

        View::render("Static/Views/declaracaoFe", $data);
    }

    public function apostoloJeque(): void
    {
        $data = [
            "title" => "Apóstolo Jeque - " . self::CHURCH_NAME
        ];

        View::render("Static/Views/apostoloJeque", $data);
    }

    public function acaoSocial(): void
    {
        $data = [
            "title" => "Ação Social - " . self::CHURCH_NAME
        ];

        View::render("Static/Views/acaoSocial", $data);
    }
}