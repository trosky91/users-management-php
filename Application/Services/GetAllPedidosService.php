<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllPedidosUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllPedidosPort.php';
require_once __DIR__ . '/Dto/Queries/GetAllPedidosQuery.php';
require_once __DIR__ . '/../../Domain/Models/PedidoModel.php';

final class GetAllPedidosService implements GetAllPedidosUseCase
{
    private GetAllPedidosPort $getAllPedidosPort;

    public function __construct(GetAllPedidosPort $getAllPedidosPort)
    {
        $this->getAllPedidosPort = $getAllPedidosPort;
    }

    /**
     * @return PedidoModel[]
     */
    public function execute(GetAllPedidosQuery $query): array
    {
        return $this->getAllPedidosPort->getAll();
    }
}