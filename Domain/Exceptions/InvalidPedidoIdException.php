<?php

declare(strict_types=1);

final class InvalidPedidoIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The order id must not be empty.');
    }
    
}