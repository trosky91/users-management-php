<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdatePedidoCommand.php';
require_once __DIR__ . '/../../../Domain/Models/PedidoModel.php';

interface UpdatePedidoUseCase
{
    public function execute(UpdatePedidoCommand $command): PedidoModel;
}