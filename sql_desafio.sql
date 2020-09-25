create database desafio_iboss;
use desafio_iboss;

create table Produto (
	codigo int auto_increment primary key not null,
	nome varchar(100) not null,
    url_imagem varchar(200) not null,
    preco decimal(8,2) not null,
    descricao varchar(200) not null,
    quantidade int not null
)
engine InnoDB;

create table Categoria (
	codigo int auto_increment primary key not null,
	nome varchar(100) not null
)
engine InnoDB;

create table produto_categoria (
	codigo int not null auto_increment primary key,
	codigo_produto int not null,
	codigo_categoria int not null,
    constraint fk_produto foreign key(codigo_produto) references produto(codigo),
	constraint fk_categoria foreign key(codigo_categoria) references categoria(codigo)
)
engine = InnoDB;

create table log_acoes (
	codigo int auto_increment primary key,
    codigo_tabela int not null,
    tabela varchar(10),
	descricao enum('inserção','exclusão','alteração'),
	dia_hora timestamp default now()
)
engine InnoDB;
