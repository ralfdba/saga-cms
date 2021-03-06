<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Dashboard
 * Panel principal del super administrador
 * @author ralf
 */
class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'ion_auth'
            ));
        $this->load->helper(array('url','language'));
    }

    public function index(){
        if($this->ion_auth->logged_in()){
            $data['metadata'] = "Soluciones y servicios IT para su empresa, "
                    . "Administración e instalación de servidores Linux, "
                    . "Desarrollo de software, "
                    . "Instalación de camaras IP, "
                    . "Instalación de redes";
            $data['titulo_site'] = "Virtualización de Servidores - Servicios IT - Consultoría IT";
            $data['info_usuario'] = $this->permisos->get_user_data();
            $data['menu'] = $this->menu_model->get_menu_users( $data['info_usuario']['user_info']->company );
            $this->vistas->__render($data,'dashboard');
        }else{
            redirect("login/index", 'refresh');
        }
    }
}
