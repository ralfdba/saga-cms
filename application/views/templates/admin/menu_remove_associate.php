<h1 class="display-4">Administrador Men&uacute; y roles</h1>
<p class="lead">
    Elimine &iacute;tems de men&uacute; a los roles del sistema.
</p>
<br />
<?php if(isset($lista_associate)){ ?>
<div class="row">
<?php
    for($n = 0; $n < count($lista_associate); $n++){
        echo "<div class=\"col-md-3\">"
        ."<strong>".$lista_associate[$n]['grupo_nombre']."</strong><br />"
        ."<a href='remove_associate_action/".$lista_associate[$n]['permiso_id']."' class='btn btn-danger'>"
        ."<i class=\"fas fa-trash-alt\"></i>&nbsp;".$lista_associate[$n]['nombre_menu']."</a>"
        ."</div>";
    }
?>
</div>
<?php }else{ ?>
<div class="alert alert-info">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> No existen datos para mostrar
    </p>
</div>
<?php } ?>
<?php if(isset($links)){ ?>
    <?php
        echo $links;
    ?>
<?php } ?>