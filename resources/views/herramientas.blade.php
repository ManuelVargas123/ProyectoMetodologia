@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Herramientas</h2>

		<div>
			<table id="table_herramientas" class="display">
				<thead>
					<th>Cantidad</th>
					<th>Marca</th>
					<th>Tipo</th>
					<th>Descripcion</th>
				</thead>
				<tbody>
					@foreach($herramientas as $herramienta)
						<tr>
							<td>{{ $herramientas->cantidad }}</td>
							<td>{{ $herramientas->marca }}</td>
							<td>{{ $herramientas->tipo }}</td>
							<td>{{ $herramientas->descripcion }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table_herramientas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection
