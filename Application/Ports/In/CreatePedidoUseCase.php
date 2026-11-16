<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreatePedidoCommand.php';
require_once __DIR__ . '/../../../Domain/Models/PedidoModel.php';

interface CreatePedidoUseCase
{
    public function execute(CreatePedidoCommand $command): PedidoModel;
}