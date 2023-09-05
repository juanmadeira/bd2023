create table Artista (
    id_artista serial primary key,
    nome_artista varchar(50) not null
);

insert into Artista (nome_artista) values
('El Toro Fuerte'),
('Legião Urbana'),
('Lupe de Lupe'),
('Radiohead');

create table Album (
    id_album serial primary key,
    nome_album varchar(100) not null
);

insert into Album (nome_album) values
('Um Tempo Lindo Para Estar Vivo'),
('Dois'),
('Quarup'),
('Kid A');