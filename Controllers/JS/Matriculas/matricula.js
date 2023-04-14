const span = document.getElementById("span");
const id_aluno = document.getElementById("id_aluno");
const id_disciplina = document.getElementById("id_disciplina");

carregar();


function carregar() {
    const dados = {
        id_aluno: document.getElementById("id_aluno").value,
        id_disciplina: document.getElementById("id_disciplina").value
    }
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {

        response = JSON.parse(this.responseText);
        const alunos = response.alunos;
        const disciplinas = response.disciplinas;
        id_aluno.innerHTML = '';
        id_disciplina.innerHTML = '';
        id_aluno.innerHTML = '<option vlaue="0"></option>';
        id_disciplina.innerHTML = '<option vlaue="0"></option>';
        alunos.forEach(el => {
            id_aluno.innerHTML += "\
                <option value='"+el.id_aluno+"'>"+el.nome+"</option>\
            ";
        });
        disciplinas.forEach(el => {
            id_disciplina.innerHTML += "\
                <option value='"+el.id_disciplina+"'>"+el.nome+"</option>\
            ";
        });

    }

    browserEscondido.open("GET", "../Controllers/API/api.php?tabela=matricula");
    browserEscondido.send();

}



function adicionar() {
    const dados = {
        id_aluno: document.getElementById("id_aluno").value,
        id_disciplina: document.getElementById("id_disciplina").value,
        tabela: "matricula"
    }
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {

        const res = JSON.parse(this.responseText);

        if (res === "sucesso") {
            span.innerHTML = "Matrícula criada com sucesso!";
            span.style.color = "green";

        } else if (res === "Insucesso") {
            span.innerHTML = "Houve um erro!";
            span.style.color = "red";

        } else if (res === "Ja existe uma matricula igual") {
            span.innerHTML = "Ja existe uma matricula igual";
            span.style.color = "red";

        } else {
            span.innerHTML = res;
            span.style.color = "red";
        }
        setTimeout(() => {
            span.innerHTML = '';
        }, 5000)
    }

    browserEscondido.open("POST", "../Controllers/API/api.php");
    browserEscondido.send(JSON.stringify(dados));

}