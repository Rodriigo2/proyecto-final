<?php

$cod_cliente = $_GET['cod'];
$cod_estado = $_GET['estadocod'];



if($cod_cliente<=0){
    echo'<script>alert("Código No Válido! No puede ser menor o igual a cero"); history.go(-1);</script>';
    exit;
}

if(trim($cod_cliente)==""){
    echo'<script>alert("Código No Válido! NO puede ser vacía."); history.go(-1);</script>';
    exit;
}

if($cod_estado[0]<=0){
    echo'<script>alert("Código No Válido! No puede ser menor o igual a cero"); history.go(-1);</script>';
    exit;
}

include("basedatos/conexion.php");

if($cod_estado[0]==1){
    $sql = "UPDATE cliente SET estado_cliente=2 where cod_cliente=$cod_cliente";
    $res = mysqli_query($con,$sql);
    if($res){
        echo'<script>window.location="listadoclientes.php";</script>';
    }else{
        echo'<script>alert("ERROR al intentar cambiar el estado del cliente."); history.go(-1);</script>';
    }
}else{
    $sql = "UPDATE cliente SET estado_cliente=1";
    $res = mysqli_query($con,$sql);
    if($res){
        echo'<script>window.location="listadoclientes.php";</script>';
    }else{
        echo'<script>alert("ERROR al intentar cambiar el estado del cliente."); history.go(-1);</script>';
    }
}



mysqli_close($con);
?>