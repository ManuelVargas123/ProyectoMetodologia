@extends('layouts.master')

@section('header')
	<meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Necesario para usar ajax -->
@endsection

@section('content')
	<div class="row">
		<div class="col s8">
			<h2>Gerente</h2>
		</div>
		<div class="col s4" style="text-align: right; margin-top: 20px;">
			<a class="waves-effect waves-light btn modal-trigger" href="#modal_nuevo_gerente">
				<i class="large material-icons" style="vertical-align: middle">add</i>
				<span style="vertical-align: middle">Agregar</span>
			</a>
		</div>
	</div>
	<table id="table_gerentes" class="display">
		<thead>
			<th>Nombre</th>
			<th>Apellido paterno</th>
			<th>Correo electrónico</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($gerentes as $gerente)
				<tr>
					<td>{{ $gerente->nombre }}</td>
					<td>{{ $gerente->primerApellido }}</td>
					<td>{{ $gerente->email }}</td>
					<td style="min-width: 60px;">
						<div class="tooltipped" data-position="top" data-tooltip="Editar" style="display: inline-block;">
							<a data-id="{{ $gerente->id }}" class="modal-trigger" href="#modal_editar_gerente"><i class="material-icons">edit</i></a>
						</div>

						<div  class="tooltipped" data-position="top" data-tooltip="Borrar" style="display: inline-block;">
							<form action="{{ route('gerente_destroy', $gerente->id) }}" method="POST">
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

	<!-- Modal - Nuevo gerente -->
	<form id="modal_nuevo_gerente" class="modal" action="{{ route('gerentes_store') }}" method="POST">
		@csrf
		<div class="modal-content">
			<h4>Agregar un nuevo Gerente</h4>
			<div class="row">
				<div class="input-field col s6">
					<input name="nombre" id="nombre" type="text" class="validate">
					<label for="nombre">Nombre</label>
				</div>
				<div class="input-field col s6">
					<input name="primerApellido" id="primerApellido" type="text" class="validate">
					<label for="primerApellido">Primer Apellido</label>
				</div>
				<div class="input-field col s6">
					<input name="email" id="email" type="email" class="validate">
					<label for="email">Correo electrónico</label>
				</div>
				<div class="input-field col s6">
					<input name="password" id="password" type="password" class="validate">
					<label for="password">Contraseña</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="button" class="modal-close waves-effect waves-green btn-flat">Guardar</button>
		</div>
	</form>

	<!-- Modal - Editar gerente -->
	<form id="modal_editar_gerente" class="modal" action="{{ route('gerentes_update') }}" method="POST">
		@csrf
		<div class="modal-content">
			<h4>Editar Gerente</h4>
			<div class="row">
				<input id="editar_id" type="hidden" name="id" value="">
				<div class="input-field col s6">
					<input name="nombre" id="editar_nombre" type="text" class="validate" placeholder="">
					<label for="editar_nombre">Nombre</label>
				</div>
				<div class="input-field col s6">
					<input name="primerApellido" id="editar_primerApellido" type="text" class="validate" placeholder="">
					<label for="editar_primerApellido">Primer Apellido</label>
				</div>
				<div class="input-field col s6">
					<input name="email" id="editar_email" type="email" class="validate" placeholder="">
					<label for="editar_email">Correo electrónico</label>
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
            $('#table_gerentes').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
            $('.modal').modal(); // Inicializar Modal
			$('.tooltipped').tooltip(); // Inicializar tooltips
        });
        $('a[href$="modal_editar_gerente"]').click(function() {
			$.ajax({
				type: "POST",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '{{ route('gerentes_edit') }}',
				data: {"id": $(this).data('id')},
				success: function(data) {
					$('#editar_id').val(data['id']);
					$('#editar_nombre').val(data['nombre']);
					$('#editar_primerApellido').val(data['primerApellido']);
					$('#editar_email').val(data['email']);
				},
				error: function(xhr, textStatus, errorThrown) {
					console.log("Ocurrió un error.");
				}
			});
		});
    </script>
@endsection