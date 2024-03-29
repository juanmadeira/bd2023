create database bd2023;
-- \c bd2023 

create table Itens (
    id_item serial primary key,
    nome_item varchar(50) not null,
    qtd_item int not null,
    preco_item numeric(10, 2) not null
);

insert into Itens (nome_item, qtd_item, preco_item) values
('Contrabaixo Strinberg Precision', '2', '1299.99'),
('Guitarra Epiphone SG', '0', '6499.99'),
('Guitarra Fender Jazzmaster', '7', '7499.99'),
('Guitarra Tagima MG30 Stratocaster', '16', '769.99');