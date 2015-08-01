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
<body>
<?php
if (Session::get('massage-db')) {
    ?>
    <p class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?= Session::get('massage-db'); ?></strong>
    </p>
<?php
}
?>
<?php
if (Session::get('massage-table')) {
    ?>
    <p class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?= Session::get('massage-table'); ?></strong>
    </p>
<?php
}
?>

<?php
if (Session::get('max_row_count')) {
    ?>
    <p class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Inserted Successfully.</strong>
    </p>
<?php
}
?>



<?php
if (Session::get('error-massage-db')) {
    ?>
    <p class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?= Session::get('error-massage-db'); ?></strong>
    </p>
<?php
}
?>
<?php
if (Session::get('error-massage-table')) {
    ?>
    <p class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?= Session::get('error-massage-table'); ?></strong>
    </p>
<?php
}
?>

<?php
if (!Session::get('max_row_count')) {
    ?>
    <p class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Problem With Inserting Data.</strong>
    </p>
<?php
}
?>
</body>
</html>