<h1 class="display-4">Agregar nuevo medio de env&iacute;o</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/mensajeria/create'); ?>
<table class="table table-striped">
	<tr>
            <td>T&iacute;tulo:</td>
            <td><input type="text" name="titulo" class="form-control" value="<?php echo set_value('titulo'); ?>"></td>
	</tr>
	<tr>
            <td>Asunto:</td>
            <td><input type="text" name="asunto" class="form-control" value="<?php echo set_value('asunto'); ?>"></td>
	</tr>        
	<tr>
            <td>De:</td>
            <td><input type="text" name="de" class="form-control" value="<?php echo set_value('de'); ?>"></td>
	</tr>
	<tr>
            <td>Para (opcional):</td>
            <td><input type="text" name="para" class="form-control" value="<?php echo set_value('para'); ?>"></td>
	</tr>
	<tr>
            <td>Tipo:</td>
            <td>
                <select name="tipo" class="form-control">
<?php
for($z = 0; $z < count($maestros); $z++){
	if($maestros[$z]['id'] == 1){
		continue;
	}
	if($maestros[$z]['estado'] == 0){
		echo "<option value=\"".$maestros[$z]['id']."\" set_select('tipo',".$maestros[$z]['id'].")>".$maestros[$z]['nombre']."</option>";
	}
}
?>
                </select>
            </td>
	</tr>
	<tr>
            <td>Cuerpo mensaje:</td>
            <td>
                <textarea name="cuerpo" class="form-control" rows="4" cols="50">
                    <?php echo set_value('cuerpo'); ?>
                </textarea>
            </td>
	</tr>		
	<tr>
            <td colspan="2">
                <input type="submit" class="btn btn-primary" value="Crear">
            </td>
	</tr>	
</table>
<?php echo form_close(); ?>
