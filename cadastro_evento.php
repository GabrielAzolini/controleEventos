<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tituloErr = $inicioErr = $descricaoErr = $palestranteErr = $nomePalestranteErr = $minicvErr = "";
    $titulo = $_POST["titulo"];
    $inicio = $_POST["inicio"];
    $descricao = $_POST["descricao"];
    $palestrante = $_POST["palestrante"];
    $nomePalestrante = $_POST["nomePalestrante"];
    $minicv = $_POST["minicv"];

    if (empty($_POST["titulo"])) {
        $tituloErr = "Título é um campo obrigatório!";
    } else {
        $titulo = test_input($_POST["titulo"]);
    }

    if (empty($_POST["inicio"])) {
        $inicioErr = "Data de Início é um campo obrigatório!";
    } else {
        $inicio = test_input($_POST["inicio"]);
    }
    
    if (empty($_POST["descricao"])) {
        $descricaoErr = "Descrição é um campo obrigatório!";
    } else {
        $descricao = test_input($_POST["descricao"]);
    }

    if (empty($_POST["palestrante"])) {
        $palestranteErr = "Código do Palestrante é um campo obrigatório!";
    } else {
        $palestrante = test_input($_POST["palestrante"]);
    }

    if (!empty($_POST["nomePalestrante"])) {
        $nomePalestrante = test_input($_POST["nomePalestrante"]);
    }

    if (empty($_POST["minicv"])) {
        $minicvErr = "Mini Currículo é um campo obrigatório!";
    } else {
        $minicv = test_input($_POST["minicv"]);
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

$sql = "INSERT INTO eventos (titulo, datainicio, descricao, palestrante, nomepalestrante, minicurriculo, isativo)
                    VALUES ( '". $titulo ."', '". $inicio ."', '". $descricao ."', '". $palestrante ."', '". $nomePalestrante . "', '" . $minicv . "', 1)";

if($conn -> query($sql) === TRUE){
    echo "Novo registro criado";
} else{
    echo "Erro!";
}

$conn.close();

?>