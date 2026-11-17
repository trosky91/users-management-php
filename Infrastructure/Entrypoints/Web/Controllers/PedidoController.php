<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/PedidoWebMapper.php';

require_once __DIR__ . '/../../../../Application/Ports/In/CreatePedidoUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdatePedidoUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetPedidoByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllPedidosUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeletePedidoUseCase.php';

require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllPedidosQuery.php';

final class PedidoController
{
    private CreatePedidoUseCase $createPedidoUseCase;
    private UpdatePedidoUseCase $updatePedidoUseCase;
    private GetPedidoByIdUseCase $getPedidoByIdUseCase;
    private GetAllPedidosUseCase $getAllPedidosUseCase;
    private DeletePedidoUseCase $deletePedidoUseCase;
    private PedidoWebMapper $mapper;

    public function __construct(
        CreatePedidoUseCase $createPedidoUseCase,
        UpdatePedidoUseCase $updatePedidoUseCase,
        GetPedidoByIdUseCase $getPedidoByIdUseCase,
        GetAllPedidosUseCase $getAllPedidosUseCase,
        DeletePedidoUseCase $deletePedidoUseCase,
        PedidoWebMapper $mapper
    ) {
        $this->createPedidoUseCase = $createPedidoUseCase;
        $this->updatePedidoUseCase = $updatePedidoUseCase;
        $this->getPedidoByIdUseCase = $getPedidoByIdUseCase;
        $this->getAllPedidosUseCase = $getAllPedidosUseCase;
        $this->deletePedidoUseCase = $deletePedidoUseCase;
        $this->mapper = $mapper;
    }

    /**
     * @return PedidoResponse[]
     */
    public function index(): array
    {
        $query = new GetAllPedidosQuery();

        $pedidos = $this->getAllPedidosUseCase->execute($query);

        return $this->mapper->fromModelsToResponses($pedidos);
    }

    public function show(string $id): ?PedidoResponse
    {
        $query = $this->mapper->fromIdToGetByIdQuery($id);

        $pedido = $this->getPedidoByIdUseCase->execute($query);

        if ($pedido === null) {
            return null;
        }

        return $this->mapper->fromModelToResponse($pedido);
    }

    public function store(CreatePedidoWebRequest $request): PedidoResponse
    {
        $command = $this->mapper->fromCreateRequestToCommand($request);

        $pedido = $this->createPedidoUseCase->execute($command);

        return $this->mapper->fromModelToResponse($pedido);
    }

    public function update(UpdatePedidoWebRequest $request): PedidoResponse
    {
        $command = $this->mapper->fromUpdateRequestToCommand($request);

        $pedido = $this->updatePedidoUseCase->execute($command);

        return $this->mapper->fromModelToResponse($pedido);
    }

    public function delete(string $id): void
    {
        $command = $this->mapper->fromIdToDeleteCommand($id);

        $this->deletePedidoUseCase->execute($command);
    }
}
