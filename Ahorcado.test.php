<?php
require_once("./vendor/autoload.php");
require_once("Ahorcado.php");

use PHPUnit\Framework\TestCase; #namespace

final class AhorcadoTest extends TestCase{

    function testExisteAhorcado() {
        $this->assertTrue(class_exists("Ahorcado"));
    }

    function testExisteVidasRestantes() {
        $game = new Ahorcado("test", 10);
        $vidas = $game->vidasRestantes();
        $this->assertIsInt($vidas);
        $this->assertGreaterThanOrEqual(0,$vidas);
        $this->assertEquals(10,$vidas);
    }

    function testExisteMostrar() {
        $game = new Ahorcado("test", 10);
        $palabra = $game->mostrar();
        $this->assertIsArray($palabra);
        $this->assertNotEmpty($palabra);
    }

    function testExisteJugar(){
        $game = new Ahorcado("test", 10);
        $game->jugar("a");
        $this->assertTrue(true);
    }
    
    function testExisteGane(){
        $game = new Ahorcado("test", 10);
        $game->gane();
        $this->assertTrue(true);
    }

    function testExistePerdi(){
        $game = new Ahorcado("test", 10);
        $game->perdi();
        $this->assertTrue(true);
    }

    function testExisteletraAlAzar(){
        $game = new Ahorcado("test", 10);
        $letra = $game->letraAlAzar();
        $letras = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","o","p","q","r","s","t","u","v","w","x","y","z");
        $this->assertIsString($letra);
        $this->assertContains($letra, $letras);
        $this->assertTrue(true);
    }
}