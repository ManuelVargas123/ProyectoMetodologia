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
			<h2 style="text-align: center;margin-top: 5px;">Herramientas</h2>
		</div>
		<div class="col l5 s12" style="text-align: center; margin-top: 15px;">
			<a class="waves-effect waves-light btn modal-trigger" href="#modal_nueva_herramienta">
				<i class="large material-icons" style="vertical-align: middle">add</i>
				<span style="vertical-align: middle">Agregar</span>
			</a>
		</div>
	</div>
	<table id="table_herramientas" class="display striped responsive-table">
		<thead>
			<th>Cantidad</th>
			<th>Marca</th>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>Caja</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($herramientas as $herramienta)
				<tr>
					<td>{{ $herramienta->cantidad }}</td>
					<td>{{ $herramienta->marca }}</td>
					<td>{{ $herramienta->nombre }}</td>
					<td>{{ $herramienta->descripcion }}</td>
					<td>{{ $herramienta->caja_id }}</td>
					<td style="min-width: 60px;">
						<div class="tooltipped" data-position="top" data-tooltip="Editar" style="display: inline-block;">
							<a data-id="{{ $herramienta->id }}" class="modal-trigger" href="#modal_editar_herramienta"><i class="material-icons">edit</i></a>
						</div>

						<div  class="tooltipped" data-position="top" data-tooltip="Borrar" style="display: inline-block;">
							<form action="{{ route('herramientas_destroy', $herramienta->id) }}" method="POST">
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

	<!-- Modal - Nueva herramienta -->
	<form id="modal_nueva_herramienta" class="modal" action="{{ route('herramientas_store') }}" method="POST">
		@csrf
		<div class="modal-content">
			<h4>Agregar nueva herramienta</h4>
			<div class="row">
				<div class="input-field col s6">
					<input name="cantidad" id="cantidad" type="number" class="validate">
					<label for="cantidad">Cantidad</label>
				</div>
				<div class="input-field col s6">
					<input name="marca" id="marca" type="text" class="validate">
					<label for="marca">Marca</label>
				</div>
				<div class="input-field col s6">
					<input name="nombre" id="nombre" type="text" class="validate">
					<label for="nombre">Nombre</label>
				</div>
				<div class="input-field col s6">
					<input name="descripcion" id="descripcion" type="text" class="validate">
					<label for="descripcion">Descripción</label>
				</div>
				<div class="input-field col s12">
					<select name="caja_herramientas">
						<option value="" selected>Ninguno</option>
						@foreach ($cajas as $caja)
							<option value="{{ $caja->id }}">Caja #{{ $caja->id }}</option>
						@endforeach
					</select>
					<label>Caja de herramienta</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<center><button class="btn waves-effect waves-light" type="submit" name="action">Agregar<i class="material-icons right">send</i></button></center>
		</div>
	</form>

	<!-- Modal - Editar herramienta -->
	<form id="modal_editar_herramienta" class="modal" action="{{ route('herramientas_update') }}" method="POST">
		@csrf
		<div class="modal-content">
			<h4>Editar herramienta</h4>
			<div class="row">
				<input id="editar_id" type="hidden" name="id" value="">
				<div class="input-field col s6">
					<input name="cantidad" id="editar_cantidad" type="number" class="validate" placeholder="">
					<label for="editad_cantidad">Cantidad</label>
				</div>
				<div class="input-field col s6">
					<input name="marca" id="editar_marca" type="text" class="validate" placeholder="">
					<label for="editar_marca">Marca</label>
				</div>
				<div class="input-field col s6">
					<input name="nombre" id="editar_nombre" type="text" class="validate" placeholder="">
					<label for="editar_nombre">Nombre</label>
				</div>
				<div class="input-field col s6">
					<input name="descripcion" id="editar_descripcion" type="text" class="validate" placeholder="">
					<label for="editar_descripcion">Descripción</label>
				</div>
				<div class="input-field col s12">
					<select name="caja_herramientas" id="editar_caja_herramientas">
						<option value="">Ninguno</option>
						@foreach ($cajas as $caja)
							<option value="{{ $caja->id }}">Caja #{{ $caja->id }}</option>
						@endforeach
					</select>
					<label>Caja de herramienta</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<center><button class="btn waves-effect waves-light" type="submit" name="action">Editar<i class="material-icons right">send</i></button></center>
		</div>
	</form>

@endsection

@section('footer')
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table_herramientas').DataTable({ // Inicializar tabla
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
			$('.modal').modal(); // Inicializar Modal
			$('.tooltipped').tooltip(); // Inicializar tooltips
        });

		$('a[href$="modal_editar_herramienta"]').click(function() {
			$.ajax({
				type: "POST",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '{{ route('herramientas_edit') }}',
				data: {"id": $(this).data('id')},
				success: function(data) {
					$('#editar_id').val(data['id']);
					$('#editar_cantidad').val(data['cantidad']);
					$('#editar_marca').val(data['marca']);
					$('#editar_nombre').val(data['nombre']);
					$('#editar_descripcion').val(data['descripcion']);
					$('#editar_caja_herramientas option:eq('+data['caja_herramientas']+')').prop('selected', true);
				},
				error: function(xhr, textStatus, errorThrown) {
					console.log("Ocurrió un error.");
				}
			});
		});
    </script>
@endsection
