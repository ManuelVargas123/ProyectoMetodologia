@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Cajas Herramientas</h2>

		<div>
			<table id="table_id" class="display">
				<thead>
					<th>Cantidad</th>
					<th>Marca</th>
					<th>Tipo</th>
					<th>Descripcion</th>
				</thead>
				<tbody>
					@foreach($ConsultaCajas_herramientas as $Cajas_herramientas)
						<tr>
							<td>{{$Cajas_herramientas->}}</td>
							<td>{{$Cajas_herramientas->}}</td>
							<td>{{$Cajas_herramientas->}}</td>
							<td>{{$Cajas_herramientas->}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
@endsection
