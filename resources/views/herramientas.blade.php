@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Herramientas</h2>

		<div>
			<table id="table_id" class="display">
				<thead>
					<th>Cantidad</th>
					<th>Marca</th>
					<th>Tipo</th>
					<th>Descripcion</th>
				</thead>
				<tbody>
					@foreach($Consultaherramientas as $herramienta)
						<tr>
							<td>{{$herramienta->cantidad}}</td>
							<td>{{$herramienta->marca}}</td>
							<td>{{$herramienta->tipo}}</td>
							<td>{{$herramienta->descripcion}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
@endsection
