<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidPedidoValorException.php';

final class PedidoValor
{
    private int $value;

    public function __construct(mixed $value)
    {
        if (!is_int($value)) {
            throw InvalidPedidoValorException::becauseValueIsNotInteger();
        }

        if ($value < 0) {
            throw InvalidPedidoValorException::becauseValueIsNegative();
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(PedidoValor $other): bool
    {
        return $this->value === $other->value();
    }
}