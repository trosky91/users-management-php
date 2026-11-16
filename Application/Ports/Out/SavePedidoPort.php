<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/PedidoModel.php';

interface SavePedidoPort
{
    public function save(PedidoModel $pedido): PedidoModel;
}
