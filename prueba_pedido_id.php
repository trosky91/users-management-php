<?php

require_once __DIR__ . '/Domain/ValueObjects/PedidoId.php';

$id1 = new PedidoId(' PED-001 ');
$id2 = new PedidoId('PED-001');

echo $id1->value() . PHP_EOL;
var_dump($id1->equals($id2));
echo $id1 . PHP_EOL;