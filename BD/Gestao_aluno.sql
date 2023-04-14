--
-- Banco de dados: Gestao_aluno
--
CREATE DATABASE IF NOT EXISTS Gestao_aluno;
USE Gestao_aluno;
-- --------------------------------------------------------

-- Estrutura da tabela `Aluno`

CREATE TABLE IF NOT EXISTS Aluno (
  id_aluno int NOT NULL AUTO_INCREMENT,
  nome varchar(45) NOT NULL,
  data_nascimento date NOT NULL,
  endereco varchar(45) NOT NULL,
  telefone varchar(45) NOT NULL,
  PRIMARY KEY (id_aluno)
);

-- Estrutura da tabela Disciplina
CREATE TABLE IF NOT EXISTS Disciplina (
  id_disciplina int NOT NULL AUTO_INCREMENT,
  nome varchar(45) NOT NULL,
  professor varchar(45) NOT NULL,
  PRIMARY KEY (id_disciplina)
);

-- Estrutura da tabela Matricula
CREATE TABLE IF NOT EXISTS  Matricula (
  id_matricula int NOT NULL AUTO_INCREMENT,
  id_aluno int NOT NULL,
  id_disciplina int NOT NULL,
  data_matricula date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY(id_matricula),
  INDEX id_aluno_idx(id_aluno),
  INDEX id_disciplina_idx(id_disciplina),
  CONSTRAINT fk_id_aluno FOREIGN KEY(id_aluno) REFERENCES Aluno(id_aluno) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_id_disciplina FOREIGN KEY(id_disciplina) REFERENCES Disciplina(id_disciplina) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Estrutura da tabela Nota
CREATE TABLE IF NOT EXISTS  Nota (
  id_nota int NOT NULL AUTO_INCREMENT,
  id_matricula int NOT NULL,
  nota decimal(4,2) NOT NULL,
  PRIMARY KEY(id_nota),
  INDEX id_matricula_idx(id_matricula),
  CONSTRAINT fk_id_matricula FOREIGN KEY(id_matricula) REFERENCES Matricula(id_matricula) ON DELETE NO ACTION ON UPDATE NO ACTION
);


-- INSERINDO dados na tabela Aluno
INSERT INTO Aluno (nome, data_nascimento, endereco, telefone) VALUES
('Caminaté Na Rang', '2023-04-04', 'Praceta do Chafariz', '960439561'),
('Carlos Abreeu', '2023-04-12', 'Praceta do Chafariz', '960439561');

-- --------------------------------------------------------


-- INSERINDO dados na tabela `Disciplina`
INSERT INTO Disciplina (nome, professor) VALUES
('DAAI2', 'Helder'),
('Técnicas Avançadas de Programação', 'Ricardo Campos');

-- --------------------------------------------------------

-- INSERINDO dados na tabela `Matricula`
INSERT INTO Matricula (id_aluno, id_disciplina, data_matricula) VALUES
(1, 1, '2023-04-07'),
(2, 1, '2023-04-07'),
(1, 2, '2023-04-09');

-- --------------------------------------------------------

-- INSERINDO dados na tabela `Nota`
INSERT INTO Nota (id_matricula, nota) VALUES
(1, '11.00'),
(2, '8.00');

COMMIT;
