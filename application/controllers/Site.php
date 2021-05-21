<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Site
 *
 * @author ralf1
 */
class Site extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'menu_model'
        ));
        $this->load->library(
            array(
                'ion_auth',
                'form_validation'
            ));
    }
    
    public function index(){
        $data['info_usuario'] = $this->navegacion->get_navegacion_front();
        $data['metadata'] = "Soluciones y servicios IT para su empresa, "
                . "Administración e instalación de servidores Linux, "
                . "Desarrollo de software, "
                . "Instalación de camaras IP, "
                . "Instalación de redes";
        $data['titulo_site'] = "Virtualización de Servidores - Servicios IT - Consultoría IT";
        $this->vistas->__render($data, 'index');
    }
    
}
