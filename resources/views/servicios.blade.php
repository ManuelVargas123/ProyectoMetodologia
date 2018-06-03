@extends('layouts.master')

@section('header')
	<meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Necesario para usar ajax -->
@endsection

@section('content')
	<div class="row">
		<div class="col s8">
			<h2>Servicios</h2>
		</div>
		<div class="col s4" style="text-align: right; margin-top: 20px;">
			<a class="waves-effect waves-light btn modal-trigger" href="#modal_nuevo_servicio">
				<i class="large material-icons" style="vertical-align: middle">add</i>
				<span style="vertical-align: middle">Agregar</span>
			</a>
		</div>
	</div>
	<table id="table_servicios" class="display striped">
		<thead>
			<th>Servicio</th>
			<th>Costo</th>
			<th>Fecha</th>
			<th>Descripcion</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($servicios as $servicio)
				<tr>
					<td>{{ $servicio->servicio }}</td>
					<td>{{ $servicio->costo }}</td>
					<td>{{ $servicio->fecha }}</td>
					<td>{{ $servicio->descripcion }}</td>
					<td style="min-width: 60px;">
						<div class="tooltipped" data-position="top" data-tooltip="Editar" style="display: inline-block;">
							<a data-id="{{ $servicio->id }}" class="modal-trigger" href="#modal_editar_servicio"><i class="material-icons">edit</i></a>
						</div>

						<div  class="tooltipped" data-position="top" data-tooltip="Borrar" style="display: inline-block;">
							<form action="{{ route('servicios_destroy', $servicio->id) }}" method="POST">
								@csrf
								<input type="hidden" name="_method" value="delete" />
								<button type="submit" name="button" style="border: 0; background: transparent; color: #2195d6; cursor: pointer;"><i class="material-icons">delete_forever</i></button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<!-- Modal - Nuevo servicio -->
	<form id="modal_nuevo_servicio" class="modal" action="{{ route('servicios_store') }}" method="POST">
		@csrf
		<div class="modal-content">
			<h4>Agregar un nuevo Servicio</h4>
			<div class="row">
				<div class="input-field col s6">
					<input name="servicio" id="servicio" type="text" class="validate">
					<label for="servicio">Servicio</label>
				</div>
				<div class="input-field col s6">
					<input name="costo" id="costo" type="number" min="0.00" max="10000.00" step="0.01" class="validate">
					<label for="costo">Costo</label>
				</div>
				<div class="input-field col s6">
					<input name="fecha" id="fecha" type="date" class="validate">
					<label for="fecha">Fecha</label>
				</div>
				<div class="input-field col s6">
					<input name="descripcion" id="descripcion" type="text" class="validate">
					<label for="descripcion">Descripcion</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="button" class="modal-close waves-effect waves-green btn-flat">Guardar</button>
		</div>
	</form>

	<!-- Modal - Editar servicio -->
	<form id="modal_editar_servicio" class="modal" action="{{ route('servicios_update') }}" method="POST">
		@csrf
		<div class="modal-content">
			<h4>Editar Servicio</h4>
			<div class="row">
				<input id="editar_id" type="hidden" name="id" value="">
				<div class="input-field col s6">
					<input name="servicio" id="editar_servicio" type="text" class="validate" placeholder="">
					<label for="editar_servicio">Servicio</label>
				</div>
				<div class="input-field col s6">
					<input name="costo" id="editar_costo" type="text" class="validate" placeholder="">
					<label for="editar_costo">Costo</label>
				</div>
				<div class="input-field col s6">
					<input name="fecha" id="editar_fecha" type="text" class="validate" placeholder="">
					<label for="editar_fecha">Fecha</label>
				</div>
				<div class="input-field col s6">
					<input name="descripcion" id="editar_descripcion" type="text" class="validate" placeholder="">
					<label for="editar_descripcion">Descripcion</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="button" class="modal-close waves-effect waves-green btn-flat">Guardar</button>
		</div>
	</form>
@endsection

@section('footer')
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table_servicios').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
            $('.modal').modal(); // Inicializar Modal
			$('.tooltipped').tooltip(); // Inicializar tooltips
        });
        $('a[href$="modal_editar_servicio"]').click(function() {
			$.ajax({
				type: "POST",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '{{ route('servicios_edit') }}',
				data: {"id": $(this).data('id')},
				success: function(data) {
					$('#editar_id').val(data['id']);
					$('#editar_servicio').val(data['servicio']);
					$('#editar_costo').val(data['costo']);
					$('#editar_fecha').val(data['fecha']);
					$('#editar_descripcion').val(data['descripcion']);
				},
				error: function(xhr, textStatus, errorThrown) {
					console.log("Ocurrió un error.");
				}
			});
		});
    </script>
@endsection