<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
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
                <li class="<?=(($data['URL'] == 'home/index' || $data['URL'] == '') ? 'active' : '') ?>"><a href="<?=__base_path__?>home/index"><span></span>Home</a></li>
                <li class="<?=$data['URL'] == 'home/about' ? 'active' : '' ?>"><a href="<?=__base_path__?>home/about">About</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Task Action <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="<?=$data['URL'] == 'task/createDataBase' ? 'active' : '' ?>"><a href="<?=__base_path__?>task/createDataBase">Create DataBase</a></li>
                        <li class="<?=$data['URL'] == 'task/createTable' ? 'active' : '' ?>"><a href="<?=__base_path__?>task/createTable">Create Table</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li class="<?=$data['URL'] == 'home/contacts' ? 'active' : '' ?>"><a href="<?=__base_path__?>home/contacts">Contacts</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>