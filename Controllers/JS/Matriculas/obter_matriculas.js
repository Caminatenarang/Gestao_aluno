const tbody = document.getElementById("tbody");


// console.log("Ola");
carregar();
function carregar() {
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {
        const res = JSON.parse(this.responseText);
        tbody.innerHTML = '';
        res.forEach(el => {
            tbody.innerHTML += "\
                <tr>\
                    <td>"+el.id_matricula+"</td>\
                    <td>"+el.nome_aluno+"</td>\
                    <td>"+el.disciplina+"</td>\
                    <td>"+el.data_matricula+"</td>\
                </tr>";
        });
    }

    browserEscondido.open("GET", "Controllers/API/api.php?tabela=obter_matriculas")
    browserEscondido.send()
}