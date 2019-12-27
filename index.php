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
    echo "<form action='' method='post'>";
    echo "<label>Selecciona la palabra para jugar:</label></br>";
    echo "<input type='text' name='palabra' autocapitalize='none' pattern='[a-zA-Z]+'></input>";
    echo "</br><label>Selecciona la cantidad de vidas:</label></br>";
    echo "<input type='number' name='vidas' min='1' step='1'></input></br>";
    echo "<input type='submit' name='postForm' value='Empezar Juego'>";
    echo "</form>";
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
            echo "♥";
        }
        echo "</h1>";
        echo "<h3> Letras Jugadas: </br>";
        print(implode(",", $_SESSION['letras_jugadas']));
        echo "</h3></br>";
        echo "<a href='index.php?letra=a'>A</a> ";
        echo "<a href='index.php?letra=b'>B</a> ";
        echo "<a href='index.php?letra=c'>C</a> ";
        echo "<a href='index.php?letra=d'>D</a> ";
        echo "<a href='index.php?letra=e'>E</a> ";
        echo "<a href='index.php?letra=f'>F</a> ";
        echo "<a href='index.php?letra=g'>G</a> ";
        echo "<a href='index.php?letra=h'>H</a> ";
        echo "<a href='index.php?letra=i'>I</a> ";
        echo "<a href='index.php?letra=j'>J</a> ";
        echo "<a href='index.php?letra=k'>K</a> ";
        echo "<a href='index.php?letra=l'>L</a> ";
        echo "<a href='index.php?letra=m'>M</a> ";
        echo "<a href='index.php?letra=n'>N</a> ";
        echo "<a href='index.php?letra=o'>O</a> ";
        echo "<a href='index.php?letra=p'>P</a> ";
        echo "<a href='index.php?letra=q'>Q</a> ";
        echo "<a href='index.php?letra=r'>R</a> ";
        echo "<a href='index.php?letra=s'>S</a> ";
        echo "<a href='index.php?letra=t'>T</a> ";
        echo "<a href='index.php?letra=u'>U</a> ";
        echo "<a href='index.php?letra=v'>V</a> ";
        echo "<a href='index.php?letra=w'>W</a> ";
        echo "<a href='index.php?letra=x'>X</a> ";
        echo "<a href='index.php?letra=y'>Y</a> ";
        echo "<a href='index.php?letra=z'>Z</a> ";
    }
    echo "</br><h3> Score: </br>";
    print($_SESSION['score']);
    echo "</h3>";
    echo "<form method='post'>";
    echo "<input type='submit' name='reset' value='Reiniciar Juego'>";
    echo "</form>";
} 

