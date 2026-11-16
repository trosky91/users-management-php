<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdatePedidoUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetPedidoByIdPort.php';
require_once __DIR__ . '/../Ports/Out/UpdatePedidoPort.php';

require_once __DIR__ . '/Dto/Commands/UpdatePedidoCommand.php';
require_once __DIR__ . '/Mappers/PedidoApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Models/PedidoModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/PedidoId.php';
require_once __DIR__ . '/../../Domain/Exceptions/PedidoNotFoundException.php';

final class UpdatePedidoService implements UpdatePedidoUseCase
{
    private GetPedidoByIdPort $getPedidoByIdPort;
    private UpdatePedidoPort $updatePedidoPort;

    public function __construct(
        GetPedidoByIdPort $getPedidoByIdPort,
        UpdatePedidoPort $updatePedidoPort
    ) {
        $this->getPedidoByIdPort = $getPedidoByIdPort;
        $this->updatePedidoPort = $updatePedidoPort;
    }

    public function execute(UpdatePedidoCommand $command): PedidoModel
    {
        // 1. Convertir el identificador recibido en un Value Object.
        $pedidoId = new PedidoId($command->id());

        // 2. Buscar el pedido existente.
        $pedido = $this->getPedidoByIdPort->getById($pedidoId);

        // 3. Verificar que el pedido exista.
        if ($pedido === null) {
            throw PedidoNotFoundException::becauseIdDoesNotExist(
                $command->id()
            );
        }

        // 4. Actualizar los datos del modelo de dominio.
        $pedidoActualizado =
            PedidoApplicationMapper::fromUpdateCommandToExistingModel(
                $command,
                $pedido
            );

        // 5. Solicitar la persistencia de los cambios.
        return $this->updatePedidoPort->update($pedidoActualizado);
    }
}