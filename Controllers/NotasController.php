<?php
class NotasController extends Controller
{
    public $titulo;

    public function index()
    {
        $this->ver_notas(array());
    }

    public function ver_notas($parametro)
    {
        if (API) {
            $nota = new Notas();

            if (!empty($parametro) && !empty($parametro[0])) {
                
                $res = json_encode($nota->obter_notas_por_id($parametro[0]));

                print_r($res);
                exit();
            } else {

                $res = json_encode($nota->obter_notas());

                print_r($res);
                exit();
            }

        } else {
            $this->js = "\n<script src='Controllers/JS/Notas/obter_notas.js'></script>";
            $this->titulo = "Ver Notas";
            $this->carregarTemplate('Notas/notas', array());
        }
    }
    public function criar_nota()
    {
        $this->js = "\n<script src='../Controllers/JS/Notas/notas.js'></script>";
        $this->titulo = "Criar nota";
        $this->carregarTemplate('Notas/criar_nota');
    }


}


?>