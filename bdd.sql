create database ESCOLA;
use ESCOLA;

create table Alunos(
	prontuario varchar(7) NOT NULL,
    nome varchar(35) NOT NULL,
    curso varchar(50) NOT NULL,
	primary key(prontuario)	
)Engine InnoDB;