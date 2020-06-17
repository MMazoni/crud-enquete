--CREATE DATABASE IF NOT EXISTS `enquete` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use enquete;

create table if not exists Enquetes (
    id_enquete int(5) not null auto_increment,
    titulo text collate utf8mb4_unicode_ci not null,
    dt_inicio datetime not null,
    dt_termino datetime not null,
    id_status int(5) not null,
    primary key(id_enquete)
);

create table if not exists Estados (
    id_status int(5) not null auto_increment,
    descricao text collate utf8mb4_unicode_ci not null,
    primary key(id_status)
);

create table if not exists Opcoes (
    id_opcao int(5) not null auto_increment,
	id_enquete int(5) not null,
    nome text collate utf8mb4_unicode_ci not null,
    qnt_votos int(5) default 0 not null,
    primary key(id_opcao)
);

alter table Enquetes
	add constraint FK_id_status
	foreign key (id_status) references Estados(id_status);

alter table Opcoes
	add constraint FK_id_enquete
	foreign key (id_enquete) references Enquetes(id_enquete);

ALTER TABLE Enquetes 
DEFAULT CHARSET=utf8;

ALTER TABLE Opcoes 
DEFAULT CHARSET=utf8;

ALTER TABLE Estados 
DEFAULT CHARSET=utf8;

insert into Estados (descricao)
	values ('Não iniciada');

insert into Estados (descricao)
	values ('Em andamento');

insert into Estados (descricao)
	values ('Finalizada');

insert into Enquetes(titulo, dt_inicio, dt_termino, id_status)
	values ('Qual é a melhor vitamina?', '2020-06-10', '2020-06-16', 2);

insert into Enquetes(titulo, dt_inicio, dt_termino, id_status)
	values ('Qual é o melhor vilão da Marvel?', '2020-06-16', '2020-06-18', 2);

insert into Enquetes(titulo, dt_inicio, dt_termino, id_status)
	values ('Qual é a melhor matéria?', '2020-06-20', '2020-06-21', 3);

insert into Enquetes(titulo, dt_inicio, dt_termino, id_status)
	values ('Qual é a melhor planeta?', '2020-06-10', '2020-06-21', 3);

insert into Opcoes(id_enquete, nome, qnt_votos)
	values (1, 'Vitamina C', 4);

insert into Opcoes(id_enquete, nome, qnt_votos)
	values (1, 'Vitamina A', 10);
	
insert into Opcoes(id_enquete, nome, qnt_votos)
	values (1, 'Vitamina B12', 1);
	
insert into Opcoes(id_enquete, nome, qnt_votos)
	values (1, 'Vitamina D', 7);

insert into Opcoes(id_enquete, nome, qnt_votos)
	values (2, 'Loki', 13);
	
insert into Opcoes(id_enquete, nome, qnt_votos)
	values (2, 'Thanus', 20);
	
insert into Opcoes(id_enquete, nome, qnt_votos)
	values (2, 'Galactus', 18);

insert into Opcoes(id_enquete, nome, qnt_votos)
	values (3, 'Matemática', 10);

insert into Opcoes(id_enquete, nome, qnt_votos)
	values (3, 'Geografia', 1);

insert into Opcoes(id_enquete, nome, qnt_votos)
	values (3, 'Português', 13);

insert into Opcoes(id_enquete, nome, qnt_votos)
	values (3, 'Biologia', 5);

insert into Opcoes(id_enquete, nome, qnt_votos)
	values (3, 'Química', 20);

insert into Opcoes(id_enquete, nome, qnt_votos)
	values (4, 'Plutão', 1);