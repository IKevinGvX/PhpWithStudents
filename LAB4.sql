CREATE DATABASE Sise;

USE Sise;
CREATE TABLE ciclov_notas (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Alumno VARCHAR(100) NOT NULL,
    nota1 DECIMAL(5, 2) NOT NULL,
    nota2 DECIMAL(5, 2) NOT NULL,
    nota3 DECIMAL(5, 2) NOT NULL,
    nota4 DECIMAL(5, 2) NOT NULL,
    Promedio DECIMAL(5, 2) NOT NULL
);
DELIMITER //

CREATE PROCEDURE InsertarNota(
    IN pAlumno VARCHAR(100),
    IN pNota1 DECIMAL(5, 2),
    IN pNota2 DECIMAL(5, 2),
    IN pNota3 DECIMAL(5, 2),
    IN pNota4 DECIMAL(5, 2)
)
BEGIN
    DECLARE pPromedio DECIMAL(5, 2);
    SET pPromedio = (pNota1 + pNota2 + pNota3 + pNota4) / 4;
    INSERT INTO ciclov_notas (Alumno, nota1, nota2, nota3, nota4, Promedio)
    VALUES (pAlumno, pNota1, pNota2, pNota3, pNota4, pPromedio);
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE ActualizarNota(
    IN pId INT,
    IN pAlumno VARCHAR(100),
    IN pNota1 DECIMAL(5, 2),
    IN pNota2 DECIMAL(5, 2),
    IN pNota3 DECIMAL(5, 2),
    IN pNota4 DECIMAL(5, 2)
)
BEGIN
    DECLARE pPromedio DECIMAL(5, 2);
    SET pPromedio = (pNota1 + pNota2 + pNota3 + pNota4) / 4;
    UPDATE ciclov_notas
    SET Alumno = pAlumno,
        nota1 = pNota1,
        nota2 = pNota2,
        nota3 = pNota3,
        nota4 = pNota4,
        Promedio = pPromedio
    WHERE Id = pId;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE EliminarNota(IN idi INT)
BEGIN
    DELETE FROM ciclov_notas WHERE Id = idi;
END //

DELIMITER ;
call EliminarNota (22);
DELIMITER //

CREATE PROCEDURE ListarNotas()
BEGIN
    SELECT * FROM ciclov_notas;
END //

DELIMITER ;

CREATE DATABASE Sise;

USE Sise;
 -- LIBROS
CREATE TABLE Libro (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    cantidad INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2) GENERATED ALWAYS AS (cantidad * precio) STORED
);

-- Procedimientos almacenados
DELIMITER $$

-- Listar libros
CREATE PROCEDURE ListarLibros()
BEGIN
    SELECT * FROM Libro;
END$$

-- Insertar libro
CREATE PROCEDURE InsertarLibro(IN p_titulo VARCHAR(255), IN p_cantidad INT, IN p_precio DECIMAL(10, 2))
BEGIN
    INSERT INTO Libro (titulo, cantidad, precio) VALUES (p_titulo, p_cantidad, p_precio);
END$$

-- Actualizar libro
CREATE PROCEDURE ActualizarLibro(IN p_id INT, IN p_titulo VARCHAR(255), IN p_cantidad INT, IN p_precio DECIMAL(10, 2))
BEGIN
    UPDATE Libro
    SET titulo = p_titulo, cantidad = p_cantidad, precio = p_precio
    WHERE id_libro = p_id;
END$$

-- Eliminar libro
CREATE PROCEDURE EliminarLibro(IN p_id INT)
BEGIN
    DELETE FROM Libro WHERE id_libro = p_id;
END$$
-- Productos
DELIMITER ;
CREATE TABLE Productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    cantidad INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2) GENERATED ALWAYS AS (cantidad * precio) STORED
);

DELIMITER $$

-- Procedimiento para listar productos
CREATE PROCEDURE ListarProductos()
BEGIN
    SELECT * FROM Productos;
END$$

-- Procedimiento para insertar un producto
CREATE PROCEDURE InsertarProducto(
    IN p_descripcion VARCHAR(255), 
    IN p_codigo VARCHAR(50), 
    IN p_cantidad INT, 
    IN p_precio DECIMAL(10, 2)
)
BEGIN
    INSERT INTO Productos (descripcion, codigo, cantidad, precio) 
    VALUES (p_descripcion, p_codigo, p_cantidad, p_precio);
END$$

-- Procedimiento para actualizar un producto
CREATE PROCEDURE ActualizarProducto(
    IN p_id INT, 
    IN p_descripcion VARCHAR(255), 
    IN p_codigo VARCHAR(50), 
    IN p_cantidad INT, 
    IN p_precio DECIMAL(10, 2)
)
BEGIN
    UPDATE Productos
    SET descripcion = p_descripcion, codigo = p_codigo, cantidad = p_cantidad, precio = p_precio
    WHERE id_producto = p_id;
END$$

-- Procedimiento para eliminar un producto
CREATE PROCEDURE EliminarProducto(IN p_id INT)
BEGIN
    DELETE FROM Productos WHERE id_producto = p_id;
END$$

DELIMITER ;