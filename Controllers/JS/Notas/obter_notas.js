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
                <td>"+ el.id_nota + "</td>\
            <td>"+ el.nome_aluno + "</td>\
            <td>"+ el.nome_disciplina + "</td>\
            <td title='Clique duas vezes para editar'><input type='number' id='n"+ el.id_nota + "' readonly value='"+ el.nota + "' ondblclick='editavel(this)'></td>\
            <td>\
            <button type='button' onclick='editar("+ el.id_nota + ")'>Editar</button>\
            <button type='button' onclick='eliminar("+el.id_nota+")'>Eliminar</button>\
            </td>\
                </tr >";
        });
    }

    browserEscondido.open("GET", "Controllers/API/api.php?tabela=obter_notas")
    browserEscondido.send()
}

//ATUALIZAR DADOS
function editar(id) {
    const nota = document.getElementById("n" + id).value
    
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
    browserEscondido.send(JSON.stringify({ id: id, nota: nota, tabela: "nota" }));


}

//ELIMINAR DADOS
function eliminar(id) {
    const dados = { id: id, tabela: "nota" };

    const browserEscondido = new XMLHttpRequest();

    browserEscondido.onload = function () {
        carregar();
        const res = JSON.parse(this.responseText);
        console.log(res);
        if (res === "sucesso") {
            span.innerHTML = "Nota eliminada com sucesso!";
            span.style.color = "green";

        } else if (res === "insucesso") {
            span.innerHTML = "Houve um erro!";
            span.style.color = "red";

        }else{
            span.innerHTML = "Nota não pode ser eliminada";
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