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
('Ramo 1'),
('Ramo 2'),
('Ramo 3'),
('Ramo 4');

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
(53, 941598756, 1),
(53, 963297511, 1),
(53, 924679184, 2),
(53, 981427356, 3),
(53, 997846221, 4);

-- tabelas de relações
--cria tabela ass_ramo
create table ass_ramo (
    cd_ass_ramo serial primary key,
    cd_assinantes int references Assinante,
    cd_ramos int references Ramo_Atividade
);

insert into ass_ramo (cd_assinantes, cd_ramos) values
(1, 3),
(2, 4),
(3, 2),
(4, 1);

-- cria tabela ass_tipo
create table ass_tipo (
    cd_ass_tipo serial primary key,
    cd_assinantes int references Assinante,
    cd_tipos int references Tipo_Assinante
);

insert into ass_tipo (cd_assinantes, cd_tipos) values
(1, 2),
(2, 2),
(3, 2),
(4, 1);

-- cria tabela ass_end
create table ass_end (
    cd_ass_end serial primary key,
    cd_assinantes int references Assinante,
    cd_enderecos int references Endereco
);

insert into ass_end (cd_assinantes, cd_enderecos) values
(1, 1),
(2, 4),
(3, 3),
(4, 2);

-- cria tabela end_munic
create table end_munic (
    cd_end_munic serial primary key,
    cd_enderecos int references Endereco,
    cd_municipios int references Municipio
);

insert into end_munic (cd_enderecos, cd_municipios) values
(1, 2),
(2, 2),
(3, 1),
(4, 1);

-- cria tabela end_fone
create table end_fone (
    cd_end_fone serial primary key,
    cd_enderecos int references Endereco,
    cd_fones int references Telefone
);

insert into end_fone (cd_enderecos, cd_fones) values
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- a) listar os nomes dos assinantes, seguido dos dados do endereço e os telefones correspondentes.
select a.nm_assinante as nome, e.ds_endereco as endereco, e.complemento, e.bairro, e.cep, t.ddd, t.n_fone as telefone
from Assinante a
join ass_end ae on a.cd_assinante = ae.cd_assinantes
join Endereco e on ae.cd_enderecos = e.cd_endereco
join end_fone ef on e.cd_endereco = ef.cd_enderecos
join Telefone t on ef.cd_fones = t.cd_fone;

-- b) listar os nomes dos assinantes, seguido do seu ramo, ordenados por ramo e posteriormente por nome.
select a.nm_assinante as nome, ra.ds_ramo as ramo
from Assinante a
join ass_ramo ar on a.cd_assinante = ar.cd_assinantes
join Ramo_Atividade ra on ar.cd_ramos = ra.cd_ramo
order by ra.ds_ramo, a.nm_assinante;

-- c) listar os assinantes do município de pelotas que são do tipo residencial.
select a.nm_assinante as nome
from Assinante a
join ass_end ae on a.cd_assinante = ae.cd_assinantes
join Endereco e on ae.cd_enderecos = e.cd_endereco
join end_munic em on e.cd_endereco = em.cd_enderecos
join Municipio m on em.cd_municipios = m.cd_municipio
join ass_tipo at on a.cd_assinante = at.cd_assinantes
join Tipo_Assinante ta on at.cd_tipos = ta.cd_tipo
where m.ds_municipio = 'Pelotas' and ta.ds_tipo = 'Residencial';

-- d) listar os nomes dos assinantes que possuem mais de um telefone.
select nm_assinante as nome
from Assinante
where (
    select cd_assinante = (
        select assinante_fone from telefone group by assinante_fone having count(assinante_fone) > 1
    )
);

-- e) listar os nomes dos assinantes seguido do número do telefone, tipo de assinante comercial, com endereço em porto alegre.
select a.nm_assinante as nome, t.ddd || ' ' || t.n_fone as telefone
from Assinante a
join ass_end ae on a.cd_assinante = ae.cd_assinantes
join Endereco e on ae.cd_enderecos = e.cd_endereco
join end_munic em on e.cd_endereco = em.cd_enderecos
join Municipio m on em.cd_municipios = m.cd_municipio
join ass_tipo at on a.cd_assinante = at.cd_assinantes
join Tipo_Assinante ta on at.cd_tipos = ta.cd_tipo
join end_fone ef on e.cd_endereco = ef.cd_enderecos
join Telefone t on ef.cd_fones = t.cd_fone
where m.ds_municipio = 'Porto Alegre' and ta.ds_tipo = 'Comercial';

-- exclui as tabelas
drop table Assinante, Ramo_Atividade, Tipo_Assinante, Municipio, Endereco, Telefone, ass_ramo, ass_tipo, ass_end, end_munic, end_fone;