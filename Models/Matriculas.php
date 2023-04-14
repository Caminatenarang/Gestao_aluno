<?php

require_once 'Conexao.php';
class Matriculas
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();

    }

    public function obter_matriculas()
    {
        $dados = array();
        $cmd = $this->con->query("SELECT * FROM Matricula");
        // $cmd->execute();
        $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function obter_matricula_por_id($id)
    {
        $cmd = $this->con->prepare("SELECT m.id_matricula, a.nome AS nome_aluno, d.nome AS disciplina, m.data_matricula 
                                FROM Matricula m
                                INNER JOIN Disciplina d
                                ON d.id_disciplina = m.id_disciplina
                                INNER JOIN Aluno a
                                ON a.id_aluno = m.id_aluno
                                WHERE m.id_matricula = ?");
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

    public function obter_disciplinas_inscrito($id){
        $cmd = $this->con->prepare("SELECT m.id_matricula, d.nome FROM Matricula m 
                            INNER JOIN disciplina d 
                            ON m.id_disciplina = d.id_disciplina
                            WHERE m.id_aluno = ?");
        $cmd->bindParam(1, $id);
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    public function criar_matricula($id_aluno, $id_disciplina)
    { //metodo responsavel por criar matricula
        //faz-se aind aum select para certificar que nao ha matricula com os dados fornecidos
        $sql = "SELECT * FROM Matricula WHERE id_aluno = ? AND id_disciplina = ?";
        $cmd = $this->con->prepare($sql);
        $cmd->bindParam(1, $id_aluno);
        $cmd->bindParam(2, $id_disciplina);

        try {
            $cmd->execute();
            $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);

            //se for diferente de zero significa que há e, entretanto, retorna-se falso
            if (count($dados) != 0) {

                return "Ja existe uma matricula igual";

            } else { //caso contrario signific auq nao ha um registo com os dados fornecidos
                $sql = "INSERT INTO Matricula(id_aluno, id_disciplina)VALUES(?,?)";
                $cmd = $this->con->prepare($sql);
                $cmd->bindValue(1, $id_aluno);
                $cmd->bindValue(2, $id_disciplina);

                if ($cmd->execute()) { //se for verdadeiro retorna-se verdadeiro
                    return "sucesso";

                } else { //caso contrario retorna-se falso
                    return "insucesso";
                }
            }

        } catch (Exception $e) {
            return "Dados invalidos";
        }
    }


    public function get_dados_matricula()
    {
        $cmd = $this->con->prepare("SELECT m.id_matricula, a.nome AS nome_aluno, d.nome AS disciplina, m.data_matricula 
                                FROM Matricula m
                                INNER JOIN Disciplina d
                                ON d.id_disciplina = m.id_disciplina
                                INNER JOIN Aluno a
                                ON a.id_aluno = m.id_aluno");
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }

}