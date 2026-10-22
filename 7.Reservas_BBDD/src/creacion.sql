-- Creamos la base de datos y la seleccionamos
CREATE DATABASE IF NOT EXISTS gestion_reservas;
USE gestion_reservas;
-- 1. Tabla de Usuarios (Evita repetir el nombre y email por cada reserva)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE
);
-- 2. Tabla de Pistas (Catálogo de pistas disponibles)
CREATE TABLE pistas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);
-- Insertamos las pistas base
INSERT INTO pistas (nombre)
VALUES ('Padel 1'),
    ('Padel 2'),
    ('Tenis'),
    ('Baloncesto');
-- 3. Tabla de Materiales (Catálogo de materiales para prestar)
CREATE TABLE materiales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);
-- Insertamos los materiales base
INSERT INTO materiales (nombre)
VALUES ('raqueta'),
    ('balon'),
    ('petos');
-- 4. Tabla Principal de Reservas (Conecta usuario, pista y fecha)
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    pista_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    normas_aceptadas BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (pista_id) REFERENCES pistas(id) ON DELETE CASCADE,
    -- Evitamos que se reserve la misma pista el mismo día a la misma hora
    UNIQUE KEY pista_ocupada (pista_id, fecha, hora)
);
-- 5. Tabla Intermedia Reserva-Material (Relación Muchos a Muchos)
-- Una reserva puede tener varios materiales, y un material estar en varias reservas
CREATE TABLE reserva_materiales (
    reserva_id INT NOT NULL,
    material_id INT NOT NULL,
    PRIMARY KEY (reserva_id, material_id),
    FOREIGN KEY (reserva_id) REFERENCES reservas(id) ON DELETE CASCADE,
    FOREIGN KEY (material_id) REFERENCES materiales(id) ON DELETE CASCADE
);
-- Insertamos datos en las tablas: USE gestion_reservas;
-- 1. Insertar Usuarios
INSERT INTO usuarios (id, nombre, email)
VALUES (1, 'mario', 'mario@gmail.com'),
    (2, 'lucia', 'lucia88@hotmail.com'),
    (3, 'carlos', 'carlos_dev@gmail.com'),
    (4, 'ana', 'ana.martinez@empresa.es'),
    (5, 'david', 'david.gamer@yahoo.com'),
    (6, 'elena', 'elenita_99@gmail.com'),
    (7, 'jorge', 'jorge.lopez@outlook.com'),
    (8, 'sara', 'sara_fit@gmail.com'),
    (9, 'pablo', 'pablo.ruiz@gmail.com'),
    (10, 'marta', 'marta_g@hotmail.com'),
    (11, 'Mario', 'mr.zanahorio07@gmail.com'),
    (12, 'mgutval', 'mgutval@g.educaand.es');
-- 2. Insertar Reservas
-- Las pistas (pista_id) corresponden a: 1=Padel 1, 2=Padel 2, 3=Tenis, 4=Baloncesto
INSERT INTO reservas (
        id,
        usuario_id,
        pista_id,
        fecha,
        hora,
        normas_aceptadas
    )
VALUES (1, 1, 1, '2026-10-11', '16:00:00', TRUE),
    (2, 2, 3, '2026-10-12', '17:00:00', TRUE),
    (3, 3, 4, '2026-10-13', '20:00:00', TRUE),
    (4, 4, 2, '2026-10-14', '21:00:00', TRUE),
    (5, 5, 4, '2026-10-14', '18:00:00', TRUE),
    (6, 6, 3, '2026-10-15', '17:00:00', TRUE),
    (7, 7, 1, '2026-10-15', '19:00:00', TRUE),
    (8, 8, 2, '2026-10-16', '19:00:00', TRUE),
    (9, 9, 4, '2026-10-17', '21:00:00', TRUE),
    (10, 10, 1, '2026-10-18', '16:00:00', TRUE),
    (11, 11, 1, '2026-10-11', '17:00:00', TRUE),
    (12, 12, 1, '2026-10-20', '16:00:00', TRUE);
-- 3. Insertar la relación entre Reservas y Materiales
-- Los materiales (material_id) corresponden a: 1=raqueta, 2=balon, 3=petos
-- (Se omiten las reservas 4, 6 y 8 porque tenían "ninguno")
INSERT INTO reserva_materiales (reserva_id, material_id)
VALUES (1, 1),
    -- Reserva 1: raqueta
    (2, 1),
    (2, 2),
    -- Reserva 2: raqueta, balon
    (3, 2),
    -- Reserva 3: balon
    (5, 2),
    -- Reserva 5: balon
    (7, 1),
    -- Reserva 7: raquetas (asociado al ID de raqueta)
    (9, 3),
    (9, 2),
    -- Reserva 9: petos, balon
    (10, 1),
    -- Reserva 10: raqueta
    (11, 1),
    (11, 2),
    (11, 3),
    -- Reserva 11: raquetas, balon, petos
    (12, 1);
-- Reserva 12: raquetas