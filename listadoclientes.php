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
    <title>Listado de Clientes</title>
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
<?php
if($nombre==''){
  echo'<script>alert("ERROR!. Usted no se encuentra logueado."); window.location="index.html";</script>';
}
?>
    <main>
    <table class="table">
        <thead>
            <th>#</th>
            <th>Razón social</th>
            <th>Dirección</th>
            <th>CUIT</th>
            <th>Correo Electrónico</th>
            <th>Cond. IVA</th>
            <th>Estado</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php
        $sql = "Select cliente.*,estado.desc_estado,cond_iva.desc_iva from cliente inner join cond_iva on cliente.cond_iva_cliente=cond_iva.id_iva inner join estado on cliente.estado_cliente=estado.id_estado";

        include("basedatos/conexion.php");
        $res = mysqli_query($con,$sql);
        if(empty($res)){

        }else{
            $filas = mysqli_num_rows($res);
            if($filas>0){
                while($reg=mysqli_fetch_array($res)){
                    echo '<tr>';
                        echo '<td>'.$reg['cod_cliente'].'</td>';
                        echo '<td>'.$reg['razonsocial_cliente'].'</td>';
                        echo '<td>'.$reg['direccion_cliente'].'</td>';
                        echo '<td>'.$reg['cuit_cliente'].'</td>';
                        echo '<td>'.$reg['email_cliente'].'</td>';
                        echo '<td>'.$reg['desc_iva'].'</td>';
                        echo '<td>'.$reg['desc_estado'].'</td>';
                        echo '<td width=5%><a href="modificar_cliente.php?cod='.$reg['cod_cliente'].'"><img width="20px" src="images/icons8-lápiz-30.png" alt="Editar"></a></td>';
                        echo '<td width=5%><a href="cambiar_estado.php?cod='.$reg['cod_cliente'].'& estadocod='.$reg['estado_cliente'].'"><img width="20px" src="images/icons8-reemplazar-50.png" alt="Cambiar Estado"></a></td>';
                        echo '</tr>';
                        echo '</tr>';
                }
            }
        }
            ?>
        </tbody>
    </table>
    <a href="menu.php"><button class="btn btn-secondary">Volver a Inicio</button></a>
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
</html>