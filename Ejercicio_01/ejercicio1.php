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
<div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h3>Menú Principal</h3>
        </div>
        <div class="card-body">
            <!-- Distribución en dos columnas -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="?opcion=factorial" class="btn btn-success btn-lg btn-block">Calcular Factorial</a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="?opcion=primo" class="btn btn-info btn-lg btn-block">Comprobar si es Primo</a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="?opcion=serie" class="btn btn-warning btn-lg btn-block">Calcular Serie Matemática</a>
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
                        case 'factorial':
                            echo "<h4>Calcular Factorial</h4>";
                            echo "<form method='POST'>
                                    <div class='form-group'>
                                        <label for='numero'>Ingrese un número entre 1 y 10:</label>
                                        <input type='number' name='numero' min='1' max='10' class='form-control' required>
                                    </div¿¼
                                    >
                                    <button type='submit' class='btn btn-primary btn-block'>Calcular</button>
                                  </form>";

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $numero = intval($_POST['numero']);
                                if ($numero < 1 || $numero > 10) {
                                    echo "<div class='alert alert-danger mt-3'>Por favor, ingrese un número entre 1 y 10.</div>";
                                } else {
                                    echo "<div class='alert alert-success mt-3'>El factorial de $numero es: " . factorial($numero) . "</div>";
                                }
                            }
                            break;

                        case 'primo':
                            echo "<h4>Comprobar si un Número es Primo</h4>";
                            echo "<form method='POST'>
                                    <div class='form-group'>
                                        <label for='numero'>Ingrese un número entre 1 y 10:</label>
                                        <input type='number' name='numero' min='1' max='10' class='form-control' required>
                                    </div>
                                    <button type='submit' class='btn btn-primary btn-block'>Comprobar</button>
                                  </form>";

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $numero = intval($_POST['numero']);
                                if ($numero < 1 || $numero > 10) {
                                    echo "<div class='alert alert-danger mt-3'>Por favor, ingrese un número entre 1 y 10.</div>";
                                } else {
                                    $resultado = esPrimo($numero) ? "es primo" : "no es primo";
                                    echo "<div class='alert alert-success mt-3'>El número $numero $resultado.</div>";
                                }
                            }
                            break;

                        case 'serie':
                            echo "<h4>Calcular Serie Matemática</h4>";
                            echo "<form method='POST'>
                                    <div class='form-group'>
                                        <label for='numero'>Ingrese el número de términos entre 1 y 10:</label>
                                        <input type='number' name='numero' min='1' max='10' class='form-control' required>
                                    </div>
                                    <button type='submit' class='btn btn-primary btn-block'>Calcular</button>
                                  </form>";

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $numero = intval($_POST['numero']);
                                if ($numero < 1 || $numero > 10) {
                                    echo "<div class='alert alert-danger mt-3'>Por favor, ingrese un número entre 1 y 10.</div>";
                                } else {
                                    echo "<div class='alert alert-success mt-3'>El resultado de la serie matemática con $numero términos es: " . calcularSerie($numero) . "</div>";
                                }
                            }
                            break;

                        case 'salir':
                            // Redirige al menú principal
                            session_destroy(); // Si usas sesiones para almacenar el estado
                            header('Location: ../index.html'); // Redirige directamente al inicio
                            exit; // Asegura que no se ejecute más código
                            break;

                        default:
                            echo "<h2>Opción no válida</h2>";
                    }
                }

                // Función para calcular factorial
                function factorial($numero) {
                    $total=1;
                    for ( $i = $numero ; $i >= 1 ; $i--) {
                        $total=$total*$i;
                    }
                    return $total;
                }

                // Función para verificar si un número es primo
                function esPrimo($n) {
                    if ($n < 2) return false;
                    for ($i = 2; $i <= sqrt($n); $i++) {
                        if ($n % $i == 0) return false;
                    }
                    return true;
                }

                // Función para calcular la serie matemática
                function calcularSerie($n) {
                    $resultado = 0;
                    $signo = 1;
                    for ($i = 1; $i <= $n; $i++) {
                        $resultado += $signo * pow($i, 2) / factorial($i);
                        $signo *= -1; // Alterna el signo
                    }
                    return $resultado;
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
