@extends('layouts.master')

@section('header')
@endsection

@section('content')
	<div class="row">
		<div class="col s8">
			<h2>Cajas Herramientas</h2>
		</div>
		<div class="col s4" style="text-align: right; margin-top: 20px;">
			<a class="waves-effect waves-light btn modal-trigger" href="#modal_nueva_caja">
				<i class="large material-icons" style="vertical-align: middle">add</i>
				<span style="vertical-align: middle">Agregar</span>
			</a>
		</div>
	</div>

	<div>
		<table id="table_caja_herramientas" class="display striped">
			<thead>
				<th>#</th>
				<th>Propietario 1</th>
				<th>Propietario 2</th>
				<th>Herramientas</th>
				<th></th>
			</thead>
			<tbody>
				@foreach($caja_herramientas as $caja_herramienta)
					<tr>
						<td>Caja #{{ $caja_herramienta->id }}</td>
						<td>{{ $caja_herramienta->propietario1 }}</td>
						<td>{{ $caja_herramienta->propietario2 }}</td>
						<td>{{ $caja_herramienta->herramientas }}</td>
						<td style="min-width: 60px;">
						<div class="tooltipped" data-position="top" data-tooltip="Editar" style="display: inline-block;">
							<a data-id="{{ $caja_herramienta->id }}" class="modal-trigger" href="#modal_editar_caja"><i class="material-icons">edit</i></a>
						</div>

						<div  class="tooltipped" data-position="top" data-tooltip="Borrar" style="display: inline-block;">
							<form action="{{ route('caja_herramientas_destroy', $caja_herramienta->id) }}" method="POST">
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
	</div>

	<!-- Modal - Nueva caja -->
	<form id="modal_nueva_caja" class="modal" action="{{ route('caja_herramientas_store') }}" method="POST">
		@csrf
		<div class="modal-content">
			<h4>Agregar nueva caja</h4>
			<div class="row">
				<div class="input-field col s6">
					<i class="material-icons prefix">account_circle</i>
					<select name="empleado1">
						<option value="" selected>Ninguno</option>
						@foreach ($empleados as $empleado)
							<option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
						@endforeach
					</select>
					<label>Propietario 1</label>
				</div>
				<div class="input-field col s6">
					<i class="material-icons prefix">account_circle</i>
					<select name="empleado2">
						<option value="" selected>Ninguno</option>
						@foreach ($empleados as $empleado)
							<option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
						@endforeach
					</select>
					<label>Propietario 2</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="button" class="modal-close waves-effect waves-green btn-flat">Guardar</button>
		</div>
	</form>

	<!-- Modal - Editar caja -->
	<form id="modal_editar_caja" class="modal" action="{{ route('caja_herramientas_update') }}" method="POST">
		@csrf
		<div class="modal-content">
			<h4>Editar Caja</h4>
			<div class="row">
				<div class="input-field col s6">
					<i class="material-icons prefix">account_circle</i>
					<select name="empleado1">
						<option value="" selected>Ninguno</option>
						@foreach ($empleados as $empleado)
							<option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
						@endforeach
					</select>
					<label>Propietario 1</label>
				</div>
				<div class="input-field col s6">
					<i class="material-icons prefix">account_circle</i>
					<select name="empleado2">
						<option value="" selected>Ninguno</option>
						@foreach ($empleados as $empleado)
							<option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
						@endforeach
					</select>
					<label>Propietario 2</label>
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
            $('#table_caja_herramientas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
			$('.modal').modal(); // Inicializar Modal
        });
    </script>
@endsection
