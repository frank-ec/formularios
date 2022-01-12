<?php
 // print_r ($_POST);

	include("includes/header.php"); // Incluye css, librerias, datepicker
	// Define constantes el ejercicio economico, fraccion basica desgravada,  canasta basica familiar  
	const EJERCICIO = 2022;
	const FBD = 11310;
	const CBF = 719.65;   //Diciembre 2021
	const DECIMOCUARTO = 35.4167;	//Año 2022 valor mensual

	// Calculos de constantes 
	$limite = round(FBD * 2.13,2) ;			
	$sieteCbf =  round(CBF * 7,2) ;
	$rebaja10=round(($sieteCbf * 10)/100,2) ;
	$rebaja20=round(($sieteCbf * 20)/100,2) ;
	
	// Recibe informacion del formulario
	// Ingresos
	
	$meses= $_POST["meses"];
	$derechoFr= $_POST["fr"];

	$ingresoMensual= $_POST["ingresoMensual"];
	$ingresoAnual= round($ingresoMensual * $meses,2);
	$decimo3 = round($ingresoAnual/12,2);
	$decimo4 = round(DECIMOCUARTO * $meses,2);
	if($derechoFr==1){
		$fondosReserva = round($ingresoAnual/12,2);
	}if($derechoFr==0){
		$fondosReserva = 0.00;
	}

	// $fondosReserva = round($ingresoAnual/12,2);
	$otrosIngresosG =  $_POST["otrosIngresosG"];
	$otrosIngresosE =  $_POST["otrosIngresosE"];
	$ingresosOtrosE =  $_POST["ingresosOtrosE"];
	//Gastos
	$gpVivienda =  $_POST["gpVivienda"];
	$gpEducacion = $_POST["gpEducacion"];
	$gpSalud = $_POST["gpSalud"];
	$gpVestimenta = $_POST["gpVestimenta"];
	$gpAlimentacion = $_POST["gpAlimentacion"];
	$gpTurismo = $_POST["gpTurismo"];
	
	// Calculos
	$totalIngresosEmpleador = round($ingresoAnual+ $fondosReserva + $decimo3 +$decimo4 + $otrosIngresosG+ $otrosIngresosE,2);
	$totalingresosP = round($totalIngresosEmpleador+ $ingresosOtrosE,2);
	$totalGastosP = round($gpVivienda + $gpEducacion + $gpSalud + $gpVestimenta + $gpAlimentacion + $gpTurismo,2);
	
		
?>	

