@extends('layouts.master')
@section('content')

	<div class="row" style="margin-top: 40px;">
	@foreach($proximasCitas as $proximaCita)
      	<div class="col l4 s6">
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
		    </div>
		  </div>
		</div>
	@endforeach
	</div>
@endsection()