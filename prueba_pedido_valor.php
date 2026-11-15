<?php

require_once __DIR__ . '/Domain/ValueObjects/PedidoValor.php';


$valor1 = new PedidoValor(150000);
$valor2 = new PedidoValor(150000);

echo $valor1->value() . PHP_EOL;

var_dump($valor1->equals($valor2));
