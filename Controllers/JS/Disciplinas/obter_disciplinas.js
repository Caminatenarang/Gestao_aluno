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
                <td>"+ el.id_disciplina + "</td>\
            <td title='Clique duas vezes para editar'><input type='text' id='n"+ el.id_disciplina + "' readonly value='"+ el.nome + "' ondblclick='editavel(this)'></td>\
            <td title='Clique duas vezes para editar'><input type='text' id='prof"+ el.id_disciplina + "' readonly value='"+ el.professor + "' ondblclick='editavel(this)'></td>\
            <td>\
            <button type='button' onclick='editar("+ el.id_disciplina + ")'>Editar</button>\
            <button type='button' onclick='eliminar("+el.id_disciplina+")'>Eliminar</button>\
            </td>\
                </tr >";
        });
    }

    browserEscondido.open("GET", "Controllers/API/api.php?tabela=obter_disciplinas")
    browserEscondido.send()
}

//ATUALIZAR DADOS
function editar(id) {
    const nome = document.getElementById("n" + id).value
    const prof = document.getElementById("prof" + id).value
    
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
    browserEscondido.send(JSON.stringify({ id: id, nome: nome, prof: prof, tabela: "disciplina" }));


}

//ELIMINAR DADOS
function eliminar(id) {
    const dados = { id: id, tabela: "disciplina" };

    const browserEscondido = new XMLHttpRequest();

    browserEscondido.onload = function () {
        carregar();
        const res = JSON.parse(this.responseText);
        console.log(res);
        if (res === "sucesso") {
            span.innerHTML = "Disciplina eliminada com sucesso!";
            span.style.color = "green";

        } else if (res === "insucesso") {
            span.innerHTML = "Houve um erro!";
            span.style.color = "red";

        }else{
            span.innerHTML = "Disciplina não pode ser eliminada";
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