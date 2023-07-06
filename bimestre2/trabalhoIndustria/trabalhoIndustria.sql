create table pecas (
    id_peca serial primary key, 
    nome_peca varchar(20) not null,
    peso_peca real not null check(peso_peca > 0),
    cor_peca varchar(15) not null
);

insert into pecas (nome_peca, peso_peca, cor_peca) values
('Prego', 2, 'Metálica'),
('Parafuso', 4, 'Platinado'),
('Porca', 4, 'Metállica'),
('Chapa', 2000, 'Cobre');

create table depositos (
    id_deposito serial primary key, 
    desc_deposito varchar(50) not null,
    endereco_deposito varchar(45) not null
);

insert into depositos (desc_deposito, endereco_deposito) values
('Depósito um', 'R. dos depósitos, 1'),
('Depósito dois', 'R. dos depósitos, 2'),
('Depósito três', 'R. dos depósitos, 3'),
('Depósito quatro', 'R. dos depósitos, 4');

create table fornecedores (
    id_fornecedor serial primary key, 
    nome_fornecedor varchar(30) not null,
    endereco_fornecedor varchar(45) not null
);

insert into fornecedores (nome_fornecedor, endereco_fornecedor) values
('Wellington', 'R. dos fornecedores, 420'),
('Geison','R. dos fornecedores, 666'),
('Edimilson','R. dos fornecedores, 69'),
('Rozele','Pelotas');

create table projetos (
    id_projeto serial primary key, 
    desc_projeto varchar(50) not null,
    orcamento_projeto real not null check(orcamento_projeto > 0)
);

insert into projetos (desc_projeto, orcamento_projeto) values
('Ateliê', 0.1),
('"Neve"', 1000000),
('Extermínio total da população gaúcha', 13000),
('Formação da nova banda da cena emo gaúcha', 1000000000000000);

create table funcionarios (
    id_funcionario serial primary key, 
    nome_funcionario varchar(30) not null,
    salario_funcionario real not null check(salario_funcionario > 0)
);

insert into funcionarios (nome_funcionario, salario_funcionario) values
('Miguel', 2.00),
('Isabella', 2000.00),
('Murillo', 1500.00),
('Sarah', 69.00);

create table departamentos (
    id_departamento serial primary key, 
    setor_departamento int not null
);

insert into departamentos (setor_departamento) values
(1),
(2),
(3),
(4);

create table telefones (
    id_tel serial primary key, 
    num_tel varchar(11) not null,
    id_funcionarios int references funcionarios
);

insert into telefones (num_tel, id_funcionarios) values
(53991250073, 1),
(53981202921, 2),
(53981286971, 3),
(53997160509, 4);

create table fornece (
    id serial primary key,
    id_peca int references pecas,
    id_fornecedor int references fornecedores
);

insert into fornece (id_peca, id_fornecedor) values
(1, 1),
(2, 2),
(3, 3),
(4, 4);

create table emprega (
    id serial primary key,
    id_projetos int references projetos,
    id_fornecedores int references fornecedores
);

insert into emprega (id_projetos, id_fornecedores) values
(1, 1),
(2, 2),
(3, 3),
(4, 4);

create table pertence (
    id serial primary key,
    id_funcionarios int references funcionarios,
    id_projetos int references projetos
);

insert into pertence (id_funcionarios, id_projetos) values
(1, 1),
(2, 2),
(3, 3),
(4, 4);

create table usa (
    id serial primary key,
    id_pecas int references pecas,
    id_projetos int references projetos,
    id_funcionarios int references funcionarios
);

insert into usa (id_pecas, id_projetos) values
(1, 1),
(2, 2),
(3, 3),
(4, 4);

create table contem (
    id serial primary key,
    id_projetos int references projetos,
    id_departamentos int references departamentos
);

insert into contem (id_projetos, id_departamentos) values
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- i) apresente os telefones de um dado funcionário, pelo nome do funcionário
select f.nome_funcionario as funcionário,
num_tel as telefone from telefones
join funcionarios f on id_funcionarios = f.id_funcionario;

-- ii) apresente os nomes dos funcionários que estão vinculados a um projeto, pelo nome do projeto.
select f.nome_funcionario as funcionário,
pr.desc_projeto as projeto
from pertence
join funcionarios f on id_funcionarios = f.id_funcionario
join projetos pr on id_projetos = pr.id_projeto;

-- iii) quantos funcionários estão vinculados a este projeto?
select count(id_funcionarios) as funcionários
from pertence
where id_projetos = 1;

-- iv) quais são as peças utilizadas no projeto xxx do funcionário yyy?
select p.nome_peca as peça,
pr.desc_projeto as projeto from usa
join pecas p on id_pecas = p.id_peca
join projetos pr on id_projetos = pr.id_projeto
where id_projeto = 1;

-- v) quais são os fornecedores deste mesmo projeto do item iv?
select fo.nome_fornecedor as fornecedor,
pr.desc_projeto as projeto
from emprega
join fornecedores fo on id_fornecedores = fo.id_fornecedor
join projetos pr on id_projetos = pr.id_projeto
where id_projeto = 1;

-- vi) no departamento y, apresentar quem é o funcionário de maior salário, apresentar o nome do projeto e qual departamento.
select f.nome_funcionario as funcionario,
pr.desc_projeto as projeto from pertence
join projetos pr on id_projetos = pr.id_projeto
join funcionarios f on id_funcionarios = f.id_funcionario
where salario_funcionario = (
    select max(salario_funcionario)
    from funcionarios
);

-- vii) apresentar os funcionários que tem salário acima de média
select nome_funcionario as funcionário,
salario_funcionario as salário
from funcionarios
where salario_funcionario >= (
    select avg (salario_funcionario) 
    from funcionarios
);

-- viii) apresentar os projetos dos funcionários e peças vinculadas dos funcionários que tem salário acima da média.
select f.nome_funcionario as funcionário, p.nome_peca as peças, pr.desc_projeto as projeto
from funcionarios f
join pertence pt on f.id_funcionario = pt.id_funcionarios
join projetos pr on pt.id_projetos = pr.id_projeto
join usa u on pr.id_projeto = u.id_projetos
join pecas p on u.id_pecas = p.id_peca
where f.salario_funcionario >= (
    select avg (salario_funcionario)
    from funcionarios
);

-- ix) apresente um departamento, todos os projetos relacionados a este departamento e todos os funcionários relacionados a estes projetos.
select d.setor_departamento as "nº departamento",
pr.desc_projeto as projeto,
f.nome_funcionario as funcionário
from departamentos d
join contem c on d.id_departamento = c.id_departamentos
join projetos pr on c.id_projetos = pr.id_projeto
join pertence pt on pr.id_projeto = pt.id_projetos
join funcionarios f on pt.id_funcionarios = f.id_funcionario;

drop table fornece, emprega, pertence, usa, contem, pecas, depositos, fornecedores, projetos, telefones, funcionarios, departamentos;