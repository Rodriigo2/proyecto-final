<?php

$cod_comp = $_GET['cod'];
$cod_prod = $_GET['prod'];
$subtotal = $_GET['subtotal'];



if($cod_comp<=0){
    echo'<script>alert("Código No Válido! No puede ser menor o igual a cero"); history.go(-1);</script>';
    exit;
}

if(trim($cod_comp)==""){
    echo'<script>alert("Código No Válido! NO puede ser vacía."); history.go(-1);</script>';
    exit;
}

if($cod_prod<=0){
    echo'<script>alert("Código No Válido! No puede ser menor o igual a cero"); history.go(-1);</script>';
    exit;
}

if(trim($cod_prod)==""){
    echo'<script>alert("Código No Válido! NO puede ser vacía."); history.go(-1);</script>';
    exit;
}
include("basedatos/conexion.php");

$sql = "DELETE FROM comprobante_detalle WHERE cod_comp=$cod_comp and cod_prod=$cod_prod";
$res = mysqli_query($con,$sql);

if($res){
    $sql2 = "update comprobante set total_comp=total_comp-($subtotal) where cod_comp=$cod_comp";
   $totalact2= mysqli_query($con,$sql2);
   if(!$totalact2){
      echo'<script>alert("ERROR al intentar actualizar el total del comprobante. Verifique los mismos."); history.go(-1);</script>';
   }
   
    header("location:comprobante.php?cc=".$cod_comp);
}else{
    echo '<script>alert("Error al intentar quitar el producto!");</script>';
    header("location:comprobante.php?cc=".$cod_comp);
}


mysqli_close($con);
?>