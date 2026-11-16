<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetPedidoByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/PedidoModel.php';

interface GetPedidoByIdUseCase
{
    public function execute(GetPedidoByIdQuery $query): ?PedidoModel;
}