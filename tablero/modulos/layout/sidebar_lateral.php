<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 menu_lateral">

    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ADMINISTRATIVO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- MENU DE Administración y Organización -->
        <!-- Sidebar Menu -->
        <nav class="mt-2 ">

            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Administración y Organización
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','departamentos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Departamentos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Empleado</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expediente</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hospital</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pacientes</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Responsable</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pisos</p>
                            </a>
                        </li>

                    </ul>

                </li>

                <!-- MENU DE Almacenamiento y Inventario-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Almacenamiento y Inventario
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/categorias.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="fas fa-archive nav-icon"></i>
                                <p>Almacen_insumos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="fas fa-tint nav-icon"></i>
                                <p>Hemocomponentes</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="fas fa-box nav-icon"></i>
                                <p>Prod_entrada</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <p>Producto</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="fas fa-truck nav-icon"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logística y Transporte-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-shipping-fast nav-icon"></i>
                        <p>
                            Logística y Transporte
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/categorias.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Prestamo_transporte</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transporte</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Servicios y Atención Médica:-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-hospital nav-icon"></i>
                        <p>
                            Servicios y Atención Médica
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/categorias.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cocina</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Facturación</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Historial_cuenta_productos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Historial_cuenta_servicios</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Imagenología</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laboratorio</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mantenimiento_gral</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orden_estudio</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/productos.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Servicios</p>
                            </a>
                        </li>
                    </ul>
                </li>







                <!-- Configuracion-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-hospital nav-icon"></i>
                        <p>
                            Configuracion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a onclick="cargarContenido('content-wrapper','modulos/categorias.php')" class="nav-link"
                                style="cursor: pointer;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>

                    </ul>
                </li>










            </ul>

            <ul class="nav nav-pills nav-sidebar nav_profile">
                <li class="nav-item">
                    <a href="../principal/index.html" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Cerrar Sesion
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>