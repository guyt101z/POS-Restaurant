<?php
include ('funciones.php');
include ('../utilidades/conex.php'); 

if (isset($_REQUEST["mesa"])) {
	$mesa=$_REQUEST["mesa"];	
	
	if ($mesa != 0) {
		$sql="SELECT * FROM tmp_mesas WHERE mesa = $mesa";
		$rs=mysql_query($sql,$db);
		if (mysql_num_rows($rs) > 0) {
			$row=mysql_fetch_object($rs);
			$cliente = $row->nombre;
		} else {		
			$cliente = "Mesa No.";
		}
	} else {
		$cliente = "Ventas del día";
	}
} else {
	$mesa = 0;
	$cliente = "Ventas del día";
}

if (isset($_REQUEST["tipo"])) {
	$tipo = $_REQUEST["tipo"];
} else {
	$tipo = 1;
}

if (isset($_REQUEST["multiple"])) {
	$multiple=$_REQUEST["multiple"];
} else { 
	$multiple = 0;
}

if ($multiple == 0) {
	$columna3 = "show_mesa.php";
} else {
	$columna3 = "add_multiple.php";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ventas - Restaurante - El Peregrino</title>

<script src="funciones.js" type="text/javascript"></script>
<link rel="STYLESHEET" type="text/css" href="../css/960.css" />
<link rel="STYLESHEET" type="text/css" href="../css/reset.css" />
<link rel="STYLESHEET" type="text/css" href="../css/text.css" />
<link href="../css/auxiliar.css" rel="stylesheet" type="text/css" />

<! Jquery >
<link type="text/css" href="../css/sunny/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../utilidades/jquery/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../utilidades/jquery/js/jquery-ui-1.8.20.custom.min.js"></script>
<! Fin - Jquery >


<script type="text/javascript">
$(function(){

	// Tabs
	$( "#tabs" ).tabs();

	// Accordion
	$("#accordion").accordion({header: "h3"});	
	$( "#accordion" ).accordion({ autoHeight: false });
	
	//hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
});	
</script>

<script type="text/javascript">

function validarPago(t) {
   	if (isNaN(document.getElementById('pagaCon').value)) {
		document.getElementById('pagaCon').value = "";
		alert("Debe ingresar una cantidad para pagar !!!");
	} else {
		if (document.getElementById('pagaCon').value == "") {
			alert("Debe ingresar una cantidad para pagar !!!");
		} else {                
			if (document.getElementById('pagaCon').value < t) {
				alert("ERROR !!! - La cantidad que ingreso es menor que el total de la cuenta.");                               
                        } else {
                            
                            document.myform.submit();
                                  
			}
		}
	}

} // end function

/*
function validarVuelto() {
	if (isNaN(document.getElementById('cantidad').value) || document.getElementById('cantidad').value <= 0 ) {
		document.getElementById('cantidad').value = "";
		alert("La cantidad debe ser un numero mayor que 0");
	} else {		
		document.getElementById('frm_vuelto').submit();
	}
} // end function
*/

function calcularvuelto(c) {
	a=document.getElementById('pagaCon').value;
	b=a-c;
	document.getElementById('vuelto').dissabled=false;
	document.getElementById('vuelto').value=b;
	document.getElementById('vuelto').dissabled=true;
	
} // end function

</script>
</head>

<body onload="javascript:document.getElementById('codigoBarras').focus()">
<?php
$n=12;
?>
<div class="container_12">
<?php include('../utilidades/mainmenu.php'); ?><br>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<!-- Encabezado -->

	<div class="grid_2"><h2 class="title" align="center">MESAS</h2></div>
	<div class="grid_4"><h2 class="title" align="center">MENU</h2></div>
	<div class="grid_5" align="right"><h2 class="title"><?php echo $cliente ?></h2></div>
    <div class="grid_1" align="left"><img src="../images/sel_mesa<?php echo $mesa ?>.jpg" width="60" height="50" /></div>
	<div class="clear"></div>
    
 <!-- Cuerpo (columnas) -->   

    <div class="grid_2" align="center"><a href="<?php echo $_SERVER['PHP_SELF']."?mesa=0" ?>"><button id="buttonIndependiente">Ventas</button></a><p>&nbsp;</p><?php echo show_mesas($n, $mesa); ?></div>
    <div class="grid_4"><?php include('menu.php') ?></div>
    <div class="grid_6"><?php include ($columna3); ?></div>
    <div class="clear"></div>            

<div class="grid_8">
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>
</div>

</body>
</html>