<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidPedidoPropinaException.php';

final class PedidoPropina
{
    private int $value;

    public function __construct(mixed $value)
    {
        if (!is_int($value)) {
            throw InvalidPedidoPropinaException::becauseValueIsNotInteger();
        }

        if ($value < 0) {
            throw InvalidPedidoPropinaException::becauseValueIsNegative();
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(PedidoPropina $other): bool
    {
        return $this->value === $other->value();
    }
}