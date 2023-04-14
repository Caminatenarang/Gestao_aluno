<?php

require_once 'Conexao.php';
class Disciplinas
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();

    }

    public function obter_disciplinas()
    {
        $dados = array();
        $cmd = $this->con->query("SELECT * FROM Disciplina");
        // $cmd->execute();
        $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function obter_disciplina_por_id($id)
    {
        $cmd = $this->con->prepare("SELECT * FROM Disciplina
        WHERE id_disciplina = :id");
        $cmd->bindParam(':id', $id);
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

    public function insert_disciplina($dados)
    {
        $cmd = $this->con->prepare("SELECT * FROM Disciplina
        WHERE nome = ?");
        $cmd->bindParam(1, $dados->nome);

        if ($cmd->execute() && $cmd->rowCount() > 0) {
            return "existe";

        } else {
            $cmd = $this->con->prepare("INSERT INTO Disciplina(nome, professor)VALUES(?,?)");
            $cmd->bindValue(1, $dados->nome);
            $cmd->bindValue(2, $dados->docente);

            if ($cmd->execute()) {
                return "sucesso";
            } else {
                return "insucesso";
            }
        }
    }

    public function update_disciplina($dados)
    {

        $cmd = $this->con->prepare("UPDATE Disciplina SET nome = ?, professor = ?
        WHERE id_disciplina = ?");

        $cmd->bindValue(1, $dados->nome);
        $cmd->bindValue(2, $dados->prof);
        $cmd->bindParam(3, $dados->id);

        if ($cmd->execute()) {
            return "sucesso";
        } else {
            return "insucesso";
        }
    }




    public function delete_disciplina($id)
    {
        // echo $id;
        // exit();
        $cmd = $this->con->prepare("DELETE FROM Disciplina
        WHERE id_disciplina = ?");
        $cmd->bindParam(1, $id);

        try {
            if ($cmd->execute()) {

                return "sucesso";
            } else {
                return "insucesso";
            }
        } catch (Exception $e) {
            return "Disciplina nao pode ser eliminada";
        }
    }


}