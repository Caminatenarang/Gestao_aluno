<?php

require_once 'Conexao.php';
class Alunos
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();

    }

    public function obter_alunos()
    {
        $dados = array();
        $cmd = $this->con->query("SELECT * FROM Aluno");
        $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function obter_aluno_por_id($id)
    {
        $cmd = $this->con->prepare("SELECT * FROM Aluno
        WHERE id_aluno = :id");
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
    public function update_aluno($id, $nome, $dn, $end, $tel)
    {

        $cmd = $this->con->prepare("UPDATE Aluno SET nome = ?, data_nascimento = ?, endereco = ?, telefone = ?
        WHERE id_aluno = ?");

        $cmd->bindValue(1, $nome);
        $cmd->bindValue(2, $dn);
        $cmd->bindValue(3, $end);
        $cmd->bindValue(4, $tel);
        $cmd->bindParam(5, $id);

        if ($cmd->execute()) {
            return "sucesso";
        } else {
            return "insucesso";
        }
    }


    public function insert_aluno($dados)
    {
        $cmd = $this->con->prepare("SELECT * FROM Aluno
        WHERE telefone = ?");
        $cmd->bindParam(1, $dados->tel);

        if ($cmd->execute() && $cmd->rowCount() > 0) {
            return "existe";

        } else {
            $cmd = $this->con->prepare("INSERT INTO Aluno(nome, data_nascimento, endereco, telefone)VALUES(?,?,?,?)");
            $cmd->bindValue(1, $dados->nome);
            $cmd->bindValue(2, $dados->dn);
            $cmd->bindValue(3, $dados->end);
            $cmd->bindValue(4, $dados->tel);

            if ($cmd->execute()) {
                return "sucesso";
            } else {
                return "insucesso";
            }
        }
    }

    public function delete_aluno($id)
    {
        // echo $id;
        // exit();
        $cmd = $this->con->prepare("DELETE FROM Aluno
        WHERE id_aluno = ?");
        $cmd->bindParam(1, $id);
        try {
            if ($cmd->execute()) {

                return "sucesso";
            } else {
                return "insucesso";
            }
        } catch (Exception $e) {
            return "Aluno nao pode ser eliminado";
        }
    }
}