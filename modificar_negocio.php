<?php 
session_start();
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
    <title>Modificar Negocio</title>
</head>
<body>
    <header class="header">
    </header>
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
        <main class="main">
            <?php
    if($nombre==''){
              echo'<script>alert("ERROR!. Usted no se encuentra logueado."); window.location="index.html";</script>';
            }
    include("basedatos/conexion.php");
    $sql= "SELECT * FROM negocio";
    $resultado=mysqli_query($con,$sql);
    $reg = mysqli_fetch_array($resultado);
    mysqli_close($con);
    ?>
    <form action="actualizar_negocio.php" method="post">
        <div class="form-group" align="center">
        <h2>Modificar Negocio</h2>
        <table>
        <tr><td><label for="cuit">Cuit</label></td>
        <td><input type="number" class="form-control" name="cuit" id="cuit" required value="<?php echo $reg['cuit'] ?>"></td></tr>
        <tr><td><label for="razon_social">Razón Social</label></td>
        <td><input type="text" class="form-control" name="razon_social" id="razon_social" required value="<?php echo $reg['razon_social'] ?>"></td></tr>
        <tr><td><label for="fecha">Fecha de inicio</label></td>
        <td><input type="text" class="form-control" name="fecha" id="fecha" required value="<?php echo $reg['fecha_inicio'] ?>"></td></tr>
        <tr><td><label for="direccion">Dirección</label></td>
        <td><input type="text" class="form-control" name="direccion" id="direccion" required value="<?php echo $reg['direccion'] ?>"></td></tr>
        <tr><td><label for="nro_telefeno">Nro. de Teléfono</label></td>
        <td><input type="number" class="form-control" name="nro_telefeno" id="nro_telefeno" required value="<?php echo $reg['nro_telefeno'] ?>"></td></tr>
        <tr><td><label for="email">Correo electrónico</label></td>
        <td><input type="email" class="form-control" name="email" id="email" required value="<?php echo $reg['email'] ?>"></td></tr>
        <tr><td><label for="cond_iva">Cond. IVA</label></td>
    <td><select class="form-select" name="cond_iva[]" id="cond_iva">
    <option value="0">Seleccione...</option>
    <?php
    include("basedatos/conexion.php");
    $sql = "SELECT * FROM cond_iva order by desc_iva";

    $res = mysqli_query($con,$sql);
    if(!empty($res)){
    while($regum=mysqli_fetch_array($res)){
        if($reg['cond_iva']==$regum['id_iva']){
            $sel ='selected';
        }else{
            $sel='';
        }
        echo '<option value="'.$regum['id_iva'].'"'.$sel.'>'.$regum['desc_iva'].'</option>';
                    }
                }
                    mysqli_close($con);

    ?>
    <tr><td><label for="website">Sitio Web</label></td>
        <td><input type="text" class="form-control" name="website" id="website" value="<?php echo $reg['website'] ?>"></td></tr>
        </table>
        </div>
        <input type="submit" class="btn btn-success"  value="Actualizar" id="btn-actualizar" name="btn-actualizar"></input>
    </form>
    </main>
    <div class="footer">
    <hr>
    <a href="menu.php"><button class="btn btn-secondary">Volver a Inicio</button></a>
    </div>
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
</html>