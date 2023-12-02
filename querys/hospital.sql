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
Id_Paciente Serial NOT NULL PRIMARY KEY,
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
Id_Responsable Serial NOT NULL PRIMARY KEY,
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

#1ra tabla
CREATE TABLE nuevos_proveedores (
    Id SERIAL NOT NULL,
    Id_proveedor INT NOT NULL,
    Empresa VARCHAR(30) NOT NULL,
    Id_producto INT,
    Insertado_el TIMESTAMP(6) NOT NULL
);
#2da tabla
CREATE TABLE eliminados_proveedores (
    Id SERIAL NOT NULL,
    Id_proveedor INT NOT NULL,
    Empresa VARCHAR(30) NOT NULL,
    Id_producto INT,
    Eliminado_el TIMESTAMP(6) NOT NULL
);
#Funcion para trigger Insertar
CREATE OR REPLACE FUNCTION agregar_nuevo_proveedor()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF NEW.Id_proveedor IS NOT NULL THEN
        INSERT INTO nuevos_proveedores (Id_proveedor, empresa, Id_producto, insertado_el)
        VALUES (NEW.Id_proveedor, NEW.empresa, NEW.Id_producto, NOW());
    END IF;
    RETURN NEW;
END;
$$;
# trigger Insertar
CREATE OR REPLACE TRIGGER trigger_nuevo_proveedor
BEFORE INSERT
ON proveedores
FOR EACH ROW
EXECUTE PROCEDURE agregar_nuevo_proveedor();

#Funcion para trigger  eliminar 
CREATE OR REPLACE FUNCTION agregar_eliminado_proveedor()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_proveedor IS NOT NULL THEN
        INSERT INTO eliminados_proveedores (Id_proveedor, empresa, Id_producto, eliminado_el)
        VALUES (OLD.Id_proveedor, OLD.empresa, OLD.Id_producto, NOW());
    END IF;
    RETURN OLD;
END;
$$
#trigger eliminar 
CREATE OR REPLACE TRIGGER trigger_eliminado_proveedor
AFTER DELETE
ON proveedores
FOR EACH ROW
EXECUTE PROCEDURE agregar_eliminado_proveedor();


CREATE TABLE historial_cuenta_productos(
Id_cuenta_prod SERIAL NOT NULL PRIMARY KEY,
concepto VARCHAR(20) NOT NULL,
fecha_cargo DATE NOT NULL,
cantidad INT NOT NULL,
Id_producto INT,
FOREIGN KEY (Id_producto) REFERENCES Producto(Id_producto));

#1ra tabla
CREATE TABLE nuevos_historiales_cuenta_productos (
    Id SERIAL NOT NULL,
    Id_cuenta_prod INT NOT NULL,
    Concepto VARCHAR(20) NOT NULL,
    Id_producto INT,
    Insertado_el TIMESTAMP(6) NOT NULL
);
#2da tabla
CREATE TABLE eliminados_historiales_cuenta_productos (
    Id SERIAL NOT NULL,
    Id_cuenta_prod INT NOT NULL,
    Concepto VARCHAR(20) NOT NULL,
    Id_producto INT,
    Eliminado_el TIMESTAMP(6) NOT NULL
);
#Funcion para trigger Insertar 
CREATE OR REPLACE FUNCTION agregar_nuevo_historial_cuenta_producto()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF NEW.Id_cuenta_prod IS NOT NULL THEN
        INSERT INTO nuevos_historiales_cuenta_productos (Id_cuenta_prod, 
            concepto, Id_producto, insertado_el)
        VALUES (NEW.Id_cuenta_prod, NEW.concepto, NEW.Id_producto, NOW());
    END IF;
    RETURN NEW;
END;
$$;
#trigger insertar 
CREATE OR REPLACE TRIGGER trigger_nuevo_historial_cuenta_producto
BEFORE INSERT
ON historial_cuenta_productos
FOR EACH ROW
EXECUTE PROCEDURE agregar_nuevo_historial_cuenta_producto();
#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION agregar_eliminado_historial_cuenta_producto()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_cuenta_prod IS NOT NULL THEN
        INSERT INTO eliminados_historiales_cuenta_productos (Id_cuenta_prod, 
            concepto, Id_producto, eliminado_el)
        VALUES (OLD.Id_cuenta_prod, OLD.concepto, OLD.Id_producto, NOW());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER trigger_eliminado_historial_cuenta_producto
