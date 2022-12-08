<?php
$cod_cliente= $_POST['cod_cliente'];
$tipo_comp = $_POST['tipo_comp'];
$pto_venta = $_POST['pto_venta'];
$letra_comp = $_POST['letra_comp'];
$cond_vta = $_POST['cond_vta'];
session_start();
$id_usuario = $_SESSION['codus'];

if($cod_cliente[0]<=0){
    echo'<script>alert("Hubo un ERROR! Debe seleccionar un cliente."); history.go(-1);</script>';
    exit;
}

if($tipo_comp[0]<=0){
    echo'<script>alert("Hubo un ERROR! Debe seleccionar un tipo de comprobante."); history.go(-1);</script>';
    exit;
}

if($pto_venta[0]<=0){
    echo'<script>alert("Hubo un ERROR! Debe seleccionar un punto de venta."); history.go(-1);</script>';
    exit;
}

if($letra_comp[0]<=0){
    echo'<script>alert("Hubo un ERROR! Debe seleccionar una letra."); history.go(-1);</script>';
    exit;
}

if($cond_vta[0]<=0){
    echo'<script>alert("Hubo un ERROR! Debe seleccionar la condición de la venta."); history.go(-1);</script>';
    exit;
}

include "basedatos/conexion.php";

$com_slq= "Select max(nro_comp)+1 as nrocomp from comprobante where cod_letra=$letra_comp[0] and  punto_vta=$pto_venta[0]";
$res = mysqli_query($con, $com_slq);

$data= mysqli_fetch_array($res);

if(empty($data['nrocomp'])){
$nrocomp = "1";    

}else{
    $nrocomp=$data['nrocomp'];
}

$sql = "INSERT INTO comprobante(nro_comp, punto_vta, cod_cliente,cod_usuario, cod_letra, tipo_comp, cod_est_comp, total_comp, cod_cond_vta) VALUES ($nrocomp,$pto_venta[0], $cod_cliente[0],$id_usuario, $letra_comp[0] , $tipo_comp[0], 1, 0, $cond_vta[0])";

$res = mysqli_query($con,$sql);

if($res){
    header("location:comprobante.php?cc=".$nrocomp);
}else{
    echo'<script>alert("Hubo un error al generar el comprobante... Verifique los datos e intente nuevamente"); history.go(-1);</script>';
}

mysqli_close($con);



?>