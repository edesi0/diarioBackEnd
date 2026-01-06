<?php
require_once __DIR__ . '../../../controller/Usuario/classUsuario.php';

$usuario = new Usuario();
$usuarios = $usuario->selectUsuarios();

foreach ($usuarios as $u) {
    echo $u['usuario'] . "<br>";
}
