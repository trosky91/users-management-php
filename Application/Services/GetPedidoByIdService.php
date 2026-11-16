<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetPedidoByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetPedidoByIdPort.php';
require_once __DIR__ . '/Dto/Queries/GetPedidoByIdQuery.php';
require_once __DIR__ . '/Mappers/PedidoApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Models/PedidoModel.php';

final class GetPedidoByIdService implements GetPedidoByIdUseCase
{
    private GetPedidoByIdPort $getPedidoByIdPort;

    public function __construct(GetPedidoByIdPort $getPedidoByIdPort)
    {
        $this->getPedidoByIdPort = $getPedidoByIdPort;
    }

    public function execute(GetPedidoByIdQuery $query): ?PedidoModel
    {
        $pedidoId = PedidoApplicationMapper::fromGetPedidoByIdQueryToPedidoId(
            $query
        );

        return $this->getPedidoByIdPort->getById($pedidoId);
    }
}