<?php

require_once __DIR__ . '/Domain/Enums/PedidoEstadoEnum.php';

$estado = PedidoEstadoEnum::PENDIENTE;

echo $estado->value . PHP_EOL;

var_dump($estado === PedidoEstadoEnum::PENDIENTE);