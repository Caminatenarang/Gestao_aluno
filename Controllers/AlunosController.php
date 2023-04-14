<?php 
class AlunosController extends Controller
{
    
    public function index() //metodo padrao
    {
        $this->ver_alunos(array());
    }

    public function ver_alunos($parametro) //metodo para chamar o view alunos
    {
       
       
        if(API){
            $aluno = new Alunos();

            if( !empty($parametro) && !empty($parametro[0])){
                $res = json_encode($aluno->obter_aluno_por_id($parametro[0]));
    
                print_r($res);
                exit();
            }else{

                $res = json_encode($aluno->obter_alunos());
    
                print_r($res);
                exit();
            }

        }else{


            $this->js =  "\n<script src='Controllers/JS/Alunos/obter_alunos.js'></script>"; //arquivo javascript a ser colocado no fim da página
            $this->titulo = "Ver alunos";
            
            $this->carregarTemplate('Alunos/alunos', array()); //carregará o template que por sua vez carregará o view alunos que depois. O segundo parâmetro ainda não será utilizado
        }
        
    }
    public function criar_aluno()
    {
        $this->js =  "\n<script src='../Controllers/JS/Alunos/alunos.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->titulo = "Criar aluno";
        $this->carregarTemplate('Alunos/criar_aluno');
    }

   
}


?>