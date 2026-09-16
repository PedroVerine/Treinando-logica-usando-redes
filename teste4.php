<?php

//🧠 Exercício — Analisador de Link de Rede

 /* O programa deverá:

Receber o IP do equipamento. (cadastrar info e criar a fuc pra conectar) Feito 
Receber a latência do ping. (Vou ter que filtras as palavras chaves. )
Receber a quantidade de pacotes enviados.
Receber a quantidade de pacotes perdidos.
Calcular a porcentagem de perda.
Classificar o resultado:
ONLINE — perda de 0%;
ATENÇÃO — perda entre 1% e 20%;
OFFLINE — perda acima de 20%.
Salvar as informações no banco monitor_rede. 
Obs: Mais informações do banco de dados no diretório Info/ComandoSQL_ATV_teste4.txt */


// Fuc pra conectar no banco de dados 
function conectarBanco()
{
    // credencias
    $host = "localhost";
    $usuario = "root";
    $senha = "*7vn_71";
    $banco = "monitor_rede";
    // var armazenando o request ao banco
    $conexao = new mysqli($host, $usuario, $senha, $banco);

    if ($conexao->connect_error) { // condição caso der erro ou funcione 
        die("Erro na conexão: " . $conexao->connect_error);
    }

    return $conexao;  
}

$conexao = conectarBanco();
echo "Conexão realizada com sucesso!";


// Fuc pra coleta
function Coleta(int $equipamentsID) {    // Vamos lá, criamos o elemento equiapmentsID 
    $conexao = conectarBanco();      // Chamamos a Fuc conectarBanco()
    $sql = "SELECT IP FROM Equipaments WHERE EquipamentsID = 1"; // Criamos uma consulta no banco
    $resultado = $conexao->prepare($sql); // criamos o armazenamento do resultado 
    $resultado->bind_param("i", $equipamentsID);
    $resultado->execute(); // executa

    $resultado_consulta = $resultado->get_result(); // $resultado representa esse resultado vindo do MySQL.
    $equipamento = $resultado_consulta->fetch_assoc(); // pega a primeira linha e transforma em um array associativo.
    $ip = $equipamento["IP"];
    echo $ip;
};

$var = Coleta(1);
echo $var;
