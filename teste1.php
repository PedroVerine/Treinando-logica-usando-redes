<?php
// Função pra calcular a taxa de discart de pacotes na interface 



// O algoritmo que vamos usar vai ser: 
// taxa = pacotes_descartados / pacotes_recebidos * 100

function CalcDiscarte(float $pacotes_recebidos, float $pacotes_descartados ) { // função com os parâmetros nescessários pro algoritmo 

   $taxa = $pacotes_descartados / $pacotes_recebidos * 100; // jogamos os elementos na var taxa e retornamos os valores 
   $resultado = $taxa;
   // ate aqui criamos o resultado do problema das perdas de pacote. 
   // próximo passa é analisar 
   if( $resultado <= 1) { 
     echo "Normal";
   }  elseif ($resultado >  1 &&  $resultado <= 3) {
   echo "Atenção";
    } else  {
      echo "Crítico"; 
    } 
    
      return $resultado;

}
$chamando_fuc_fora_do_bloco = CalcDiscarte(1500000, 3500);
echo  $chamando_fuc_fora_do_bloco;