AFTER DELETE
ON historial_cuenta_productos
FOR EACH ROW
EXECUTE PROCEDURE agregar_eliminado_historial_cuenta_producto();

CREATE TABLE historial_cuenta_servicios(
Id_cuenta_serv SERIAL NOT NULL PRIMARY KEY,
concepto VARCHAR(30) NOT NULL,
fecha_cargo DATE NOT NULL,
cantidad INT NOT NULL,
Id_servicios INT,
FOREIGN KEY (Id_servicios) REFERENCES Servicios(Id_servicio));

# Tabla 1 (UPDATE)
CREATE TABLE historial_cuenta_servicios_UPDATE(
Id_cuenta_serv SERIAL NOT NULL PRIMARY KEY,
concepto VARCHAR(30) NOT NULL,
fecha_cargo DATE NOT NULL,
actualizado_el TIMESTAMP(6) NOT NULL);

# Tabla 2 (DELETE)
CREATE TABLE historial_cuenta_servicios__DELETE(
Id_cuenta_serv SERIAL NOT NULL PRIMARY KEY,
concepto VARCHAR(30) NOT NULL,
fecha_cargo DATE NOT NULL,
eliminado_el TIMESTAMP(6) NOT NULL);

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION historial_cuenta_servicios_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.concepto <> OLD.concepto THEN
             INSERT INTO historial_cuenta_servicios_UPDATE(Id_cuenta_serv,
                concepto,fecha_cargo,actualizado_el)
             VALUES(OLD.Id_cuenta_serv,OLD.concepto,OLD.fecha_cargo,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER historial_cuenta_servicios_UPDATE
 BEFORE UPDATE
 ON historial_cuenta_servicios 
 FOR EACH ROW 
 EXECUTE PROCEDURE historial_cuenta_servicios_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION historial_cuenta_servicios__DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_cuenta_prod IS NOT NULL THEN
        INSERT INTO historial_cuenta_servicios__DELETE(Id_cuenta_serv,
                concepto,fecha_cargo,eliminado_el)
        VALUES (OLD.Id_cuenta_serv,OLD.concepto,OLD.fecha_cargo,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER historial_cuenta_servicios__DELETE
AFTER DELETE
ON historial_cuenta_servicios
FOR EACH ROW
EXECUTE PROCEDURE historial_cuenta_servicios__DELETE();

CREATE TABLE facturacion(
Id_factura SERIAL NOT NULL PRIMARY KEY,
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

#1ra tabla
CREATE TABLE nuevas_facturas (
    Id SERIAL NOT NULL,
    Id_factura INT NOT NULL,
    Subtotal FLOAT NOT NULL,
    Id_cuenta_prod INT,
    Id_cuenta_serv INT,
    Id_responsable INT,
    Insertado_el TIMESTAMP(6) NOT NULL
);
#2da tabla
CREATE TABLE eliminadas_facturas (
    Id SERIAL NOT NULL,
    Id_factura INT NOT NULL,
    Subtotal FLOAT NOT NULL,
    Id_cuenta_prod INT,
    Id_cuenta_serv INT,
    Id_responsable INT,
    Eliminado_el TIMESTAMP(6) NOT NULL
);
#Funcion para trigger Insertar
CREATE OR REPLACE FUNCTION agregar_nueva_factura()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF NEW.Id_factura IS NOT NULL THEN
        INSERT INTO nuevas_facturas (Id_factura, subtotal, 
            Id_cuenta_prod, Id_cuenta_serv, Id_responsable, 
            insertado_el)
        VALUES (NEW.Id_factura, NEW.subtotal, NEW.Id_cuenta_prod, 
            NEW.Id_cuenta_serv, NEW.Id_responsable, NOW());
    END IF;
    RETURN NEW;
END;
$$;
#trigger insertar 
CREATE OR REPLACE TRIGGER trigger_nueva_factura
BEFORE INSERT
ON facturacion
FOR EACH ROW
EXECUTE PROCEDURE agregar_nueva_factura();
#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION agregar_eliminada_factura()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_factura IS NOT NULL THEN
        INSERT INTO eliminadas_facturas (Id_factura, subtotal, 
            Id_cuenta_prod, Id_cuenta_serv, Id_responsable, 
            eliminado_el)
        VALUES (OLD.Id_factura, OLD.subtotal, OLD.Id_cuenta_prod, 
            OLD.Id_cuenta_serv, OLD.Id_responsable, NOW());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER trigger_eliminada_factura
AFTER DELETE
ON facturacion
FOR EACH ROW
EXECUTE PROCEDURE agregar_eliminada_factura();

CREATE TABLE empleado(
Id_empleado SERIAL NOT NULL PRIMARY KEY,
Nombre VARCHAR(20) NOT NULL,
Apellido VARCHAR(20) NOT NULL,
Puesto VARCHAR(20) NOT NULL,
Turno VARCHAR(15) NOT NULL,
Id_departamento INT,
FOREIGN KEY (Id_departamento) REFERENCES Departamentos(Id_departamento));

#Tabla 1 UPDATE
CREATE TABLE empleado_UPDATE(
Id_empleado SERIAL NOT NULL PRIMARY KEY,
Nombre VARCHAR(20) NOT NULL,
Apellido VARCHAR(20) NOT NULL,
Puesto VARCHAR(20) NOT NULL,
actualizado_el TIMESTAMP(6) NOT NULL);

#Tabla 2 DELETE
CREATE TABLE empleado_DELETE(
Id_empleado SERIAL NOT NULL PRIMARY KEY,
Nombre VARCHAR(20) NOT NULL,
Apellido VARCHAR(20) NOT NULL,
Puesto VARCHAR(20) NOT NULL,
eliminado_el TIMESTAMP(6) NOT NULL);

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION empleado_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.Puesto <> OLD.Puesto THEN
             INSERT INTO empleado_UPDATE(Id_empleado,
                Nombre,Apellido,Puesto,actualizado_el)
             VALUES(OLD.Id_empleado,OLD.Nombre,OLD.Apellido,OLD.Puesto,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER empleado_UPDATE
 BEFORE UPDATE
 ON empleado 
 FOR EACH ROW 
 EXECUTE PROCEDURE empleado_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION empleado_DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_empleado IS NOT NULL THEN
        INSERT INTO empleado_DELETE(Id_empleado,
                Nombre,Apellido,Puesto,eliminado_el)
        VALUES (OLD.Id_empleado,OLD.Nombre,OLD.Apellido,OLD.Puesto,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER empleado_DELETE
AFTER DELETE
ON empleado
FOR EACH ROW
EXECUTE PROCEDURE empleado_DELETE();

CREATE TABLE imagenologia(
Id_estudio INT PRIMARY KEY,
Tipo VARCHAR(20) NOT NULL,
Id_departamento INT,
FOREIGN KEY (id_departamento) REFERENCES Departamentos(Id_departamento));

#Tabla 1 UPDATE
CREATE TABLE imagenologia_UPDATE(
Id_estudio INT PRIMARY KEY,
Tipo VARCHAR(20) NOT NULL,
Id_departamento INT,
actualizado_el TIMESTAMP(6) NOT NULL,
FOREIGN KEY (id_departamento) REFERENCES Departamentos(Id_departamento));

#Tabla 2 DELETE
CREATE TABLE imagenologia_DELETE(
Id_estudio INT PRIMARY KEY,
Tipo VARCHAR(20) NOT NULL,
Id_departamento INT,
eliminado_el TIMESTAMP(6) NOT NULL,
FOREIGN KEY (id_departamento) REFERENCES Departamentos(Id_departamento));

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION imagenologia_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.Tipo <> OLD.Tipo THEN
             INSERT INTO imagenologia_UPDATE(Id_estudio,
                Tipo,Id_departamento,actualizado_el)
             VALUES(OLD.Id_estudio,OLD.Tipo,OLD.Id_departamento,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER imagenologia_UPDATE
 BEFORE UPDATE
 ON imagenologia 
 FOR EACH ROW 
 EXECUTE PROCEDURE imagenologia_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION imagenologia_DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_estudio IS NOT NULL THEN
        INSERT INTO imagenologia_DELETE(Id_estudio,
                Tipo,Id_departamento,eliminado_el)
        VALUES (OLD.Id_estudio,OLD.Tipo,OLD.Id_departamento,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER imagenologia_DELETE
AFTER DELETE
ON imagenologia
FOR EACH ROW
EXECUTE PROCEDURE imagenologia_DELETE();

CREATE TABLE hemocomponentes(
Id_hemocomponente INT PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Grupo VARCHAR (10) NOT NULL,
rh VARCHAR (5),
ml FLOAT);

#Tabla 1 UPDATE
CREATE TABLE hemocomponentes_UPDATE(
Id_hemocomponente INT PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Grupo VARCHAR (10) NOT NULL,
actualizado_el TIMESTAMP(6) NOT NULL);

#Tabla 2 DELETE
CREATE TABLE hemocomponentes_DELETE(
Id_hemocomponente INT PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Grupo VARCHAR (10) NOT NULL,
eliminado_el TIMESTAMP(6) NOT NULL);

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION hemocomponentes_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.Grupo <> OLD.Grupo THEN
             INSERT INTO hemocomponentes_UPDATE(Id_hemocomponente,
                Nombre,Grupo,actualizado_el)
             VALUES(OLD.Id_hemocomponente,OLD.Nombre,OLD.Grupo,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER hemocomponentes_UPDATE
 BEFORE UPDATE
 ON hemocomponentes 
 FOR EACH ROW 
 EXECUTE PROCEDURE hemocomponentes_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION hemocomponentes_DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_hemocomponente IS NOT NULL THEN
        INSERT INTO hemocomponentes_DELETE(Id_hemocomponente,
                Nombre,Grupo,eliminado_el)
        VALUES (OLD.Id_hemocomponente,OLD.Nombre,OLD.Grupo,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER hemocomponentes_DELETE
AFTER DELETE
ON hemocomponentes
FOR EACH ROW
EXECUTE PROCEDURE hemocomponentes_DELETE();

CREATE TABLE laboratorio(
Id_laboratorio INT PRIMARY KEY,
muestra VARCHAR(20) NOT NULL,
Id_departamento INT,
Id_hemocomponentes INT,
FOREIGN KEY (Id_departamento) REFERENCES Departamentos(Id_departamento),
FOREIGN KEY (Id_hemocomponentes) REFERENCES
Hemocomponentes(Id_hemocomponente));

#Tabla 1 UPDATE
CREATE TABLE laboratorio_UPDATE(
Id_laboratorio INT PRIMARY KEY,
muestra VARCHAR(20) NOT NULL,
actualizado_el TIMESTAMP(6) NOT NULL);

#Tabla 2 DELETE
CREATE TABLE laboratorio_DELETE(
Id_laboratorio INT PRIMARY KEY,
muestra VARCHAR(20) NOT NULL,
eliminado_el TIMESTAMP(6) NOT NULL);

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION laboratorio_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.muestra <> OLD.muestra THEN
             INSERT INTO laboratorio_UPDATE(Id_laboratorio,
                muestra,actualizado_el)
             VALUES(OLD.Id_laboratorio,OLD.muestra,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER laboratorio_UPDATE
 BEFORE UPDATE
 ON laboratorio 
 FOR EACH ROW 
 EXECUTE PROCEDURE laboratorio_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION laboratorio_DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_laboratorio IS NOT NULL THEN
        INSERT INTO laboratorio_DELETE(Id_laboratorio,
                muestra,eliminado_el)
        VALUES (OLD.Id_laboratorio,OLD.muestra,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER laboratorio_DELETE
AFTER DELETE
ON laboratorio
FOR EACH ROW
EXECUTE PROCEDURE laboratorio_DELETE();

CREATE TABLE Mantenimiento_gral(
Id_equipo SERIAL NOT NULL PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Cantidad INT NOT NULL,
Fecha_mantenimiento DATE NOT NULL,
activo VARCHAR(20) NOT NULL,
tipo_de_equipo VARCHAR(20) NOT NULL,
Id_departamento INT,
FOREIGN KEY (Id_departamento) REFERENCES Departamentos(Id_departamento));

#Tabla 1 UPDATE
CREATE TABLE Mantenimiento_gral_UPDATE(
Id_equipo SERIAL NOT NULL PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Cantidad INT NOT NULL,
actualizado_el TIMESTAMP(6) NOT NULL);

#Tabla 2 DELETE
CREATE TABLE Mantenimiento_gral_DELETE(
Id_equipo SERIAL NOT NULL PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Cantidad INT NOT NULL,
eliminado_el TIMESTAMP(6) NOT NULL);

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION Mantenimiento_gral_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.Cantidad <> OLD.Cantidad THEN
             INSERT INTO Mantenimiento_gral_UPDATE(Id_equipo,
                Nombre,Cantidad,actualizado_el)
             VALUES(OLD.Id_equipo,OLD.Nombre,OLD.Cantidad,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER Mantenimiento_gral_UPDATE
 BEFORE UPDATE
 ON Mantenimiento_gral 
 FOR EACH ROW 
 EXECUTE PROCEDURE Mantenimiento_gral_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION Mantenimiento_gral_DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_equipo IS NOT NULL THEN
        INSERT INTO Mantenimiento_gral_DELETE(Id_equipo,
                Nombre,Cantidad,eliminado_el)
        VALUES (OLD.Id_equipo,OLD.Nombre,OLD.Cantidad,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER Mantenimiento_gral_DELETE
AFTER DELETE
ON Mantenimiento_gral
FOR EACH ROW
EXECUTE PROCEDURE Mantenimiento_gral_DELETE();

CREATE TABLE Orden_estudio(
Id_orden SERIAL NOT NULL PRIMARY KEY,
Descripcion VARCHAR(20) NOT NULL,
Id_estudio INT,
Id_laboratorio INT,
Id_Paciente INT,
FOREIGN KEY (Id_estudio) REFERENCES Imagenologia(Id_estudio),
FOREIGN KEY (Id_laboratorio) REFERENCES Laboratorio(Id_laboratorio),
FOREIGN KEY (Id_paciente) REFERENCES Pacientes(Id_paciente));

#Tabla 1 UPDATE
CREATE TABLE Orden_estudio_UPDATE(
Id_orden SERIAL NOT NULL PRIMARY KEY,
Descripcion VARCHAR(20) NOT NULL,
actualizado_el TIMESTAMP(6) NOT NULL);

#Tabla 2 DELETE
CREATE TABLE Orden_estudio_DELETE(
Id_orden SERIAL NOT NULL PRIMARY KEY,
Descripcion VARCHAR(20) NOT NULL,
eliminado_el TIMESTAMP(6) NOT NULL);

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION Orden_estudio_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.Descripcion <> OLD.Descripcion THEN
             INSERT INTO Orden_estudio_UPDATE(Id_orden,
                Descripcion,actualizado_el)
             VALUES(OLD.Id_orden,OLD.Descripcion,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER Orden_estudio_UPDATE
 BEFORE UPDATE
 ON Orden_estudio 
 FOR EACH ROW 
 EXECUTE PROCEDURE Orden_estudio_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION Orden_estudio_DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_orden IS NOT NULL THEN
        INSERT INTO Orden_estudio_DELETE(Id_orden,
                Descripcion,eliminado_el)
        VALUES (OLD.Id_orden,OLD.Descripcion,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER Orden_estudio_DELETE
AFTER DELETE
ON Orden_estudio
FOR EACH ROW
EXECUTE PROCEDURE Orden_estudio_DELETE();

CREATE TABLE Transporte(
Placa VARCHAR(10) PRIMARY KEY,
Modelo VARCHAR(20) NOT NULL,
Marca VARCHAR(20) NOT NULL,
Disponibilidad VARCHAR(10) NOT NULL);

#Tabla 1 UPDATE
CREATE TABLE Transporte_UPDATE(
Placa VARCHAR(10) PRIMARY KEY,
Disponibilidad VARCHAR(10) NOT NULL,
actualizado_el TIMESTAMP(6) NOT NULL);

#Tabla 2 DELETE
CREATE TABLE Transporte_DELETE(
Placa VARCHAR(10) PRIMARY KEY,
Disponibilidad VARCHAR(10) NOT NULL,
eliminado_el TIMESTAMP(6) NOT NULL);

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION Transporte_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.Disponibilidad <> OLD.Disponibilidad THEN
             INSERT INTO Transporte_UPDATE(Placa,
                Disponibilidad,actualizado_el)
             VALUES(OLD.Placa,OLD.Disponibilidad,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER Transporte_UPDATE
 BEFORE UPDATE
 ON Transporte 
 FOR EACH ROW 
 EXECUTE PROCEDURE Transporte_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION Transporte_DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Placa IS NOT NULL THEN
        INSERT INTO Transporte_DELETE(Placa,
                Disponibilidad,eliminado_el)
        VALUES (OLD.Placa,OLD.Disponibilidad,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER Transporte_DELETE
AFTER DELETE
ON Transporte
FOR EACH ROW
EXECUTE PROCEDURE Transporte_DELETE();

CREATE TABLE Prestamo_transporte(
Placa VARCHAR(10),
F_inicio DATE NOT NULL,
F_fin DATE NOT NULL,
Id_empleado INT,
FOREIGN KEY (Placa) REFERENCES Transporte(Placa),
FOREIGN KEY (Id_empleado) REFERENCES Empleado(Id_empleado));

#Tabla 1 UPDATE
CREATE TABLE Prestamo_transporte_UPDATE(
Placa VARCHAR(10),
F_inicio DATE NOT NULL,
F_fin DATE NOT NULL,
Id_empleado INT,
actualizado_el TIMESTAMP(6) NOT NULL);

#Tabla 2 DELETE
CREATE TABLE Prestamo_transporte_DELETE(
Placa VARCHAR(10),
F_inicio DATE NOT NULL,
F_fin DATE NOT NULL,
Id_empleado INT,
eliminado_el TIMESTAMP(6) NOT NULL);

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION Prestamo_transporte_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.Id_empleado <> OLD.Id_empleado THEN
             INSERT INTO Prestamo_transporte_UPDATE(Placa,
                F_inicio,F_fin,Id_empleado,actualizado_el)
             VALUES(OLD.Placa,OLD.F_inicio,OLD.F_fin,OLD.Id_empleado,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER Prestamo_transporte_UPDATE
 BEFORE UPDATE
 ON Prestamo_transporte 
 FOR EACH ROW 
 EXECUTE PROCEDURE Prestamo_transporte_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION Prestamo_transporte_DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Placa IS NOT NULL THEN
        INSERT INTO Prestamo_transporte_DELETE(Placa,
                F_inicio,F_fin,Id_empleado,eliminado_el)
        VALUES (OLD.Placa,OLD.F_inicio,OLD.F_fin,OLD.Id_empleado,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER Prestamo_transporte_DELETE
AFTER DELETE
ON Prestamo_transporte
FOR EACH ROW
EXECUTE PROCEDURE Prestamo_transporte_DELETE();

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

#Table 1 UPDATE
CREATE TABLE expediente_UPDATE(
Id_expediente SERIAL NOT NULL PRIMARY KEY,
Diagnosticos VARCHAR(50) NOT NULL,
actualizado_el TIMESTAMP(6) NOT NULL);

#Table 2 DELETE
CREATE TABLE expediente_DELETE(
Id_expediente SERIAL NOT NULL PRIMARY KEY,
Diagnosticos VARCHAR(50) NOT NULL,
eliminado_el TIMESTAMP(6) NOT NULL);

#Funcion para trigger UPDATE
CREATE OR REPLACE FUNCTION expediente_UPDATE()
 RETURNS TRIGGER
 LANGUAGE PLPGSQL
 AS
$$
BEGIN
       IF NEW.Diagnosticos <> OLD.Diagnosticos THEN
             INSERT INTO expediente_UPDATE(Id_expediente,
                Diagnosticos,actualizado_el)
             VALUES(OLD.Id_expediente,OLD.Diagnosticos,now());
       END IF;
       
       RETURN NEW;

END;
$$
;
#Trigger UPDATE
CREATE OR REPLACE TRIGGER expediente_UPDATE
 BEFORE UPDATE
 ON expediente 
 FOR EACH ROW 
 EXECUTE PROCEDURE expediente_UPDATE();

#Funcion para trigger eliminar 
CREATE OR REPLACE FUNCTION expediente_DELETE()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS $$
BEGIN
    IF OLD.Id_expediente IS NOT NULL THEN
        INSERT INTO expediente_DELETE(Id_expediente,
                Diagnosticos,eliminado_el)
        VALUES (OLD.Id_expediente,OLD.Diagnosticos,now());
    END IF;
    RETURN OLD;
END;
$$;
#trigger eliminar 
CREATE OR REPLACE TRIGGER expediente_DELETE
AFTER DELETE
ON expediente
FOR EACH ROW
EXECUTE PROCEDURE expediente_DELETE();

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

# ROLLUP n+1
select nombre,tipo,marca, SUM(precio) Suma from 
producto GROUP BY ROLLUP (nombre,tipo,marca)
ORDER BY nombre,marca,tipo;

# CUBE 2^n
select nombre,tipo,marca, SUM(precio) Suma from 
producto GROUP BY CUBE (nombre,tipo,marca)
ORDER BY nombre,marca,tipo;

#RANK() Y DENSE_RANK()
select marca, Rank() over(order by marca),dense_rank() over(order by marca) 
from producto;