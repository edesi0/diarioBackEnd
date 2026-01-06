<?php
include_once __DIR__ . ('../../controller/Usuario/classUsuario.php');
//Verificação de Segurança
$url = $_SERVER["PHP_SELF"];

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header("Location: ../index.php");
  exit;
}

class Dao
{

  //Variaveis para conexão do banco de dados  
  private $host = "localhost";
  private $usuario =  "root";
  private $senha = "";
  private $database = "diario";
  private $conn;
  private $stm;

  //metodos

  function __construct()
  {
    $this->conectaBanco();
  }

  //host
  public function setHost($value)
  {
    $this->host = $value;
  }

  public function getHost()
  {
    return $this->host;
  }

  //usuario
  public function setUsuario($value)
  {
    $this->usuario = $value;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }

  //senha
  public function setSenha($value)
  {
    $this->senha = $value;
  }

  public function getSenha()
  {
    return $this->senha;
  }

  //database
  public function setDatabase($value)
  {
    $this->database = $value;
  }

  public function getDatabase()
  {
    return $this->database;
  }



  public function conectaBanco()
  {
    try {
      $this->conn = new mysqli($this->host, $this->usuario, $this->senha, $this->database);
    } catch (Exception $e) {
      echo (json_encode(["sucesso" => false, "msg" => "nao foi possivel conectar ao banco de dados"]));
      exit;
    }
  }

  public function select_usuario($usuario = '')
  {
    $sql = "select * from usuarios ";

    if (!empty($usuario)) {
      $sql = $sql . " where usuario like (?%)";
      $this->stm = $this->conn->prepare($sql);
      $this->stm->bind_param("s", $sql);
    } else {
      $this->stm = $this->conn->prepare($sql);
    }


    try {
      $this->stm->execute();
    } catch (Exception $e) {
      echo (json_encode(["sucesso" => false, "msg" => "Erro ao buscar os usuarios!"]));
      exit;
    }

    $result = $this->stm->get_result();
    return $result;
  }
}
