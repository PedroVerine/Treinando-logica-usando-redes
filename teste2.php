<?php

// Objetivo é calcular o discarte de pacotes na entrada(IN) e na saida(OUT)


 //Qual operação matemática você usaria no PHP para descobrir quantos novos discards aconteceram 
 //desde a última coleta? SUBTRAÇÃO 

 function CalcPerdasOUT(int $out, int $discarteOUT) {
    $CalcuPerdasDePacoteOUT = $out - $discarteOUT ;
   return $CalcuPerdasDePacoteOUT;
 }

 
 function CalcPerdasIN( int $in, int $discarteIN) {
    $CalcuPerdasDePacoteIN = $in - $discarteIN;
   return $CalcuPerdasDePacoteIN;
 }

 $Var = CalcPerdasIN(111,2);
 $Var2 = CalcPerdasOUT(2,4);

 echo $Var;
 echo $Var2;

