<?php

// Calcular quem é maior ou menor 

function CalcMaiorMenor( float $num1, float $num2) {
    if($num1 > $num2) {
        return "Maior ";
    } else {
        return "Menor";
    };
}
$var = CalcMaiorMenor(4,33);
echo $var;