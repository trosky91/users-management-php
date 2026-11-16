<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreatePedidoCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeletePedidoCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetPedidoByIdQuery.php';

require_once __DIR__ . '/../../../Domain/Models/PedidoModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PedidoId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PedidoValor.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PedidoPropina.php';
require_once __DIR__ . '/../Dto/Commands/UpdatePedidoCommand.php';

final class PedidoApplicationMapper
{
    public static function fromCreateCommandToModel(
        CreatePedidoCommand $command,
        string $generatedId
    ): PedidoModel {
        return new PedidoModel(
            new PedidoId($generatedId),
            new DateTimeImmutable($command->fecha()),
            $command->cliente(),
            $command->proveedor(),
            new PedidoValor($command->valor()),
            $command->pais(),
            $command->departamento(),
            $command->ciudad(),
            $command->nomenclaturaVivienda(),
            new PedidoPropina($command->propina())
        );
    }

    public static function fromGetPedidoByIdQueryToPedidoId(
        GetPedidoByIdQuery $query
    ): PedidoId {
        return new PedidoId($query->id());
    }

    public static function fromDeleteCommandToPedidoId(
        DeletePedidoCommand $command
    ): PedidoId {
        return new PedidoId($command->id());
    }

    public static function fromModelToArray(PedidoModel $pedido): array
    {
        return [
            'id' => $pedido->id()->value(),
            'fecha' => $pedido->fecha()->format('Y-m-d H:i:s'),
            'fechaEnvio' => $pedido->fechaEnvio()?->format('Y-m-d H:i:s'),
            'fechaEntrega' => $pedido->fechaEntrega()?->format('Y-m-d H:i:s'),
            'cliente' => $pedido->cliente(),
            'proveedor' => $pedido->proveedor(),
            'valor' => $pedido->valor()->value(),
            'estado' => $pedido->estado()->value,
            'pais' => $pedido->pais(),
            'departamento' => $pedido->departamento(),
            'ciudad' => $pedido->ciudad(),
            'nomenclaturaVivienda' => $pedido->nomenclaturaVivienda(),
            'propina' => $pedido->propina()->value()
        ];
    }

    /**
     * @param PedidoModel[] $pedidos
     * @return array<int, array<string, mixed>>
     */
    public static function fromModelsToArray(array $pedidos): array
    {
        $result = [];

        foreach ($pedidos as $pedido) {
            $result[] = self::fromModelToArray($pedido);
        }

        return $result;
    }


    public static function fromUpdateCommandToExistingModel(
        UpdatePedidoCommand $command,
        PedidoModel $pedido
    ): PedidoModel {
        $pedido->actualizarDatos(
            new DateTimeImmutable($command->fecha()),
            $command->cliente(),
            $command->proveedor(),
            new PedidoValor($command->valor()),
            $command->pais(),
            $command->departamento(),
            $command->ciudad(),
            $command->nomenclaturaVivienda(),
            new PedidoPropina($command->propina())
        );

        return $pedido;
    }

}
