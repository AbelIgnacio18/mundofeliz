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
			<h1 class="logo"><img src="../public/pdf/assets/img/logo_pdf.webp" style="max-width:100px"></h1>
<!-- 			<div class="address">IEP MUNDO FELIZ</div> -->
			<div class="address" style="font-size:60%;">Cel: 961 141 838 / 922 916 052<br>
				www.mundofeliz.edu.pe<br><!-- 10752090625 --></div>
			<div class="centerItem bold">
				<div class="item">BOLETA DE VENTA ELECTRÓNICA</div>
			</div>

			@forelse($estudiante as $est)
			<div class="detail" style="font-size:50%;">N°:</div>
			<div class="paymentDetails bold" style="font-size:60%;">
				<div class="detail center">{{ str_pad($est->numcomprobante, 6, '0', STR_PAD_LEFT)}}</div>
			</div>

			<div class="detail" style="font-size:50%;">Apoderado:</div>
			<div class="paymentDetails bold" style="font-size:60%;">
				<div class="detail center">{{$est->nombreapoderado}}</div>
			</div>

			<div class="detail" style="font-size:50%;">Estudiante:</div>
			<div class="paymentDetails bold" style="font-size:60%;">
				<div class="detail center">{{$est->nombre}} {{$est->apellidos}}</div>
			</div>

			<div class="detail" style="font-size:50%;">DNI:</div>
			<div class="paymentDetails bold" style="font-size:60%;">
				<div class="detail center">{{$est->dni}}</div>
			</div>

			<div class="detail" style="font-size:50%;">Fecha:</div>
			<div class="paymentDetails bold" style="font-size:60%;">
				<div class="detail center">{{$est->fecha}}</div>
			</div>

			@empty
			@endforelse


			<div>
				@if(count($pension)!=0)
				<h3 class="center" style="font-size:60%;">------------------------------</h3>
				<table>
					<thead style="font-size:45%;">
						<th>Cod.</th>
						<th>Descrip.</th>
						<th>Cant.</th>
						<th>Prec.</th>
						<th>Importe</th>
					</thead>

					<tbody>
						@forelse($pension as $p)
						<tr style="font-size:45%;">
							<td><b>{{$p->codigo}}</b></td>
							<td><b>{{$p->concepto}}</b></td>
							<td><b>{{$p->cantidad}}</b></td>
							<td><b>s/.{{$p->monto/$p->cantidad}}</b></td>
							<td><b>s/.{{$p->monto}}</b></td>
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
					<thead style="font-size:45%;">
						<th>Descripción</th>
						<th>Cant.</th>
						<th>Precio</th>
						<th>Importe</th>
					</thead>

					<tbody>
						@forelse($articulo as $art)
						<tr style="font-size:45%;">
							<td><b>{{$art->categoria}} {{$art->articulo}}</b></td>
							<td><b>{{$art->cantidad}}</b></td>
							<td><b>s/.{{$art->montoar/$art->cantidad}}</b></td>
							<td><b>>s/.{{$art->montoar}}</b</td>
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

				<div class="detail bold" style="font-size:65%;">Total:</div>
				<div class="detail text-end bold" style="font-size:70%;">s/.{{$est->montototal}}</div>

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