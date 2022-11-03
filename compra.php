<?php
include("cliente.php");

$tempCliente = new Cliente();
$tempCliente->nome = "WESLEY";
$tempCliente->saldo = 100;
$tempCliente->confirmarrecebimento();
$tempCliente->pagarconta(300);

echo "<br/>Nome do Cliente : ".$tempCliente->nome;
echo "<br/>Nome do Saldo : ".$tempCliente->saldo;

?>