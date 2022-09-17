<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $codigoErr = $nomeErr = $emailErr = $cpfErr = $dataNascErr = "";
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $dataNasc = $_POST["dataNasc"];

    if (empty($_POST["codigo"])) {
        $codigoErr = "Código é um campo obrigatório!";
    } else {
        $codigo = test_input($_POST["codigo"]);
    }

    if (empty($_POST["nome"])) {
        $nomeErr = "Nome é um campo obrigatório!";
    } else {
        $nome = test_input($_POST["nome"]);
    }
    
    if (empty($_POST["email"])) {
        $emailErr = "E-mail é um campo obrigatório!";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["cpf"])) {
        $cpfErr = "CPF é um campo obrigatório!";
    } else {
        $cpf = test_input($_POST["cpf"]);
    }

    if (empty($_POST["dataNasc"])) {
        $dataNascErr = "Data de Nascimento é um campo obrigatório!";
    } else {
        $dataNasc = test_input($_POST["dataNasc"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$serverName = "DESKTOP-ACOPVKF\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( "Database"=>"controleEventos", "UID"=>"admin", "PWD"=>"admin");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    echo "Conexão estabelecida.<br />";
}else{
    echo "Conexão não pôde ser estabelecida.<br />";
    die( print_r( sqlsrv_errors(), true));
}

$sql = "INSERT INTO pessoas (codigo, nome, email, cpf, datanasc, isativo)
                    VALUES ( '". $codigo ."', '". $nome ."', '". $email ."', '". $cpf ."', '". $dataNasc ."', 1)";

if($conn -> query($sql) === TRUE){
    echo "Novo registro criado";
} else{
    echo "Erro!";
}

$conn.close();

?>