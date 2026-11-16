<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeletePedidoCommand.php';

interface DeletePedidoUseCase
{
    public function execute(DeletePedidoCommand $command): void;
}