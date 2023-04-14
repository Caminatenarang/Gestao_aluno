<h1>LANÇAR UMA NOTA</h1>

<form>

    <label>Aluno:</label><br>
    <select name="id_aluno" id="id_aluno" onchange="disciplina_aluno(this)">

    </select><br>

    <label>Disciplina:</label><br>
    <select name="id_matricula" id="id_matricula">

    </select><br>
    <label>Nota:</label><br>
    <input type="number" id="nota"><br>

    <button type="button" onclick="adicionar()">Criar Matrícula</button>
</form>
<span id="span"></span>