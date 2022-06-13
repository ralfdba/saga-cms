<h1 class="display-4">Agregar nuevo &iacute;tem men&uacute;</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/menu/add'); ?>
<table class="table">
    <tr>
        <td>Nombre menú:</td>
        <td>
            <input type="text" name="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>">
        </td>
    </tr>
    <tr>
        <td>Descripción menú (opcional):</td>
        <td>
            <input type="text" name="desc" class="form-control" value="<?php echo set_value('desc'); ?>">
        </td>
    </tr>    
    <tr>
        <td>Ruta controlador:</td>
        <td>
            <input type="text" name="controlador" class="form-control" value="<?php echo set_value('controlador'); ?>">
        </td>
    </tr>
    <tr>
        <td>Orden:</td>
        <td>
            <input type="text" name="orden" class="form-control" value="<?php echo set_value('orden'); ?>">
        </td>
    </tr>
    <tr>
        <td>Menú en Front:</td>
        <td>
            <select name="front" class="form-control">
                <option value="0" <?php echo set_select('front','0', ( !empty($data) && $data == "0" ? TRUE : FALSE )); ?>>No</option>
                <option value="1" <?php echo set_select('front','1', ( !empty($data) && $data == "1" ? TRUE : FALSE )); ?>>Si</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Empresa:</td>
        <td>
            <select name="rut_empresa" class="form-control">
                <option value="-1" selected disabled>Elegir</option>
                <?php
                    for ( $n = 0; $n < count( $empresas ); $n++) {
                ?>
                <option value="<?php echo $empresas[$n]['rut']; ?>"><?php echo $empresas[$n]['empresa']; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>    
    <tr>
        <td colspan="2">
            <button type="submit" class="btn btn-success">Crear</button>
        </td>
    </tr>    
</table>
<?php echo form_close(); ?>
