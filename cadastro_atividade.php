<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $atividadeErr = $descricaoErr = $palestranteErr = $eventoErr = "";
    $atividade = $_POST["atividade"];
    $descricao = $_POST["descricao"];
    $palestrante = $_POST["palestrante"];
    $nomePalestrante = $_POST["nomePalestrante"];
    $evento = $_POST["evento"];

    if (empty($_POST["atividade"])) {
        $atividadeErr = "Atividade é um campo obrigatório!";
    } else {
        $atividade = test_input($_POST["atividade"]);
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

    if (empty($_POST["evento"])) {
        $eventoErr = "Evento é um campo obrigatório!";
    } else {
        $evento = test_input($_POST["evento"]);
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

$sql = "INSERT INTO atividades (nome, descricao, palestrante, nomepalestrante, evento, isativo)
                    VALUES ( '". $atividade ."', '". $descricao ."', '". $palestrante ."', '". $nomePalestrante . "', '" . $evento . "', 1)";

if($conn -> query($sql) === TRUE){
    echo "Novo registro criado";
} else{
    echo "Erro!";
}

$conn.close();

?>