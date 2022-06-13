<h1 class="display-4">Editar &iacute;tem men&uacute;</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('admin/menu/edit/'.$menu_select[0]['id']); ?>
<table class="table">
    <tr>
        <td>Menú ID:</td>
        <td>
            <input type="text" name="menu_id" class="form-control" value="<?php echo $menu_select[0]['id']; ?>" readonly="">
        </td>
    </tr>    
    <tr>
        <td>Nombre menú:</td>
        <td>
            <input type="text" name="nombre" class="form-control" value="<?php echo $menu_select[0]['nombre_menu']; ?>">
        </td>
    </tr>
    <tr>
        <td>Descripción menú (opcional):</td>
        <td>
            <input type="text" name="desc" class="form-control" value="<?php echo $menu_select[0]['descripcion']; ?>">
        </td>
    </tr>    
    <tr>
        <td>Ruta controlador:</td>
        <td>
            <input type="text" name="controlador" class="form-control" value="<?php echo $menu_select[0]['controlador']; ?>">
        </td>
    </tr>
    <tr>
        <td>Orden:</td>
        <td>
            <input type="text" name="orden" class="form-control" value="<?php echo $menu_select[0]['orden']; ?>">
        </td>
    </tr>
    <tr>
        <td>Menú en Front:</td>
        <td>
            <select name="front" class="form-control">
                <option value="0" <?php echo set_select('front','0', ( !empty($menu_select[0]['front']) && $menu_select[0]['front'] == "0" ? TRUE : FALSE )); ?>>No</option>
                <option value="1" <?php echo set_select('front','1', ( !empty($menu_select[0]['front']) && $menu_select[0]['front'] == "1" ? TRUE : FALSE )); ?>>Si</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Empresa:</td>
        <td>
            <select name="rut_empresa" class="form-control">
                <option value="-1" selected disabled>Elegir</option>
                <?php
                    $ssel = [];
                    for( $x = 0; $x < count( $empresas ); $x++ ) {
                        if ( $empresas[$x]['rut'] == $menu_select[0]['rut_empresa'] ) {
                            $ssel[] = "selected";
                        } else {
                            $ssel[] = "";
                        }
                ?>
                <option value="<?php echo $empresas[$x]['rut']; ?>" <?php echo $ssel[$x]; ?>>
                <?php echo $empresas[$x]['empresa']; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>    
    <tr>
        <td colspan="2">
            <button type="submit" class="btn btn-success">Editar</button>
        </td>
    </tr>    
</table>
<?php echo form_close(); ?>
