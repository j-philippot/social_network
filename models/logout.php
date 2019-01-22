<?php
session_start();
session_destroy();
// Enviar a página de inicio:
header("Location: ../index.php");
exit();