<h1 class="display-4">Agregar notificaci&oacute;n</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/mensajeria/edit/'.$mensajeria_select[0]['id']); ?>
<table class="table table-striped">
    <tr>
        <td>ID:</td>
        <td>
            <input type="text" name="id" class="form-control" value="<?php echo $mensajeria_select[0]['id']; ?>" readonly>
        </td>
    </tr>
    <tr>
        <td>Estado:</td>
        <td>
            <select name="tipo" class="form-control">
                <?php
                    $selactivo = "";
                    $selinactivo = "";
                    if($mensajeria_select[0]['estado'] == 0){
                        $selactivo = "selected";
                    }else{
                        $selinactivo = "selected";
                    }
                ?>
                <option value="0" <?php if(isset($selactivo) || !is_null($selactivo)){ echo $selactivo; } ?>>Activo</option>
                <option value="1" <?php if(isset($selactivo) || !is_null($selinactivo)){ echo $selinactivo; } ?>>Inactivo</option> 
            </select>
        </td>
    </tr>    
    <tr>
        <td>T&iacute;tulo:</td>
        <td><input type="text" name="titulo" class="form-control" value="<?php echo $mensajeria_select[0]['titulo']; ?>"></td>
    </tr>
    <tr>
        <td>Asunto:</td>
        <td><input type="text" name="asunto" class="form-control" value="<?php echo $mensajeria_select[0]['asunto']; ?>"></td>
    </tr>        
    <tr>
        <td>De:</td>
        <td><input type="text" name="de" class="form-control" value="<?php echo $mensajeria_select[0]['de']; ?>"></td>
    </tr>
    <tr>
        <td>Para (opcional):</td>
        <td><input type="text" name="para" class="form-control" value="<?php echo $mensajeria_select[0]['para']; ?>"></td>
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
	if($mensajeria_select[0]['tipo_notifiacion'] == $maestros[$z]['id']){

                echo "<option value=\"".$maestros[$z]['id']."\" set_select('tipo',".$maestros[$z]['id'].") selected>".$maestros[$z]['nombre']."</option>";
	}else{
	
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
                <?php echo $mensajeria_select[0]['cuerpo']; ?>
            </textarea>
        </td>
    </tr>		
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Editar">
        </td>
    </tr>	
</table>
<?php echo form_close(); ?>
