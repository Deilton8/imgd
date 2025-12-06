<?php
namespace App\Modules\Static\Controllers;

use App\Core\Controller;
use App\Core\View;

class StaticController extends Controller
{
    // Sobre IMGD
    public function imgd()
    {
        $data = [
            "title" => "Igreja Ministério da Graça de Deus - IMGD"
        ];

        View::render("Static/Views/imgd", $data);
    }

    // Declaracao de fé
    public function declaracaoFe()
    {
        $data = [
            "title" => "Declaracao de Fé - IMGD"
        ];

        View::render("Static/Views/declaracaoFe", $data);
    }

    // Apostolo Jeque
    public function apostoloJeque()
    {
        $data = [
            "title" => "Apóstolo Jeque - IMGD"
        ];

        View::render("Static/Views/apostoloJeque", $data);
    }

    // Ação Social
    public function acaoSocial()
    {
        $data = [
            "title" => "Acção Social - IMGD"
        ];

        View::render("Static/Views/acaoSocial", $data);
    }
}