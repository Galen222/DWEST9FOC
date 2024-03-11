<?php
/**
 * Realiza una petición a la API que devuelve información de usuarios random.
 * 
 * @return object Devuelve un objeto JSON con la información del usuario.
 */
function obtenerUsuarioRandom() {
    $user_json = file_get_contents('https://randomuser.me/api/');
    return json_decode($user_json);
}

/**
 * Refresca la página cada 6 segundos.
 * 
 * Esta función utiliza jQuery para recargar la página automáticamente cada 6 segundos.
 */
function refrescarPagina() {
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            //Cada 6 segundos (6000 milisegundos) se ejecutará la función refrescar
            setTimeout(refrescar, 6000);
        });

        function refrescar(){
            //Actualizo la página
            location.reload();
        }
    </script>
    <?php
}

// Obtengo información del usuario aleatorio
$user_info = obtenerUsuarioRandom()->results[0];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importo CSS -->
    <link rel="stylesheet" href="cliente.css">
    <title>DWES Tarea 9</title>
</head>
<body>
<header>
    <h1>DWES Tarea 9 - Aplicaciones web híbridas</h1>
</header>
<main>
    <h2>Personas aleatorias</h2>
    <!-- Creo contenedor para la tarjeta -->
    <div class="personas">
        <div class="semicirculo"></div>
        <div class="foto">
            <!-- Muestro foto de la persona -->
            <img src="<?php echo $user_info->picture->large; ?>" alt="Foto de perfil">
        </div>
        <div class="datos">
            <!-- Muestro nombre y apellido -->
            <h3><?php echo $user_info->name->first . ' ' . $user_info->name->last; ?></h3>
            <!-- Muestro calle, numero y pais -->
            <p><?php echo $user_info->location->street->name .", "
                . $user_info->location->street->number . ", " . $user_info->nat?></p>
            <!-- Muestro información de contacto -->
            <p><?php echo $user_info->email; ?></p>
            <p><?php echo $user_info->phone; ?></p>
        </div>
    </div>
</main>
<footer>
    <p>Jesús Domingo Martín Cuesta. 46877606H</p>
</footer>
<?php
// Llamo a la función para refrescar la página
refrescarPagina();
?>
</body>
</html>
