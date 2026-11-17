<?php

declare(strict_types=1);

final class CreatePedidoWebRequest
{
    private string $fecha;
    private string $fechaEnvio;
    private string $fechaEntrega;
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
        string $fecha,
        string $fechaEnvio,
        string $fechaEntrega,
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
        $this->fecha = trim($fecha);
        $this->fechaEnvio = trim($fechaEnvio);
        $this->fechaEntrega = trim($fechaEntrega);
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

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getFechaEnvio(): string
    {
        return $this->fechaEnvio;
    }

    public function getFechaEntrega(): string
    {
        return $this->fechaEntrega;
    }

    public function getCliente(): string
    {
        return $this->cliente;
    }

    public function getProveedor(): string
    {
        return $this->proveedor;
    }

    public function getValor(): int
    {
        return $this->valor;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function getPais(): string
    {
        return $this->pais;
    }

    public function getDepartamento(): string
    {
        return $this->departamento;
    }

    public function getCiudad(): string
    {
        return $this->ciudad;
    }

    public function getNomenclaturaVivienda(): string
    {
        return $this->nomenclaturaVivienda;
    }

    public function getPropina(): int
    {
        return $this->propina;
    }
}