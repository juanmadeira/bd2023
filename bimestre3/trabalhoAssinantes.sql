-- cria tabela Ramo_Atividade
create table Ramo_Atividade (
    cd_ramo serial primary key,
    ds_ramo varchar(90) not null
);

insert into Ramo_Atividade (ds_ramo) values
('Descricao 1'),
('Descricao 2'),
('Descricao 3'),
('Descricao 4');

-- cria tabela Tipo_Assinante
create table Tipo_Assinante (
    cd_tipo serial primary key,
    ds_tipo varchar(90) not null
);

insert into Tipo_Assinante (ds_tipo) values
('Comercial'),
('Residencial');

-- cria tabela Municipio
create table Municipio (
    cd_municipio serial primary key,
    ds_municipio varchar(100) not null
);

insert into Municipio (ds_municipio) values
('Pelotas'),
('Porto Alegre');

-- cria tabela Endereco
create table Endereco (
    cd_endereco serial primary key,
    ds_endereco varchar(100) not null,
    complemento varchar(100),
    bairro varchar(100) not null,
    cep int not null
);

insert into Endereco (ds_endereco, complemento, bairro, cep) values
('Rua Falls Avenue', 'Restaurante RR', 'Main Street', '90880020'),
('Rua Not Far', 'Taverna Roadhouse', 'Main Street', '93347320'),
('Rua GN Highway', 'Hotel Great Northern', 'White Tail Falls', '93420280'),
('Rua Highway 21', 'Posto de Gasolina', 'Lower Town', '92110400');

-- cria tabela de Telefone
create table Telefone (
    cd_fone serial primary key,
    ddd int not null,
    n_fone int not null,
    assinante_fone int not null
);

insert into Telefone (ddd, n_fone, assinante_fone) values
('53', '941598756', '1'),
('53', '924679184', '2'),
('53', '981427356', '3'),
('53', '997846221', '4');

-- cria tabela Assinante
create table Assinante (
    cd_assinante serial primary key,
    nm_assinante varchar(20) not null
);

insert into Assinante (nm_assinante) values
('Laura Palmer'),
('Audrey Horne'),
('Donna Hayward'),
('Dale Cooper');

--listar os nomes dos assinantes, seguido dos dados do endereço e os telefones correspondentes.
select a.nm_assinante, e.ds_endereco, e.complemento, e.bairro, e.cep, t.ddd, t.n_fone
from Assinante a
join Telefone t on a.cd_assinante = t.assinante_fone
join Endereco e on t.assinante_fone = e.cd_endereco;

--listar os nomes dos assinantes, seguido do seu ramo, ordenados por ramo e posteriormente por nome.
select a.nm_assinante, r.ds_ramo
from Assinante a
join Ramo_Atividade r on a.cd_assinante = r.cd_ramo
order by r.ds_ramo, a.nm_assinante;

--listar os assinantes do município de pelotas que são do tipo residencial.
select a.nm_assinante, m.ds_municipio, ta.ds_tipo
from Assinante a
join Municipio m on a.cd_municipio = m.cd_municipio
join Tipo_Assinante ta on a.cd_tipo = ta.cd_tipo
where m.ds_municipio = 'Pelotas' and ta.ds_tipo = 'Residencial';

--listar os nomes dos assinantes que possuem mais de um telefone.
select a.nm_assinante
from Assinante a
join Telefone t on a.cd_assinante = t.assinante_fone
group by a.nm_assinante
having count(t.cd_fone) > 1;

--listar os nomes dos assinantes seguido do número do telefone, tipo de assinante comercial, com endereço em Porto Alegre.
select a.nm_assinante, t.ddd || ' ' || t.n_fone as telefone, ta.ds_tipo as tipo_assinante
from Assinante a
join Telefone t on a.cd_assinante = t.assinante_fone
join Tipo_Assinante ta on a.cd_assinante % 2 + 1 = ta.cd_tipo
join Endereco e on t.assinante_fone = e.cd_endereco
join Municipio m on e.ds_municipio = m.cd_municipio
where ta.ds_tipo = 'Comercial' and m.ds_municipio = 'Porto Alegre';

-- exclui as tabelas
drop table Assinante, Ramo_Atividade, Tipo_Assinante, Municipio, Endereco, Telefone;