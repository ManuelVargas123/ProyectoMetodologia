@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Partes</h2>

		<div>
			<table id="table_id" class="display">
				<thead>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</thead>
				<tbody>
					@foreach($Consultapartes as $partes)
						<tr>
							<td>{{$partes->}}</td>
							<td>{{$partes->}}</td>
							<td>{{$partes->}}</td>
							<td>{{$partes->}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endsection

@section('footer')
@endsection
