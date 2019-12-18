<?php
require_once("Ahorcado.php");

function simulacion(){
    $game = new Ahorcado("test", 35);
    while(!($game->perdi()) && !($game->gane())){
        print($game->vidasRestantes() . "\n");
        print(implode(" ", $game->mostrar()));
        print("\n");
        $game->jugar($game->letraAlAzar());
    }
    if($game->perdi()){
        print("Perdiste :( \n");
    }else{
        print(implode(" ", $game->mostrar()));
        print("\n Ganaste!!! \n");
    }
}

simulacion();

?>