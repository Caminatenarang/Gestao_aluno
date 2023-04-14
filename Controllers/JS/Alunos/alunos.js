const span = document.getElementById("span");

function adicionar() {
    const nome = document.getElementById('nome').value;
    const dn = document.getElementById('dn').value;
    const end = document.getElementById('endereco').value;
    const tel = document.getElementById('telefone').value;
    const dados = { nome: nome, dn: dn, end: end, tel: tel, tabela: "aluno" };

    const browserEscondido = new XMLHttpRequest();

    browserEscondido.onload = function () {
        const res = JSON.parse(this.responseText);
        if (res === "sucesso") {
            span.innerHTML = "Aluno criado com sucesso!";
            span.style.color = "green";

        } else if (res === "insucesso") {
            span.innerHTML = "Houve um erro!";
            span.style.color = "red";

        } else if (res === "existe") {
            span.innerHTML = "Ja existe um aluno com um campo igual (Telefone)";
            span.style.color = "red";

        }
        setTimeout(() => {
            span.innerHTML = '';
        }, 5000)

    }

    if (dados.nome === "" || dados.dn === "" || dados.end === "" || dados.tel === "") {
        alert("Preencha todos os campos");

    } else {

        browserEscondido.open("POST", "../Controllers/API/api.php")
        browserEscondido.send(JSON.stringify(dados));
    }

}