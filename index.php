<?php    
    $nombre_apellido = (isset($_POST['nombre_apellido'])) ? $_POST['nombre_apellido'] : null;
    $telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : null;
    $email = (isset($_POST['email'])) ? $_POST['email'] : null;
    $errores = array();
    $formulatio_validado = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require_once 'gump.class.php';
        $resultado = GUMP::is_valid($_POST, array(
            'nombre_apellido' => 'required|min_len,3|max_len,50',
            'telefono' => 'required|numeric|min_len,5|max_len,20',
            'email' => 'required|valid_email'
        ));
        if($resultado === TRUE){
            $formulatio_validado = true;
        }else{
            $errores = $resultado;
        }
    }
?>
<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="utf-8">
        <title>Validador con GUMP</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" />
    </head>
    <body>        
        <div class="container">
            <div class="row">
                <h1 class="span12"> Ejemplo de validación </h1>
            </div>
            <?php if($formulatio_validado): ?>
                <div class="row">
                    <div class="span12"> Formulario validado correctamente. </div>
                </div>
            <?php else: ?>
                <form action="index.php" method="post">
                    <div class="row">
                        <div class="span2"> <label for="nombre_apellido"> Nombre y apellido </label> </div>
                        <div class="span4"> <input type="text" name="nombre_apellido" id="nombre_apellido" value="<?php echo $nombre_apellido ?>" /> </div>
                        <div class="span2"> <label for="telefono"> Teléfono </label> </div>
                        <div class="span4"> <input type="number" name="telefono" id="telefono" value="<?php echo $telefono ?>" /> </div>
                    </div>
                    <div class="row">
                        <div class="span2"> <label for="email"> Email </label> </div>
                        <div class="span4"> <input type="email" name="email" id="email" value="<?php echo $email ?>" /> </div>
                        <div class="span6"> &nbsp; </div>
                    </div>
                    <div class="row">
                        <div class="span12"> <input type="submit" value="Enviar" class="btn btn-success" /> </div>                    
                    </div>
                </form>
                <ul class="text text-error">
                    <?php foreach($errores as $key => $error): ?>
                        <li> <?php echo $error; ?> </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </body>
</html>