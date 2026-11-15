<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/PedidoId.php';
require_once __DIR__ . '/../ValueObjects/PedidoValor.php';
require_once __DIR__ . '/../ValueObjects/PedidoPropina.php';
require_once __DIR__ . '/../Enums/PedidoEstadoEnum.php';

final class PedidoModel
{
    private PedidoId $id;
    private DateTimeImmutable $fecha;
    private ?DateTimeImmutable $fechaEnvio;
    private ?DateTimeImmutable $fechaEntrega;
    private string $cliente;
    private string $proveedor;
    private PedidoValor $valor;
    private PedidoEstadoEnum $estado;
    private string $pais;
    private string $departamento;
    private string $ciudad;
    private string $nomenclaturaVivienda;
    private PedidoPropina $propina;

    public function __construct(
        PedidoId $id,
        DateTimeImmutable $fecha,
        string $cliente,
        string $proveedor,
        PedidoValor $valor,
        string $pais,
        string $departamento,
        string $ciudad,
        string $nomenclaturaVivienda,
        PedidoPropina $propina,
        ?DateTimeImmutable $fechaEnvio = null,
        ?DateTimeImmutable $fechaEntrega = null
    ) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->fechaEnvio = $fechaEnvio;
        $this->fechaEntrega = $fechaEntrega;

        $this->cliente = $this->validarTexto($cliente, 'cliente');
        $this->proveedor = $this->validarTexto($proveedor, 'proveedor');

        $this->valor = $valor;
        $this->estado = PedidoEstadoEnum::PENDIENTE;

        $this->pais = $this->validarTexto($pais, 'país');
        $this->departamento = $this->validarTexto($departamento, 'departamento');
        $this->ciudad = $this->validarTexto($ciudad, 'ciudad');
        $this->nomenclaturaVivienda = $this->validarTexto(
            $nomenclaturaVivienda,
            'nomenclatura de vivienda'
        );

        $this->propina = $propina;
    }

    private function validarTexto(string $valor, string $campo): string
    {
        $valor = trim($valor);

        if ($valor === '') {
            throw new InvalidArgumentException(
                "El campo {$campo} es obligatorio."
            );
        }

        return $valor;
    }

    public function id(): PedidoId
    {
        return $this->id;
    }

    public function fecha(): DateTimeImmutable
    {
        return $this->fecha;
    }

    public function fechaEnvio(): ?DateTimeImmutable
    {
        return $this->fechaEnvio;
    }

    public function fechaEntrega(): ?DateTimeImmutable
    {
        return $this->fechaEntrega;
    }

    public function cliente(): string
    {
        return $this->cliente;
    }

    public function proveedor(): string
    {
        return $this->proveedor;
    }

    public function valor(): PedidoValor
    {
        return $this->valor;
    }

    public function estado(): PedidoEstadoEnum
    {
        return $this->estado;
    }

    public function pais(): string
    {
        return $this->pais;
    }

    public function departamento(): string
    {
        return $this->departamento;
    }

    public function ciudad(): string
    {
        return $this->ciudad;
    }

    public function nomenclaturaVivienda(): string
    {
        return $this->nomenclaturaVivienda;
    }

    public function propina(): PedidoPropina
    {
        return $this->propina;
    }
}