<?php echo validation_errors(); ?>
<?php
if(isset($message)){
?>
<div class="alert alert-danger"><?php echo $message; ?></div>
<?php } ?>
<?php
$attributes = array('class' => 'form-signin', 'id' => 'login-form');
echo form_open('login/index', $attributes);
?>
<img src="<?=base_url("assets/img/logo.png")?>" class="img-fluid mx-auto d-block margin_bottom30">
<label for="inputEmail" class="sr-only">E-mail</label>
<input type="email" name="correo" id="inputEmail" class="form-control" placeholder="Correo" value="<?php echo set_value('correo'); ?>">
<label for="inputPassword" class="sr-only">Password</label>
<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
<p>
    <br />
    <i class="fa fa-unlock" aria-hidden="true"></i>
    <a href="<?=site_url('login/forgot'); ?>">
        Recuperar contrase&ntilde;a
    </a><br />
    <i class="fas fa-user-plus"></i>
    <a href="<?=site_url('registro'); ?>">
        Crear cuenta
    </a><br />
    <i class="fas fa-check"></i>
    <a href="<?=site_url('registro/activate_via_login'); ?>">
        Activar cuenta
    </a>       
</p>
</form>