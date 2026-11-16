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
        
    ) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->fechaEnvio = null;
        $this->fechaEntrega = null;

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

    public static function reconstituir(
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
        PedidoEstadoEnum $estado,
        ?DateTimeImmutable $fechaEnvio = null,
        ?DateTimeImmutable $fechaEntrega = null
    ): self {

        self::validarEstadoYFechas(
            $estado,
            $fechaEnvio,
            $fechaEntrega
        );
        $pedido = new self(
            $id,
            $fecha,
            $cliente,
            $proveedor,
            $valor,
            $pais,
            $departamento,
            $ciudad,
            $nomenclaturaVivienda,
            $propina,
            
        );


        $pedido->estado = $estado;
        $pedido->fechaEnvio = $fechaEnvio;
        $pedido->fechaEntrega = $fechaEntrega;
        

        return $pedido;
    }

    private static function validarEstadoYFechas(
        PedidoEstadoEnum $estado,
        ?DateTimeImmutable $fechaEnvio,
        ?DateTimeImmutable $fechaEntrega
    ): void {

        switch ($estado) {
            case PedidoEstadoEnum::PENDIENTE:
                if ($fechaEnvio !== null || $fechaEntrega !== null) {
                    throw new InvalidArgumentException(
                        'Un pedido pendiente no puede tener fechas de envío o entrega.'
                    );
                }
                break;

            case PedidoEstadoEnum::ENVIADO:
                if ($fechaEnvio === null || $fechaEntrega !== null) {
                    throw new InvalidArgumentException(
                        'Un pedido enviado debe tener fecha de envío y no de entrega.'
                    );
                }
                break;

            case PedidoEstadoEnum::ENTREGADO:
                if ($fechaEnvio === null || $fechaEntrega === null) {
                    throw new InvalidArgumentException(
                        'Un pedido entregado debe tener ambas fechas.'
                    );
                }
                break;

            case PedidoEstadoEnum::CANCELADO:
                if ($fechaEntrega !== null) {
                    throw new InvalidArgumentException(
                        'Un pedido cancelado no puede tener fecha de entrega.'
                    );
                }
                break;
        }

        if (
            $fechaEnvio !== null &&
            $fechaEntrega !== null &&
            $fechaEntrega < $fechaEnvio
        ) {
            throw new InvalidArgumentException(
                'La fecha de entrega no puede ser anterior a la fecha de envío.'
            );
        }
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


    public function actualizarDatos(
        DateTimeImmutable $fecha,
        string $cliente,
        string $proveedor,
        PedidoValor $valor,
        string $pais,
        string $departamento,
        string $ciudad,
        string $nomenclaturaVivienda,
        PedidoPropina $propina
    ): void {
        $this->fecha = $fecha;

        $this->cliente = $this->validarTexto($cliente, 'cliente');
        $this->proveedor = $this->validarTexto($proveedor, 'proveedor');

        $this->valor = $valor;

        $this->pais = $this->validarTexto($pais, 'país');
        $this->departamento = $this->validarTexto($departamento, 'departamento');
        $this->ciudad = $this->validarTexto($ciudad, 'ciudad');

        $this->nomenclaturaVivienda = $this->validarTexto(
            $nomenclaturaVivienda,
            'nomenclatura de vivienda'
        );

        $this->propina = $propina;
    }

    public function enviar(): void
    {
        if ($this->estado !== PedidoEstadoEnum::PENDIENTE) {
            throw new InvalidArgumentException(
                'Solo un pedido pendiente puede ser enviado.'
            );
        }

        $this->estado = PedidoEstadoEnum::ENVIADO;
        $this->fechaEnvio = new DateTimeImmutable();
    }

    public function entregar(): void
    {
        if ($this->estado !== PedidoEstadoEnum::ENVIADO) {
            throw new InvalidArgumentException(
            '   Solo un pedido enviado puede ser entregado.'
            );
        }

        $this->estado = PedidoEstadoEnum::ENTREGADO;
        $this->fechaEntrega = new DateTimeImmutable();
    }

    public function cancelar(): void
    {
        if (
            $this->estado !== PedidoEstadoEnum::PENDIENTE &&
            $this->estado !== PedidoEstadoEnum::ENVIADO
        ) {
            throw new InvalidArgumentException(
                'Un pedido entregado o cancelado no puede ser cancelado.'
            );
     }

        $this->estado = PedidoEstadoEnum::CANCELADO;
    }
}