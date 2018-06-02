<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/favicon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>Taller Andrés</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

    <!-- Con asset, laravel va a la carpeta 'public' y busca la ruta dada -->
    <link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">

    @yield('header')
</head>

<body background="{{asset('img/background.png')}}">
    <!--Menus desplegables-->
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="motores">Motores</a></li>
        <li><a href="transmisiones">Transmisiones</a></li>
        <li><a href="partes">Partes</a></li>
        <li><a href="empleados">Empleados</a></li>
        <li><a href="herramientas">Herramientas</a></li>
        <li><a href="cajas_herramientas">Cajas de herramientas</a></li>
    </ul>
    <ul id="dropdown2" class="dropdown-content">
        <li><a href="agregar_gerente">Agregar Gerente</a></li>
        <li><a href="eliminar_gerente">Eliminar Gerente</a></li>
        <li><a href="ver_gerentes">Ver tabla de Gerentes</a></li>
    </ul>

    <!-- La secciones que tengan el arroba isAdmin, endisAdmin,
    son las secciones que solo podra ver el Administrador -->

    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo" style="margin-left: 20px;"><img style="position: absolute;width: 270px;" src="/img/banner.png"></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                @isAdmin
                <li><a href="ventas">Ventas</a></li>
                <li><a class="dropdown-trigger" href="ventas" data-target="dropdown2">Gerentes<i class="material-icons right">arrow_drop_down</i></a></li>
                @endisAdmin
                <!-- Dropdown Trigger -->
                <li><a class="dropdown-trigger" href="#" data-target="dropdown1" style="margin-right: 10px;">Inventario<i class="material-icons right">arrow_drop_down</i></a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <p>
                            <button type="submit" class="waves-effect waves-light btn-small #ef5350 red lighten-1" style="margin-bottom: 40px; margin-right: 15px;">Salir</button>
                        </p>
                    </form>
                </li>
            </ul>
        </div>
    </nav>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
    <div class="container">
        @yield('content')
    </div>

    <!--  Scripts-->
    <script src="{{asset('js/materialize.min.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            //collapsible
            var elems = document.querySelectorAll('.collapsible');
            var options;
            var instances = M.Collapsible.init(elems, options);

            //select option
            var elems2 = document.querySelectorAll('select');
            var instances2 = M.FormSelect.init(elems2);

            //Menu desplegable navbar
            $(".dropdown-trigger").dropdown();
        });
    </script>
    @yield('footer')
</body>

</html>
