<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreatePedidoRequest.php';
require_once __DIR__ . '/../Dto/UpdatePedidoRequest.php';
require_once __DIR__ . '/../Dto/PedidoResponse.php';

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreatePedidoCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdatePedidoCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeletePedidoCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetPedidoByIdQuery.php';

require_once __DIR__ . '/../../../../../Domain/Models/PedidoModel.php';

final class PedidoWebMapper
{
    public function fromCreateRequestToCommand(
        CreatePedidoWebRequest $request
    ): CreatePedidoCommand {
        return new CreatePedidoCommand(
            $request->getFecha(),
            $request->getCliente(),
            $request->getProveedor(),
            $request->getValor(),
            $request->getPais(),
            $request->getDepartamento(),
            $request->getCiudad(),
            $request->getNomenclaturaVivienda(),
            $request->getPropina()
        );
    }

    public function fromUpdateRequestToCommand(
        UpdatePedidoWebRequest $request
    ): UpdatePedidoCommand {
        return new UpdatePedidoCommand(
            $request->getId(),
            $request->getFecha(),
            $request->getCliente(),
            $request->getProveedor(),
            $request->getValor(),
            $request->getPais(),
            $request->getDepartamento(),
            $request->getCiudad(),
            $request->getNomenclaturaVivienda(),
            $request->getPropina()
        );
    }

    public function fromIdToGetByIdQuery(
        string $id
    ): GetPedidoByIdQuery {
        return new GetPedidoByIdQuery($id);
    }

    public function fromIdToDeleteCommand(
        string $id
    ): DeletePedidoCommand {
        return new DeletePedidoCommand($id);
    }

    public function fromModelToResponse(
        PedidoModel $pedido
    ): PedidoResponse {
        return new PedidoResponse(
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
     * @param PedidoModel[] $pedidos
     * @return PedidoResponse[]
     */
    public function fromModelsToResponses(array $pedidos): array
    {
        $responses = array();

        foreach ($pedidos as $pedido) {
            $responses[] = $this->fromModelToResponse($pedido);
        }

        return $responses;
    }
}
