<?php

require_once __DIR__ . '/Domain/ValueObjects/PedidoPropina.php';

$propina1 = new PedidoPropina(0);
$propina2 = new PedidoPropina(5000);

echo $propina1->value() . PHP_EOL;
echo $propina2->value() . PHP_EOL;