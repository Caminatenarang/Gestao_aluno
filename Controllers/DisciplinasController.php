<?php

class DisciplinasController extends Controller
{
    public $titulo;

    public function index()
    {
        $this->ver_disciplinas(array());
    }

    public function ver_disciplinas($parametro)
    {
        if (API) {
            $aluno = new Disciplinas();

            if (!empty($parametro) && !empty($parametro[0])) {
                $res = json_encode($aluno->obter_disciplina_por_id($parametro[0]));

                print_r($res);
                exit();
            } else {

                $res = json_encode($aluno->obter_disciplinas());

                print_r($res);
                exit();
            }

        } else {
            $this->js = "\n<script src='Controllers/JS/Disciplinas/obter_disciplinas.js'></script>";
            $this->titulo = "Ver disciplinas";

            $this->carregarTemplate('Disciplinas/disciplinas', array());
        }
    }
    public function criar_disciplina()
    {
        $this->js = "\n<script src='../Controllers/JS/Disciplinas/disciplinas.js'></script>";
        $this->titulo = "Criar disciplina";

        $this->carregarTemplate('Disciplinas/criar_disciplina');
    }


}