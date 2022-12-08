<?php 
session_start();
$_SESSION['codus'];
$_SESSION['nomus'];
$nombre = $_SESSION['nomus'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/style.css">
    <title>Comprobante</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <h2>Sistema Facturación</h2>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="menu.php">INICIO</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          NEGOCIO/CLIENTES
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item" href="modificar_negocio.php">Modificar Negocio</a>
            <a class="dropdown-item" href="cliente.php">Registrar Cliente</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          PRODUCTOS
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <a class="dropdown-item" href="productos/producto/producto.php">Productos</a>
            <a class="dropdown-item" href="productos/producto/actualizar_precios.php">Actualizar precio</a>
            <a class="dropdown-item" href="productos/producto/mov_stock.php">Movimiento de Stock</a>
            <a class="dropdown-item" href="productos/tipo-de-producto/tipo_producto.php">Tipos de productos</a>
            <a class="dropdown-item" href="productos/unidad-de-medida/umedida.php">Unidades de Medida</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="comprobante.php">COMPROBANTE</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">CERRAR SESIÓN</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<main>

    <?php
    if($nombre==''){
      echo'<script>alert("ERROR!. Usted no se encuentra logueado."); window.location="index.html";</script>';
    }
  include("basedatos/conexion.php");
  $cod_c= 0;
  if(isset($_GET['cc'])){
  $cod_c=$_GET['cc'];
    $sql ="Select * from comprobante where cod_comp=$cod_c";
    $resultado= mysqli_query($con,$sql);
    $comp= mysqli_fetch_array($resultado);

    // echo'<script>alert("Comprobante recibido: '.$cod_c.'");</script>';


  }

?>
    <form action="guardar_comp.php" method="post">
        <div class="form-group" align="center">
        <table>
        <h2>Emisión de comprobantes</h2>
        <tr><td><label class="form-label" for="cod_cliente">Cliente</label></td>
        <td><select name="cod_cliente[]" class="form-select" id="cod_cliente">
        <option value="0">Seleccione...</option>
<?php
    $sql = "SELECT cod_cliente,razonsocial_cliente FROM cliente order by razonsocial_cliente";

    $res = mysqli_query($con,$sql);
    if(!empty($res)){
    while($reg=mysqli_fetch_array($res)){
      if($cod_c>0){
      if($comp['cod_cliente']==$reg['cod_cliente']){
        echo '<option value="'.$reg['cod_cliente'].'" selected>'.$reg['razonsocial_cliente'].'</option>';
      }
      }else{
        echo '<option value="'.$reg['cod_cliente'].'">'.$reg['razonsocial_cliente'].'</option>';

      }
                    }
                }
    ?>
        </select></td></tr>

        <tr><td><label class="form-label" for="tipo_comp">Tipo Comprobante</label></td>
        <td><select name="tipo_comp[]" class="form-select" id="tipo_comp">
        <option value="0">Seleccione...</option>
    <?php
    $sql = "SELECT cod_comp, desc_comp FROM tipo_comp order by desc_comp";

    $res = mysqli_query($con,$sql);
    if(!empty($res)){
    while($reg=mysqli_fetch_array($res)){
      if($cod_c>0){
      if($comp['cod_comp']==$reg['cod_comp']){
        echo '<option value="'.$reg['cod_comp'].'" selected>'.$reg['desc_comp'].'</option>';
      }
      }else{
        $sel="";
        if($reg['cod_comp']==1){
            $sel=" selected";
        }
        echo '<option value="'.$reg['cod_comp'].'" '.$sel.'>'.$reg['desc_comp'].'</option>';
      }
                    }
                }
    ?>
        </select></td></tr>
        <tr><td><label class="form-label" for="pto_venta">Punto Vta.</label></td>
        <td><select name="pto_venta[]" class="form-select" id="pto_venta">
        <option value="0">Seleccione...</option>
    <?php
    $sql = "SELECT cod_ptoventa,nro_punto FROM ptos_venta Where cod_estado=1 order by  nro_punto";

    $res = mysqli_query($con,$sql);
    if(!empty($res)){
    while($reg=mysqli_fetch_array($res)){
      if($cod_c>0){
      if($comp['punto_vta']==$reg['cod_ptoventa']){
        echo '<option value="'.$reg['cod_ptoventa'].'" selected>'.$reg['nro_punto'].'</option>';
      }
      }else{
        echo '<option value="'.$reg['cod_ptoventa'].'">'.$reg['nro_punto'].'</option>';
      }
                    }
                }
    ?>
        </select></td></tr>

        <tr><td><label class="form-label" for="letra_comp">Letra</label></td>
        <td><select name="letra_comp[]" class="form-select" id="letra_comp">
        <option value="0">Seleccione...</option>
    <?php
    $sql = "SELECT cod_letra,desc_letra FROM letras_comp order by desc_letra";

    $res = mysqli_query($con,$sql);
    if(!empty($res)){
    while($reg=mysqli_fetch_array($res)){
      if($cod_c>0){
      if($comp['cod_letra']==$reg['cod_letra']){
        echo '<option value="'.$reg['cod_letra'].'" selected>'.$reg['desc_letra'].'</option>';
      }
      }else{
        echo '<option value="'.$reg['cod_letra'].'">'.$reg['desc_letra'].'</option>';
      }
                    }
                }
    ?>
        </select></td></tr>

        <tr><td><label class="form-label" for="cond_vta">Condición</label></td>
        <td><select name="cond_vta[]" class="form-select" id="cond_vta">
        <option value="0">Seleccione...</option>
    <?php
    $sql = "SELECT cod_cv,desc_cv FROM cond_vta where estado_cv=1 order by desc_cv";

    $res = mysqli_query($con,$sql);
    if(!empty($res)){
    while($reg=mysqli_fetch_array($res)){
      if($cod_c>0){
        if($comp['cod_cond_vta']==$reg['cod_cv']){
          echo '<option value="'.$reg['cod_cv'].'" selected>'.$reg['desc_cv'].'</option>';
      }
      }else{
        echo '<option value="'.$reg['cod_cv'].'">'.$reg['desc_cv'].'</option>';
      }
                    }
                }

                
    ?>
        </select></td></tr>
                <tr>
        <td><label class="form-label" for="nro_comp">Nro. Comprobante</label></td>
        <td><input class="form-control" type="number" name="nro_comp" id="nro_comp" min="0" value="<?php if($cod_c!=0){ echo $comp['nro_comp']; }else{
          echo "0";
        } ?>"disabled></td>
                </tr>
                 <?php
        // if($cod_c > 0){
        // echo'<tr><td><label class="form-label" for="cc_txt">Cod. Comp</label></td>';
        // echo'<td><input class="form-control" type="number" name="cc_txt" disabled id="nro_comp" min="0" value="'.$comp['cod_comp'].'"</td></tr>';
        // }

        ?>
        
        </table><br>
