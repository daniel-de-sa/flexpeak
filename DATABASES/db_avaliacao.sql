/*
    Autor: Daniel de Sá
    SGBD: MySQL
    Versão do SGBD:5.7  
*/

-- Cria o banco de dados da aplicação
CREATE DATABASE IF NOT EXISTS flexpeak DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE flexpeak;


-- Cria a tabela de Professores
    CREATE TABLE professores(
        id_professor INT NOT NULL AUTO_INCREMENT,
        nome VARCHAR(70) NOT NULL,
        data_nascimento DATE NOT NULL,
        data_criacao DATE NOT NULL,
        PRIMARY KEY(id_professor)
    )ENGINE = INNODB;

-- Cria a tabela de Cursos
    CREATE TABLE cursos(
        id_curso INT NOT NULL AUTO_INCREMENT,
        nome VARCHAR(60) NOT NULL,
        data_criacao DATE NOT NULL,
        id_professor INT NOT NULL DEFAULT '0',
        PRIMARY KEY(id_curso)
    )ENGINE = INNODB;
    
-- Cria a tabela de Alunos
    CREATE TABLE alunos(
        id_aluno INT NOT NULL AUTO_INCREMENT,
        nome VARCHAR(70) NOT NULL,
        data_nascimento DATE NOT NULL,
        logradouro VARCHAR(70) NOT NULL,
        numero INT NOT NULL,
        bairro VARCHAR(40) NOT NULL,
        cidade VARCHAR(40) NOT NULL,
        estado VARCHAR(30) NOT NULL,
        data_criacao DATE NOT NULL,
        cep INT NOT NULL,
        id_curso INT NOT NULL DEFAULT '0',
        PRIMARY KEY(id_aluno)
    )ENGINE = INNODB;