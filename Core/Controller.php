<?php

class Controller { //classe a ser herdada por todas as outras
    public $dados = array();
    public $titulo; //title a ser atribuido dinamicamente conforme a pagina acessada
    public $js; //receberá ficheiro javascript a ser carregado

    public function carregarTemplate($nomeView, $dadosModel = array()) { //metodo responsavel por carregar template
        $this->dados = $dadosModel;
        require 'Views/template.php';
        
        
    }

    //metodo responsavel por carregar o view no template
    public function carregarViewNoTemplate($nomeView, $dadosModel = array()){
        
        require 'Views/'.$nomeView . '.php';      
        echo $this->js; //despeja-se o ficheiro javascript da respetiva página no fim.
    }
}