<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SavePedidoPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetPedidoByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllPedidosPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdatePedidoPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeletePedidoPort.php';

require_once __DIR__ . '/../Mapper/PedidoPersistenceMapper.php';

final class PedidoRepositoryMySQL implements
    SavePedidoPort,
    GetPedidoByIdPort,
    GetAllPedidosPort,
    UpdatePedidoPort,
    DeletePedidoPort
{
    private PDO $pdo;
    private PedidoPersistenceMapper $mapper;

    public function __construct(
        PDO $pdo,
        PedidoPersistenceMapper $mapper
    ) {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(PedidoModel $pedido): PedidoModel
    {
        $dto = $this->mapper->fromModelToDto($pedido);

        $sql = "INSERT INTO pedidos (
            id, fecha, fecha_envio, fecha_entrega,
            cliente, proveedor, valor, estado,
            pais, departamento, ciudad,
            nomenclatura_vivienda, propina
        ) VALUES (
            :id, :fecha, :fecha_envio, :fecha_entrega,
            :cliente, :proveedor, :valor, :estado,
            :pais, :departamento, :ciudad,
            :nomenclatura_vivienda, :propina
        )";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ':id' => $dto->id(),
            ':fecha' => $dto->fecha(),
            ':fecha_envio' => $dto->fechaEnvio(),
            ':fecha_entrega' => $dto->fechaEntrega(),
            ':cliente' => $dto->cliente(),
            ':proveedor' => $dto->proveedor(),
            ':valor' => $dto->valor(),
            ':estado' => $dto->estado(),
            ':pais' => $dto->pais(),
            ':departamento' => $dto->departamento(),
            ':ciudad' => $dto->ciudad(),
            ':nomenclatura_vivienda' => $dto->nomenclaturaVivienda(),
            ':propina' => $dto->propina()
        ]);

        $pedidoGuardado = $this->getById($pedido->id());

        if ($pedidoGuardado === null) {
            throw new RuntimeException(
                'No fue posible recuperar el pedido después de guardarlo.'
            );
        }

        return $pedidoGuardado;
    }

    public function getById(PedidoId $pedidoId): ?PedidoModel
    {
        $sql = "SELECT * FROM pedidos WHERE id = :id LIMIT 1";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $pedidoId->value()
        ]);

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    /**
     * @return PedidoModel[]
     */
    public function getAll(
        ?string $search = null,
        int $page = 1,
        int $limit = 10
    ): array {
        $page = max(1, $page);
        $limit = max(1, min(100, $limit));

        $sql = "SELECT * FROM pedidos";
        $parameters = [];

        if ($search !== null && trim($search) !== '') {
            $sql .= " WHERE
                cliente LIKE :search_cliente
                OR proveedor LIKE :search_proveedor
                OR estado LIKE :search_estado
                OR ciudad LIKE :search_ciudad
                OR pais LIKE :search_pais";

            $searchValue = '%' . trim($search) . '%';

            $parameters = [
                ':search_cliente' => $searchValue,
                ':search_proveedor' => $searchValue,
                ':search_estado' => $searchValue,
                ':search_ciudad' => $searchValue,
                ':search_pais' => $searchValue
            ];
        }

        $offset = ($page - 1) * $limit;

        $sql .= " ORDER BY fecha DESC
                  LIMIT :limit OFFSET :offset";

        $statement = $this->pdo->prepare($sql);

        foreach ($parameters as $key => $value) {
            $statement->bindValue($key, $value, PDO::PARAM_STR);
        }

        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);

        $statement->execute();

        $rows = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function update(PedidoModel $pedido): PedidoModel
    {
        $dto = $this->mapper->fromModelToDto($pedido);

        $sql = "UPDATE pedidos SET
            fecha = :fecha,
            fecha_envio = :fecha_envio,
            fecha_entrega = :fecha_entrega,
            cliente = :cliente,
            proveedor = :proveedor,
            valor = :valor,
            estado = :estado,
            pais = :pais,
            departamento = :departamento,
            ciudad = :ciudad,
            nomenclatura_vivienda = :nomenclatura_vivienda,
            propina = :propina
            WHERE id = :id";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ':fecha' => $dto->fecha(),
            ':fecha_envio' => $dto->fechaEnvio(),
            ':fecha_entrega' => $dto->fechaEntrega(),
            ':cliente' => $dto->cliente(),
            ':proveedor' => $dto->proveedor(),
            ':valor' => $dto->valor(),
            ':estado' => $dto->estado(),
            ':pais' => $dto->pais(),
            ':departamento' => $dto->departamento(),
            ':ciudad' => $dto->ciudad(),
            ':nomenclatura_vivienda' => $dto->nomenclaturaVivienda(),
            ':propina' => $dto->propina(),
            ':id' => $dto->id()
        ]);

        $pedidoActualizado = $this->getById($pedido->id());

        if ($pedidoActualizado === null) {
            throw new RuntimeException(
                'No fue posible recuperar el pedido después de actualizarlo.'
            );
        }

        return $pedidoActualizado;
    }

    public function delete(PedidoId $pedidoId): void
    {
        $sql = "DELETE FROM pedidos WHERE id = :id";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ':id' => $pedidoId->value()
        ]);
    }
}
