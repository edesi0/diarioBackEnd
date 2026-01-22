<?php
include_once('../diarioBackEnd/controller/classUsuario.php');
echo('Bem vindo');

$usuario = new Usuario();

echo($usuario->selectUsuarios());

