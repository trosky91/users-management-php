<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/PedidoModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PedidoId.php';

interface GetPedidoByIdPort
{
    public function getById(PedidoId $pedidoId): ?PedidoModel;
}
