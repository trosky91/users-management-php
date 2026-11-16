<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllPedidosQuery.php';

interface GetAllPedidosUseCase
{
    /**
     * @return PedidoModel[]
     */
    public function execute(GetAllPedidosQuery $query): array;
}