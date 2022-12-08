<?php

$cuit = trim($_POST['cuit']);
$razon_social = trim($_POST['razon_social']);
$fecha = trim($_POST['fecha']);
$direccion = trim($_POST['direccion']);
$nro_telefeno = trim($_POST['nro_telefeno']);
$email = trim($_POST['email']);
$cond_iva = $_POST['cond_iva'];
$website = trim($_POST['website']);

if($cuit==''){
    echo'<script>alert("CUIT No Válido! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}
if(strlen($cuit)<10){
    echo'<script>alert("CUIT No Válido! No puede tener menos de 10 caracteres."); history.go(-1);</script>';
    exit;
}

if(strlen($cuit)>11){
    echo'<script>alert("CUIT No Válido! No puede tener mas de 11 caracteres."); history.go(-1);</script>';
    exit;
}

if($razon_social==''){
    echo'<script>alert("Razón Social No Válida! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}

if(strlen($razon_social)>50){
    echo'<script>alert("Razón Social No Válido! excede el limite de caracteres."); history.go(-1);</script>';
    exit;
}

if($fecha==''){
    echo'<script>alert("Fecha No Válida! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}

if(strlen($fecha)!=10){
    echo'<script>alert("Fecha No Válida! Debe tener 10 digitos(DD/MM/AAAA)."); history.go(-1);</script>';
    exit;
}

if($direccion==''){
    echo'<script>alert("Dirección No Válida! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}

if(strlen($direccion)>100){
    echo'<script>alert("Dirección No Válida! excede el limite de caracteres."); history.go(-1);</script>';
    exit;
}

if($nro_telefono=''){
    echo'<script>alert("Nro. teléfono No Válido! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}

if(strlen($nro_telefono)>11){
    echo'<script>alert("Nro. teléfono No Válido! excede el limite de caracteres."); history.go(-1);</script>';
    exit;
}

if($email==''){
    echo'<script>alert("Correo electrónico No Válido! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}

if(strlen($email)>50){
    echo'<script>alert("Correo electrónico No Válido! excede el limite de caracteres."); history.go(-1);</script>';
    exit;
}

if(strlen($email)<7){
    echo'<script>alert("Correo electrónico No Válido! NO puede tener menos de 7 caracteres."); history.go(-1);</script>';
    exit;
}

if($cond_iva[0]<=0){
    echo'<script>alert("Hubo un ERROR! Debe seleccinar la cond. IVA."); history.go(-1);</script>';
    exit;
}

if($website==''){
    echo'<script>alert("website No Válido! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}

if(strlen($website)>100){
    echo'<script>alert("Website No Válido! excede el limite de caracteres."); history.go(-1);</script>';
    exit;
}

include('basedatos/conexion.php');
$sql = "UPDATE negocio SET cuit=$cuit,razon_social='$razon_social',fecha_inicio='$fecha',direccion='$direccion',nro_telefeno=$nro_telefeno,email='$email',cond_iva=$cond_iva[0],website='$website'";


$res = mysqli_query($con,$sql);

if($res){
    echo'<script>alert("Datos actualizados correctamente");window.location="modificar_negocio.php";</script>';
}else{
     echo'<script>alert("ERROR al intentar guardar los datos. Verifique los mismos."); history.go(-1);</script>';
}

mysqli_close($con);
?>