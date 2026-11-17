<?php

declare(strict_types=1);

final class PedidoPersistenceDto
{
    private string $id;
    private string $fecha;
    private ?string $fechaEnvio;
    private ?string $fechaEntrega;
    private string $cliente;
    private string $proveedor;
    private int $valor;
    private string $estado;
    private string $pais;
    private string $departamento;
    private string $ciudad;
    private string $nomenclaturaVivienda;
    private int $propina;

    public function __construct(
        string $id,
        string $fecha,
        ?string $fechaEnvio,
        ?string $fechaEntrega,
        string $cliente,
        string $proveedor,
        int $valor,
        string $estado,
        string $pais,
        string $departamento,
        string $ciudad,
        string $nomenclaturaVivienda,
        int $propina
    ) {
        $this->id = trim($id);
        $this->fecha = trim($fecha);
        $this->fechaEnvio = $fechaEnvio;
        $this->fechaEntrega = $fechaEntrega;
        $this->cliente = trim($cliente);
        $this->proveedor = trim($proveedor);
        $this->valor = $valor;
        $this->estado = trim($estado);
        $this->pais = trim($pais);
        $this->departamento = trim($departamento);
        $this->ciudad = trim($ciudad);
        $this->nomenclaturaVivienda = trim($nomenclaturaVivienda);
        $this->propina = $propina;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function fecha(): string
    {
        return $this->fecha;
    }

    public function fechaEnvio(): ?string
    {
        return $this->fechaEnvio;
    }

    public function fechaEntrega(): ?string
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

    public function valor(): int
    {
        return $this->valor;
    }

    public function estado(): string
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

    public function propina(): int
    {
        return $this->propina;
    }
}