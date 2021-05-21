<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registro usuarios | <?php echo $this->config->item('titulo');?></title>
    <!-- Bootstrap CSS -->
    	<link href=<?=base_url("assets/css/bootstrap.min.css")?> rel="stylesheet">
        <link href=<?=base_url("assets/css/bootstrap.min.css.map")?> rel="stylesheet">
        <link href=<?=base_url("assets/css/fontawesome-all.min.css")?> rel="stylesheet">
        <link href=<?=base_url("assets/css/fontawesome.min.css")?> rel="stylesheet">
        <link href=<?=base_url("assets/css/custom.css")?> rel="stylesheet"> 
    </head>
    <body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo $this->config->item('url_sistema');?>">
            <?php echo $this->config->item('titulo');?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <span class="navbar-text">
            Registro de usuarios
        </span>        
    </nav>    
    <div class="container">