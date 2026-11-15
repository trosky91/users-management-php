<?php

require_once __DIR__ . '/Domain/Models/PedidoModel.php';

$pedido = new PedidoModel(
    new PedidoId('PED-001'),
    new DateTimeImmutable('2026-11-15'),
    'Cliente de prueba',
    'Proveedor de prueba',
    new PedidoValor(150000),
    'Colombia',
    'Bolívar',
    'Cartagena',
    'Calle 10 # 20-30',
    new PedidoPropina(10000)
);

echo 'ID: ' . $pedido->id() . PHP_EOL;
echo 'Cliente: ' . $pedido->cliente() . PHP_EOL;
echo 'Valor: ' . $pedido->valor()->value() . PHP_EOL;
echo 'Estado: ' . $pedido->estado()->value . PHP_EOL;
echo 'Propina: ' . $pedido->propina()->value() . PHP_EOL;

var_dump($pedido->fechaEnvio());
var_dump($pedido->fechaEntrega());