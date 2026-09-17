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

// Curriocidade:
//Em PHP, um array associativo é um tipo de array onde as chaves (índices) não são números 
//automáticos, mas sim nomes personalizados (strings) que você define para identificar cada valor.
//Isso é útil quando você quer que cada elemento tenha um rótulo claro, 
//em vez de depender de índices numéricos.



// ###################   Fuc pra conectar no banco de dados   ########################################
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


// ######################################  Fuc pra coleta IP ########################################################################
function Coleta(int $equipamentsID) {    // Vamos lá, criamos o elemento equiapmentsID 
    $conexao = conectarBanco();      // Chamamos a Fuc conectarBanco()
    $sql = "SELECT IP FROM Equipaments WHERE EquipamentsID = ?"; // Criamos uma consulta no banco
    $resultado = $conexao->prepare($sql); // criamos o armazenamento do resultado 
    $resultado->bind_param("i", $equipamentsID);
    $resultado->execute(); // executa

    $resultado_consulta = $resultado->get_result(); // $resultado representa esse resultado vindo do MySQL.
    $equipamento = $resultado_consulta->fetch_assoc(); // pega a primeira linha e transforma em um array associativo.
    $ip = $equipamento["IP"];
    return $ip;
};

$var = Coleta(1);
echo $var;

// ######################################  Fuc pra executar o ping ########################################################################


function  ExecutPing() {
        $ip_da_fuc_coleta = Coleta(1); // chamamos a fuc que coleta o IP do banco 
    $s = $ip_da_fuc_coleta; // mandamos essa info pra outra fuc

    // fizemos o if pra validar o system operacional 
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { 
    // Windows usa -n para número de pacotes
    $cmd = "ping -n 4 " . escapeshellarg($s);
} else {
    // Linux/Mac usam -c para número de pacotes
    $cmd = "ping -c 4 " . escapeshellarg($s);
}

 // executamos o ping e depois retornamos 
 $output = shell_exec($cmd);
 return $output;

        


};

$var2 = ExecutPing();
echo $var2;




// ######################################  Fuc pra filtrar a coleta ########################################################################


//No php Há dois tipos principais de filtragem: validação e higienização:

/* Um filtro de validação é utilizado para verificar se os dados cumprem certos critérios. Estes filtros são identificados pelas constantes
 FILTER_VALIDATE_*. Por exemplo, a constante FILTER_VALIDATE_EMAIL pode ser usada para determinar se o dado é um endereço de e-mail válido. 
 Entretanto, ele nunca alterará os dados de entrada.

A sanitização, por outro lado, "limpará" os dados, portanto pode alterar os dados de entrada adicionando ou removendo caracteres. 
Estes filtros são identificados pelas constantes FILTER_SANITIZE_*. Por exemplo, o filtro FILTER_SANITIZE_EMAIL removerá caracteres que são
 inadequados para um endereço de e-mail. Entretanto, os dados sanitizados não são validados para verificar se o endereço é válido.
*/

function FiltrarInfo($saidaPing)
{
    
    $palavrasChave = ["Resposta", "Esgotado", "tempo"];

    $encontradas = [];

    foreach ($palavrasChave as $palavra) {

        if (stripos($saidaPing, $palavra) !== false) {
            $encontradas[] = $palavra;
        }
    }

    return $encontradas;
}


