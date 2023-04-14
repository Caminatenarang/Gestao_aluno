<?php

class HomeController extends Controller{
    public $titulo;

    public function index(){
        $this->titulo = "Home";
        $this->carregarTemplate('home');
    }
}