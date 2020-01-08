<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ahorcado</title>
</head>
<body style='margin: 20vh auto;text-align:center;overflow: hidden;'>
<?php
include_once("Ahorcado.php");
session_start();

if (isset($_POST['reset'])) {
    //session_destroy();
    $_SESSION['letras_jugadas'] = array();
    $_SESSION['palabra'] = null;
    $_SESSION['vidas'] = null;
    Header('Location: '.$_SERVER['PHP_SELF']);
    Exit(); //optional
}

if(!isset($_SESSION['letras_jugadas'])){
    $_SESSION['letras_jugadas'] = array();
}

if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

if(isset($_GET['letra']) && !in_array($_GET['letra'], $_SESSION['letras_jugadas'])){
    $_SESSION['letras_jugadas'][] = $_GET['letra'];
}

if (isset($_POST['postForm'])) {
    if(isset($_POST['palabra']) && isset($_POST['vidas']) && $_POST['vidas'] > 0 ){
        $_SESSION['palabra'] = strtolower($_POST['palabra'])    ;
        $_SESSION['vidas'] = $_POST['vidas'];
    }
}

if(!isset($_SESSION['palabra'])){//si no tengo palabra no empezo el juego
    echo "<form action='' method='post'>
    <h1>Nuevo Juego</h1>
    <label>Selecciona la palabra para jugar:</label></br>
    <input type='text' name='palabra' autocapitalize='none' pattern='[a-zA-Z]+'></input>
    </br><label>Selecciona la cantidad de vidas:</label></br>
    <input type='number' name='vidas' min='1' step='1'></input></br></br>
    <input type='submit' name='postForm' value='Empezar Juego'>
    </form>";
}else{
    $ahorcado = new Ahorcado($_SESSION['palabra'],$_SESSION['vidas']);
    foreach($_SESSION['letras_jugadas'] as $v){
        $ahorcado->jugar($v);
    }
    if($ahorcado->gane()){
        $_SESSION['score'] +=1;
        echo "<h1>GANASTE!!!</h1>";
    }elseif($ahorcado->perdi()){
        $_SESSION['score'] -=1;
        echo "<h1>PERDISTE!!!</h1>";
    }else{ // si no gane y no perdi entonces juego
        echo "<h1> Palabra: </br>";
        print(implode(" ", $ahorcado->mostrar()));
        echo "</br></h1><h3> Vidas restantes: </h3><h1>";
        for($i=0;$i<$ahorcado->vidasRestantes();$i++){
            echo "<span style='color:red'>♥</span>";
        }
        echo "</h1>";
        echo "<h3> Letras Jugadas: </br>";
        print(implode(",", $_SESSION['letras_jugadas']));
        echo "</h3></br>";
        foreach (range('a', 'z') as $char) {
            $upperChar = strtoupper($char);
            if (in_array($char, $_SESSION['letras_jugadas'])){
                echo "<span style='color: grey'>$upperChar</span> ";
            }else{
                echo "<a href='index.php?letra=$char'>$upperChar</a> ";
            }
        }
    }
    echo "</br><h3> Score: ";
    print($_SESSION['score']);
    echo "</h3>
    <form method='post'>
    <input type='submit' name='reset' value='Reiniciar Juego'>
    </form>";
} 
?> 
</body>
</html>