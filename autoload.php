<?php 
spl_autoload_register(function($nomeArquivo){

    if(file_exists('Controllers/'. $nomeArquivo . '.php')){

        require 'Controllers/'. $nomeArquivo . '.php';

    }elseif(file_exists('Models/' . $nomeArquivo . '.php')){

        require 'Models/'. $nomeArquivo . '.php';

    }elseif(file_exists('Core/' . $nomeArquivo . '.php')){
        
        require 'Core/' .$nomeArquivo. '.php';
    }
});