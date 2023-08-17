-- cria tabela Assinante
create table Assinante (
    cd_assinante serial primary key,
    nm_assinante varchar(100),
    mun_assinante int not null,
    ramo_assinante int not null,
    tip_assinante int not null,
    ende_assinante int not null
);

insert into Assinante (nm_assinante, tip_assinante, mun_assinante, ramo_assinante, ende_assinante) values
('Laura Palmer', 2, 5, 2, 1),
('Dale Cooper', 1, 2, 5, 2);

-- cria a tabela Tipo_Assinante
create table Tipo_Assinante (
    cd_tipo serial primary key,
    ds_tipo varchar(100) not null
);

insert into tipo_assinante (ds_tipo) values
('Comercial'),
('Residencial');

-- cria a tabela Ramo_Atividade
create table Ramo_Atividade (
    cd_ramo serial primary key,
    ds_ramo varchar(100) not null
);

insert into Ramo_Atividade (ds_ramo) values
('generic_ds_ramo1'),
('generic_ds_ramo2'),
('generic_ds_ramo3'),
('generic_ds_ramo4'),
('generic_ds_ramo5');

-- cria a tabela Municipio
create table Municipio (
    cd_municipio serial primary key,
    ds_municipio varchar(100) not null
);

insert into municipio (ds_municipio) values
('generic_ds_municipio1'),
('Porto Alegre'),
('generic_ds_municipio3'),
('generic_ds_municipio4'),
('Pelotas'),
('generic_ds_municipio6'),
('generic_ds_municipio7'),
('generic_ds_municipio8'),
('generic_ds_municipio9'),
('generic_ds_municipio0');

-- cria a tabela Endereco
create table Endereco (
    cd_endereco serial primary key,
    ds_endereco varchar(100) not null,
    complemento varchar(100),
    bairro varchar(100) not null,
    cep int not null,
    mun_ende int not null
);

-- cria tabela Telefone
create table Telefone (
    cd_fone serial primary key,
    ddd int not null,
    n_fone int not null,
    assinante_fone int not null
);

-- popula a tabela de telefones
insert into telefone (ddd, n_fone, assinante_fone) values
(53, 941598756, 1),
(54, 924679184, 1),
(53, 981427356, 2);

-- popula a tabela de endereços
insert into endereco (ds_endereco, complemento, bairro, cep, mun_ende) values
('Rua Falls Avenue', 'Restaurante Double R Diner', 'Main Street', '90880020', 5),
('Rua Not Far', 'Taverna Roadhouse', 'Main Street', '93347320', 2);

--listar os nomes dos assinantes, seguido dos dados do endereço e os telefones correspondentes.
select nm_assinante as nome, e.ds_endereco as endereco, t.n_fone as contato from assinante join endereco e on e.cd_endereco = ende_assinante join telefone t on t.assinante_fone = cd_assinante;

--listar os nomes dos assinantes, seguido do seu ramo, ordenados por ramo e posteriormente por nome.
select nm_assinante as nome, r.ds_ramo as ramo from assinante join ramo_atividade r on r.cd_ramo = ramo_assinante order by ds_ramo, nm_assinante;

--listar os assinantes do município de pelotas que são do tipo residencial.
select nm_assinante as nome from assinante where tip_assinante = (select cd_tipo from tipo_assinante where ds_tipo = 'residencial') and mun_assinante = (select cd_municipio from municipio where ds_municipio = 'pelotas');

--listar os nomes dos assinantes que possuem mais de um telefone.
select nm_assinante as nome from assinante where (select cd_assinante = (select assinante_fone from telefone group by assinante_fone having count(assinante_fone)>1));

--listar os nomes dos assinantes seguido do número do telefone, tipo de assinante comercial, com endereço em porto alegre.
select nm_assinante as nome, t.n_fone as contato from assinante join telefone t on cd_assinante = t.assinante_fone where tip_assinante = (select cd_tipo from tipo_assinante where ds_tipo = 'comercial') and mun_assinante = (select cd_municipio from municipio where ds_municipio = 'porto alegre');

-- exclui as tabelas
drop table Municipio, Endereco, Ramo_Atividade, Tipo_Assinante, Telefone, Assinante;