<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Blog
 * Para publicaciones del sistema
 * @author ralf
 */
class Blog extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'admin/blog_model',
            'admin/categorias_model',
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'notificaciones',
                'upload',
                'ion_auth'
            ));
    }

    protected function set_upload_option(){
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 5000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        return $config;
    }
    
    public function index(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->blog_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->blog_model->get_current_page_records($limit_per_page, $start_index);             
                    $config['base_url'] = site_url() . '/admin/blog/index';
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'blog_lista');
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
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('titulo', 'T&iacute;tulo', 'required|trim|min_length[3]|max_length[120]');
                $this->form_validation->set_rules('categoria', 'Categor&iacute;a', 'trim');
                $this->form_validation->set_rules('texto', 'Texto', 'required|trim|min_length[3]');
                $this->form_validation->set_rules('extracto', 'Extracto', 'required|trim|min_length[3]|max_length[150]');
                
                if ($this->form_validation->run() == FALSE){
                    $data['categoria_lista'] = $this->categorias_model->select_all();
                    $this->vistas->__render_admin($data, 'blog_create');
                }else{
                    $this->upload->initialize($this->set_upload_option());
                    $params['titulo'] = $this->input->post('titulo');
                    $params['categoria'] = $this->input->post('categoria');
                    $params['cuerpo'] = $this->input->post('texto');
                    $params['extracto'] = $this->input->post('extracto');
                    if($this->upload->do_upload('userfile')){
                        //Con imagen
                        $imagen_upload = $this->upload->data();
                        $params['imagen_url'] = $imagen_upload['file_name'];
                    }
                    
                    $resp = $this->blog_model->insert($params);
                    
                    if(is_null($resp)){
                        $data['message'] = "Error al crear nueva entrada de blog."
                                            . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                    }else{
                        $data['message'] = "Exito al crear nueva entrada de blog."
                                . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
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
                    $params['blog_id'] = $id;
                    $data['blog_select'] = $this->blog_model->selectbyid($params);            
                }        
                $data['info_usuario'] = $this->permisos->get_user_data();
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('titulo', 'T&iacute;tulo', 'required|trim|min_length[3]|max_length[120]');
                $this->form_validation->set_rules('categoria', 'Categor&iacute;a', 'trim');
                $this->form_validation->set_rules('texto', 'Texto', 'required|trim|min_length[3]');
                $this->form_validation->set_rules('id', 'ID', 'trim');
                $this->form_validation->set_rules('estado', 'Estado', 'trim');
                $this->form_validation->set_rules('extracto', 'Extracto', 'required|trim|min_length[3]|max_length[150]');
                
                if ($this->form_validation->run() == FALSE){
                    $data['categoria_lista'] = $this->categorias_model->select_all();
                    $this->vistas->__render_admin($data, 'blog_edit');
                }else{            
                    $this->upload->initialize($this->set_upload_option());
                    $params['id'] = $this->input->post('id');
                    $params['titulo'] = $this->input->post('titulo');
                    $params['categoria'] = $this->input->post('categoria');
                    $params['cuerpo'] = $this->input->post('texto');
                    $params['estado'] = $this->input->post('estado');
                    $params['extracto'] = $this->input->post('extracto');
                    if($this->upload->do_upload('userfile')){
                        //Con imagen
                        $imagen_upload = $this->upload->data();
                        $params['imagen_url'] = $imagen_upload['file_name'];
                    }
                    
                    $resp = $this->blog_model->update($params);
                    
                    if($resp > 0){
                        $data['message'] = "Exito al editar entrada de blog."
                                            . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                    }else{
                        $data['message'] = "Error al editar entrada de blog."
                                . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
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
                    $resp = $this->blog_model->delete($id);
                    if($resp > 0){
                            $data['message'] = "Exito al eliminar categor&iacute;a"
                            . ".&nbsp;<a href=\"".$this->agent->referrer()."\">Volver</a>";
                    }else{
                        $data['message'] = "Error al eliminar categor&iacute;a";
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
}
