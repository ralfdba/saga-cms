<h1 class="display-4">Administrador Men&uacute;</h1>
<p class="lead">
    Agregue, edite o elimine &iacute;tems de men&uacute;
</p>
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="<?=site_url('admin/menu/add'); ?>">
            <button type="button" class="btn btn-secondary">
                <i class="fa fa-plus" aria-hidden="true"></i> Crear nuevo &iacute;tem de men&uacute;
            </button>
        </a>
        <a href="<?=site_url('admin/menu/associate'); ?>">
            <button type="button" class="btn btn-secondary">
                <i class="fa fa-magic" aria-hidden="true"></i> Asignar &iacute;tem de men&uacute; a rol
            </button>
        </a>
        <a href="<?=site_url('admin/menu/remove_associate'); ?>">
            <button type="button" class="btn btn-secondary">
                <i class="fas fa-minus-circle" aria-hidden="true"></i> Quitar &iacute;tem de men&uacute; a rol
            </button>
        </a>        
    </div>   
</div>
<br />
<?php if(isset($results)){ ?>
<table class="table">
    <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre men&uacute;</th>
          <th scope="col">Controlador</th>
          <th scope="col">Orden</th>
          <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($n = 0; $n < count($results); $n++){
                $edit[] = "<a href=\"".site_url('admin/menu/edit/'.$results[$n]->id.'')."\""
                        . "class=\"badge badge-info\">"
                        . "<i class=\"fa fa-cogs\" aria-hidden=\"true\"></i>"
                        . "</a>"
                        . "<a href=\"".site_url('admin/menu/delete/'.$results[$n]->id.'')."\""
                        . "class=\"badge badge-danger\">"
                        . "<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>"
                        . "</a>";                    
                echo "<tr>"
                . "<td>".$results[$n]->id."</td>"
                        . "<td>".$results[$n]->nombre_menu."</td>"
                        . "<td>".$results[$n]->controlador."</td>"
                        . "<td>".$results[$n]->orden."</td>"
                        . "<td>".$edit[$n]."</td>"
                        . "</tr>";
            }
        ?>
    </tbody>    
</table>
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
