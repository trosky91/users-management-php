<?php

declare(strict_types=1);

enum PedidoEstadoEnum: string
{
    case PENDIENTE = 'Pendiente';
    case ENVIADO = 'Enviado';
    case ENTREGADO = 'Entregado';
    case CANCELADO = 'Cancelado';
}