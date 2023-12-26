<?php
function calcularFgts($salario, $mesesTrabalhados, $tipoTrabalhador){
    $fgts = 0;
    switch ($tipoTrabalhador) {
        case 'aprendiz':
            $taxaFgts = 0.02;
            break;
        case 'domestica':
            $taxaFgts = 0.06; 
            break;
        default:
            $taxaFgts = 0.08;
            break;
    }
    $fgts = ($salario * $taxaFgts) * $mesesTrabalhados;
    return $fgts;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculadora de FGTS</title>
</head>

<body>
    <form action="index.php" method="post">
        <label for="salario">Salário</label>
        <input type="number" name="salario" id="salario">
        
        <label for="mesesTrabalhados">Número de meses trabalhados</label>
        <input type="number" name="mesesTrabalhados" id="mesesTrabalhados">
        
        <label for="tipoTrabalhador">Tipo de trabalhador</label>
        <select name="tipoTrabalhador" id="tipoTrabalhador">
            <option value="normal">Trabalhador Normal</option>
            <option value="aprendiz">Jovem Aprendiz</option>
            <option value="domestica">Empregada Doméstica</option>
        </select>

        <button type="submit">Enviar</button>
    </form>

    <div id="resultado">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $salario = isset($_POST['salario']) ? floatval($_POST['salario']) : null;
            $mesesTrabalhados = isset($_POST['mesesTrabalhados']) ? intval($_POST['mesesTrabalhados']) : null;
            $tipoTrabalhador = isset($_POST['tipoTrabalhador']) ? $_POST['tipoTrabalhador'] : 'normal';

            if ($salario === null || $mesesTrabalhados === null) {
                echo "Por favor, preencha todos os campos do formulário.";
            } else {
                $resultado = calcularFgts($salario, $mesesTrabalhados, $tipoTrabalhador);
                echo "O valor do FGTS é: R$ " . number_format($resultado, 2, ',', '.');
            }
        }
        ?>
    </div>
</body>

</html>