<body>
			<section id="contenedor">
			<header>
					<a href="menu_tarjetero.php"> <img src="interfaz/images/logo.png"> </a>
			</header>
			</section>

	<h2 align="Center">DATOS PARA PROYECCIÓN</h2>

	<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
               
				<form name="gastosp" class="form-horizontal  bg-info" method="POST" action="index.php" enctype="multipart/form-data" autocomplete="on">
                    <fieldset>
						<div class="form-group">
                            <span class="col-md-2 col-md-offset-2 text-center">Meses a proyectar</span>
                            <div class="col-md-1">
									<select class="form-control" id="meses" name="meses" required>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12" selected="selected">12</option>
									</select>
                            </div>
							<span class="col-md-3 col-md-offset-2 text-center">Recibe fondos de reserva ?</span>
							<div class="col-md-1">
									<select class="form-control" id="fr" name="fr" required>
										<option value="0">No</option>
										<option value="1" selected="selected">Si</option>
									</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-5 col-md-offset-2 text-left">SUELDO O REMUNERACION MENSUAL (NO descuente el aporte al IESS)</span>
                            <div class="col-md-2">
								<input type="text"  class="form-control" id="ingresoMensual" name="ingresoMensual" placeholder="ingresoMensual"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>

						<div class="form-group">
                            <span class="col-md-5 col-md-offset-2 text-left">OTROS INGRESOS GRAVADOS (Horas Extras,Comisiones,Utilidades)</span>
                            <div class="col-md-2">
								<input type="text"  class="form-control" id="otrosIngresosG" name="otrosIngresosG" placeholder="otrosIngresosG"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>

						<div class="form-group">
                            <span class="col-md-5 col-md-offset-2 text-left">OTROS INGRESOS EXCENTOS (Excepto Fondos de Reserva)</span>
                            <div class="col-md-2">
								<input type="text"  class="form-control" id="otrosIngresosE" name="otrosIngresosE" placeholder="otrosIngresosE"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>

						<div class="form-group">
                            <span class="col-md-5 col-md-offset-2 text-center">TOTAL INGRESOS CON OTROS EMPLEADORES (Si fuera el caso)</span>
                            <div class="col-md-2">
								<input type="text"  class="form-control" id="ingresosOtrosE" name="ingresosOtrosE" placeholder="ingresosOtrosE"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>
						
		
						<div class="form-group">
                            <span class="col-md-3 col-md-offset-2 text-center">GASTOS DE VIVIENDA</span>
                            <div class="col-md-2">
								<input type="text"  class="form-control" id="gpVivienda" name="gpVivienda" placeholder="gpVivienda"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>

						<div class="form-group">
                            <span class="col-md-3 col-md-offset-2 text-center">GASTOS DE EDUCACIÓN, ARTE Y CULTURA</span>
                            <div class="col-md-2">
								<input type="text"  class="form-control" id="gpEducacion" name="gpEducacion" placeholder="gpEducacion"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>
						<div class="form-group">
                            <span class="col-md-3 col-md-offset-2 text-center">GASTOS DE SALUD</span>
                            <div class="col-md-2">
								<input type="text"  class="form-control" id="gpSalud" name="gpSalud" placeholder="gpSalud"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>
						<div class="form-group">
                            <span class="col-md-3 col-md-offset-2 text-center">GASTOS DE VESTIMENTA</span>
                            <div class="col-md-2">
								<input type="text"  class="form-control" id="gpVestimenta" name="gpVestimenta" placeholder="gpVestimenta"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>
						<div class="form-group">
                            <span class="col-md-3 col-md-offset-2 text-center">GASTOS DE ALIMENTACIÓN</span>
                            <div class="col-md-2">
							<input type="text"  class="form-control" id="gpAlimentacion" name="gpAlimentacion" placeholder="gpAlimentacion"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>
						<div class="form-group">
                            <span class="col-md-3 col-md-offset-2 text-center">GASTOS DE TURISMO</span>
                            <div class="col-md-2">
								<input type="text"  class="form-control" id="gpTurismo" name="gpTurismo" placeholder="gpTurismo"  value="0.00" required onKeyUp="Suma()">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Calcular</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

				<table class="table table-sm" border="1">
							<thead>
								<tr>
								<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
							<tr>
								<th>(SUELDOS,  REMUNERACIONES ANUALES)</th>
								<th>DÉCIMO TERCERO</th>
								<th>DÉCIMO CUARTO</th>
								<th>FONDOS DE RESERVA</th>
								<th>OTROS INGRESOS GRAVADOS</th>
								<th>OTROS INGRESOS EXCENTOS</th>
								<th>INGRESOS CON OTROS EMPLEADORES</th>
								<tr>
								<td><?php echo number_format($ingresoAnual,2, '.', '');?></td>
								<td><?php echo number_format($decimo3,2, '.', '');?></td>
								<td><?php echo number_format($decimo4,2, '.', '');?></td>
								<td><?php echo number_format($fondosReserva,2, '.', '');?></td>
								<td><?php echo number_format($otrosIngresosG,2, '.', '');?></td>
								<td><?php echo number_format($otrosIngresosE,2, '.', '');?></td>
								<td><?php echo number_format($ingresosOtrosE,2, '.', '');?></td>
								</tr>
							</tr>

							</tbody>
						</table>
					
					<?php if($totalGastosP>$sieteCbf){
								echo '<div class="alert alert-danger" role="alert">
									Advertencia: La suma de sus gastos personales proyectados, no puede exceder a $
									'.$sieteCbf.'</div>';
							}if($totalGastosP==0){
								echo '<div class="alert alert-danger" role="alert">
								Advertencia: No puede puede proyectar sus gastos personales con valor de $0.00 </div>';
			}  
							?>
				<h2 align="Center">Formulario SRI - Gastos Personales <?php echo EJERCICIO; ?> - Continente </h2>

				<table class="table table-sm" border="2">
					<thead>
						<tr>
						<th scope="col">
						</th>
						<th scope="col">CASILLERO</th>
						<th scope="col">VALOR USD</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<th scope="row">INGRESOS PROYECTADOS</th>
						<tr>
						<th scope="row">(+) TOTAL INGRESOS CON ESTE EMPLEADOR (con el empleador que más ingresos perciba)</th>
						<td>103</td>
						<td><?php echo number_format($totalIngresosEmpleador,2, '.', '');?></td>
						</tr>
						<tr>
						<th scope="row">(+) TOTAL INGRESOS CON OTROS EMPLEADORES (en caso de haberlos)</th>
						<td>104</td>
						<td><?php echo number_format($ingresosOtrosE,2, '.', '');?></td>
						</tr>
						<tr>
						<th scope="row">(=) TOTAL INGRESOS PROYECTADOS</th>
						<td>105</td>
						<td><?php echo number_format($totalingresosP,2, '.', '');?></td>
						</tr>
						
						<th scope="row">GASTOS PROYECTADOS</th>

						<tr>
						<th scope="row">(+) GASTOS DE VIVIENDA</th>
						<td>106</td>
						<td><?php echo "$gpVivienda";?></td>
						</tr>
						<tr>
						<th scope="row">(+) GASTOS DE EDUCACIÓN, ARTE Y CULTURA</th>
						<td>107</td>
						<td><?php echo "$gpEducacion";?></td>
						</tr>
						<tr>
						<th scope="row">(+) GASTOS DE SALUD</th>
						<td>108</td>
						<td><?php echo "$gpSalud";?></td>
						</tr>
						<tr>
						<th scope="row">(+) GASTOS DE VESTIMENTA</th>
						<td>109</td>
						<td><?php echo "$gpVestimenta";?></td>
						</tr>

						<tr>
						<th scope="row">(+) GASTOS DE ALIMENTACIÓN</th>
						<td>110</td>
						<td><?php echo "$gpAlimentacion";?></td>
						</tr>

						<tr>
						<th scope="row">(+) GASTOS DE TURISMO</th>
						<td>111</td>
						<td><?php echo "$gpTurismo";?></td>
						</tr>

						<tr>
						<th scope="row">(=) TOTAL GASTOS PROYECTADOS (106 +107 +108 + 109 + 110 + 111)</th>
						<td>112</td>
						<td><?php echo number_format($totalGastosP,2, '.', '');?></td>
						</tr>

						<tr>
						<th scope="row">REBAJA DE IMPUESTO A LA RENTA POR GASTOS PERSONALES PROYECTADOS</th>
						<td>112</td>
						<td><?php
						 			if($totalingresosP > $limite){
										echo round($rebaja10,2);	
									}if($totalingresosP < $limite){
										echo round($rebaja20,2);	
									}?></td>
						</tr>

					</tr>

					</tbody>
				</table>
				<h3 align="center"> Descargar <a href="http://190.152.10.78/formularios/Formulario_SRI_GP_2022.xlsx" target="_blank">Formulario_SRI_GP_2022</a></h3> 

            </div>
        </div>
    </div>
</div>
	
					
						


</body>
</html>