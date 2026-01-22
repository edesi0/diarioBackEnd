<?php
include_once('./model/dao.php');

//Verificação de Segurança
$url = $_SERVER["PHP_SELF"];
if (strpos("classAlunos.php", "$url")) {
  header("Location: ../index.php");
}


class Alunos {

}
