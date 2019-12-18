<?php
class Ahorcado{
    private $palabra;
    private $vidas;
    private $adivinar = array();
    private $letrasUsadas = array();

    public function __construct(string $palabra, int $vidas){
        $this->palabra = str_split($palabra);
        $this->vidas = $vidas;
        $this->adivinar = array_fill(0, strlen($palabra), "_");
    }

    public function vidasRestantes():int {
        return $this->vidas;
    }

    public function mostrar():array {
        return $this->adivinar;
    }

    public function jugar(string $letra){
        $contador = 0;
        if(!in_array($letra,$this->letrasUsadas)){
        foreach($this->palabra as $k => $v){
            if ($letra == $v){
                $this->adivinar[$k] = $letra;
                $contador += 1;
            }
        }
            array_push($this->letrasUsadas,$letra);
            if ($contador == 0){
                $this->vidas -= 1;
            }
        }else{
            //print "ya usaste letra: " . $letra . "\n";
        }
    }
    
    public function gane():bool {
        if (in_array("_",$this->adivinar)){
            return false;
        }else{
            return true;
        }
    }

    function perdi():bool {
        if ($this->vidasRestantes() <= 0){
            return true;
        }else{
            return false;
        }
    }

    function letraAlAzar():string {
        $letras = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","o","p","q","r","s","t","u","v","w","x","y","z");
        $posicion= random_int(0,count($letras)-1);
        while(in_array($letras[$posicion],$this->letrasUsadas)){
            $posicion= random_int(0,count($letras)-1);
            if(in_array($letras[$posicion],$this->letrasUsadas)){
                return $letras[$posicion];
            }
        }
            return $letras[$posicion];
    }
}
    
?>