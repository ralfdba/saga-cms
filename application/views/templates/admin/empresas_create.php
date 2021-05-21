<h1 class="display-4">Agregar nueva empresa</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/empresas/create'); ?>
<table class="table table-striped">
    <tr>
        <td>Nombre empresa:</td>
        <td><input type="text" name="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>"></td>
    </tr>
    <tr>
        <td>RUT empresa:</td>
        <td><input type="text" name="rut" class="form-control" value="<?php echo set_value('rut'); ?>"></td>
    </tr>
    <tr>
        <td>Direcci&oacute;n comercial:</td>
        <td><input type="text" name="direccion" class="form-control" value="<?php echo set_value('direccion'); ?>"></td>
    </tr>
    <tr>
        <td>E-Mail Notificaciones:</td>
        <td><input type="text" name="correo" class="form-control" value="<?php echo set_value('correo'); ?>"></td>
    </tr>    
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Crear">
        </td>
    </tr>	
</table>
<?php echo form_close(); ?>
