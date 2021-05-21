<?php echo validation_errors(); ?>
<?php
echo form_open('registro/index');
?>
<?php
if(isset($message)){
?>
<div class="alert alert-warning"><?php echo $message; ?></div>
<?php } ?>
<table class="table table-striped">
	<tr>
            <td>E-Mail:</td>
            <td><input type="text" name="correo" class="form-control" value="<?php echo set_value('correo'); ?>"></td>
	</tr>    
	<tr>
            <td>Contrase&ntilde;a:</td>
            <td><input type="password" name="passwordoriginal" class="form-control" value="<?php echo set_value('passwordoriginal'); ?>"></td>
	</tr>
	<tr>
            <td>Repita Contrase&ntilde;a:</td>
            <td><input type="password" name="passwordcheck" class="form-control" value="<?php echo set_value('passwordcheck'); ?>"></td>
	</tr>
	<tr>
            <td>Nombre:</td>
            <td><input type="text" name="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>"></td>
	</tr>
	<tr>
            <td>Apellidos:</td>
            <td><input type="text" name="apellidos" class="form-control" value="<?php echo set_value('apellidos'); ?>"></td>
	</tr>
	<tr>
            <td>RUT:</td>
            <td><input type="text" name="rut" class="form-control" value="<?php echo set_value('rut'); ?>"></td>
	</tr>
	<tr>
            <td>Direcci&oacute;n:</td>
            <td><input type="text" name="direccion" class="form-control" value="<?php echo set_value('direccion'); ?>"></td>
	</tr>
	<tr>
            <td>Elegir perfil:</td>
            <td>
                <select name="grupo" class="form-control">
                    <?php
                        for($n = 0; $n < count($grupos); $n++){
                            if($grupos[$n]->id == 1){
                                continue;
                            }else{
                                echo "<option value=\"".$grupos[$n]->id."\">".$grupos[$n]->name."</option>";
                            }

                        }
                    ?>
                </select>
            </td>
	</tr>		
	<tr>
            <td colspan="2">
                <input type="submit" class="btn btn-primary" value="Crear nuevo usuario">
            </td>
	</tr>	
</table>
</form>