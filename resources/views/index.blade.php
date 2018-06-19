@extends('layouts.master')
@section('content')

	<div class="row" style="margin-top: 40px;">
	@foreach($proximasCitas as $proximaCita)
      	<div class="col l4 s12">
		  <div class="card">
		    <div class="card-content">
		      <p><b>Se debe de agendar una cita.</b></p>
		    </div>
		    <div class="card-tabs">
		      <ul class="tabs tabs-fixed-width">
		        <li class="tab">Información del Cliente</li>
		      </ul>
		    </div>
		    <div class="card-content grey lighten-4">
		      <div id="proximaCita"><b>Nombre:</b> {{ $proximaCita->nombreCliente }}</div>
		      <div id="proximaCita"><b>Apellido:</b> {{ $proximaCita->apellidoCliente }}</div>
		      <div id="proximaCita"><b>Telefono:</b> {{ $proximaCita->telCliente }}</div>
		      <div id="proximaCita"><b>Servicio realizado:</b> {{ $proximaCita->servicio }}</div>
		      <div id="proximaCita"><b>Fecha estimada para cita:</b> {{ $proximaCita->fechaSiguiente }}</div>
		      <div id="proximaCita"><b>Descripción del servicio:</b> {{ $proximaCita->descripcion }}</div>
		      <form action="{{ route('update') }}" method="POST">
		      	<input type="hidden" name="id" value="{{ $proximaCita->id }}">
		      	<p>
      		  		<label>
        				<input name="agendada" type="checkbox"/>
        				<span>Agendada</span>
      				</label>
    			</p>
		      	<p>
      		  		<label>
        				<input name="finalizado" type="checkbox"/>
        				<span>Servicio terminado</span>
      				</label>
    			</p>
    			<div class="modal-footer">
					<center><button class="btn waves-effect waves-light" type="submit" name="action">Enviar<i class="material-icons right">send</i></button></center>
				</div>
    		  </form>
		    </div>
		  </div>
		</div>
	@endforeach
	</div>
@endsection()