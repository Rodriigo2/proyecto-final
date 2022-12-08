<?php
session_start();
unset($_SESSION['codus']);
unset($_SESSION['nomus']);
unset($_SESSION['corrus']);
session_destroy();
header("location:index.html");
?>