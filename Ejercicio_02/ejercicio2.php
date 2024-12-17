<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css.map">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container mt-5">
    <!-- Menú principal -->
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h3>Menú Principal</h3>
        </div>
        <div class="card-body">
            <!-- Distribución en dos columnas con colores de Bootstrap -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="?opcion=fraccionarios" class="btn btn-warning btn-lg btn-block">Operaciones con Fraccionarios</a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="?opcion=cubo" class="btn btn-info btn-lg btn-block">Números Especiales</a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="?opcion=fibonacci" class="btn btn-success btn-lg btn-block">Serie Fibonacci</a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="?opcion=salir" class="btn btn-danger btn-lg btn-block">Salir</a>
                </div>
            </div>
        </div>
    </div>

        <!-- Sección para mostrar contenido según la opción seleccionada -->
        <div class="card mt-4">
            <div class="card-body">
                <?php
                // Verifica si se seleccionó una opción
                if (isset($_GET['opcion'])) {
                    $opcion = $_GET['opcion'];
                    switch ($opcion) {
                        case 'fibonacci':
                            echo "<h4>Serie Fibonacci</h4>";
                            echo "<form method='POST'>
                                    <div class='form-group'>
                                        <label for='numero'>Ingrese un número entre 1 y 50:</label>
                                        <input type='number' name='numero' min='1' max='50' class='form-control' required>
                                    </div>
                                    <button type='submit' class='btn btn-primary btn-block'>Calcular</button>
                                  </form>";

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $numero = intval($_POST['numero']);
                                echo "<div class='alert alert-success mt-3'>Los primeros $numero números de Fibonacci son: " . implode(", ", fibonacci($numero)) . "</div>";
                            }
                            break;

                        case 'cubo':
                            echo "<h4>Números Especiales</h4>";
                            echo "<p>Los números entre 1 y 1,000,000 donde la suma de los cubos de sus dígitos es igual al número son:</p>";
                            echo "<div class='alert alert-info'>" . implode(", ", numerosEspeciales()) . "</div>";
                            break;

                        case 'fraccionarios':
                            echo "<h4>Operaciones con Fraccionarios</h4>";
                            echo "<form method='POST'>
                                    <div class='form-group'>
                                        <label for='A'>Ingrese A (numerador/denominador):</label>
                                        <input type='text' name='A' class='form-control' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='B'>Ingrese B (numerador/denominador):</label>
                                        <input type='text' name='B' class='form-control' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='C'>Ingrese C (numerador/denominador):</label>
                                        <input type='text' name='C' class='form-control' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='D'>Ingrese D (numerador/denominador):</label>
                                        <input type='text' name='D' class='form-control' required>
                                    </div>
                                    <button type='submit' class='btn btn-primary btn-block mt-3'>Calcular</button>
                                  </form>";

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $A = parseFraccion($_POST['A']);
                                $B = parseFraccion($_POST['B']);
                                $C = parseFraccion($_POST['C']);
                                $D = parseFraccion($_POST['D']);

                                $resultado = calcularFraccion($A, $B, $C, $D);
                                echo "<div class='alert alert-success mt-3'>El resultado de la operación es: " . $resultado['numerador'] . "/" . $resultado['denominador'] . "</div>";
                            }
                            break;

                        case 'salir':
                            session_destroy(); // Si usas sesiones para almacenar el estado
                            header('Location: ../index.html'); // Redirige directamente al inicio
                            exit; // Asegura que no se ejecute más código
                            break;

                        default:
                            echo "<h2>Opción no válida</h2>";
                    }
                }

                // Función Fibonacci
                function fibonacci($n) {
                    $serie = [1, 1];
                    for ($i = 2; $i < $n; $i++) {
                        $serie[] = $serie[$i - 1] + $serie[$i - 2];
                    }
                    return array_slice($serie, 0, $n);
                }

                // Función para encontrar números especiales
                function numerosEspeciales() {
                    $resultados = [];
                    for ($i = 1; $i <= 1000000; $i++) {
                        $sumaCubos = array_sum(array_map(function ($digito) {
                            return pow((int)$digito, 3);
                        }, str_split($i)));

                        if ($sumaCubos == $i) {
                            $resultados[] = $i;
                        }
                    }
                    return $resultados;
                }

                // Funciones para operaciones con fraccionarios
                function parseFraccion($fraccion) {
                    list($numerador, $denominador) = explode('/', $fraccion);
                    return [
                        'numerador' => intval($numerador),
                        'denominador' => max(1, intval($denominador))
                    ];
                }

                function calcularFraccion($A, $B, $C, $D) {
                    $resultadoNumerador = $A['numerador'] * $D['denominador'] +
                                          $B['numerador'] * $C['numerador'] * $D['denominador'] - 
                                          $D['numerador'] * $A['denominador'];

                    $resultadoDenominador = $A['denominador'] * $B['denominador'] * $C['denominador'] * $D['denominador'];

                    return compact('resultadoNumerador', 'resultadoDenominador');
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
