<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/PedidoId.php';

interface DeletePedidoPort
{
    public function delete(PedidoId $pedidoId): void;
}
