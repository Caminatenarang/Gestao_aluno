<?php
class MatriculasController extends Controller
{
    public $titulo;
    public function index()
    {
        $this->ver_matriculas(array());
    }

    public function ver_matriculas($parametro)
    {
        if (API) {
            $matricula = new Matriculas();

            if (!empty($parametro) && !empty($parametro[0])) {
                $res = json_encode($matricula->obter_matricula_por_id($parametro[0]));

                print_r($res);
                exit();
            } else {

                $res = json_encode($matricula->get_dados_matricula());

                print_r($res);
                exit();
            }

        } else {
            $this->js = "\n<script src='Controllers/JS/Matriculas/obter_matriculas.js'></script>";
            $this->titulo = "Ver Matrículas";
            $this->carregarTemplate('Matriculas/matriculas', array());
        }
    }
    public function criar_matricula()
    {
        $this->js = "\n<script src='../Controllers/JS/Matriculas/matricula.js'></script>";
        $this->titulo = "Criar Matrícula";
        $this->carregarTemplate('Matriculas/criar_matricula');
    }


}


?>