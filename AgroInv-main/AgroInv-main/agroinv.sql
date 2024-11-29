create database projetomvc;
use projetomvc;
create table eventos (
	id_evento int auto_increment primary key, 
	id_usuario int,
	titulo_evento varchar(255),
	descricao_evento varchar(255),
    link_aula varchar(255),
	comeco_evento timestamp null,
	fim_evento timestamp null,
    lab_evento varchar(255),
    professor_evento varchar(255),
    turma_evento varchar(255)
);


create table posts (
    id_post INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    titulo VARCHAR(255),
    texto VARCHAR(255),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    tipo_usuario VARCHAR(255),
    nome_usuario VARCHAR(255),
    email_usuario VARCHAR(255),
    senha_usuario VARCHAR(255),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_turma VARCHAR(255) NOT NULL,
    ano_ingresso INT(4) NOT NULL,
    quantidade_alunos INT NOT NULL
);

create table produtos(
    id int auto_increment primary key,
    unidade varchar(255),
    quantidade decimal, 
    validade date,
    nome varchar(255),
    categoria varchar(255)
);


