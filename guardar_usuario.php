<?php
$nombre_usuario = trim($_POST['nombre_usuario']);
$correo_usuario = trim($_POST['correo_usuario']);
$password_usuario = trim($_POST['password_usuario']);

if($nombre_usuario==""){
    echo'<script>alert("El nombre debe ser un texto válido"); history.go(-1);</script>';
    exit;
}

if(strlen($nombre_usuario)>50){
    echo'<script>alert("El nombre de usuario excede el límite de carácteres(50)"); history.go(-1);</script>';
    exit;
}

if($correo_usuario==""){
    echo'<script>alert("El campo Correo electrónico no debe estar vacio."); history.go(-1);</script>';
    exit;
}

if(strlen($correo_usuario)>120){
    echo'<script>alert("El correo electrónico excede el límite de caracteres(120)"); history.go(-1);</script>';
    exit;
}

if($password_usuario==""){
    echo'<script>alert("El campo contraseña no debe estar vacio."); history.go(-1);</script>';
    exit;
}

if(strlen($password_usuario)<6){
    echo'<script>alert("La contraseña debe tener al menos 6 caracteres."); history.go(-1);</script>';
    exit;
}

if(strlen($password_usuario)>16){
    echo'<script>alert("La contraseña no puede tener mas de 16 caracteres."); history.go(-1);</script>';
    exit;
}

if(!preg_match('`[a-z]`',$password_usuario)){
    echo'<script>alert("La contraseña debe tener al menos una letra minúscula."); history.go(-1);</script>';
    exit;
}

if(!preg_match('`[A-Z]`',$password_usuario)){
    echo'<script>alert("La contraseña debe tener al menos una letra mayúscula."); history.go(-1);</script>';
    exit;
}

if(!preg_match('`[0-9]`',$password_usuario)){
    echo'<script>alert("La contraseña debe tener al menos un caracter numérico."); history.go(-1);</script>';
    exit;
}

include ("basedatos/conexion.php");

$sql="Select * from usuario where correo_usuario='$correo_usuario' or nombre_usuario='$nombre_usuario'";
$res_sel = mysqli_query($con,$sql);
$nro_filas_dev=mysqli_num_rows($res_sel);
if($nro_filas_dev !=0){
    echo'<script>alert("Ya existe un correo electrónico/nombre de usuario con los datos provistos"); history.go(-1)";</script>';
    exit;
}

$sql = "INSERT INTO usuario(nombre_usuario, correo_usuario, password_usuario) VALUES ('$nombre_usuario','$correo_usuario','$password_usuario')";


$resultado = mysqli_query($con,$sql);

if($resultado){
    
    echo'<script>alert("El usuario se creó con éxito"); window.location="index.html";</script>';
}else{
    
    echo'<script>alert("Hubo un error al crear el usuario"); history.go(-1);</script>';
}

mysqli_close($con);
?>