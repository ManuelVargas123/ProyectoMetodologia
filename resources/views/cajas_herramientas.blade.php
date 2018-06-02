@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Cajas Herramientas</h2>

		<div>
			<table id="table_caja_herramientas" class="display">
				<thead>
					<th>Cantidad</th>
					<th>Marca</th>
					<th>Tipo</th>
					<th>Descripcion</th>
				</thead>
				<tbody>
					@foreach($caja_herramientas as $caja_herramienta)
						<tr>
							<td>{{ $caja_herramienta-> }}</td>
							<td>{{ $caja_herramienta-> }}</td>
							<td>{{ $caja_herramienta-> }}</td>
							<td>{{ $caja_herramienta-> }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table_id').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection
