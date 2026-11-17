<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/PedidoPersistenceDto.php';
require_once __DIR__ . '/../Entity/PedidoEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/PedidoModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PedidoId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PedidoValor.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PedidoPropina.php';
require_once __DIR__ . '/../../../../../Domain/Enums/PedidoEstadoEnum.php';

final class PedidoPersistenceMapper
{
    /**
     * Convierte el modelo del dominio en un DTO de persistencia.
     */
    public function fromModelToDto(PedidoModel $pedido): PedidoPersistenceDto
    {
        return new PedidoPersistenceDto(
            $pedido->id()->value(),
            $pedido->fecha()->format('Y-m-d H:i:s'),
            $pedido->fechaEnvio()?->format('Y-m-d H:i:s'),
            $pedido->fechaEntrega()?->format('Y-m-d H:i:s'),
            $pedido->cliente(),
            $pedido->proveedor(),
            $pedido->valor()->value(),
            $pedido->estado()->value,
            $pedido->pais(),
            $pedido->departamento(),
            $pedido->ciudad(),
            $pedido->nomenclaturaVivienda(),
            $pedido->propina()->value()
        );
    }

    /**
     * Convierte el DTO de persistencia en un Entity.
     */
    public function fromDtoToEntity(
        PedidoPersistenceDto $dto
    ): PedidoEntity {
        return new PedidoEntity(
            $dto->id(),
            $dto->fecha(),
            $dto->fechaEnvio(),
            $dto->fechaEntrega(),
            $dto->cliente(),
            $dto->proveedor(),
            $dto->valor(),
            $dto->estado(),
            $dto->pais(),
            $dto->departamento(),
            $dto->ciudad(),
            $dto->nomenclaturaVivienda(),
            $dto->propina()
        );
    }

    /**
     * Convierte una fila de MySQL en un Entity.
     *
     * Se esperan nombres de columnas en snake_case.
     */
    public function fromRowToEntity(array $row): PedidoEntity
    {
        return new PedidoEntity(
            (string) $row['id'],
            (string) $row['fecha'],
            $row['fecha_envio'] !== null
                ? (string) $row['fecha_envio']
                : null,
            $row['fecha_entrega'] !== null
                ? (string) $row['fecha_entrega']
                : null,
            (string) $row['cliente'],
            (string) $row['proveedor'],
            (int) $row['valor'],
            (string) $row['estado'],
            (string) $row['pais'],
            (string) $row['departamento'],
            (string) $row['ciudad'],
            (string) $row['nomenclatura_vivienda'],
            (int) $row['propina']
        );
    }

    /**
     * Convierte un Entity en un modelo del dominio.
     */
    public function fromEntityToModel(PedidoEntity $entity): PedidoModel
    {
        $estado = PedidoEstadoEnum::from($entity->estado());

        $fechaEnvio = $entity->fechaEnvio() !== null
            ? new DateTimeImmutable($entity->fechaEnvio())
            : null;

        $fechaEntrega = $entity->fechaEntrega() !== null
            ? new DateTimeImmutable($entity->fechaEntrega())
            : null;

        return PedidoModel::reconstituir(
            new PedidoId($entity->id()),
            new DateTimeImmutable($entity->fecha()),
            $entity->cliente(),
            $entity->proveedor(),
            new PedidoValor($entity->valor()),
            $entity->pais(),
            $entity->departamento(),
            $entity->ciudad(),
            $entity->nomenclaturaVivienda(),
            new PedidoPropina($entity->propina()),
            $estado,
            $fechaEnvio,
            $fechaEntrega
        );
    }

    /**
     * Convierte una fila de MySQL directamente en un modelo.
     */
    public function fromRowToModel(array $row): PedidoModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return PedidoModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = [];

        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }

        return $models;
    }
}
