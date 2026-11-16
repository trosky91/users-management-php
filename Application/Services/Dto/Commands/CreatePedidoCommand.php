<?php

declare(strict_types=1);

final class CreatePedidoCommand
{
    private string $fecha;
    private string $cliente;
    private string $proveedor;
    private int $valor;
    private string $pais;
    private string $departamento;
    private string $ciudad;
    private string $nomenclaturaVivienda;
    private int $propina;

    public function __construct(
        string $fecha,
        string $cliente,
        string $proveedor,
        int $valor,
        string $pais,
        string $departamento,
        string $ciudad,
        string $nomenclaturaVivienda,
        int $propina
    ) {
        $this->fecha = trim($fecha);
        $this->cliente = trim($cliente);
        $this->proveedor = trim($proveedor);
        $this->valor = $valor;
        $this->pais = trim($pais);
        $this->departamento = trim($departamento);
        $this->ciudad = trim($ciudad);
        $this->nomenclaturaVivienda = trim($nomenclaturaVivienda);
        $this->propina = $propina;
    }

    public function fecha(): string
    {
        return $this->fecha;
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
