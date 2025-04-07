<?php

class Libro{
    private int $id_libro;
    private string $titulo;
    private string $autor;
    private int $paginas;
    private string $fecha;
    private string $imagen;
    private float $precio;
    private array $categorias;
    private string $sinopsis;
    private string $editorial;

    public function __construct(int $id_libro = 0, string $titulo = '', string $autor = '',float $precio = 0.0, int $paginas = 0, string $fecha = '', string $imagen = '', array $categorias = [], string $sinopsis = '', string $editorial = '') {
        $this->id_libro = $id_libro;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->precio = $precio;
        $this->paginas = $paginas;
        $this->fecha = $fecha;
        $this->imagen = $imagen;
        $this->categorias = $categorias;
        $this->sinopsis = $sinopsis;
        $this->editorial = $editorial;
    }

    // Getters
    public function get_id(): int { return $this->id_libro; }
    public function get_titulo(): string { return $this->titulo; }
    public function get_autor(): string { return $this->autor; }
    public function get_precio(): float { return $this->precio; }
    public function get_numPags(): int { return $this->paginas; }
    public function get_fecha(): string { return $this->fecha; }
    public function get_url(): string { return $this->imagen; }
    public function get_categorias(): array { return $this->categorias; }
    public function get_sinopsis(): string { return $this->sinopsis; }
    public function get_editorial(): string {return $this->editorial; }

    // Setters
    public function set_id(int $id_libro): void { $this->id_libro = $id_libro; }
    public function set_titulo(string $titulo): void { $this->titulo = $titulo; }
    public function set_autor(string $autor): void { $this->autor = $autor; }
    public function set_precio(float $precio): void { $this->precio = $precio; }
    public function set_numPags(int $numPags): void { $this->paginas = $numPags; }
    public function set_fecha(string $fecha): void { $this->fecha = $fecha; }
    public function set_url(string $imagen): void { $this->imagen = $imagen; }
    public function set_categorias(string $categorias): void { $this->categorias = json_decode($categorias, true) ?? []; }
    public function set_sinopsis(string $sinopsis): void { $this->sinopsis = $sinopsis; }
    public function set_editorial(string $editorial): void { $this->editorial = $editorial; }
}



?>