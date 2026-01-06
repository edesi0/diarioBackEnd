<?php
include_once __DIR__ .('../../../model/Dao.php');

Class Usuario{

 private $usuario_id;
 private $usuario; 

function __construct($usuario_id_value ='',$usuario_value ='') 
{
 $this->setUsuarioId($usuario_id_value);
 $this->setUsuario($usuario_value);
}

//usuario
public function getUsuario()
{
    return $this->usuario;
}

public function setUsuario($value)
{
$this->usuario = $value;
}

//usuario_id
public function getUsuarioId()
{
    return ($this->usuario_id);
}

public function setUsuarioId($value)
{
 $this->usuario_id =$value;
}

public function selectUsuarios($usuario ='')
{
  $dao = new Dao();
  return $result = $dao->select_usuario($usuario);   
}

}