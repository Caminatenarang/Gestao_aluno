<?php
header('Content-Type: application/json');

require_once '../../Models/Matriculas.php';
require_once '../../Models/Disciplinas.php';
require_once '../../Models/Alunos.php';
require_once '../../Models/Notas.php';

$metodo = $_SERVER["REQUEST_METHOD"];
$matricula = new Matriculas();

if ($metodo == "GET") {
    $tabela = $_GET["tabela"];

    if ($tabela == "matricula") { //se a requisicao for para matricula
        $aluno = new Alunos();
        $disciplina = new Disciplinas();
        $alunos = $aluno->obter_alunos();
        $disciplinas = $disciplina->obter_disciplinas();

        echo json_encode(array("disciplinas" => $disciplinas, "alunos" => $alunos));

    } elseif ($tabela == "obter_matriculas") { //se a requisicao for para ver matricula
        $matricula = new Matriculas();
        $dados = $matricula->get_dados_matricula();
        echo json_encode($dados);

    } elseif ($tabela == "alunos") { //se a requisicao for para alunos
        $n = new Alunos();
        $dados = $n->obter_alunos();
        echo json_encode($dados);


    } elseif ($tabela == "disciplinas") { //se a requisicao for para disciplinas



    }elseif($tabela == "obter_disciplinas"){

        $disciplina = new Disciplinas();

        $res = $disciplina->obter_disciplinas();

        echo json_encode($res);


    } elseif ($tabela == "disciplinas_aluno") { //se a requisicao for para notas
        $id = $_GET["id"];
        $matricula = new Matriculas();

        $res = $matricula->obter_disciplinas_inscrito($id);
        echo json_encode($res);

    }elseif ($tabela == "obter_notas") { //se a requisicao for para notas
        $notas = new Notas();

        $res = $notas->obter_notas();
        echo json_encode($res);

    }



} else if ($metodo == "POST") {

    $input = json_decode(file_get_contents("php://input"));

    if ($input->tabela == "aluno") {

        $aluno = new Alunos();

        echo json_encode($aluno->insert_aluno($input));

    } elseif ($input->tabela == "matricula") {


        $id_aluno = $input->id_aluno;
        $id_disciplina = $input->id_disciplina;

        $matricula = $matricula->criar_matricula($id_aluno, $id_disciplina);
        echo json_encode($matricula);

    } elseif ($input->tabela == "disciplina") {
        $disciplina = new Disciplinas();

        echo json_encode($disciplina->insert_disciplina($input));

    } elseif ($input->tabela == "nota") {

        $nota = new Notas();

        echo json_encode($nota->insert_nota($input));

    }



} else if ($metodo == "PUT") {

    $input = json_decode(file_get_contents("php://input"));

    if ($input->tabela == "aluno") {
        $id = $input->id;
        $nome = $input->nome;
        $dn = $input->dn;
        $end = $input->end;
        $tel = $input->tel;
        $aluno = new Alunos();

        $res = $aluno->update_aluno($id, $nome, $dn, $end, $tel);

        echo json_encode($res);


    } elseif ($input->tabela == "matricula") {



    } elseif ($input->tabela == "disciplina") {

        $disciplina = new Disciplinas();

        $res = $disciplina->update_disciplina($input);

        echo json_encode($res);

    } elseif($input->tabela == "nota") {
        $nota = new Notas();

        $res = $nota->update_nota($input);

        echo json_encode($res);


    }



} elseif ($metodo == "DELETE") {
    $input = json_decode(file_get_contents("php://input"));

    if ($input->tabela == "aluno") {
        $id = $input->id;

        $aluno = new Alunos();

        $res = $aluno->delete_aluno($id);

        echo json_encode($res);


    } elseif ($input->tabela == "matricula") {



    } elseif ($input->tabela == "disciplina") {
        $id = $input->id;

        $disciplina = new Disciplinas();

        $res = $disciplina->delete_disciplina($id);

        echo json_encode($res);

    } elseif ($input->tabela == "nota") {
        $id = $input->id;
        $nota = new Notas();

        $res = $nota->delete_nota($id);
        echo json_encode($res);
    }
}


?>