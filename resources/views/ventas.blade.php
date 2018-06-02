@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Ventas</h2>

		<div>
			<table id="table_id" class="display">
				<thead>
					<th>Cantidad</th>
					<th>Marca</th>
					<th>Tipo</th>
					<th>Descripcion</th>
				</thead>
				<tbody>
					@foreach($Consultaventas as $ventas)
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
@endsection
