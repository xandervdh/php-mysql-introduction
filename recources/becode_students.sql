create table students
(
    id         int auto_increment
        primary key,
    first_name varchar(255)                        not null,
    last_name  varchar(255)                        not null,
    email      varchar(255)                        not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    password   varchar(255)                        not null,
    image      varchar(255)                        not null
);

INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (61, 'Xander', 'Van der Herten', 'x@x.x', '2020-10-29 10:00:27', '$2y$10$d7ZxGJtuPybuoB6wTQn/DumSLMLBrSEMPdv5cfXztsgasGDua9x2u', 'https://cdn2.thecatapi.com/images/avb.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (62, 'Cis', 'Magito', 'cis@duck.be', '2020-10-29 10:04:06', '$2y$10$goBKdS5rF.2x0l8JuPTyo.D6zUQ5aa87hNdLWZVUUJD4QKQcNz1lG', 'https://cdn2.thecatapi.com/images/1f6.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (63, 'Whitney', 'Kaiboni', 'whitney@hotmail.com', '2020-10-29 10:04:42', '$2y$10$X1fSTLhC2g97AhjeDZMlJOVTIUjyXkwrP3j2xnsfYsrjXQjCYqexi', 'https://cdn2.thecatapi.com/images/MjA1MDIzMg.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (64, 'frank', 'de tank', 'drugs@comeandget.it', '2020-10-29 10:07:34', '$2y$10$Dd/sLEiRcXrOKGPs27ycwumA7SmKQhXQQ2LFfwN9BoLUSNonAFfUO', 'https://cdn2.thecatapi.com/images/efu.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (65, 'tessa', 'van mol', 'mlkj@mlkj.be', '2020-10-29 10:10:48', '$2y$10$D7QbhpVezjunIBmwbM7N8eSGoZOCqdwWkI3Ctdt05ek4Y1Q9.TX1i', 'https://cdn2.thecatapi.com/images/ani.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (66, 'Sicco', 'smit', 'sick@o.be', '2020-10-29 10:11:08', '$2y$10$cLVfPJdbID.o8fP9kAw7GeEvnkQMksygpDtQNPQLJieCip2K0TwdC', 'https://cdn2.thecatapi.com/images/93b.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (67, 'kayalin', 'becode', 'kaya@lin.com', '2020-10-29 10:11:26', '$2y$10$CKWIScWFXF3Y9.pJaJ8DmOoGSMfonxn.GgiZHhjtbjKKrIoKOPcl2', 'https://cdn2.thecatapi.com/images/cs7.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (68, 'dwayne', 'bock', 'd@wayne.com', '2020-10-29 10:11:47', '$2y$10$z5ZBWpx8DuTXoG/cNxkF.eiMEBO.lsts0Jqh7iH/cpCsUPVh/vofm', 'https://cdn2.thecatapi.com/images/d96ktWl7w.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (69, 'lea', 'something', 'lea@starwars.com', '2020-10-29 10:12:05', '$2y$10$B/RnMpJ9snabRebvYwvDMur8Ypglgcpyz8dFk2B/iLrdNwrSFJO.W', 'https://cdn2.thecatapi.com/images/242.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (70, 'nikita', 'russian', 'nikita@belgium.ru', '2020-10-29 10:12:50', '$2y$10$LLjETK96zvgoN7ggX4yu4u6kJn.RdCwJP.8L1fpImzQP4StK1mlxq', 'https://cdn2.thecatapi.com/images/xm7DwPPR2.jpg');
INSERT INTO becode.students (id, first_name, last_name, email, created_at, password, image) VALUES (71, 'hendrik', 'cromboon', 'hendrik@becode.be', '2020-10-29 10:21:51', '$2y$10$uqnDferSNX3Wp6MxuQjADO61Kzd00AePaWov/2DcYpD2U.CZhYHJi', 'https://cdn2.thecatapi.com/images/as1.jpg');