@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Transmisiones</h2>

		<div>
			<table id="table_id" class="display">
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
					@foreach($Consultatransmisiones as $transmisiones)
						<tr>
							<td>{{$transmisiones->nombre}}</td>
							<td>{{$transmisiones->modelo}}</td>
							<td>{{$transmisiones->cantidad}}</td>
							<td>{{$transmisiones->marca}}</td>
							<td>{{$transmisiones->descripcion}}</td>
							<td>{{$transmisiones->modelosDisponibles}}</td>
							<td>{{$transmisiones->palancaCambios}}</td>
							<td>{{$transmisiones->updated_at}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
@endsection
