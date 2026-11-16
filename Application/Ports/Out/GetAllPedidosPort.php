<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/PedidoModel.php';

interface GetAllPedidosPort
{
    /**
     * @return PedidoModel[]
     */
    public function getAll(): array;
}
