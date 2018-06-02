@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Motores</h2>

		<div>
			<table id="table_id" class="display">
				<thead>
					<th>Nombre</th>
					<th>Modelo</th>
					<th>Cantidad</th>
					<th>Marca</th>
					<th>Descripcion</th>
					<th>Modelos disponibles</th>
					<th>Cilindros</th>
					<th>Ultima actualizacion</th>
				</thead>
				<tbody>
					@foreach($Consultamotores as $motores)
						<tr>
							<td>{{$motores->nombre}}</td>
							<td>{{$motores->modelo}}</td>
							<td>{{$motores->cantidad}}</td>
							<td>{{$motores->marca}}</td>
							<td>{{$motores->descripcion}}</td>
							<td>{{$motores->modelosDisponibles}}</td>
							<td>{{$motores->cilindros}}</td>
							<td>{{$motores->updated_at}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
@endsection
