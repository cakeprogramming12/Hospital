CREATE SCHEMA Hospital;
asasasas
CREATE TABLE Hospital(RFC_hospital VARCHAR (13) PRIMARY KEY,
Nombre VARCHAR(50) NOT NULL,
Direccion VARCHAR(60) NOT NULL,
Email VARCHAR(30) NOT NULL);


CREATE TABLE Pisos(
No_Piso INT PRIMARY KEY,
Hab_cama Varchar(10) NOT NULL,
Especialidad VARCHAR (30) NOT NULL);

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

CREATE TABLE departamentos(
Id_departamento INT PRIMARY KEY,
Nombre VARCHAR(50) NOT NULL,
Descripcion VARCHAR(100) NOT NULL);


CREATE TABLE Producto(
Id_producto INT PRIMARY KEY,
Nombre VARCHAR(30) NOT NULL,
Precio FLOAT NOT NULL,
Tipo VARCHAR (20) NOT NULL,
Marca VARCHAR(50) NOT NULL);


CREATE TABLE Prod_entrada(
ID_Prod_entrada INT PRIMARY KEY,
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
Id_proveedor INT PRIMARY KEY,
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
Id_empleado INT PRIMARY KEY,
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
Id_orden INT PRIMARY KEY,
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
Id_expediente INT,
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
PRIMARY KEY (Id_expediente,F_ingreso),
FOREIGN KEY (Id_paciente) REFERENCES pacientes(Id_paciente),
FOREIGN KEY (Id_departamento) REFERENCES departamentos(Id_departamento))
PARTITION BY RANGE (F_ingreso);


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
