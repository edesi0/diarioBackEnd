<?php
include_once __DIR__ . ('../../controller/classUsuario.php');
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
      echo (json_encode(["sucesso" => false, "msg" => "nao foi possivel conectar ao banco de dados " .$e]));
      exit;
    }
  }

  public function select_usuario(string $usuario = ''): string
{
  $sql = "SELECT * FROM usuarios";
  $params = null;

  if ($usuario !== '') {
    $sql .= " WHERE usuario LIKE ?";          // placeholder correto
    $params = $usuario . "%";                 // ou "%{$usuario}%" se quiser "contém"
  }

  $stmt = $this->conn->prepare($sql);
  if (!$stmt) {
    return json_encode([
      "sucesso" => false,
      "msg" => "Erro no prepare: " . $this->conn->error
    ], JSON_UNESCAPED_UNICODE);
  }

  if ($params !== null) {
    $stmt->bind_param("s", $params);          // bind no valor, não no $sql
  }

  if (!$stmt->execute()) {
    return json_encode([
      "sucesso" => false,
      "msg" => "Erro ao executar: " . $stmt->error
    ], JSON_UNESCAPED_UNICODE);
  }

  $result = $stmt->get_result();
  if (!$result) {
    return json_encode([
      "sucesso" => false,
      "msg" => "get_result indisponível (mysqlnd). Erro: " . $stmt->error
    ], JSON_UNESCAPED_UNICODE);
  }

  $rows = [];
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }

  $stmt->close();

  return json_encode([
    "sucesso" => true,
    "data" => $rows
  ], JSON_UNESCAPED_UNICODE);
}

}
