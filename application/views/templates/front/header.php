<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php if(!empty($titulo_site)){ echo $titulo_site; }else{ echo $this->config->item('titulo'); } ?> | <?php echo $this->config->item('titulo');?></title>
    <meta name="title" content="<?php echo $this->config->item('titulo');?> - <?php if(!empty($titulo_site)){ echo $titulo_site; }else{echo $this->config->item('desripcion_general'); } ?>">
    <meta name="description" content="<?php echo $this->config->item('titulo');?> - <?php if(!empty($metadata)){ echo $metadata; }else{ echo $titulo_site; } ?>">    
    <!-- Bootstrap CSS -->
    	<link href=<?=base_url("assets/css/bootstrap.min.css")?> rel="stylesheet">
        <link href=<?=base_url("assets/css/bootstrap.min.css.map")?> rel="stylesheet">
        <link href=<?=base_url("assets/css/fontawesome-all.min.css")?> rel="stylesheet">
        <link href=<?=base_url("assets/css/fontawesome.min.css")?> rel="stylesheet">
        <link href=<?=base_url("assets/css/custom.css")?> rel="stylesheet"> 
    </head>
    <body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo $this->config->item('url_sistema');?>">
            <img src="<?php echo $this->config->item('logo_sistema');?>" alt="<?php echo $this->config->item('titulo');?>" width="250">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarText" 
                aria-controls="navbarText" 
                aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
                <?php
                    if(isset($info_usuario['menu'])){
                        for($n = 0; $n < count($info_usuario['menu']); $n++){
                        echo $objmenu = "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"".site_url($info_usuario['menu'][$n]['controlador'])."\">".$info_usuario['menu'][$n]['nombre_menu']."
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
        </div>
    </nav>    
    <div class="container">