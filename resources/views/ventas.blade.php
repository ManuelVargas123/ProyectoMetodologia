@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Ventas</h2>

		<div>
			<table id="table_ventas" class="display">
				<thead>
					<th>Cantidad</th>
					<th>Marca</th>
					<th>Tipo</th>
					<th>Descripcion</th>
				</thead>
				<tbody>
					@foreach($ventas as $venta)
						<tr>
							<td>{{$ventas->}}</td>
							<td>{{$ventas->}}</td>
							<td>{{$ventas->}}</td>
							<td>{{$ventas->}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table_ventas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection
