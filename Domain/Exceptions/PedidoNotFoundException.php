<?php

declare(strict_types=1);

final class PedidoNotFoundException extends RuntimeException
{
    public static function becauseIdDoesNotExist(string $id): self
    {
        return new self(
            "No existe un pedido con el identificador: {$id}"
        );
    }
}