<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->config->item('titulo');?></title>
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
        <img src="<?=base_url("assets/img/logo.png")?>" class="img-fluid mx-auto d-block" style="max-width:120px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menunav" aria-controls="menunav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menunav">
            <ul class="navbar-nav mr-auto">
                <?php
                    if(isset($menu)){
                        for($n = 0; $n < count($menu); $n++){
                        echo $objmenu = "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"".site_url($menu[$n]['controlador'])."\">".$menu[$n]['nombre_menu']."
                        </a></li>";
                        	}
                    }
                  
                ?>                
                <li class="nav-item active">
                  <a class="nav-link" href="<?=site_url('login/logout'); ?>">
                      <i class="fa fa-times" aria-hidden="true"></i>
                      &nbsp;<?php
                        echo $this->session->userdata('identity');
                      ?>
                  </a>
                </li>                
            </ul>
            <span class="navbar-text">
                    <?php echo $this->config->item('titulo');?>&nbsp;
                    <?php echo $this->config->item('version_ns');?>
            </span>            
        </div>        
    </nav>    
    <div class="container">
