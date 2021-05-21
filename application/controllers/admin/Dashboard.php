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
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                $this->vistas->__render_admin($data,'dashboard');
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }
}
