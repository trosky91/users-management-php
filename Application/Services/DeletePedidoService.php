<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeletePedidoUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetPedidoByIdPort.php';
require_once __DIR__ . '/../Ports/Out/DeletePedidoPort.php';

require_once __DIR__ . '/Dto/Commands/DeletePedidoCommand.php';
require_once __DIR__ . '/Mappers/PedidoApplicationMapper.php';

require_once __DIR__ . '/../../Domain/ValueObjects/PedidoId.php';
require_once __DIR__ . '/../../Domain/Exceptions/PedidoNotFoundException.php';

final class DeletePedidoService implements DeletePedidoUseCase
{
    private GetPedidoByIdPort $getPedidoByIdPort;
    private DeletePedidoPort $deletePedidoPort;

    public function __construct(
        GetPedidoByIdPort $getPedidoByIdPort,
        DeletePedidoPort $deletePedidoPort
    ) {
        $this->getPedidoByIdPort = $getPedidoByIdPort;
        $this->deletePedidoPort = $deletePedidoPort;
    }

    public function execute(DeletePedidoCommand $command): void
    {
        // 1. Convertir el identificador en un Value Object.
        $pedidoId = PedidoApplicationMapper::fromDeleteCommandToPedidoId(
            $command
        );

        // 2. Verificar que el pedido exista.
        $pedido = $this->getPedidoByIdPort->getById($pedidoId);

        if ($pedido === null) {
            throw PedidoNotFoundException::becauseIdDoesNotExist(
                $command->id()
            );
        }

        // 3. Solicitar la eliminación del pedido.
        $this->deletePedidoPort->delete($pedidoId);
    }
}