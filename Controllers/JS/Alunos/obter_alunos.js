const tbody = document.getElementById("tbody");

carregar();


function carregar() {
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {

        const res = JSON.parse(this.responseText);
        tbody.innerHTML = '';

        res.forEach(el => {
            tbody.innerHTML += "\
                <tr>\
                <td>"+ el.id_aluno + "</td>\
            <td title='Clique duas vezes para editar'><input type='text' id='n"+ el.id_aluno + "' readonly value='"+ el.nome + "' ondblclick='editavel(this)'></td>\
            <td title='Clique duas vezes para editar'><input type='text' id='dn"+ el.id_aluno + "' readonly value='"+ el.data_nascimento + "' ondblclick='editavel(this)'></td>\
            <td title='Clique duas vezes para editar'><input type='text' id='end"+ el.id_aluno + "' readonly value='"+ el.endereco + "' ondblclick='editavel(this)'></td>\
            <td title='Clique duas vezes para editar'><input type='text' id='tel"+ el.id_aluno + "' readonly value='"+ el.telefone + "' ondblclick='editavel(this)'></td>\
            <td>\
            <button type='button' onclick='editar("+ el.id_aluno + ")'>Editar</button>\
            <button type='button' onclick='eliminar("+el.id_aluno+")'>Eliminar</button>\
            </td>\
                </tr >";
        });

    }

    browserEscondido.open("GET", "Controllers/API/api.php?tabela=alunos")
    browserEscondido.send()
}


//ATUALIZAR DADOS
function editar(id) {
    const nome = document.getElementById("n" + id).value
    const dn = document.getElementById("dn" + id).value
    const end = document.getElementById("end" + id).value
    const tel = document.getElementById("tel" + id).value
    
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {
        carregar();
        res = JSON.parse(this.responseText);
        
        if (res == "sucesso") {
            span.innerHTML = "Atualizado com sucesso!";
            span.style.color = "green";
        } else if (res == "insucesso") {
            span.innerHTML = "Não foi possível atualizar!";
            span.style.color = "red";
        }
        setTimeout(() => {
            span.innerHTML = '';
        }, 5000)

    }

    browserEscondido.open("PUT", "Controllers/API/api.php");
    browserEscondido.send(JSON.stringify({ id: id, nome: nome, dn: dn, end: end, tel: tel, tabela: "aluno" }));


}

//ELIMINAR DADOS
function eliminar(id) {
    const dados = { id: id, tabela: "aluno" };

    const browserEscondido = new XMLHttpRequest();

    browserEscondido.onload = function () {
        carregar();
        const res = JSON.parse(this.responseText);
        if (res === "sucesso") {
            span.innerHTML = "Aluno eliminado com sucesso!";
            span.style.color = "green";

        } else if (res === "insucesso") {
            span.innerHTML = "Houve um erro!";
            span.style.color = "red";

        }else{
            span.innerHTML = "Aluno não pode ser eliminado";
            span.style.color = "red";
        }
        setTimeout(() => {
            span.innerHTML = '';
        }, 5000)

    }


    browserEscondido.open("DELETE", "Controllers/API/api.php")
    browserEscondido.send(JSON.stringify(dados));


}


//TORNAR UM CAMPO EDITÁVEL OU NÃO
function editavel(el) {


    if (el.hasAttribute("readonly")) {
        el.removeAttribute("readonly")
    } else {
        el.setAttribute("readonly", true)
    }

}