<?php
     if ($cod_c<=0){
          echo '<input type="submit" class="btn btn-success" id="btn-generar" value="Generar Comprobante">';
    }
?>

        </div>
    </form>
<?php
if ($cod_c>0){
  ?>
  <div class="form-group" align="center">
  <form action="comp_guardar_detalle.php" method="post">
    <table>
      <?php
    echo'<tr><td><label class="form-label" for="cc_txt">Cod. Comp</label></td>';
    echo'<td><input class="form-control" type="number" name="cc_txt" id="cc_txt" min="0" value="'.$comp['cod_comp'].'"</td></tr>';
        ?>
      <tr><td><label for="producto">Producto</label></td>
    <td><select class="form-select" name="producto[]" id="producto">
      <option value="0">Seleccione un producto...</option>
      <?php
      $sql="Select cod_producto, nombre from producto order by nombre";
      $res = mysqli_query($con,$sql);
    while($reg=mysqli_fetch_array($res)) {
      echo '<option value="'.$reg['cod_producto'].'">'.$reg['nombre'].'</option>';
    }
      
      ?>
    </select></tr>
      <tr><td><label for="precio">Precio</label></td>
    <td><input class="form-control" type="number" name="precio" id="precio"></td></tr>
    <tr><td><label for="cantidad">Cantidad</label></td>
  <td><input class="form-control" type="number" name="cantidad" id="cantidad"></td></tr>
    </table>
    <div class="boton">
    <input class="btn btn-success" type="submit" value="Agregar Producto">
    </div>
    </div>
  </form>
  <a href="comprobante.php"><button class="btn btn-primary">Generar Nuevo comprobante</button></a>
  <div class="tabla1">
<?php
}
if($cod_c>0){
  echo'<table class="table letra">';
  echo '<tr class="titulo"><th>#</th><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acciones</th></tr>';
//traer los datos del comprobante
$sql ="select comprobante_detalle.*,producto.nombre from comprobante_detalle inner join producto on comprobante_detalle.cod_prod=producto.cod_producto where cod_comp=$cod_c";
$res = mysqli_query($con,$sql);
while($regis = mysqli_fetch_array($res)){
echo '<tr>';
echo '<td>'.$regis['cod_prod'].'</td>';
echo '<td>'.$regis['nombre'].'</td>';
echo '<td>'.$regis['precio'].'</td>';
echo '<td>'.$regis['cantidad'].'</td>';
echo '<td>'.$regis['subtotal'].'</td>';
echo '<td><a href="quitar_producto.php?cod='.$regis['cod_comp'].'& prod='.$regis['cod_prod'].'& subtotal='.$regis['subtotal'].'"><img width="20px" src="images/delete.svg" alt="quitar"></a></td>';

echo '</tr>';
}

echo '</table>';



}

?>
</div>
<div class="form-group">
  <?php
  if($cod_c>0){
      $sql3="Select total_comp from comprobante where cod_comp=$cod_c";
      $res3 = mysqli_query($con,$sql3);
      $reg=mysqli_fetch_array($res3);
      ?>
      <div align="right">
      <label for="total">Total</label>
      <input type="number" class="total-btn" name="total" id="total" value="<?php echo $reg['total_comp'];?>" disable>
      </div>
      <?php
      mysqli_close($con);
  }
      ?>
</div>

</main>
</body>
<script>const $dropdown = $(".dropdown");
const $dropdownToggle = $(".dropdown-toggle");
const $dropdownMenu = $(".dropdown-menu");
const showClass = "show";
 
$(window).on("load resize", function() {
  if (this.matchMedia("(min-width: 768px)").matches) {
    $dropdown.hover(
      function() {
        const $this = $(this);
        $this.addClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "true");
        $this.find($dropdownMenu).addClass(showClass);
      },
      function() {
        const $this = $(this);
        $this.removeClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "false");
        $this.find($dropdownMenu).removeClass(showClass);
      }
    );
  } else {
    $dropdown.off("mouseenter mouseleave");
  }
});</script>
</body>
</html>