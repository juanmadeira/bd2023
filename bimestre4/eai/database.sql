--cria o banco de dados do trabalho
CREATE DATABASE trabalho41;

--conecta no banco de dados
\c trabalho41

--cria a tabela dos usuários
CREATE TABLE usuario (
    id SERIAL PRIMARY KEY,
    nm VARCHAR(40) NOT NULL,
    email VARCHAR(75) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    isAdm INT
);

--cria a tabela dos livros
CREATE TABLE livro (
    id SERIAL PRIMARY KEY,
    autores VARCHAR(100) NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    ano VARCHAR(4) NOT NULL,
    editora VARCHAR(40) NOT NULL,
    quantidade INT NOT NULL
);

--cria a tabela da relação entre usuário e livro
CREATE TABLE emprestimo (
	idEmprestimo SERIAL PRIMARY KEY,
	tempo TIMESTAMP NOT NULL,
	idUsuario INT NOT NULL,
	idLivro INT NOT NULL,
	FOREIGN KEY (idUsuario) REFERENCES usuario (id),
	FOREIGN KEY (idLivro) REFERENCES livro (id)
);

--insere o usuário administrador
    -- email: adm@email.com
    -- senha: adm
INSERT INTO usuario (nm, email, senha, isadm) VALUES ('anya taylor joy', 'adm@email.com', '$2y$10$tbRtK9vUCQWmCFXiGEZLWOGD4SyVYia/vSV5Rn.3iJGQFakDU67/6', 1);