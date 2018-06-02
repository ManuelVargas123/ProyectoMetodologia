@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Empleados</h2>

		<div>
			<table id="table_empleados" class="display">
				<thead>
					<th>Nombre</th>
					<th>Apellido paterno</th>
					<th>Fecha de agregado</th>
				</thead>
				<tbody>
					@foreach($empleados as $empleado)
						<tr>
							<td>{{ $empleado->nombre }}</td>
							<td>{{ $empleado->primerApellido }}</td>
							<td>{{ $empleado->created_at }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table_empleados').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection
