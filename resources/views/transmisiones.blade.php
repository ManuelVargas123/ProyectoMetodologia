@extends('layouts.master')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Necesario para usar ajax -->
@endsection

@section('content')
	@if(count($errors) > 0)
		<div style="background-color: #f15858; border-radius: 4px; border: 1px solid #de3c3c; color: #FFF; font-family: 'Roboto'; margin-top: 10px; padding: 0px 10px;">
			<ul>
				@foreach ($errors->all() as $error)
					<ul>
						<li>• {{ $error }}</li>
					</ul>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="row">
		<div class="col l7 s12">
			<h2 style="text-align: center;margin-top: 5px;">Transmisiones</h2>
		</div>
		<div class="col l5 s12" style="text-align: center; margin-top: 15px;">
			<a class="waves-effect waves-light btn modal-trigger" href="#modal_nueva_transmision">
				<i class="large material-icons" style="vertical-align: middle">add</i>
				<span style="vertical-align: middle">Agregar</span>
			</a>
		</div>
	</div>
	<table id="table_transmisiones" class="display striped responsive-table">
		<thead>
			<th>Nombre</th>
			<th>Modelo</th>
			<th>Cantidad</th>
			<th>Marca</th>
			<th>Descripción</th>
			<th>Modelos disponibles</th>
			<th>Palanca de cambios</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($transmisiones as $transmision)
				<tr>
					<td>{{ $transmision->nombre }}</td>
					<td>{{ $transmision->modelo }}</td>
					<td>{{ $transmision->cantidad }}</td>
					<td>{{ $transmision->marca }}</td>
					<td>{{ $transmision->descripcion }}</td>
					<td>{{ $transmision->modelosDisponibles }}</td>
					<td>{{ $transmision->palancaCambios }}</td>
					<td style="min-width: 60px;">
						<div class="tooltipped" data-position="top" data-tooltip="Editar" style="display: inline-block;">
							<a data-id="{{ $transmision->id }}" class="modal-trigger" href="#modal_editar_transmision"><i class="material-icons">edit</i></a>
						</div>

						<div  class="tooltipped" data-position="top" data-tooltip="Borrar" style="display: inline-block;">
							<form action="{{ route('transmisiones_destroy', $transmision->id) }}" method="POST">
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

	<!-- Modal - Nuevo motor -->
		<form id="modal_nueva_transmision" class="modal" action="{{ route('transmisiones_store') }}" method="POST">
			@csrf
			<div class="modal-content">
				<h4>Agregar nueva transmisión</h4>
				<div class="row">
					<div class="input-field col s6">
						<input name="nombre" id="nombre" type="text" class="validate">
						<label for="nombre">Nombre</label>
					</div>
					<div class="input-field col s6">
						<input name="modelo" id="modelo" type="text" class="validate">
						<label for="modelo">Modelo</label>
					</div>
					<div class="input-field col s6">
						<input name="cantidad" id="cantidad" type="number" class="validate">
						<label for="cantidad">Cantidad</label>
					</div>
					<div class="input-field col s6">
						<input name="marca" id="marca" type="text" class="validate">
						<label for="marca">Marca</label>
					</div>
					<div class="input-field col s6">
						<input name="descripcion" id="descripcion" type="text" class="validate">
						<label for="descripcion">Descripción</label>
					</div>
					<div class="input-field col s6">
						<input name="modelos_disponibles" id="modelos_disponibles" type="text" class="validate">
						<label for="modelos_disponibles">Modelos disponibles</label>
					</div>

					<div class="input-field col s6">
						<input name="palanca_cambios" id="palanca_cambios" type="text" class="validate">
						<label for="palanca_cambios">Palanca de cambios</label>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<center><button class="btn waves-effect waves-light" type="submit" name="action">Agregar<i class="material-icons right">send</i></button></center>
			</div>
		</form>

	<!-- Modal - Editar transmision-->
	<form id="modal_editar_transmision" class="modal" action="{{ route('transmisiones_update') }}" method="POST">
		@csrf
		<div class="modal-content">
			<h4>Editar transmisión</h4>
			<div class="row">
				<input id="editar_id" type="hidden" name="id" value="">
				<div class="input-field col s6">
					<input name="nombre" id="editar_nombre" type="text" class="validate" placeholder="">
					<label for="editar_nombre">Nombre</label>
				</div>
				<div class="input-field col s6">
					<input name="modelo" id="editar_modelo" type="text" class="validate" placeholder="">
					<label for="editar_modelo">Modelo</label>
				</div>
				<div class="input-field col s6">
					<input name="cantidad" id="editar_cantidad" type="number" class="validate" placeholder="">
					<label for="editar_cantidad">Cantidad</label>
				</div>
				<div class="input-field col s6">
					<input name="marca" id="editar_marca" type="text" class="validate" placeholder="">
					<label for="editar_marca">Marca</label>
				</div>
				<div class="input-field col s6">
					<input name="descripcion" id="editar_descripcion" type="text" class="validate" placeholder="">
					<label for="editar_descripcion">Descripción</label>
				</div>
				<div class="input-field col s6">
					<input name="modelos_disponibles" id="editar_modelos_disponibles" type="text" class="validate" placeholder="">
					<label for="editar_modelos_disponibles">Modelos disponibles</label>
				</div>

				<div class="input-field col s6">
					<input name="palanca_cambios" id="editar_palanca_cambios" type="text" class="validate" placeholder="">
					<label for="editar_palanca_cambios">Palanca de cambios</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<center><button class="btn waves-effect waves-light" type="submit" name="action">Editar<i class="material-icons right">send</i></button></center>
	</form>
@endsection

@section('footer')
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table_transmisiones').DataTable({ // Inicializar tabla
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
			$('.modal').modal(); // Inicializar Modal
			$('.tooltipped').tooltip(); // Inicializar tooltips
        });

		$('a[href$="modal_editar_transmision"]').click(function() {
			$.ajax({
				type: "POST",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '{{ route('transmisiones_edit') }}',
				data: {"id": $(this).data('id')},
				success: function(data) {
					$('#editar_id').val(data['id']);
					$('#editar_nombre').val(data['nombre']);
					$('#editar_modelo').val(data['modelo']);
					$('#editar_cantidad').val(data['cantidad']);
					$('#editar_marca').val(data['marca']);
					$('#editar_descripcion').val(data['descripcion']);
					$('#editar_modelos_disponibles').val(data['modelos_disponibles']);
					$('#editar_palanca_cambios').val(data['palanca_cambios']);
				},
				error: function(xhr, textStatus, errorThrown) {
					console.log("Ocurrió un error.");
				}
			});
		});
    </script>
@endsection
