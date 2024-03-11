<?php
$comandasDirectory = '../app/Views/comandas/';
$files = scandir($comandasDirectory);
session_start();

if (!isset($_SESSION['marked_status'])) {
    $_SESSION['marked_status'] = array_fill_keys($files, false);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .comanda-form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }

        a:hover {
            color: #555;
        }
    </style></head>
<body>
    <header>
        <h1>Bienvenido chef!</h1>
    </header>

    <?php
    if (!isset($_SESSION['user'])) {
        header("Location: /comandas");
        exit();
    }

    if (!empty($files)) {
        echo "<form class='comanda-form' action='' method='post'>";
        foreach ($files as $comanda) {
            // Skip special entries . and ..
            if ($comanda != "." && $comanda != "..") {
                echo "<label><input type='checkbox' name='files[]' value='{$comanda}'";
                // Check the checkbox if the file is marked
                if (isset($_SESSION['marked_status'][$comanda]) && $_SESSION['marked_status'][$comanda]) {
                    echo " checked";
                }
                echo ">{$comanda}</label>";
            }
        }
        echo "<input type='submit' name='rename' value='Renombrar'>";
        echo "</form>";

        // Button to mark all files
        echo "<form action='' method='post'>";
        echo "<input type='submit' name='mark_all' value='Marcar Todas'>";
        echo "</form>";
    }

    if (isset($_POST['rename']) && isset($_POST['files'])) {
        $selectedFiles = $_POST['files'];

        foreach ($selectedFiles as $selectedFile) {
            $originalFilePath = $comandasDirectory . $selectedFile;
            $extension = pathinfo($originalFilePath, PATHINFO_EXTENSION);
            $newFileName = 'comandas_' . getdate()[0] . '_elaborada.' . $extension;
            $newFilePath = $comandasDirectory . $newFileName;

            if (file_exists($originalFilePath)) {
                $content = file_get_contents($originalFilePath);
                file_put_contents($newFilePath, $content);
                unlink($originalFilePath);
            }
        }
        $_SESSION['marked_status'] = array_fill_keys($files, false);
        
        ?>
        <script>
        document.window.location.reload();  
        </script>
        <?php
    }

    if (isset($_POST['mark_all'])) {
        // Toggle marked status for all files
        foreach ($files as $comanda) {
            // Skip special entries . and ..
            if ($comanda != "." && $comanda != "..") {
                $_SESSION['marked_status'][$comanda] = !$_SESSION['marked_status'][$comanda];
            }
        }
    }
    ?>
    <a href="/cancelarPedido">Cerrar sesión</a>
</body>
</html>
