<?php
$correo_usuario = trim($_POST['correo_usuario']);
$pass = trim($_POST['pass']);

include "basedatos/conexion.php";

$sql = "Select * FROM usuario where nombre_usuario='$correo_usuario' or correo_usuario='$correo_usuario'";

$res = mysqli_query($con,$sql);

if(empty($res)){
    //error
    echo '<script>alert("Usuario no registrado en el sistema!");window.location="index.html"</script>';
}else{
    $nfilas=mysqli_num_rows($res);
    if($nfilas>0){
        $reg=mysqli_fetch_array($res);
        if($pass==$reg['password_usuario']){
            session_start();
            $_SESSION['codus']=$reg['id_usuario'];
            $_SESSION['nomus']=$reg['nombre_usuario'];
            $_SESSION['corrus']=$reg['correo_usuario'];
            echo '<script>window.location="menu.php"</script>';
        }else{
            echo '<script>alert("La contraseña ingresada no es correcta");history.go(-1)</script>';
        }
    }else{
        echo '<script>alert("Usuario no registrado en el sistema!");window.location="index.html"</script>'; 
    }
}

mysqli_close($con);

?>