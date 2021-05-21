<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Notificaciones
 * Mensajería del sistema
 * @author ralf
 */
class Mensajeria extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
		'admin/mensajeria_model',
		'admin/maestros_model',
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'notificaciones',
                'ion_auth'
            ));
    }
    
    public function index(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->mensajeria_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->mensajeria_model->get_current_page_records($limit_per_page, $start_index);             
                    $config['base_url'] = site_url() . '/admin/mensajeria/index';
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'mensajeria_lista');
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }
    public function create(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
		    $data['info_usuario'] = $this->permisos->get_user_data();
		    $data['maestros'] = $this->maestros_model->select_all();
                //form
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('titulo', 'T&iacute;tulo', 'required|trim|min_length[6]|max_length[50]');
                $this->form_validation->set_rules('asunto', 'Asunto', 'required|trim|min_length[6]|max_length[50]');
                $this->form_validation->set_rules('de', 'De', 'required|trim|valid_email');
                $this->form_validation->set_rules('para', 'Para', 'trim|min_length[3]|max_length[50]');
                $this->form_validation->set_rules('cuerpo', 'Cuerpo', 'required|trim|min_length[3]');
                $this->form_validation->set_rules('tipo', 'Tipo', 'trim');
                //
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'mensajeria_create');
                }else{
                    $params['titulo'] = $this->input->post('titulo');
                    $params['asunto'] = $this->input->post('asunto');
                    $params['de'] = $this->input->post('de');
                    $params['para'] = $this->input->post('para');
                    $params['cuerpo'] = $this->input->post('cuerpo');
                    $params['tipo_notificacion'] = $this->input->post('tipo');
                    $resp = $this->mensajeria_model->insert($params);
                    if(is_null($resp)){
                        $data['message'] = "Error al crear nuevo tipo de mensajer&iacute;a";
                    }else{
                        $data['message'] = "Exito al crear nuevo tipo de mensajer&iacute;a"
                                . ".&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                    }            
                    $this->vistas->__render_admin($data, 'error');
        
                }
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }         
    }
    public function edit($id = NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                if($id){
                    $params['mensajeria_id'] = $id;
                    $data['mensajeria_select'] = $this->mensajeria_model->selectbyid($params);            
                }
                $data['info_usuario'] = $this->permisos->get_user_data();
		    $data['maestros'] = $this->maestros_model->select_all();
                //
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('id', 'ID', 'trim');
                $this->form_validation->set_rules('estado', 'Estado', 'trim');
                $this->form_validation->set_rules('titulo', 'T&iacute;tulo', 'required|trim|min_length[6]|max_length[50]');
                $this->form_validation->set_rules('asunto', 'Asunto', 'required|trim|min_length[6]|max_length[50]');
                $this->form_validation->set_rules('de', 'De', 'required|trim|valid_email');
                $this->form_validation->set_rules('para', 'Para', 'trim|min_length[3]|max_length[50]');
                $this->form_validation->set_rules('cuerpo', 'Cuerpo', 'required|trim|min_length[3]');
                $this->form_validation->set_rules('tipo', 'Tipo', 'trim');
                //
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'mensajeria_edit');
                }else{
                    $params['id'] = $this->input->post('id');
                    $params['estado'] = $this->input->post('estado');
                    $params['titulo'] = $this->input->post('titulo');
                    $params['asunto'] = $this->input->post('asunto');
                    $params['de'] = $this->input->post('de');
                    $params['para'] = $this->input->post('para');
                    $params['cuerpo'] = $this->input->post('cuerpo');
                    $params['tipo_notificacion'] = $this->input->post('tipo');
                    $resp = $this->mensajeria_model->update($params);
                    if($resp == 0){
                        $data['message'] = "Error al editar tipo de mensajer&iacute;a";
                    }else{
                        $data['message'] = "Exito al editar tipo de mensajer&iacute;a"
                                . ".&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                    }            
                    $this->vistas->__render_admin($data, 'error');
        
                }
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }
    public function delete($id = NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                if($id){
                    $resp = $this->mensajeria_model->delete($id);
                    if($resp > 0){
                            $data['message'] = "Exito al eliminar notificaci&oacute;n"
                            . ".&nbsp;<a href=\"".$this->agent->referrer()."\">Volver</a>";
                    }else{
                        $data['message'] = "Error al eliminar notificaci&oacute;n;";
                    }            
                    $this->vistas->__render_admin($data,'error');
                }
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }         
    }
    public function envio_masivo(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){

            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }
}
