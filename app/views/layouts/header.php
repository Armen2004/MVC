<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=Session::get('site-title')?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/png" href="<?=__public_path__?>img/Armen.png">
    <link rel="stylesheet" href="<?=__public_path__?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=__public_path__?>css/bootstrap-theme.css">
    <script src="<?=__public_path__?>js/jquery.js"></script>
    <script src="<?=__public_path__?>js/bootstrap.js"></script>
    <script src="<?=__public_path__?>js/functionality.js"></script>

</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Tasks</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?=(($data['URL'] == 'index/index' || $data['URL'] == '') ? 'active' : '') ?>"><a href="<?=__base_path__?>index/index"><span></span>Home</a></li>
                <li class="<?=$data['URL'] == 'index/createContact' ? 'active' : '' ?>"><a href="<?=__base_path__?>index/createContact">Create Contact</a></li>
                <li class="<?=$data['URL'] == 'index/search' ? 'active' : '' ?>"><a href="<?=__base_path__?>index/search">Search</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>