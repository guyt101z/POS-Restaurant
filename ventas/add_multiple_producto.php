<?php
include ("../utilidades/conex.php");
$mesa=$_REQUEST["mesa"];
$producto=$_REQUEST["producto"];
$tipo=$_REQUEST["tipo"];
$cantidad=$_REQUEST["cantidad"];
$hora=date("G:i");


$sql="SELECT * FROM tmp_ventas WHERE mesa=$mesa AND producto=$producto";
$result=mysql_query($sql,$db);
if (mysql_num_rows($result) > 0) { // si ya hay registros para este producto
	$row=mysql_fetch_array($result);
	$c=$row["cantidad"];
	$c+=$cantidad;
	$sql="UPDATE tmp_ventas SET cantidad=$c WHERE mesa=$mesa AND producto=$producto";
} else { // el producto todavia no existe en la base de datos temporal 
	$sql="INSERT INTO tmp_ventas (mesa, cantidad, producto,hora) VALUES ($mesa, $cantidad, $producto,'$hora')";
}
$result=mysql_query($sql);

header("Location: index.php?mesa=$mesa&tipo=$tipo");
?>