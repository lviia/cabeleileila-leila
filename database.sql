create schema salao_leila;

use salao_leila;

CREATE TABLE usuarios (
	 id int auto_increment primary key
	,is_admin bool not null
	,nome varchar(140) not null
    ,telefone varchar(20)
    ,email varchar(80) not null
    ,senha varchar(16) not null
);

INSERT INTO usuarios (is_admin, nome, telefone, email, senha) VALUES (True, 'Cabeleileila Leila', '', 'leila@gmail.com', 'leilaleila');
INSERT INTO usuarios (is_admin, nome, telefone, email, senha) VALUES (False, 'DSIN-TESTE', '14 3451-4098','dsin@gmail.com', 'dsin123');

CREATE TABLE agendamentos (
	 id_agendamento int auto_increment primary key
	,horario_agendamento varchar(10) not null
    ,data_agendamento date not null
    ,procedimento varchar(50) not null
    ,id int
    ,nome_agendamento varchar(140)
	,FOREIGN KEY (id) REFERENCES usuarios(id)
    ,FOREIGN KEY (nome_agendamento) REFERENCES usuarios(nome)
);
