
<!DOCTYPE html>
<html lang="pt-pt">
    <head>
        <title><?=$this->titulo?></title> <!--a ser atribuido dinamicamente-->
        <link rel="stylesheet" href="/Gestao_aluno/Formatacao/estilo.css">
    </head>

    <body>
        
    <?php
        require 'nav.php';
        //Depois de ser carregado o template, este por sua vez consegue chamar o metodo a seguir
        $this->carregarViewNoTemplate($nomeView, $dadosModel);
    ?>

    </body>
</html>