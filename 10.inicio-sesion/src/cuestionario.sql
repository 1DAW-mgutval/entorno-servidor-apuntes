USE login_dwes;

-- ==========================================
-- TABLA PREGUNTAS
-- ==========================================

CREATE TABLE IF NOT EXISTS preguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enunciado VARCHAR(500) NOT NULL,
    opcion_a VARCHAR(255) NOT NULL,
    opcion_b VARCHAR(255) NOT NULL,
    opcion_c VARCHAR(255) NOT NULL,
    opcion_d VARCHAR(255) NOT NULL,
    correcta CHAR(1) NOT NULL,
    CONSTRAINT chk_correcta
        CHECK (correcta IN ('A', 'B', 'C', 'D'))
) ENGINE=InnoDB;

-- ==========================================
-- TABLA RESULTADOS
-- ==========================================


CREATE TABLE IF NOT EXISTS resultados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL,
    aciertos INT NOT NULL,
    total_preguntas INT NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_resultados_usuarios
        FOREIGN KEY (usuario)
        REFERENCES usuarios(email)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_spanish_ci;



-- ==========================================
-- INSERTAR PREGUNTAS SIN DUPLICARLAS
-- ==========================================

INSERT INTO preguntas
(enunciado, opcion_a, opcion_b, opcion_c, opcion_d, correcta)
SELECT
    datos.enunciado,
    datos.opcion_a,
    datos.opcion_b,
    datos.opcion_c,
    datos.opcion_d,
    datos.correcta
FROM (
    SELECT
    '¿Qué función permite iniciar una sesión en PHP?' AS enunciado,
    'session_start()' AS opcion_a,
    'session_begin()' AS opcion_b,
    'start_session()' AS opcion_c,
    'session_open()' AS opcion_d,
    'A' AS correcta

    UNION ALL SELECT
    '¿Dónde se almacenan normalmente las variables de sesión?',
    'En el navegador',
    'En el servidor',
    'En una cookie exclusivamente',
    'En un archivo HTML',
    'B'

    UNION ALL SELECT
    '¿Qué significa PDO en PHP?',
    'PHP Data Objects',
    'Personal Data Operations',
    'PHP Database Output',
    'Program Data Objects',
    'A'

    UNION ALL SELECT
    '¿Qué método de PDO prepara una consulta SQL?',
    'execute()',
    'query()',
    'prepare()',
    'fetch()',
    'C'

    UNION ALL SELECT
    '¿Qué método ejecuta una consulta previamente preparada?',
    'execute()',
    'prepare()',
    'connect()',
    'close()',
    'A'

    UNION ALL SELECT
    '¿Qué superglobal recoge los datos enviados mediante POST?',
    '$_GET',
    '$_SESSION',
    '$_POST',
    '$_SERVER',
    'C'

    UNION ALL SELECT
    '¿Qué atributo HTML indica dónde se envían los datos de un formulario?',
    'method',
    'action',
    'name',
    'type',
    'B'

    UNION ALL SELECT
    '¿Qué atributo de un formulario indica el método de envío?',
    'action',
    'id',
    'method',
    'class',
    'C'

    UNION ALL SELECT
    '¿Qué función permite eliminar una variable de sesión?',
    'session_destroy()',
    'unset()',
    'session_remove()',
    'delete_session()',
    'B'

    UNION ALL SELECT
    '¿Qué método de PDO obtiene la siguiente fila de resultados?',
    'fetch()',
    'execute()',
    'prepare()',
    'insert()',
    'A'

    UNION ALL SELECT
    '¿Qué ventaja ofrecen las consultas preparadas de PDO?',
    'Aumentan el tamaño de la base de datos',
    'Evitan conectarse a MySQL',
    'Ayudan a prevenir inyecciones SQL',
    'Eliminan automáticamente las tablas',
    'C'

    UNION ALL SELECT
    '¿Qué función permite finalizar una sesión PHP?',
    'session_close()',
    'session_destroy()',
    'session_end()',
    'close_session()',
    'B'
) AS datos
WHERE NOT EXISTS (
    SELECT 1
    FROM preguntas
    WHERE preguntas.enunciado = datos.enunciado
);

