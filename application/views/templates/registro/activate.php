<?php echo validation_errors(); ?>
<?php
echo form_open('registro/activate_via_login');
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
            <td>RUT/DNI:</td>
            <td><input type="text" name="rut" class="form-control" value="<?php echo set_value('rut'); ?>"></td>
	</tr>    
	<tr>
            <td colspan="2">
                <input type="submit" class="btn btn-primary" value="Activar usuario">
            </td>
	</tr>	
</table>
</form>