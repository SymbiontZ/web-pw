<?php

class Libro{
    private string $titulo;
    private string $autor;
    private int $numPags;
    private string $fecha;
    private string $url;
    private float $precio;
    private array $categorias;



    public function __construct(string $titulo, string $autor,float $precio, int $numPags, string $fecha, string $url, array $categorias) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->precio = $precio;
        $this->numPags = $numPags;
        $this->fecha = $fecha;
        $this->url = $url;
        $this->categorias = $categorias;
    }

    // Getters
    public function get_titulo(): string { return $this->titulo; }
    public function get_autor(): string { return $this->autor; }
    public function get_precio(): float { return $this->precio; }
    public function get_numPags(): int { return $this->numPags; }
    public function get_fecha(): string { return $this->fecha; }
    public function get_url(): string { return $this->url; }
    public function get_categorias(): array { return $this->categorias; }

    // Setters
    public function set_titulo(string $titulo): void { $this->titulo = $titulo; }
    public function set_autor(string $autor): void { $this->autor = $autor; }
    public function set_precio(float $precio): void { $this->precio = $precio; }
    public function set_numPags(int $numPags): void { $this->numPags = $numPags; }
    public function set_fecha(string $fecha): void { $this->fecha = $fecha; }
    public function set_url(string $url): void { $this->url = $url; }
    public function set_categorias(array $categorias): void { $this->categorias = $categorias; }

}

?>