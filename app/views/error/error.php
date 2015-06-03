<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Test</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?= __public_path__ ?>css/bootstrap.css">
        <link rel="stylesheet" href="<?= __public_path__ ?>css/bootstrap-theme.css">
        <script src="<?= __public_path__ ?>js/jquery.js"></script>
        <script src="<?= __public_path__ ?>js/bootstrap.js"></script>
        <script src="<?= __public_path__ ?>js/functionality.js"></script>

    </head>
    <body style="background: #ffcccc">
        <div class="col-lg-offset-3 col-lg-6">
            <img src="<?= __public_path__ ?>img/404.png" class="img-responsive img-circle center-block">
            <h2 class="text-danger text-center">
                <?= $data['massage'] ?>
            </h2>
            <div class="text-center">
                <a class="btn btn-danger text-center" onclick="history.go(-1);">Back</a>
            </div>
        </div>
    </body>
</html>