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

-- cria tabela Ramo_Atividade
create table Ramo_Atividade (
    cd_ramo serial primary key,
    ds_ramo varchar(90) not null
);

insert into Ramo_Atividade (ds_ramo) values
('Descrição 1'),
('Descrição 2'),
('Descrição 3'),
('Descrição 4');

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
('Rua Falls Avenue', 'Restaurante Double R Diner', 'Main Street', '90880020'),
('Rua Not Far', 'Taverna Roadhouse', 'Main Street', '93347320'),
('Rua Great Northern Highway', 'Hotel Great Northern', 'White Tail Falls', '93420280'),
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

--listar os nomes dos assinantes, seguido dos dados do endereço e os telefones correspondentes.
select nm_assinante as nome,
e.ds_endereco as endereco,
t.n_fone as contato from Assinante
join endereco e on e.cd_endereco = cd_assinante
join telefone t on t.assinante_fone = cd_assinante;

--listar os nomes dos assinantes, seguido do seu ramo, ordenados por ramo e posteriormente por nome.
select nm_assinante as nome,
r.ds_ramo as ramo from Assinante
join ramo_atividade r on r.cd_ramo = ramo_assinante
order by ds_ramo, nm_assinante;

--listar os assinantes do município de pelotas que são do tipo residencial.
select nm_assinante as nome from Assinante where Tipo_Assinante = (
    select cd_tipo from tipo_assinante where ds_tipo = 'Residencial'
)
and ende_assinante = (
    select cd_municipio from Municipio where ds_municipio = 'Pelotas'
);

--listar os nomes dos assinantes que possuem mais de um telefone.
select nm_assinante as nome from Assinante where (
    select count(cd_assinante = (select cd_fone from telefone)) from Assinante
) > 1;

--listar os nomes dos assinantes seguido do número do telefone, tipo de assinante comercial, com endereço em Porto Alegre.
select nm_assinante as nome,
t.n_fone as contato from Assinante
join telefone t on cd_assinante = t.assinante_fone where cd_assinante = (
    select cd_tipo from Tipo_Assinante where ds_tipo = 'Comercial'
)
and cd_assinante = (select cd_municipio from municipio where ds_municipio = 'Porto Alegre');

-- exclui as tabelas
drop table Assinante, Ramo_Atividade, Tipo_Assinante, Municipio, Endereco, Telefone;