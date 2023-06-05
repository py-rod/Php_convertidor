<?php include '../calculator.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">

    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <title name="Datos">Datos</title>
</head>

<body>
    <header class="header">
        <nav>
            <a href="../index.php">
                <h1>Convertidor</h1>
            </a>

            <div class="content-menu">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <img src="../assets/icons/menu.svg" alt="Menu">
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Menu de conversiones</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <a href="../index.php">Monedas</a>
                        <a href="./longitud.php">Longitud</a>
                        <a href="./masa.php">Masa</a>
                        <a href="./datos.php">Datos</a>
                        <a href="./tiempo.php">Tiempo</a>
                        <a href="./volumen.php">Volumen</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <main>
        <section>
            <h3>Datos</h3>
            <form method="POST" action="">
                <div class="form-floating mb-3">
                    <input type="number" name="quantity" class="form-control" id="floatingInput" placeholder="name@example.com" require>
                    <label for="floatingInput">Ingresar cantidad</label>
                </div>

                <div class="content-select">
                    <select name="select1">
                        <option value="bytes">Bytes</option>
                        <option value="kilobytes">Kilobytes</option>
                        <option value="megabytes">Megabytes</option>
                        <option value="gigabytes">Gigabytes</option>
                        <option value="terabytes">Terabytes</option>
                    </select>

                    <select name="select2">
                        <option value="bytes">Bytes</option>
                        <option value="kilobytes">Kilobytes</option>
                        <option value="megabytes">Megabytes</option>
                        <option value="gigabytes">Gigabytes</option>
                        <option value="terabytes">Terabytes</option>
                    </select>
                </div>
                <button type="submit">Convertir</button>
            </form>
            <p class="content-result">Resultado de la conversion: <span><?php echo $result_datos; ?></span></p>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>