const span = document.getElementById("span");

const id_aluno = document.getElementById("id_aluno");
const id_disciplina = document.getElementById("id_matricula");

carregar_alunos();


function carregar_alunos() {
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {

        const res = JSON.parse(this.responseText);
        id_aluno.innerHTML = '';
        id_aluno.innerHTML = '<option vlaue="0"></option>';

        res.forEach(el => {
            id_aluno.innerHTML += "\
                <option value='"+ el.id_aluno + "'>" + el.nome + "</option>\
            ";
        });

    }

    browserEscondido.open("GET", "../Controllers/API/api.php?tabela=alunos");
    browserEscondido.send();

}
function disciplina_aluno(el) {


    const id = el.value;
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {

        const res = JSON.parse(this.responseText);

        id_disciplina.innerHTML = '';

        res.forEach(el => {
            id_disciplina.innerHTML += "\
                <option value='"+ el.id_matricula + "'>" + el.nome + "</option>\
            ";
        });

    }

    browserEscondido.open("GET", "../Controllers/API/api.php?tabela=disciplinas_aluno&id=" + id);
    browserEscondido.send();

}





function adicionar() {
    const id_matricula = document.getElementById('id_matricula').value;
    const nota = document.getElementById('nota').value;

    const dados = {id_matricula: id_matricula, nota: nota, tabela: "nota" };

    const browserEscondido = new XMLHttpRequest();

    browserEscondido.onload = function () {
        const res = JSON.parse(this.responseText);
        if (res === "sucesso") {
            span.innerHTML = "Nota lançada com sucesso!";
            span.style.color = "green";

        } else if (res === "insucesso") {
            span.innerHTML = "Houve um erro!";
            span.style.color = "red";

        } else if (res === "existe") {
            span.innerHTML = "Nota já lançada";
            span.style.color = "red";

        }else{
            span.innerHTML = res;
            span.style.color = "red";
        }
        setTimeout(() => {
            span.innerHTML = '';
        }, 5000)

    }

    if (dados.id_matricula === "" || dados.nota === "" || dados.nota === null) {
        alert("Preencha todos os campos");

    } else if (Number(dados.nota) < 0) {

        alert("A nota não pode ser menor que zero");
    } else {

        browserEscondido.open("POST", "../Controllers/API/api.php")
        browserEscondido.send(JSON.stringify(dados));
    }

}