<?php
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$codcomp = $_POST['cc_txt'];

if($producto[0]==0){
   echo'<script>alert("Debe seleccionar un producto para continuar"); history.go(-1);</script>';
    exit;
}

if($precio==0){
   echo'<script>alert("Debe ingresar un precio válido. No puede ser 0!"); history.go(-1);</script>';
    exit;
}

if($cantidad==0){
   echo'<script>alert("Debe ingresar una cantidad válida. No puede ser 0!"); history.go(-1);</script>';
    exit;
}

if($codcomp==0){
   echo'<script>alert("No tiene un comprobante registrado!"); window.location="comprobante.php";</script>';
    exit;
}


include ("basedatos/conexion.php");

$sql = "SELECT cod_prod, cod_comp FROM comprobante_detalle WHERE cod_prod=$producto[0] and cod_comp=$codcomp";

$res = mysqli_query($con,$sql);
$nro_filas_dev=mysqli_num_rows($res);
if($nro_filas_dev !=0){
$sql = "update comprobante_detalle set cantidad=cantidad+$cantidad, subtotal=cantidad*precio  where cod_comp=$codcomp and cod_prod=$producto[0]";
$res = mysqli_query($con,$sql);
$sql2 = "update comprobante set total_comp=total_comp+($cantidad*$precio) where cod_comp=$codcomp";
   $totalact2= mysqli_query($con,$sql2);
   if(!$totalact2){
      echo'<script>alert("ERROR al intentar actualizar el total del comprobante. Verifique los mismos."); history.go(-1);</script>';
   }
header("location:comprobante.php?cc=".$codcomp);
}else{
   $sql = "INSERT INTO comprobante_detalle(cod_comp, cod_prod, cantidad, precio, subtotal) VALUES ($codcomp,$producto[0],$cantidad,$precio,$cantidad*$precio)";

$res = mysqli_query($con,$sql);

if($res){
   $sql = "update comprobante set total_comp=total_comp+($cantidad*$precio) where cod_comp=$codcomp";
   $totalact= mysqli_query($con,$sql);
   if(!$totalact){
      echo'<script>alert("ERROR al intentar actualizar el total del comprobante. Verifique los mismos."); history.go(-1);</script>';
   }
   header("location:comprobante.php?cc=".$codcomp);
}else{
     echo'<script>alert("ERROR al intentar guardar el producto. Verifique los mismos."); history.go(-1);</script>';
}
}
mysqli_close($con);
?>