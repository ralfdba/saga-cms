<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vistas{
    /**
     * @desc $params argumentos para mostrar dinamicamente
     * @desc $body archivo de la vista
     * @desc $CI->config->item('template_custom') Obtiene el nombre de la variable de config/config.php
     * **/
    public function __render($params = NULL, $body = NULL){
        $CI =& get_instance();
        $CI->load->view('templates/'.$CI->config->item('template_custom').'/header', $params);
        $CI->load->view('templates/'.$CI->config->item('template_custom').'/'.$body, $params);
        $CI->load->view('templates/'.$CI->config->item('template_custom').'/footer', $params);
    }
    /**
     * Solo para panel de administración
     * @desc $params argumentos para mostrar dinamicamente
     * @desc $body archivo de la vista
     * **/
    public function __render_admin($params = NULL, $body = NULL){
        $CI =& get_instance();
        $CI->load->view('templates/admin/header', $params);
        $CI->load->view('templates/admin/'.$body, $params);
        $CI->load->view('templates/admin/footer', $params);
    }
    /**
     * Solo para login
     * @desc $params argumentos para mostrar dinamicamente
     * @desc $body archivo de la vista
     * **/
    public function __render_login($params = NULL, $body = NULL){
        $CI =& get_instance();
        $CI->load->view('templates/login/header', $params);
        $CI->load->view('templates/login/'.$body, $params);
        $CI->load->view('templates/login/footer', $params);
    }
    /**
     * Solo para registro de nuevos usuarios
     * @desc $params argumentos para mostrar dinamicamente
     * @desc $body archivo de la vista
     * **/
    public function __render_registro($params = NULL, $body = NULL){
        $CI =& get_instance();
        $CI->load->view('templates/registro/header', $params);
        $CI->load->view('templates/registro/'.$body, $params);
        $CI->load->view('templates/registro/footer', $params);
    }
}

