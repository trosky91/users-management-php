<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreatePedidoUseCase.php';
require_once __DIR__ . '/../Ports/Out/SavePedidoPort.php';
require_once __DIR__ . '/Dto/Commands/CreatePedidoCommand.php';
require_once __DIR__ . '/Mappers/PedidoApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Models/PedidoModel.php';

final class CreatePedidoService implements CreatePedidoUseCase
{
    private SavePedidoPort $savePedidoPort;

    public function __construct(SavePedidoPort $savePedidoPort)
    {
        $this->savePedidoPort = $savePedidoPort;
    }

    public function execute(CreatePedidoCommand $command): PedidoModel
    {
        // Generar un identificador único para el pedido.
        $generatedId = 'PED-' . strtoupper(bin2hex(random_bytes(8)));

        // Convertir el comando en un modelo del dominio.
        $pedido = PedidoApplicationMapper::fromCreateCommandToModel(
            $command,
            $generatedId
        );

        // Solicitar el almacenamiento del pedido.
        return $this->savePedidoPort->save($pedido);
    }
}