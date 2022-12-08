<?php
$razonsocial_cliente = trim($_POST['razonsocial_cliente']);
$direccion_cliente = trim($_POST['direccion_cliente']);
$cuit_cliente = trim($_POST['cuit_cliente']);
$email_cliente = trim($_POST['email_cliente']);
$cond_iva_cliente = $_POST['cond_iva_cliente'];
$estado_cliente = $_POST['estado_cliente'];

if($razonsocial_cliente==''){
    echo'<script>alert("Razón Social No Válida! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}

if(strlen($razonsocial_cliente)>50){
    echo'<script>alert("Razón Social No Válido! excede el limite de caracteres."); history.go(-1);</script>';
    exit;
}

if($direccion_cliente==''){
    echo'<script>alert("Dirección No Válida! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}

if(strlen($direccion_cliente)>120){
    echo'<script>alert("Dirección No Válida! excede el limite de caracteres."); history.go(-1);</script>';
    exit;
}

if($cuit_cliente==''){
    echo'<script>alert("CUIT No Válido! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}
if(strlen($cuit_cliente)<10){
    echo'<script>alert("CUIT No Válido! No puede tener menos de 10 caracteres."); history.go(-1);</script>';
    exit;
}

if(strlen($cuit_cliente)>11){
    echo'<script>alert("CUIT No Válido! No puede tener mas de 11 caracteres."); history.go(-1);</script>';
    exit;
}

if($email_cliente==''){
    echo'<script>alert("Correo electrónico No Válido! NO puede ser vacío."); history.go(-1);</script>';
    exit;
}

if(strlen($email_cliente)>120){
    echo'<script>alert("Correo electrónico No Válido! excede el limite de caracteres."); history.go(-1);</script>';
    exit;
}

if(strlen($email_cliente)<7){
    echo'<script>alert("Correo electrónico No Válido! NO puede tener menos de 7 caracteres."); history.go(-1);</script>';
    exit;
}

if($cond_iva_cliente[0]<=0){
    echo'<script>alert("Hubo un ERROR! Debe seleccinar la cond. IVA."); history.go(-1);</script>';
    exit;
}

if($estado_cliente[0]<=0){
    echo'<script>alert("Hubo un ERROR! Debe seleccinar el Estado del cliente."); history.go(-1);</script>';
    exit;
}

include ("basedatos/conexion.php");

$sql= "INSERT INTO cliente(razonsocial_cliente, direccion_cliente, cuit_cliente, email_cliente, cond_iva_cliente, estado_cliente) VALUES ('$razonsocial_cliente','$direccion_cliente',$cuit_cliente,'$email_cliente',$cond_iva_cliente[0],$estado_cliente[0])";

$res = mysqli_query($con,$sql);

if($res){
    echo'<script>alert("Los datos del cliente fueron registrados correctamente");window.location="cliente.php";</script>';
}else{
     echo'<script>alert("ERROR al intentar registrar los datos del cliente. Verifique los mismos."); history.go(-1);</script>';
}

mysqli_close($con);
?>