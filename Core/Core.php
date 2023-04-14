<?php
class Core
{
    public $controller;
    public $metodo;
    public $parametros = array();
    public function __construct()
    {
        $this->path();
        $this->run();
    }

    public function path()
    { //funcao responsavel para obter o controller, metodo e parametro (se existir)
        
        // echo "<pre>";
        // print_r($_SERVER);
        // exit();
        if (isset($_GET['pag'])) {
            $url = $_GET['pag'];

        }
        
        //possui informação após domínio
        if (!empty($url)) {
            $url = explode('/', $url);

            if (lcfirst($url[0]) == "api") {
                define("API", true);
                array_shift($url);
            } else {
                define("API", false);
            }
            $this->controller = ucfirst($url[0]) . 'Controller';
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $this->metodo = str_replace("-", "_", lcfirst($url[0])); //substitui-se o - por _ que vem na url
                array_shift($url); //retira-se o método da url
            } else {
                $this->metodo = 'index'; //caso não existir método
            }

            if (count($url) > 0) { //se for maior que 0 significa que há parâmetros
                array_push($this->parametros, $url[0]);
            }

        } else {
            //caso não houver controller e metodo atribui-se valores padroes
            $this->controller = 'HomeController';
            $this->metodo = 'index';

        }
    }
    public function run()
    { //funcao responsavel por correr o programa


        $caminho = 'Gestao_aluno/Controllers/' . $this->controller . '.php';

        if (file_exists($caminho)) { //caso nao existir classe interrompe-se o progresso

            die("<h1>Página não encontrada</h1>");

        } elseif (!method_exists($this->controller, $this->metodo)) {
            die("<h1>Página não encontrada</h1>");
        }
        $c = new $this->controller; //cria-se objeto da classe

        if(empty($this->parametros)){
            call_user_func_array(array($c, $this->metodo), array(0=>""));
        }else{

            call_user_func_array(array($c, $this->metodo), $this->parametros); //funcao executa metodo de uma classe e passa parametros caso existir
        }

    }
}