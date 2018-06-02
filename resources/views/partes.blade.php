@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<h2>Partes</h2>

		<div>
			<table id="table_partes" class="display">
				<thead>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</thead>
				<tbody>
					@foreach($partes as $parte)
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
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table_partes').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection
