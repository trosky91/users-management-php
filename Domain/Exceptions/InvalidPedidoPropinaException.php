<?php

declare(strict_types=1);

final class InvalidPedidoPropinaException extends InvalidArgumentException
{
    public static function becauseValueIsNegative(): self
    {
        return new self('La propina no puede ser negativa.');
    }

    public static function becauseValueIsNotInteger(): self
    {
        return new self('La propina debe ser un número entero.');
    }
}