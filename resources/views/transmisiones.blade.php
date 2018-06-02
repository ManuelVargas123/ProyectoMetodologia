@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Transmisiones</h2>

		<div>
			<table id="table_transmisores" class="display">
				<thead>
					<th>Nombre</th>
					<th>Modelo</th>
					<th>Cantidad</th>
					<th>Marca</th>
					<th>Descripcion</th>
					<th>Modelos disponibles</th>
					<th>Palanca de cambios</th>
					<th>Ultima actualizacion</th>
				</thead>
				<tbody>
					@foreach($transmisiones as $transmision)
						<tr>
							<td>{{ $transmision->nombre }}</td>
							<td>{{ $transmision->modelo }}</td>
							<td>{{ $transmision->cantidad }}</td>
							<td>{{ $transmision->marca }}</td>
							<td>{{ $transmision->descripcion }}</td>
							<td>{{ $transmision->modelosDisponibles }}</td>
							<td>{{ $transmision->palancaCambios }}</td>
							<td>{{ $transmision->updated_at }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table_transmisores').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection
