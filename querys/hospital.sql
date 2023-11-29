CREATE SCHEMA Hospital;

CREATE TABLE Hospital(RFC_hospital VARCHAR (13) PRIMARY KEY,
Nombre VARCHAR(50) NOT NULL,
Direccion VARCHAR(60) NOT NULL,
Email VARCHAR(30) NOT NULL);

CREATE TABLE hospital_Eliminado(id SERIAL NOT NULL,RFC_hospital varchar(13) 
not null,nombre varchar(50) not null,insertado_el TIMESTAMP(6) NOT NULL);
CREATE OR REPLACE FUNCTION hospital_Eliminado()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.RFC_hospital is null  THEN
             INSERT INTO hospital_Eliminado(RFC_hospital,nombre,insertado_el)
             VALUES(OLD.RFC_hospital,OLD.nombre,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
CREATE OR REPLACE TRIGGER nombre_hospital_Eliminado
 AFTER DELETE
 ON hospital 
 FOR EACH ROW 
 EXECUTE PROCEDURE hospital_Eliminado();

CREATE TABLE cambio_nombre_hospital(id SERIAL NOT NULL,RFC_hospital varchar(13) 
not null,nombre varchar(50) not null,insertado_el TIMESTAMP(6) NOT NULL);
CREATE OR REPLACE FUNCTION cambio_nombre_hospital()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.nombre <> OLD.nombre THEN
             INSERT INTO cambio_nombre_hospital(RFC_hospital,nombre,insertado_el)
             VALUES(OLD.RFC_hospital,OLD.nombre,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
CREATE OR REPLACE TRIGGER nombre_cambiado_hospital
 BEFORE UPDATE
 ON hospital 
 FOR EACH ROW 
 EXECUTE PROCEDURE cambio_nombre_hospital();

CREATE TABLE hospitales_nuevos(id SERIAL NOT NULL,RFC_hospital varchar(13) 
not null,nombre varchar(50) not null,insertado_el TIMESTAMP(6) NOT NULL);
CREATE OR REPLACE FUNCTION agregar_nuevo_hospital()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.RFC_hospital is not null  THEN
             INSERT INTO hospitales_nuevos(RFC_hospital,nombre,insertado_el)
             VALUES(NEW.RFC_hospital,NEW.nombre,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
CREATE OR REPLACE TRIGGER nombre_nuevo_hospital
 BEFORE INSERT
 ON hospital 
 FOR EACH ROW 
 EXECUTE PROCEDURE agregar_nuevo_hospital();

CREATE TABLE Pisos(
No_Piso INT PRIMARY KEY,
Hab_cama Varchar(10) NOT NULL,
Especialidad VARCHAR (30) NOT NULL);

# 1ra tabla
CREATE TABLE nuevos_pisos (
    id SERIAL NOT NULL,
    No_Piso INT NOT NULL,
    Hab_cama VARCHAR(10) NOT NULL,
    Especialidad VARCHAR(30) NOT NULL,
    insertado_el TIMESTAMP(6) NOT NULL
);
# 2da tabla
CREATE TABLE eliminados_pisos (
    Id SERIAL NOT NULL,
    No_Piso INT NOT NULL,
    Hab_cama VARCHAR(10) NOT NULL,
    Especialidad VARCHAR(30) NOT NULL,
    Eliminado_el TIMESTAMP(6) NOT NULL
);
# Funcion para Trigger Insertar
CREATE OR REPLACE FUNCTION agregar_nuevo_piso()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF NEW.No_Piso IS NOT NULL THEN
        INSERT INTO nuevos_pisos (No_Piso, Hab_cama, Especialidad, insertado_el)
        VALUES (NEW.No_Piso, NEW.Hab_cama, NEW.Especialidad, NOW());
    END IF;
    RETURN NEW;
END;
$$;
#Trigger Insertar
CREATE OR REPLACE TRIGGER trigger_nuevo_piso
BEFORE INSERT
ON Pisos
FOR EACH ROW
EXECUTE PROCEDURE agregar_nuevo_piso();


# Funcion para Trigger eliminar
CREATE OR REPLACE FUNCTION agregar_eliminado_piso()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.No_Piso IS NOT NULL THEN
        INSERT INTO eliminados_pisos (No_Piso, Hab_cama, Especialidad, eliminado_el)
        VALUES (OLD.No_Piso, OLD.Hab_cama, OLD.Especialidad, NOW());
    END IF;
    RETURN OLD;
END;
$$;
# Trigger eliminar
CREATE OR REPLACE TRIGGER trigger_eliminado_piso
AFTER DELETE
ON Pisos
FOR EACH ROW
EXECUTE PROCEDURE agregar_eliminado_piso();

CREATE TABLE Pacientes(
Id_Paciente INT PRIMARY KEY,
Nombre VARCHAR(20) NOT NULL,
Apellido VARCHAR(20) NOT NULL,
Fec_Nac DATE NOT NULL,
Sexo VARCHAR(1) NOT NULL,
Telefono BIGINT NOT NULL,
Direccion VARCHAR(60) NOT NULL,
No_piso INT,
RFC_HOSPITAL VARCHAR(13),
FOREIGN KEY (No_Piso) REFERENCES Pisos(No_Piso),
FOREIGN KEY (RFC_hospital) REFERENCES hospital(RFC_hospital));

# 1ra tabla
CREATE TABLE nuevos_pacientes (
    Id SERIAL NOT NULL,
    Id_Paciente INT NOT NULL,
    Nombre VARCHAR(20) NOT NULL,
    Apellido VARCHAR(20) NOT NULL,
    Fec_Nac DATE NOT NULL,
    Sexo VARCHAR(1) NOT NULL,
    Telefono BIGINT NOT NULL,
    Direccion VARCHAR(60) NOT NULL,
    No_Piso INT,
    RFC_HOSPITAL VARCHAR(13),
    Insertado_el TIMESTAMP(6) NOT NULL
);


# 2da tabla
CREATE TABLE eliminados_pacientes (
    Id SERIAL NOT NULL,
    Id_Paciente INT NOT NULL,
    Nombre VARCHAR(20) NOT NULL,
    Apellido VARCHAR(20) NOT NULL,
    Fec_Nac DATE NOT NULL,
    Sexo VARCHAR(1) NOT NULL,
    Telefono BIGINT NOT NULL,
    Direccion VARCHAR(60) NOT NULL,
    No_Piso INT,
    RFC_HOSPITAL VARCHAR(13),
    Eliminado_el TIMESTAMP(6) NOT NULL
);


# Funcion para Trigger Insertar
CREATE OR REPLACE FUNCTION agregar_nuevo_paciente()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF NEW.Id_Paciente IS NOT NULL THEN
        INSERT INTO nuevos_pacientes (Id_Paciente, Nombre, Apellido, Fec_Nac, Sexo, Telefono, Direccion, No_Piso, RFC_HOSPITAL, insertado_el)
        VALUES (NEW.Id_Paciente, NEW.Nombre, NEW.Apellido, NEW.Fec_Nac, NEW.Sexo, NEW.Telefono, NEW.Direccion, NEW.No_Piso, NEW.RFC_HOSPITAL, NOW());
    END IF;
    RETURN NEW;
END;
$$;
# Trigger Insertar
CREATE OR REPLACE TRIGGER trigger_nuevo_paciente
BEFORE INSERT
ON Pacientes
FOR EACH ROW
EXECUTE PROCEDURE agregar_nuevo_paciente();


# Funcion para Trigger eliminar
CREATE OR REPLACE FUNCTION agregar_eliminado_paciente()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_Paciente IS NOT NULL THEN
        INSERT INTO eliminados_pacientes (Id_Paciente, Nombre, Apellido, Fec_Nac, Sexo, Telefono, Direccion, No_Piso, RFC_HOSPITAL, eliminado_el)
        VALUES (OLD.Id_Paciente, OLD.Nombre, OLD.Apellido, OLD.Fec_Nac, OLD.Sexo, OLD.Telefono, OLD.Direccion, OLD.No_Piso, OLD.RFC_HOSPITAL, NOW());
    END IF;
    RETURN OLD;
END;
$$;
# Trigger eliminar
CREATE OR REPLACE TRIGGER trigger_eliminado_paciente
AFTER DELETE
ON Pacientes
FOR EACH ROW
EXECUTE PROCEDURE agregar_eliminado_paciente();

CREATE TABLE Responsable(
Id_Responsable INT PRIMARY KEY,
Nombre VARCHAR (20) NOT NULL,
Apellido VARCHAR(20) NOT NULL,
Fec_Nac DATE NOT NULL,
Sexo VARCHAR(1) NOT NULL,
Telefono BIGINT NOT NULL,
Direccion VARCHAR(60) NOT NULL,
RFC VARCHAR(12) NOT NULL,
Id_paciente INT,
FOREIGN KEY (Id_paciente) REFERENCES Pacientes(Id_paciente));

# 1ra tabla
CREATE TABLE nuevos_responsables (
    id SERIAL NOT NULL,
    Id_Responsable INT NOT NULL,
    Nombre VARCHAR(20) NOT NULL,
    Apellido VARCHAR(20) NOT NULL,
    Fec_Nac DATE NOT NULL,
    Sexo VARCHAR(1) NOT NULL,
    Telefono BIGINT NOT NULL,
    Direccion VARCHAR(60) NOT NULL,
    RFC VARCHAR(12) NOT NULL,
    Id_paciente INT,
    insertado_el TIMESTAMP(6) NOT NULL
);


# 2da tabla
CREATE TABLE eliminados_responsables (
    Id SERIAL NOT NULL,
    Id_Responsable INT NOT NULL,
    Nombre VARCHAR(20) NOT NULL,
    Apellido VARCHAR(20) NOT NULL,
    Fec_Nac DATE NOT NULL,
    Sexo VARCHAR(1) NOT NULL,
    Telefono BIGINT NOT NULL,
    Direccion VARCHAR(60) NOT NULL,
    RFC VARCHAR(12) NOT NULL,
    Id_paciente INT,
    Eliminado_el TIMESTAMP(6) NOT NULL
);


# Funcion para Trigger Insertar
CREATE OR REPLACE FUNCTION agregar_nuevo_responsable()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF NEW.Id_Responsable IS NOT NULL THEN
        INSERT INTO nuevos_responsables (Id_Responsable, Nombre, Apellido, Fec_Nac, Sexo, Telefono, Direccion, RFC, Id_paciente, insertado_el)
        VALUES (NEW.Id_Responsable, NEW.Nombre, NEW.Apellido, NEW.Fec_Nac, NEW.Sexo, NEW.Telefono, NEW.Direccion, NEW.RFC, NEW.Id_paciente, NOW());
    END IF;
    RETURN NEW;
END;
$$;
# Trigger Insertar
CREATE OR REPLACE TRIGGER trigger_nuevo_responsable
BEFORE INSERT
ON Responsable
FOR EACH ROW
EXECUTE PROCEDURE agregar_nuevo_responsable();


# Funcion para Trigger eliminar
CREATE OR REPLACE FUNCTION agregar_eliminado_responsable()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_Responsable IS NOT NULL THEN
        INSERT INTO eliminados_responsables (Id_Responsable, Nombre, Apellido, Fec_Nac, Sexo, Telefono, Direccion, RFC, Id_paciente, eliminado_el)
        VALUES (OLD.Id_Responsable, OLD.Nombre, OLD.Apellido, OLD.Fec_Nac, OLD.Sexo, OLD.Telefono, OLD.Direccion, OLD.RFC, OLD.Id_paciente, NOW());
    END IF;
    RETURN OLD;
END;
$$;
# Trigger eliminar
CREATE OR REPLACE TRIGGER trigger_eliminado_responsable
AFTER DELETE
ON Responsable
FOR EACH ROW
EXECUTE PROCEDURE agregar_eliminado_responsable();

CREATE TABLE departamentos(
Id_departamento INT PRIMARY KEY,
Nombre VARCHAR(50) NOT NULL,
Descripcion VARCHAR(100) NOT NULL);


CREATE TABLE Producto(
Id_producto SERIAL NOT NULL PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Precio FLOAT NOT NULL,
Tipo VARCHAR (20) NOT NULL,
Marca VARCHAR(50) NOT NULL);


CREATE TABLE Prod_entrada(
ID_Prod_entrada SERIAL NOT NULL PRIMARY KEY,
Lote VARCHAR(12) NOT NULL,
Cantidad INT NOT NULL,
F_cad DATE NOT NULL,
F_entrada DATE NOT NULL,
F_salida DATE NOT NULL,
Id_producto INT,
FOREIGN KEY (Id_producto) REFERENCES Producto(Id_producto));

CREATE TABLE Almacen_insumos(
Id_prod_entrada INT,
Id_departamento INT,
merma INT NOT NULL,
stock INT NOT NULL,
FOREIGN KEY (Id_prod_entrada) REFERENCES Prod_entrada(Id_prod_entrada),
FOREIGN KEY (Id_departamento) REFERENCES Departamentos(Id_departamento));


CREATE TABLE Cocina(
Id_Dieta INT PRIMARY KEY,
Nombre VARCHAR (20) NOT NULL,
Calorias FLOAT NOT NULL,
Tipo VARCHAR (20) NOT NULL,
Especificaciones VARCHAR(100) NOT NULL,
Id_paciente INT,
FOREIGN KEY (Id_paciente) REFERENCES Pacientes(Id_paciente));

CREATE TABLE servicios(
id_servicio INT PRIMARY KEY,
concepto VARCHAR (30) NOT NULL,
precio FLOAT NOT NULL,
Id_departamento INT,
FOREIGN KEY (Id_departamento) REFERENCES Departamentos(Id_departamento));

CREATE TABLE proveedores(
Id_proveedor SERIAL NOT NULL PRIMARY KEY,
empresa VARCHAR(30) NOT NULL,
Id_producto INT,
FOREIGN KEY (Id_producto) REFERENCES Producto(Id_producto));

CREATE TABLE historial_cuenta_productos(
Id_cuenta_prod INT PRIMARY KEY,
concepto VARCHAR(20) NOT NULL,
fecha_cargo DATE NOT NULL,
cantidad INT NOT NULL,
Id_producto INT,
FOREIGN KEY (Id_producto) REFERENCES Producto(Id_producto));

CREATE TABLE historial_cuenta_servicios(
Id_cuenta_serv INT PRIMARY KEY,
concepto VARCHAR(30) NOT NULL,
fecha_cargo DATE NOT NULL,
cantidad INT NOT NULL,
Id_servicios INT,
FOREIGN KEY (Id_servicios) REFERENCES Servicios(Id_servicio));

CREATE TABLE facturacion(
Id_factura INT PRIMARY KEY,
fecha DATE NOT NULL,
subtotal FLOAT NOT NULL,
CFDI VARCHAR(40) NOT NULL,
Id_cuenta_prod INT,
Id_cuenta_serv INT,
Id_responsable INT,
FOREIGN KEY (Id_cuenta_prod) REFERENCES
historial_cuenta_productos(Id_cuenta_prod),
FOREIGN KEY (Id_cuenta_serv) REFERENCES
historial_cuenta_servicios(Id_cuenta_serv),
FOREIGN KEY (Id_responsable) REFERENCES responsable(Id_responsable));

CREATE TABLE empleado(
Id_empleado SERIAL NOT NULL PRIMARY KEY,
Nombre VARCHAR(20) NOT NULL,
Apellido VARCHAR(20) NOT NULL,
Puesto VARCHAR(20) NOT NULL,
Turno VARCHAR(15) NOT NULL,
Id_departamento INT,
FOREIGN KEY (Id_departamento) REFERENCES Departamentos(Id_departamento));


CREATE TABLE imagenologia(
Id_estudio INT PRIMARY KEY,
Tipo VARCHAR(20) NOT NULL,
Id_departamento INT,
FOREIGN KEY (id_departamento) REFERENCES Departamentos(Id_departamento));

CREATE TABLE hemocomponentes(
Id_hemocomponente INT PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Grupo VARCHAR (10) NOT NULL,
rh VARCHAR (5),
ml FLOAT);

CREATE TABLE laboratorio(
Id_laboratorio INT PRIMARY KEY,
muestra VARCHAR(20) NOT NULL,
Id_departamento INT,
Id_hemocomponentes INT,
FOREIGN KEY (Id_departamento) REFERENCES Departamentos(Id_departamento),
FOREIGN KEY (Id_hemocomponentes) REFERENCES
Hemocomponentes(Id_hemocomponente));


CREATE TABLE Mantenimiento_gral(
Id_equipo INT PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Cantidad INT NOT NULL,
Fecha_mantenimiento DATE NOT NULL,
activo VARCHAR(20) NOT NULL,
tipo_de_equipo VARCHAR(20) NOT NULL,
Id_departamento INT,
FOREIGN KEY (Id_departamento) REFERENCES Departamentos(Id_departamento));



CREATE TABLE Orden_estudio(
Id_orden SERIAL NOT NULL PRIMARY KEY,
Descripcion VARCHAR(20) NOT NULL,
Id_estudio INT,
Id_laboratorio INT,
Id_Paciente INT,
FOREIGN KEY (Id_estudio) REFERENCES Imagenologia(Id_estudio),
FOREIGN KEY (Id_laboratorio) REFERENCES Laboratorio(Id_laboratorio),
FOREIGN KEY (Id_paciente) REFERENCES Pacientes(Id_paciente));

CREATE TABLE Transporte(
Placa VARCHAR(10) PRIMARY KEY,
Modelo VARCHAR(20) NOT NULL,
Marca VARCHAR(20) NOT NULL,
Disponibilidad VARCHAR(10) NOT NULL);

CREATE TABLE Prestamo_transporte(
Placa VARCHAR(10),
F_inicio DATE NOT NULL,
F_fin DATE NOT NULL,
Id_empleado INT,
FOREIGN KEY (Placa) REFERENCES Transporte(Placa),
FOREIGN KEY (Id_empleado) REFERENCES Empleado(Id_empleado));


CREATE TABLE expediente(
Id_expediente SERIAL NOT NULL PRIMARY KEY,
Diagnosticos VARCHAR(50) NOT NULL,
Tratamientos VARCHAR(50) NOT NULL,
Intervenciones_quirurgicas VARCHAR(50) NOT NULL,
Sintomas VARCHAR (50) NOT NULL,
Antecedentes VARCHAR(100) NOT NULL,
F_ingreso DATE NOT NULL,
F_egreso DATE,
Descripcion VARCHAR(150) NOT NULL,
Id_paciente INT,
Id_departamento INT,
FOREIGN KEY (Id_paciente) REFERENCES pacientes(Id_paciente),
FOREIGN KEY (Id_departamento) REFERENCES departamentos(Id_departamento));



CREATE TABLE expediente( 
    Id_expediente SERIAL NOT NULL, 
    Diagnosticos VARCHAR(50) NOT NULL, 
    Tratamientos VARCHAR(50) NOT NULL, 
    Intervenciones_quirurgicas VARCHAR(50) NOT NULL, 
    Sintomas VARCHAR(50) NOT NULL, 
    Antecedentes VARCHAR(100) NOT NULL, 
    F_ingreso DATE NOT NULL, 
    F_egreso DATE NOT NULL, 
    Descripcion VARCHAR(150) NOT NULL, 
    Id_paciente INT, 
    Id_departamento INT, 
    PRIMARY KEY (Id_expediente, F_ingreso),  
    FOREIGN KEY (Id_paciente) REFERENCES pacientes(Id_paciente), 
    FOREIGN KEY (Id_departamento) REFERENCES departamentos(Id_departamento) 
) PARTITION BY RANGE (F_ingreso); 


CREATE TABLE expediente_2020 PARTITION OF expediente FOR VALUES FROM ('2020-01-01')
TO ('2020-12-31');
CREATE TABLE expediente_2021 PARTITION OF expediente FOR VALUES FROM ('2021-01-01')
TO ('2021-12-31');
CREATE TABLE expediente_2022 PARTITION OF expediente FOR VALUES FROM ('2022-01-01')
TO ('2022-12-31');
CREATE TABLE expediente_2023 PARTITION OF expediente FOR VALUES FROM ('2023-01-01')
TO ('2023-12-31');



CREATE FUNCTION FK_Update() RETURNS TRIGGER
as
$$
BEGIN
UPDATE pacientes
SET rfc_hospital = new.rfc_hospital;
return new;
END
$$
LANGUAGE plpgsql;

CREATE TRIGGER Tr_Update_RFC_H AFTER UPDATE ON hospital
FOR EACH ROW
EXECUTE PROCEDURE FK_Update();
