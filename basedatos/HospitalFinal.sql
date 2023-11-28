PGDMP  5    "    	        
    {            HospitalFinal    16.1    16.1 b    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16414    HospitalFinal    DATABASE     �   CREATE DATABASE "HospitalFinal" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Mexico.1252';
    DROP DATABASE "HospitalFinal";
                postgres    false                        2615    16415    hospital    SCHEMA        CREATE SCHEMA hospital;
    DROP SCHEMA hospital;
                postgres    false            �            1259    16471    almacen_insumos    TABLE     �   CREATE TABLE public.almacen_insumos (
    id_prod_entrada integer,
    id_departamento integer,
    merma integer NOT NULL,
    stock integer NOT NULL
);
 #   DROP TABLE public.almacen_insumos;
       public         heap    postgres    false            �            1259    16484    cocina    TABLE     	  CREATE TABLE public.cocina (
    id_dieta integer NOT NULL,
    nombre character varying(20) NOT NULL,
    calorias double precision NOT NULL,
    tipo character varying(20) NOT NULL,
    especificaciones character varying(100) NOT NULL,
    id_paciente integer
);
    DROP TABLE public.cocina;
       public         heap    postgres    false            �            1259    16451    departamentos    TABLE     �   CREATE TABLE public.departamentos (
    id_departamento integer NOT NULL,
    nombre character varying(50) NOT NULL,
    descripcion character varying(100) NOT NULL
);
 !   DROP TABLE public.departamentos;
       public         heap    postgres    false            �            1259    16574    empleado    TABLE       CREATE TABLE public.empleado (
    id_empleado integer NOT NULL,
    nombre character varying(20) NOT NULL,
    apellido character varying(20) NOT NULL,
    puesto character varying(20) NOT NULL,
    turno character varying(15) NOT NULL,
    id_departamento integer
);
    DROP TABLE public.empleado;
       public         heap    postgres    false            �            1259    16662 
   expediente    TABLE     �  CREATE TABLE public.expediente (
    id_expediente integer NOT NULL,
    diagnosticos character varying(50) NOT NULL,
    tratamientos character varying(50) NOT NULL,
    intervenciones_quirurgicas character varying(50) NOT NULL,
    sintomas character varying(50) NOT NULL,
    antecedentes character varying(100) NOT NULL,
    f_ingreso date NOT NULL,
    f_egreso date,
    descripcion character varying(150) NOT NULL,
    id_paciente integer,
    id_departamento integer
);
    DROP TABLE public.expediente;
       public         heap    postgres    false            �            1259    16554    facturacion    TABLE       CREATE TABLE public.facturacion (
    id_factura integer NOT NULL,
    fecha date NOT NULL,
    subtotal double precision NOT NULL,
    cfdi character varying(40) NOT NULL,
    id_cuenta_prod integer,
    id_cuenta_serv integer,
    id_responsable integer
);
    DROP TABLE public.facturacion;
       public         heap    postgres    false            �            1259    16594    hemocomponentes    TABLE     �   CREATE TABLE public.hemocomponentes (
    id_hemocomponente integer NOT NULL,
    nombre character varying(30) NOT NULL,
    grupo character varying(10) NOT NULL,
    rh character varying(5),
    ml double precision
);
 #   DROP TABLE public.hemocomponentes;
       public         heap    postgres    false            �            1259    16514    historial_cuenta_productos    TABLE     �   CREATE TABLE public.historial_cuenta_productos (
    id_cuenta_prod integer NOT NULL,
    concepto character varying(20) NOT NULL,
    fecha_cargo date NOT NULL,
    cantidad integer NOT NULL,
    id_producto integer
);
 .   DROP TABLE public.historial_cuenta_productos;
       public         heap    postgres    false            �            1259    16544    historial_cuenta_servicios    TABLE     �   CREATE TABLE public.historial_cuenta_servicios (
    id_cuenta_serv integer NOT NULL,
    concepto character varying(30) NOT NULL,
    fecha_cargo date NOT NULL,
    cantidad integer NOT NULL,
    id_servicios integer
);
 .   DROP TABLE public.historial_cuenta_servicios;
       public         heap    postgres    false            �            1259    16416    hospital    TABLE     �   CREATE TABLE public.hospital (
    rfc_hospital character varying(13) NOT NULL,
    nombre character varying(50) NOT NULL,
    direccion character varying(60) NOT NULL,
    email character varying(30) NOT NULL
);
    DROP TABLE public.hospital;
       public         heap    postgres    false            �            1259    16584    imagenologia    TABLE     �   CREATE TABLE public.imagenologia (
    id_estudio integer NOT NULL,
    tipo character varying(20) NOT NULL,
    id_departamento integer
);
     DROP TABLE public.imagenologia;
       public         heap    postgres    false            �            1259    16599    laboratorio    TABLE     �   CREATE TABLE public.laboratorio (
    id_laboratorio integer NOT NULL,
    muestra character varying(20) NOT NULL,
    id_departamento integer,
    id_hemocomponentes integer
);
    DROP TABLE public.laboratorio;
       public         heap    postgres    false            �            1259    16614    mantenimiento_gral    TABLE     7  CREATE TABLE public.mantenimiento_gral (
    id_equipo integer NOT NULL,
    nombre character varying(30) NOT NULL,
    cantidad integer NOT NULL,
    fecha_mantenimiento date NOT NULL,
    activo character varying(20) NOT NULL,
    tipo_de_equipo character varying(20) NOT NULL,
    id_departamento integer
);
 &   DROP TABLE public.mantenimiento_gral;
       public         heap    postgres    false            �            1259    16624    orden_estudio    TABLE     �   CREATE TABLE public.orden_estudio (
    id_orden integer NOT NULL,
    descripcion character varying(20) NOT NULL,
    id_estudio integer,
    id_laboratorio integer,
    id_paciente integer
);
 !   DROP TABLE public.orden_estudio;
       public         heap    postgres    false            �            1259    16426 	   pacientes    TABLE     h  CREATE TABLE public.pacientes (
    id_paciente integer NOT NULL,
    nombre character varying(20) NOT NULL,
    apellido character varying(20) NOT NULL,
    fec_nac date NOT NULL,
    sexo character varying(1) NOT NULL,
    telefono bigint NOT NULL,
    direccion character varying(60) NOT NULL,
    no_piso integer,
    rfc_hospital character varying(13)
);
    DROP TABLE public.pacientes;
       public         heap    postgres    false            �            1259    16421    pisos    TABLE     �   CREATE TABLE public.pisos (
    no_piso integer NOT NULL,
    hab_cama character varying(10) NOT NULL,
    especialidad character varying(30) NOT NULL
);
    DROP TABLE public.pisos;
       public         heap    postgres    false            �            1259    16649    prestamo_transporte    TABLE     �   CREATE TABLE public.prestamo_transporte (
    placa character varying(10),
    f_inicio date NOT NULL,
    f_fin date NOT NULL,
    id_empleado integer
);
 '   DROP TABLE public.prestamo_transporte;
       public         heap    postgres    false            �            1259    16461    prod_entrada    TABLE     �   CREATE TABLE public.prod_entrada (
    id_prod_entrada integer NOT NULL,
    lote character varying(12) NOT NULL,
    cantidad integer NOT NULL,
    f_cad date NOT NULL,
    f_entrada date NOT NULL,
    f_salida date NOT NULL,
    id_producto integer
);
     DROP TABLE public.prod_entrada;
       public         heap    postgres    false            �            1259    16456    producto    TABLE     �   CREATE TABLE public.producto (
    id_producto integer NOT NULL,
    nombre character varying(30) NOT NULL,
    precio double precision NOT NULL,
    tipo character varying(20) NOT NULL,
    marca character varying(50) NOT NULL
);
    DROP TABLE public.producto;
       public         heap    postgres    false            �            1259    16504    proveedores    TABLE     �   CREATE TABLE public.proveedores (
    id_proveedor integer NOT NULL,
    empresa character varying(30) NOT NULL,
    id_producto integer
);
    DROP TABLE public.proveedores;
       public         heap    postgres    false            �            1259    16441    responsable    TABLE     q  CREATE TABLE public.responsable (
    id_responsable integer NOT NULL,
    nombre character varying(20) NOT NULL,
    apellido character varying(20) NOT NULL,
    fec_nac date NOT NULL,
    sexo character varying(1) NOT NULL,
    telefono bigint NOT NULL,
    direccion character varying(60) NOT NULL,
    rfc character varying(12) NOT NULL,
    id_paciente integer
);
    DROP TABLE public.responsable;
       public         heap    postgres    false            �            1259    16494 	   servicios    TABLE     �   CREATE TABLE public.servicios (
    id_servicio integer NOT NULL,
    concepto character varying(30) NOT NULL,
    precio double precision NOT NULL,
    id_departamento integer
);
    DROP TABLE public.servicios;
       public         heap    postgres    false            �            1259    16644 
   transporte    TABLE     �   CREATE TABLE public.transporte (
    placa character varying(10) NOT NULL,
    modelo character varying(20) NOT NULL,
    marca character varying(20) NOT NULL,
    disponibilidad character varying(10) NOT NULL
);
    DROP TABLE public.transporte;
       public         heap    postgres    false            �          0    16471    almacen_insumos 
   TABLE DATA           Y   COPY public.almacen_insumos (id_prod_entrada, id_departamento, merma, stock) FROM stdin;
    public          postgres    false    223   ˇ       �          0    16484    cocina 
   TABLE DATA           a   COPY public.cocina (id_dieta, nombre, calorias, tipo, especificaciones, id_paciente) FROM stdin;
    public          postgres    false    224   �                 0    16451    departamentos 
   TABLE DATA           M   COPY public.departamentos (id_departamento, nombre, descripcion) FROM stdin;
    public          postgres    false    220   �       �          0    16574    empleado 
   TABLE DATA           a   COPY public.empleado (id_empleado, nombre, apellido, puesto, turno, id_departamento) FROM stdin;
    public          postgres    false    230   "�       �          0    16662 
   expediente 
   TABLE DATA           �   COPY public.expediente (id_expediente, diagnosticos, tratamientos, intervenciones_quirurgicas, sintomas, antecedentes, f_ingreso, f_egreso, descripcion, id_paciente, id_departamento) FROM stdin;
    public          postgres    false    238   ?�       �          0    16554    facturacion 
   TABLE DATA           x   COPY public.facturacion (id_factura, fecha, subtotal, cfdi, id_cuenta_prod, id_cuenta_serv, id_responsable) FROM stdin;
    public          postgres    false    229   \�       �          0    16594    hemocomponentes 
   TABLE DATA           S   COPY public.hemocomponentes (id_hemocomponente, nombre, grupo, rh, ml) FROM stdin;
    public          postgres    false    232   y�       �          0    16514    historial_cuenta_productos 
   TABLE DATA           r   COPY public.historial_cuenta_productos (id_cuenta_prod, concepto, fecha_cargo, cantidad, id_producto) FROM stdin;
    public          postgres    false    227   ��       �          0    16544    historial_cuenta_servicios 
   TABLE DATA           s   COPY public.historial_cuenta_servicios (id_cuenta_serv, concepto, fecha_cargo, cantidad, id_servicios) FROM stdin;
    public          postgres    false    228   ��       {          0    16416    hospital 
   TABLE DATA           J   COPY public.hospital (rfc_hospital, nombre, direccion, email) FROM stdin;
    public          postgres    false    216   Ј       �          0    16584    imagenologia 
   TABLE DATA           I   COPY public.imagenologia (id_estudio, tipo, id_departamento) FROM stdin;
    public          postgres    false    231   �       �          0    16599    laboratorio 
   TABLE DATA           c   COPY public.laboratorio (id_laboratorio, muestra, id_departamento, id_hemocomponentes) FROM stdin;
    public          postgres    false    233   
�       �          0    16614    mantenimiento_gral 
   TABLE DATA           �   COPY public.mantenimiento_gral (id_equipo, nombre, cantidad, fecha_mantenimiento, activo, tipo_de_equipo, id_departamento) FROM stdin;
    public          postgres    false    234   '�       �          0    16624    orden_estudio 
   TABLE DATA           g   COPY public.orden_estudio (id_orden, descripcion, id_estudio, id_laboratorio, id_paciente) FROM stdin;
    public          postgres    false    235   D�       }          0    16426 	   pacientes 
   TABLE DATA           }   COPY public.pacientes (id_paciente, nombre, apellido, fec_nac, sexo, telefono, direccion, no_piso, rfc_hospital) FROM stdin;
    public          postgres    false    218   a�       |          0    16421    pisos 
   TABLE DATA           @   COPY public.pisos (no_piso, hab_cama, especialidad) FROM stdin;
    public          postgres    false    217   ~�       �          0    16649    prestamo_transporte 
   TABLE DATA           R   COPY public.prestamo_transporte (placa, f_inicio, f_fin, id_empleado) FROM stdin;
    public          postgres    false    237   ��       �          0    16461    prod_entrada 
   TABLE DATA           p   COPY public.prod_entrada (id_prod_entrada, lote, cantidad, f_cad, f_entrada, f_salida, id_producto) FROM stdin;
    public          postgres    false    222   ��       �          0    16456    producto 
   TABLE DATA           L   COPY public.producto (id_producto, nombre, precio, tipo, marca) FROM stdin;
    public          postgres    false    221   Չ       �          0    16504    proveedores 
   TABLE DATA           I   COPY public.proveedores (id_proveedor, empresa, id_producto) FROM stdin;
    public          postgres    false    226   �       ~          0    16441    responsable 
   TABLE DATA           }   COPY public.responsable (id_responsable, nombre, apellido, fec_nac, sexo, telefono, direccion, rfc, id_paciente) FROM stdin;
    public          postgres    false    219   �       �          0    16494 	   servicios 
   TABLE DATA           S   COPY public.servicios (id_servicio, concepto, precio, id_departamento) FROM stdin;
    public          postgres    false    225   ,�       �          0    16644 
   transporte 
   TABLE DATA           J   COPY public.transporte (placa, modelo, marca, disponibilidad) FROM stdin;
    public          postgres    false    236   I�       �           2606    16488    cocina cocina_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.cocina
    ADD CONSTRAINT cocina_pkey PRIMARY KEY (id_dieta);
 <   ALTER TABLE ONLY public.cocina DROP CONSTRAINT cocina_pkey;
       public            postgres    false    224            �           2606    16455     departamentos departamentos_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (id_departamento);
 J   ALTER TABLE ONLY public.departamentos DROP CONSTRAINT departamentos_pkey;
       public            postgres    false    220            �           2606    16578    empleado empleado_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT empleado_pkey PRIMARY KEY (id_empleado);
 @   ALTER TABLE ONLY public.empleado DROP CONSTRAINT empleado_pkey;
       public            postgres    false    230            �           2606    16666    expediente expediente_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.expediente
    ADD CONSTRAINT expediente_pkey PRIMARY KEY (id_expediente);
 D   ALTER TABLE ONLY public.expediente DROP CONSTRAINT expediente_pkey;
       public            postgres    false    238            �           2606    16558    facturacion facturacion_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.facturacion
    ADD CONSTRAINT facturacion_pkey PRIMARY KEY (id_factura);
 F   ALTER TABLE ONLY public.facturacion DROP CONSTRAINT facturacion_pkey;
       public            postgres    false    229            �           2606    16598 $   hemocomponentes hemocomponentes_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.hemocomponentes
    ADD CONSTRAINT hemocomponentes_pkey PRIMARY KEY (id_hemocomponente);
 N   ALTER TABLE ONLY public.hemocomponentes DROP CONSTRAINT hemocomponentes_pkey;
       public            postgres    false    232            �           2606    16518 :   historial_cuenta_productos historial_cuenta_productos_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.historial_cuenta_productos
    ADD CONSTRAINT historial_cuenta_productos_pkey PRIMARY KEY (id_cuenta_prod);
 d   ALTER TABLE ONLY public.historial_cuenta_productos DROP CONSTRAINT historial_cuenta_productos_pkey;
       public            postgres    false    227            �           2606    16548 :   historial_cuenta_servicios historial_cuenta_servicios_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.historial_cuenta_servicios
    ADD CONSTRAINT historial_cuenta_servicios_pkey PRIMARY KEY (id_cuenta_serv);
 d   ALTER TABLE ONLY public.historial_cuenta_servicios DROP CONSTRAINT historial_cuenta_servicios_pkey;
       public            postgres    false    228            �           2606    16420    hospital hospital_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.hospital
    ADD CONSTRAINT hospital_pkey PRIMARY KEY (rfc_hospital);
 @   ALTER TABLE ONLY public.hospital DROP CONSTRAINT hospital_pkey;
       public            postgres    false    216            �           2606    16588    imagenologia imagenologia_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.imagenologia
    ADD CONSTRAINT imagenologia_pkey PRIMARY KEY (id_estudio);
 H   ALTER TABLE ONLY public.imagenologia DROP CONSTRAINT imagenologia_pkey;
       public            postgres    false    231            �           2606    16603    laboratorio laboratorio_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.laboratorio
    ADD CONSTRAINT laboratorio_pkey PRIMARY KEY (id_laboratorio);
 F   ALTER TABLE ONLY public.laboratorio DROP CONSTRAINT laboratorio_pkey;
       public            postgres    false    233            �           2606    16618 *   mantenimiento_gral mantenimiento_gral_pkey 
   CONSTRAINT     o   ALTER TABLE ONLY public.mantenimiento_gral
    ADD CONSTRAINT mantenimiento_gral_pkey PRIMARY KEY (id_equipo);
 T   ALTER TABLE ONLY public.mantenimiento_gral DROP CONSTRAINT mantenimiento_gral_pkey;
       public            postgres    false    234            �           2606    16628     orden_estudio orden_estudio_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.orden_estudio
    ADD CONSTRAINT orden_estudio_pkey PRIMARY KEY (id_orden);
 J   ALTER TABLE ONLY public.orden_estudio DROP CONSTRAINT orden_estudio_pkey;
       public            postgres    false    235            �           2606    16430    pacientes pacientes_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.pacientes
    ADD CONSTRAINT pacientes_pkey PRIMARY KEY (id_paciente);
 B   ALTER TABLE ONLY public.pacientes DROP CONSTRAINT pacientes_pkey;
       public            postgres    false    218            �           2606    16425    pisos pisos_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.pisos
    ADD CONSTRAINT pisos_pkey PRIMARY KEY (no_piso);
 :   ALTER TABLE ONLY public.pisos DROP CONSTRAINT pisos_pkey;
       public            postgres    false    217            �           2606    16465    prod_entrada prod_entrada_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.prod_entrada
    ADD CONSTRAINT prod_entrada_pkey PRIMARY KEY (id_prod_entrada);
 H   ALTER TABLE ONLY public.prod_entrada DROP CONSTRAINT prod_entrada_pkey;
       public            postgres    false    222            �           2606    16460    producto producto_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_pkey PRIMARY KEY (id_producto);
 @   ALTER TABLE ONLY public.producto DROP CONSTRAINT producto_pkey;
       public            postgres    false    221            �           2606    16508    proveedores proveedores_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.proveedores
    ADD CONSTRAINT proveedores_pkey PRIMARY KEY (id_proveedor);
 F   ALTER TABLE ONLY public.proveedores DROP CONSTRAINT proveedores_pkey;
       public            postgres    false    226            �           2606    16445    responsable responsable_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.responsable
    ADD CONSTRAINT responsable_pkey PRIMARY KEY (id_responsable);
 F   ALTER TABLE ONLY public.responsable DROP CONSTRAINT responsable_pkey;
       public            postgres    false    219            �           2606    16498    servicios servicios_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.servicios
    ADD CONSTRAINT servicios_pkey PRIMARY KEY (id_servicio);
 B   ALTER TABLE ONLY public.servicios DROP CONSTRAINT servicios_pkey;
       public            postgres    false    225            �           2606    16648    transporte transporte_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.transporte
    ADD CONSTRAINT transporte_pkey PRIMARY KEY (placa);
 D   ALTER TABLE ONLY public.transporte DROP CONSTRAINT transporte_pkey;
       public            postgres    false    236            �           2606    16479 4   almacen_insumos almacen_insumos_id_departamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.almacen_insumos
    ADD CONSTRAINT almacen_insumos_id_departamento_fkey FOREIGN KEY (id_departamento) REFERENCES public.departamentos(id_departamento);
 ^   ALTER TABLE ONLY public.almacen_insumos DROP CONSTRAINT almacen_insumos_id_departamento_fkey;
       public          postgres    false    223    220    4785            �           2606    16474 4   almacen_insumos almacen_insumos_id_prod_entrada_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.almacen_insumos
    ADD CONSTRAINT almacen_insumos_id_prod_entrada_fkey FOREIGN KEY (id_prod_entrada) REFERENCES public.prod_entrada(id_prod_entrada);
 ^   ALTER TABLE ONLY public.almacen_insumos DROP CONSTRAINT almacen_insumos_id_prod_entrada_fkey;
       public          postgres    false    222    4789    223            �           2606    16489    cocina cocina_id_paciente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.cocina
    ADD CONSTRAINT cocina_id_paciente_fkey FOREIGN KEY (id_paciente) REFERENCES public.pacientes(id_paciente);
 H   ALTER TABLE ONLY public.cocina DROP CONSTRAINT cocina_id_paciente_fkey;
       public          postgres    false    218    4781    224            �           2606    16579 &   empleado empleado_id_departamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT empleado_id_departamento_fkey FOREIGN KEY (id_departamento) REFERENCES public.departamentos(id_departamento);
 P   ALTER TABLE ONLY public.empleado DROP CONSTRAINT empleado_id_departamento_fkey;
       public          postgres    false    230    220    4785            �           2606    16672 *   expediente expediente_id_departamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.expediente
    ADD CONSTRAINT expediente_id_departamento_fkey FOREIGN KEY (id_departamento) REFERENCES public.departamentos(id_departamento);
 T   ALTER TABLE ONLY public.expediente DROP CONSTRAINT expediente_id_departamento_fkey;
       public          postgres    false    4785    220    238            �           2606    16667 &   expediente expediente_id_paciente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.expediente
    ADD CONSTRAINT expediente_id_paciente_fkey FOREIGN KEY (id_paciente) REFERENCES public.pacientes(id_paciente);
 P   ALTER TABLE ONLY public.expediente DROP CONSTRAINT expediente_id_paciente_fkey;
       public          postgres    false    218    238    4781            �           2606    16559 +   facturacion facturacion_id_cuenta_prod_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.facturacion
    ADD CONSTRAINT facturacion_id_cuenta_prod_fkey FOREIGN KEY (id_cuenta_prod) REFERENCES public.historial_cuenta_productos(id_cuenta_prod);
 U   ALTER TABLE ONLY public.facturacion DROP CONSTRAINT facturacion_id_cuenta_prod_fkey;
       public          postgres    false    4797    227    229            �           2606    16564 +   facturacion facturacion_id_cuenta_serv_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.facturacion
    ADD CONSTRAINT facturacion_id_cuenta_serv_fkey FOREIGN KEY (id_cuenta_serv) REFERENCES public.historial_cuenta_servicios(id_cuenta_serv);
 U   ALTER TABLE ONLY public.facturacion DROP CONSTRAINT facturacion_id_cuenta_serv_fkey;
       public          postgres    false    228    4799    229            �           2606    16569 +   facturacion facturacion_id_responsable_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.facturacion
    ADD CONSTRAINT facturacion_id_responsable_fkey FOREIGN KEY (id_responsable) REFERENCES public.responsable(id_responsable);
 U   ALTER TABLE ONLY public.facturacion DROP CONSTRAINT facturacion_id_responsable_fkey;
       public          postgres    false    4783    229    219            �           2606    16519 F   historial_cuenta_productos historial_cuenta_productos_id_producto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historial_cuenta_productos
    ADD CONSTRAINT historial_cuenta_productos_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES public.producto(id_producto);
 p   ALTER TABLE ONLY public.historial_cuenta_productos DROP CONSTRAINT historial_cuenta_productos_id_producto_fkey;
       public          postgres    false    221    227    4787            �           2606    16549 G   historial_cuenta_servicios historial_cuenta_servicios_id_servicios_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historial_cuenta_servicios
    ADD CONSTRAINT historial_cuenta_servicios_id_servicios_fkey FOREIGN KEY (id_servicios) REFERENCES public.servicios(id_servicio);
 q   ALTER TABLE ONLY public.historial_cuenta_servicios DROP CONSTRAINT historial_cuenta_servicios_id_servicios_fkey;
       public          postgres    false    228    4793    225            �           2606    16589 .   imagenologia imagenologia_id_departamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.imagenologia
    ADD CONSTRAINT imagenologia_id_departamento_fkey FOREIGN KEY (id_departamento) REFERENCES public.departamentos(id_departamento);
 X   ALTER TABLE ONLY public.imagenologia DROP CONSTRAINT imagenologia_id_departamento_fkey;
       public          postgres    false    4785    220    231            �           2606    16604 ,   laboratorio laboratorio_id_departamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.laboratorio
    ADD CONSTRAINT laboratorio_id_departamento_fkey FOREIGN KEY (id_departamento) REFERENCES public.departamentos(id_departamento);
 V   ALTER TABLE ONLY public.laboratorio DROP CONSTRAINT laboratorio_id_departamento_fkey;
       public          postgres    false    233    220    4785            �           2606    16609 /   laboratorio laboratorio_id_hemocomponentes_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.laboratorio
    ADD CONSTRAINT laboratorio_id_hemocomponentes_fkey FOREIGN KEY (id_hemocomponentes) REFERENCES public.hemocomponentes(id_hemocomponente);
 Y   ALTER TABLE ONLY public.laboratorio DROP CONSTRAINT laboratorio_id_hemocomponentes_fkey;
       public          postgres    false    4807    233    232            �           2606    16619 :   mantenimiento_gral mantenimiento_gral_id_departamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.mantenimiento_gral
    ADD CONSTRAINT mantenimiento_gral_id_departamento_fkey FOREIGN KEY (id_departamento) REFERENCES public.departamentos(id_departamento);
 d   ALTER TABLE ONLY public.mantenimiento_gral DROP CONSTRAINT mantenimiento_gral_id_departamento_fkey;
       public          postgres    false    4785    220    234            �           2606    16629 +   orden_estudio orden_estudio_id_estudio_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.orden_estudio
    ADD CONSTRAINT orden_estudio_id_estudio_fkey FOREIGN KEY (id_estudio) REFERENCES public.imagenologia(id_estudio);
 U   ALTER TABLE ONLY public.orden_estudio DROP CONSTRAINT orden_estudio_id_estudio_fkey;
       public          postgres    false    231    4805    235            �           2606    16634 /   orden_estudio orden_estudio_id_laboratorio_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.orden_estudio
    ADD CONSTRAINT orden_estudio_id_laboratorio_fkey FOREIGN KEY (id_laboratorio) REFERENCES public.laboratorio(id_laboratorio);
 Y   ALTER TABLE ONLY public.orden_estudio DROP CONSTRAINT orden_estudio_id_laboratorio_fkey;
       public          postgres    false    233    235    4809            �           2606    16639 ,   orden_estudio orden_estudio_id_paciente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.orden_estudio
    ADD CONSTRAINT orden_estudio_id_paciente_fkey FOREIGN KEY (id_paciente) REFERENCES public.pacientes(id_paciente);
 V   ALTER TABLE ONLY public.orden_estudio DROP CONSTRAINT orden_estudio_id_paciente_fkey;
       public          postgres    false    235    4781    218            �           2606    16431     pacientes pacientes_no_piso_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pacientes
    ADD CONSTRAINT pacientes_no_piso_fkey FOREIGN KEY (no_piso) REFERENCES public.pisos(no_piso);
 J   ALTER TABLE ONLY public.pacientes DROP CONSTRAINT pacientes_no_piso_fkey;
       public          postgres    false    218    217    4779            �           2606    16436 %   pacientes pacientes_rfc_hospital_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pacientes
    ADD CONSTRAINT pacientes_rfc_hospital_fkey FOREIGN KEY (rfc_hospital) REFERENCES public.hospital(rfc_hospital);
 O   ALTER TABLE ONLY public.pacientes DROP CONSTRAINT pacientes_rfc_hospital_fkey;
       public          postgres    false    218    4777    216            �           2606    16657 8   prestamo_transporte prestamo_transporte_id_empleado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo_transporte
    ADD CONSTRAINT prestamo_transporte_id_empleado_fkey FOREIGN KEY (id_empleado) REFERENCES public.empleado(id_empleado);
 b   ALTER TABLE ONLY public.prestamo_transporte DROP CONSTRAINT prestamo_transporte_id_empleado_fkey;
       public          postgres    false    237    4803    230            �           2606    16652 2   prestamo_transporte prestamo_transporte_placa_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo_transporte
    ADD CONSTRAINT prestamo_transporte_placa_fkey FOREIGN KEY (placa) REFERENCES public.transporte(placa);
 \   ALTER TABLE ONLY public.prestamo_transporte DROP CONSTRAINT prestamo_transporte_placa_fkey;
       public          postgres    false    4815    237    236            �           2606    16466 *   prod_entrada prod_entrada_id_producto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prod_entrada
    ADD CONSTRAINT prod_entrada_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES public.producto(id_producto);
 T   ALTER TABLE ONLY public.prod_entrada DROP CONSTRAINT prod_entrada_id_producto_fkey;
       public          postgres    false    222    221    4787            �           2606    16509 (   proveedores proveedores_id_producto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.proveedores
    ADD CONSTRAINT proveedores_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES public.producto(id_producto);
 R   ALTER TABLE ONLY public.proveedores DROP CONSTRAINT proveedores_id_producto_fkey;
       public          postgres    false    4787    226    221            �           2606    16446 (   responsable responsable_id_paciente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.responsable
    ADD CONSTRAINT responsable_id_paciente_fkey FOREIGN KEY (id_paciente) REFERENCES public.pacientes(id_paciente);
 R   ALTER TABLE ONLY public.responsable DROP CONSTRAINT responsable_id_paciente_fkey;
       public          postgres    false    219    218    4781            �           2606    16499 (   servicios servicios_id_departamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.servicios
    ADD CONSTRAINT servicios_id_departamento_fkey FOREIGN KEY (id_departamento) REFERENCES public.departamentos(id_departamento);
 R   ALTER TABLE ONLY public.servicios DROP CONSTRAINT servicios_id_departamento_fkey;
       public          postgres    false    4785    220    225            �      x������ � �      �      x������ � �            x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      {      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      }      x������ � �      |      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      ~      x������ � �      �      x������ � �      �      x������ � �     