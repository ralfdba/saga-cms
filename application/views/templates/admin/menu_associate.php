<h1 class="display-4">Administrador Men&uacute; y roles</h1>
<p class="lead">
    Asocie &iacute;tems de men&uacute; a diversos roles del sistema
</p>
<br />
<?php if(isset($lista_grupos)){ ?>
<?php
echo form_open('admin/menu/associate');
?>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Rol</th>
            <th scope="col">Men&uacute;</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $item_menu = "";            
            for($n = 0; $n < count($lista_menu); $n++){
                $item_menu .= "<span><input type=\"checkbox\" "
                        . " name=\"menu[]\""
                        . " value=\"".$lista_menu[$n]['id']."\">&nbsp;".$lista_menu[$n]['nombre_menu']."</span><br />";
	    }
?>
	
        <tr>
            <td>
                <select name="roles" class="form-control">
                    <?php
                        for($n = 0; $n < count($lista_grupos); $n++){
                            echo "<option value=".$lista_grupos[$n]->id.">".$lista_grupos[$n]->name."</option>";
                        }
                    ?>
                </select>
            </td>
            <td><?php echo $item_menu;?></td>            
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" class="btn btn-primary" value="Asociar">
            </td>
        </tr>        
    </tbody>
</table>
<?php echo form_close(); ?>
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
