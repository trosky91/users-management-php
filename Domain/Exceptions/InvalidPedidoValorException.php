<?php

declare(strict_types=1);

final class InvalidPedidoValorException extends InvalidArgumentException
{
    public static function becauseValueIsNegative(): self
    {
        return new self('El valor del pedido no puede ser negativo.');
    }

    public static function becauseValueIsNotInteger(): self
    {
        return new self('El valor del pedido debe ser un número entero.');
    }
}