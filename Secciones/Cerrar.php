<?php
session_start();
session_destroy();
header("Location: Paginas.php?seccion=inicio");
exit;
