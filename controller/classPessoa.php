<?php
include_once('Class\Conexao.php');

//Verificação de Segurança
$url = $_SERVER["PHP_SELF"];
if(strpos("ClassPessoa.php", "$url"))
{
header("Location: ../index.php");
 }

 class Pessoa extends conexao{

    //cadastrar pessoa
public function pessoa_Insert($nome,$cpf,$data_nascimento,$endereco,$numero,$bairro,$cidade,
$uf,$telefone,$celular,$email){
    //gera a coenxaão
    $dbc= $this->con_ConectaBd();
    //sql para inserir no banco
    $sql="insert into pessoas (nome,cpf,data_nascimento,endereco,numero,bairro,cidade,uf,
    telefone,celular,email) values ('$nome','$cpf','$data_nascimento','$endereco','$numero','$bairro','$cidade',
    '$uf','$telefone','$celular','$email')";
    
   if($dbc->query($sql)){
       return(true);
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
        return(false);
        
    }
}
 }
?>