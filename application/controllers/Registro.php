<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Registro
 * Registro para nuevos usuarios del sistema.
 * Este consta de un registro de 2 pasos.
 * @author ralf
 */
class Registro extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'ion_auth',
                'form_validation',
                'vistas',
                'rut',
                'notificaciones'
            ));
        $this->load->helper(array('url','language'));
        $this->form_validation->set_error_delimiters(
                $this->config->item('error_start_delimiter', 'ion_auth'), 
                $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }    
    public function index(){
        $data['grupos'] = $this->ion_auth->groups()->result();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('passwordoriginal', 'Campo contrase&ntilde;a', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('passwordcheck', 'Contrase&ntilde;a no coincide', 'required|trim|matches[passwordoriginal]');
        $this->form_validation->set_rules('correo', 'Debe registrar un e-mail valido', 'required|trim|valid_email');
        $this->form_validation->set_rules('nombre', 'Campo nombre es necesario', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('apellidos', 'Campo apellidos es necesario', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('rut', 'Campo RUT es necesario', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('direccion', 'Campo Direcci&oacute;n es necesario', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('grupo', 'Campo grupo', 'trim');
    //
        if ($this->form_validation->run() == FALSE){
            $this->vistas->__render_registro($data, 'registro');
        }else{
            /**
            * Paso 1, Validez del rut
            * **/
            if($this->rut->valida_rut(strtoupper($this->input->post('rut')))){
                //Paso 2, Se verifica mail para evitar duplicados
                if(!$this->ion_auth->email_check($this->input->post('correo'))){
                    // Paso 3, si es correcto se crea el registro.
                    $password = $this->input->post('passwordoriginal');
                    $email = $this->input->post('correo');
                    $rut = $this->input->post('rut');
                    $additional_data = array(
                        'first_name' => $this->input->post('nombre'),
                        'last_name' => $this->input->post('apellidos'),
                        'rut'=>$rut,
                        'direccion'=>$this->input->post('direccion')
                    );
                    $group = array($this->input->post('grupo'));
                    $result = $this->ion_auth->register('', $password, $email, $additional_data, $group);
                    if($result != FALSE){
                        $data['message'] = "Exito en la creaci&oacute;n del nuevo registro."
                                . "&nbsp; Un e-mail de confirmaci&oacute;n ha sido enviado a: ".$email
                                . "&nbsp; <a href=\"".$this->config->item('url_sistema')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                        $this->notificaciones->sent_notificacion_registro_confirmacion($result);
                    }else{
                        $data['message'] = "Error en la creaci&oacute;n del nuevo registro. Intente nuevamente.";
                    }                   
                }else{
                    $data['message'] = "Error, e-mail: <strong>".$this->input->post('correo')."</strong> ya existe.";
                }
            }else{
                //retorna error de validez de rut
                $data['message'] = "RUT: <strong>".$this->input->post('rut')."</strong> no v&aacute;lido.";
            }
            
            $this->vistas->__render_registro($data, 'registro');

        }
        

    }
    
    public function activate($codigo = NULL){
        if($codigo){
            $decode = base64_decode(urldecode($codigo));
            $frags = explode("|", $decode);
            if($this->ion_auth_model->activate($frags[0], $frags[1])){
                redirect("login/index", 'refresh');
            }else{
                redirect("login/forgot", 'refresh');
            }            
        }else{
            redirect("login/index", 'refresh');
        }
    }

    public function activate_via_login(){
        $data['grupos'] = $this->ion_auth->groups()->result();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('rut', 'Campo RUT es necesario', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('correo', 'Debe registrar un e-mail valido', 'required|trim|valid_email');
        if ($this->form_validation->run() == FALSE){
            $this->vistas->__render_registro($data, 'activate');
        }else{
            $params['rut'] = $this->input->post('rut');
            $params['correo'] = $this->input->post('correo');
            $result = $this->registro_model->update($params);
            if($result != FALSE){
                $data['message'] = "Felicidades, ha activado su cuenta."
                        . "&nbsp; <a href=\"".$this->config->item('url_sistema')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
            }else{
                $data['message'] = "Error en la activaci&oacute;n de la cuenta. Revise que el RUT/DNI Sea correcto (".$params['rut'].").";
            }           
            $this->vistas->__render_registro($data, 'activate');
        }
    }    
}
