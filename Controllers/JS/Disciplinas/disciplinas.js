const span = document.getElementById("span");

function adicionar() {
    const nome = document.getElementById('nome').value;
    const docente = document.getElementById('docente').value;

    const dados = { nome: nome, docente: docente, tabela: "disciplina" };

    const browserEscondido = new XMLHttpRequest();

    browserEscondido.onload = function () {
        const res = JSON.parse(this.responseText);
        if (res === "sucesso") {
            span.innerHTML = "Disciplina criada com sucesso!";
            span.style.color = "green";

        } else if (res === "insucesso") {
            span.innerHTML = "Houve um erro!";
            span.style.color = "red";

        } else if (res === "existe") {
            span.innerHTML = "Ja existe uma disciplina igual";
            span.style.color = "red";

        }
        setTimeout(() => {
            span.innerHTML = '';
        }, 5000)

    }

    if (dados.nome === "" || dados.docente === "") {
        alert("Preencha todos os campos");

    } else {

        browserEscondido.open("POST", "../Controllers/API/api.php")
        browserEscondido.send(JSON.stringify(dados));
    }

}