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

$pedido->enviar();

echo 'Estado después de enviar: ' . $pedido->estado()->value . PHP_EOL;
echo 'Fecha de envío: ' . $pedido->fechaEnvio()->format('Y-m-d H:i:s') . PHP_EOL;

$pedido->entregar();

echo 'Estado después de entregar: ' . $pedido->estado()->value . PHP_EOL;
echo 'Fecha de entrega: ' . $pedido->fechaEntrega()->format('Y-m-d H:i:s') . PHP_EOL;

try {
    $pedido->cancelar();

    echo 'Estado después de cancelar: '
        . $pedido->estado()->value
        . PHP_EOL;

} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}

$pedidoCancelacion = new PedidoModel(
    new PedidoId('PED-002'),
    new DateTimeImmutable('2026-11-15'),
    'Cliente de prueba 2',
    'Proveedor de prueba',
    new PedidoValor(200000),
    'Colombia',
    'Bolívar',
    'Cartagena',
    'Calle 20 # 10-15',
    new PedidoPropina(0)
);

$pedidoCancelacion->cancelar();

echo 'Estado del segundo pedido: '
    . $pedidoCancelacion->estado()->value
    . PHP_EOL;

    $pedidoEnviado = new PedidoModel(
        new PedidoId('PED-003'),
        new DateTimeImmutable('2026-11-15'),
        'Cliente de prueba 3',
        'Proveedor de prueba',
        new PedidoValor(300000),
        'Colombia',
        'Bolívar',
        'Cartagena',
        'Calle 30 # 15-20',
        new PedidoPropina(5000)
    );
    
    $pedidoEnviado->enviar();
    $pedidoEnviado->cancelar();
    
    echo 'Estado del tercer pedido: '
        . $pedidoEnviado->estado()->value
        . PHP_EOL;