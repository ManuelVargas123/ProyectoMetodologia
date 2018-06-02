@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Empleados</h2>

		<div>
			<table id="table_id" class="display">
				<thead>
					<th>Nombre</th>
					<th>Apellido paterno</th>
					<th>Fecha de agregado</th>
				</thead>
				<tbody>
					@foreach($Consultaempleados as $empleados)
						<tr>
							<td>{{$empleados->nombre}}</td>
							<td>{{$empleados->primerApellido}}</td>
							<td>{{$empleados->created_at}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
@endsection
