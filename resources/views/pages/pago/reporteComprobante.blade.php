<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>@forelse($estudiante as $est)
		{{$est->nombre}} {{$est->apellidos}}

		@empty
		@endforelse
	</title>
	<link rel="stylesheet" href="../public/pdf/assets/css/ticket.css">

</head>

<body>
	<!-- partial:index.partial.html -->
	<div id="showScroll" class="container">
		<div class="receipt">
			<h1 class="logo"><img src="../public/pdf/assets/img/logo.png" style="max-width:100px"></h1>
			<div class="address">IEP MUNDO FELIZ</div>
			<div class="address" style="font-size:80%;">Cel: 961 141 838<br>922 916 052<br>
				mundofeliz.edu.pe <br>10752090625</div>
			<div class="centerItem bold">
				<div class="item">BOLETA DE VENTA ELECTRÓNICA</div>
			</div>

			@forelse($estudiante as $est)

			<div class="detail" style="font-size:50%;">Apoderado:</div>
			<div class="paymentDetails bold" style="font-size:60%;">
				<div class="detail center">{{$est->nombreapoderado}}</div>
			</div>
			<div class="detail" style="font-size:50%;">Estudiante:</div>
			<div class="paymentDetails bold" style="font-size:60%;">
				<div class="detail center">{{$est->nombre}} {{$est->apellidos}}</div>
			</div>

			<div class="datail" style="font-size:60%;">
				<div class="detail">DNI: <b>{{$est->dni}}</b></div>
			</div>

			<div class="detail" style="font-size:60%;">
				<div class="detail">Fecha: <b>{{$est->fecha}}</b></div>
			</div>

			@empty
			@endforelse


			<div>
				@if(count($pension)!=0)
				<h3 class="center" style="font-size:60%;">------------------------------</h3>
				<table>
					<thead style="font-size:52%;">
						<th>Cod.</th>
						<th>Descrip.</th>
						<th>Cant.</th>
						<th>Prec.</th>
						<th>Importe</th>
					</thead>

					<tbody>
						@forelse($pension as $p)
						<tr style="font-size:60%;">
							<td>{{$p->codigo}}</td>
							<td>{{$p->concepto}}</td>
							<td>{{$p->cantidad}}</td>
							<td>s/.{{$p->monto/$p->cantidad}}</td>
							<td>s/.{{$p->monto*$p->cantidad}}</td>
						</tr>
						@empty
						@endforelse



					</tbody>
				</table>
				@endif
				<h3 class="center" style="font-size:60%;">------------------------------</h3>
			</div>


			<div>
				@if(count($articulo)!=0)
				<h3 class="center" style="font-size:60%;">------------------------------</h3>
				<table>
					<thead style="font-size:52%;">
						<th>Descripción</th>
						<th>Cant.</th>
						<th>Precio</th>
						<th>Importe</th>
					</thead>

					<tbody>
						@forelse($articulo as $art)
						<tr style="font-size:55%;">
							<td>{{$art->categoria}} {{$art->articulo}}</td>
							<td>{{$art->cantidad}}</td>
							<td>s/.{{$art->montoar/$art->cantidad}}</td>
							<td>s/.{{$art->montoar}}</td>
						</tr>
						@empty
						@endforelse



					</tbody>
				</table>
				@endif
				<h3 class="center" style="font-size:60%;">------------------------------</h3>
			</div>



			@forelse($estudiante as $est)

			<div class="paymentDetails">

				<div class="detail bold center" style="font-size:65%;">Total:</div>
				<div class="detail text-end bold" style="font-size:65%;">s/. {{$est->montototal}}</div>

			</div>

			@empty
			@endforelse
			<div class="detail feedback" style="font-size:50%;">Emitido desde:</div>
			<div class="paymentDetails bold" style="font-size:60%;">
				<div class="detail center">wwww.innovastaff.org</div>
			</div>

			<div class="feedback">
				<p class="bold">--------------------</p>
				<p class="center break">
					Gracias por tu preferencia</p>
				<p class="bold">--------------------</p>
			</div>

		</div>
	</div>
	<!-- partial -->

</body>

</html>