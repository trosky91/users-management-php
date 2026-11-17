<?php

declare(strict_types=1);

final class PedidoResponse
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
        $this->id = $id;
        $this->fecha = $fecha;
        $this->fechaEnvio = $fechaEnvio;
        $this->fechaEntrega = $fechaEntrega;
        $this->cliente = $cliente;
        $this->proveedor = $proveedor;
        $this->valor = $valor;
        $this->estado = $estado;
        $this->pais = $pais;
        $this->departamento = $departamento;
        $this->ciudad = $ciudad;
        $this->nomenclaturaVivienda = $nomenclaturaVivienda;
        $this->propina = $propina;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getFechaEnvio(): ?string
    {
        return $this->fechaEnvio;
    }

    public function getFechaEntrega(): ?string
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

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id,
            'fecha' => $this->fecha,
            'fechaEnvio' => $this->fechaEnvio,
            'fechaEntrega' => $this->fechaEntrega,
            'cliente' => $this->cliente,
            'proveedor' => $this->proveedor,
            'valor' => $this->valor,
            'estado' => $this->estado,
            'pais' => $this->pais,
            'departamento' => $this->departamento,
            'ciudad' => $this->ciudad,
            'nomenclaturaVivienda' => $this->nomenclaturaVivienda,
            'propina' => $this->propina,
        );
    }
}