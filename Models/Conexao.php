<?php

class Conexao
{
    private static $instance;
    private function __construct()
    {

    }
    public static function getConexao()
    {
        if (!isset(self::$instance)) {
            $dbname = 'Gestao_aluno';
            $host = 'localhost';
            $user = 'root';
            $pass = '';

            try {
                self::$instance = new PDO('mysql:dbname=' . $dbname . ';host=' . $host, $user, $pass);
                // mysqli_set_charset(self::$instance, "UTF-8");
                if(self::$instance){
                    return self::$instance;
                }else{
                    echo "<h1>CONEXÃO NÃO REALIZADA</h1>";
                    exit();
                }
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }

        }else{

            return self::$instance;
        }
    }
}