<?php
// Função para calcular calorias
function calcularCalorias($peso, $tempoMin, $met) {
    $tempoH = $tempoMin / 60; // converte para horas
    return $met * $peso * $tempoH;
}

// Inicializa variável de resultado
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idade = $_POST["idade"];
    $sexo = $_POST["sexo"];
    $peso = $_POST["peso"];
    $altura = $_POST["altura"];
    $tempo = $_POST["tempo"];
    $intensidade = $_POST["intensidade"];

    // Definir MET conforme intensidade escolhida
    switch ($intensidade) {
        case "Leve":
            $met = 4;
            break;
        case "Médio":
            $met = 8;
            break;
        case "Pesado":
            $met = 12;
            break;
        default:
            $met = 1;
    }

    $calorias = calcularCalorias($peso, $tempo, $met);

    $resultado = "
        <div class='resultado-box'>
            <h3>Resultado:</h3>
            <p><span>Idade:</span><span>$idade anos</span></p>
            <p><span>Sexo:</span><span>$sexo</span></p>
            <p><span>Peso:</span><span>$peso kg</span></p>
            <p><span>Altura:</span><span>$altura cm</span></p>
            <p><span>Tempo:</span><span>$tempo minutos</span></p>
            <p><span>Intensidade:</span><span>$intensidade ($met METs)</span></p>
            <p class='calorias'><span>Calorias Gastas:</span><span>" . round($calorias, 2) . " kcal</span></p>
        </div>
    ";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Calorias Gastas</title>
    <link rel="stylesheet" href="style5.css">
</head>
<body>
    <h2>Simule quantas calorias você irá queimar em nosso treino!</h2>
    <form method="post">
        Idade: <input type="number" name="idade" required><br><br>
        Sexo: 
        <select name="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
        </select><br><br>
        Peso (kg): <input type="number" step="0.1" name="peso" required><br><br>
        Altura (cm): <input type="number" name="altura" required><br><br>
        Tempo (minutos): <input type="number" name="tempo" required><br><br>
        
        Intensidade:
        <select name="intensidade">
            <option value="Leve"> Leve</option>
            <option value="Médio"> Médio</option>
            <option value="Pesado"> Pesado</option>
        </select><br><br>

        <button type="submit">Calcular</button>
    </form>

    <hr>
    <?php echo $resultado; ?>
</body>
</html>
