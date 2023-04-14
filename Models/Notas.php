<?php

require_once 'Conexao.php';
class Notas
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();

    }

    public function obter_notas()
    {
        $dados = array();
        $cmd = $this->con->query("SELECT n.id_nota, a.id_aluno, a.nome AS nome_aluno, d.nome AS nome_disciplina, n.nota FROM nota n 
		LEFT OUTER JOIN matricula m 
        ON m.id_matricula = n.id_matricula
        INNER JOIN disciplina d 
        ON d.id_disciplina = m.id_disciplina
        INNER JOIN aluno a 
        ON a.id_aluno = m.id_aluno");
        // $cmd->execute();
        $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
        return $dados;
    }
    public function obter_notas_por_id($id)
    {
        $dados = array();
        $cmd = $this->con->prepare("SELECT n.id_nota,a.id_aluno, a.nome AS nome_aluno, d.nome AS nome_disciplina, n.nota FROM nota n 
		LEFT OUTER JOIN matricula m 
        ON m.id_matricula = n.id_matricula
        INNER JOIN disciplina d 
        ON d.id_disciplina = m.id_disciplina
        INNER JOIN aluno a 
        ON a.id_aluno = m.id_aluno
        WHERE a.id_aluno = ?");
        $cmd->bindParam(1, $id);
        try {
            $cmd->execute();

            if ($cmd->rowCOunt() > 0) {

                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                return $dados;
            } else {
                return array("info" => "Sem resultado");
            }


        } catch (Exception $e) {
            return array("info" => "Houve um erro!", "erro" => $e->getMessage());

        }
    }


    public function insert_nota($dados)
    {
        $cmd = $this->con->prepare("SELECT * FROM Nota
        WHERE id_matricula = ?");
        $cmd->bindParam(1, $dados->id_matricula);

        try {
            if ($cmd->execute() && $cmd->rowCount() > 0) {
                return "existe";

            } else {
                $cmd = $this->con->prepare("INSERT INTO Nota(id_matricula, nota)VALUES(?,?)");
                $cmd->bindValue(1, $dados->id_matricula);
                $cmd->bindValue(2, $dados->nota);

                if ($cmd->execute()) {
                    return "sucesso";
                } else {
                    return "insucesso";
                }
            }
        } catch (Exception $e) {
            return "Houve um erro". $e->getMessage();
        }
    }

    public function update_nota($dados)
    {

        $cmd = $this->con->prepare("UPDATE Nota SET nota = ?
                                    WHERE id_nota = ?");

        $cmd->bindValue(1, $dados->nota);
        $cmd->bindParam(2, $dados->id);

        if ($cmd->execute()) {
            return "sucesso";
        } else {
            return "insucesso";
        }
    }




    public function delete_nota($id)
    {
        $cmd = $this->con->prepare("DELETE FROM Nota
        WHERE id_nota = ?");
        $cmd->bindParam(1, $id);

        if ($cmd->execute()) {

            return "sucesso";
        } else {
            return "insucesso";
        }
    }
}