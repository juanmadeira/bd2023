--- tabelas

create table funcionarios(
id serial primary key,
nome varchar(50) not null,
funcao varchar(50) not null
);

create table medicamentos(
id serial primary key,
nome varchar(50) not null,
laboratorio varchar(50) not null,
preco numeric(10,2) not null check(preco > 0),
quant integer not null check(quant > 0)
);

create table clientes(
id serial primary key not null,
nome varchar(50) not null,
endereco varchar(50) not null
);

create table compras(
id serial primary key not null,
funcionario integer not null,
foreign key(funcionario) references funcionarios(id),
medicamento integer not null,
foreign key(medicamento) references medicamentos(id),
cliente integer not null,
foreign key(cliente) references clientes(id),
data_compra timestamp not null
);

--- populando as tabelas

insert into funcionarios(nome, funcao) values('Sarah','Farmacêutica');
insert into funcionarios(nome, funcao) values('Théo', 'Farmacêutico');
insert into funcionarios(nome, funcao) values('Murillo', 'Vigia do Estacionamento');
insert into funcionarios(nome, funcao) values('Miguel', 'Limpador de Para-brisa');
insert into funcionarios(nome, funcao) values('Juan', 'Gerenciador da música ambiente');

insert into medicamentos(nome, laboratorio, preco, quant) values('Zolpidem', 'Sandoz', '45.00', '13');
insert into medicamentos(nome, laboratorio, preco, quant) values('Gabiracetamol', 'São Miguel', '60.00', '2');
insert into medicamentos(nome, laboratorio, preco, quant) values('Rianflex', 'TrevoLab', '120.00', '6');
insert into medicamentos(nome, laboratorio, preco, quant) values('Kauagloss', 'Kauacêutica', '45.00', '8');
insert into medicamentos(nome, laboratorio, preco, quant) values('Omeprasarah', 'CrimsomLab', '45.00', '8');

insert into clientes(nome, endereco) values('Julian Casablancas', 'R. Casa de Fogo, 1251');
insert into clientes(nome, endereco) values('Vitor Brauer', 'R. Somewhere in Maceió, 42');
insert into clientes(nome, endereco) values('Renato Manfredini Jr.', 'Av. Atlântica, 990');
insert into clientes(nome, endereco) values('João Gabriel', 'R. Waitingformetal, 666');
insert into clientes(nome, endereco) values('Taylor José', 'R. Dema, 777');
insert into clientes(nome, endereco) values('Anya Taylor Joy', 'R. Bonita, 42069');

insert into compras(funcionario, medicamento, cliente, data_compra) values ('2', '4', '2', '2023-06-01 02:23:52');
insert into compras(funcionario, medicamento, cliente, data_compra) values ('1', '5', '6', '2023-05-01 06:09:42');
insert into compras(funcionario, medicamento, cliente, data_compra) values ('2', '1', '4', '2023-05-12 15:03:02');
insert into compras(funcionario, medicamento, cliente, data_compra) values ('1', '2', '3', '2023-05-15 18:45:33');
insert into compras(funcionario, medicamento, cliente, data_compra) values ('2', '3', '5', '2023-06-02 08:13:15');

--- selects
select * from funcionarios;
select * from compras order by(data_compra);
select * from clientes order by(nome);
select * from medicamentos where quant = (select max(quant) from medicamentos);
select * from medicamentos where quant = (select min(quant) from medicamentos);
select * from medicamentos where preco = (select max(preco) from medicamentos);
select sum(quant) from medicamentos;

--- abandonar tabelas
drop table funcionarios, medicamentos, clientes, compras;
