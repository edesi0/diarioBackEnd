<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(204);
  exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
 echo json_encode(["sucesso"=>false,"msg"=>"acesso negado"]);
 exit;
}

$token = $_POST['token'] ?? null;
$user  = $_POST['usuario'] ?? "";

if (!isset($token)){
 echo json_encode(["sucesso"=>false,"msg"=>"parametro de seguranca nao fornecido"]);
 exit;
}

$path = __DIR__ . '/../../controller/classUsuario.php';

if (!file_exists($path)) {
  http_response_code(500);
  echo json_encode([
    "sucesso" => false,
    "msg" => "Arquivo nao encontrado: " . $path
  ], JSON_UNESCAPED_UNICODE);
  exit;
}

require_once $path;

$usuario = new Usuario();
echo $usuario->selectUsuarios($user);

