<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Categorias
 * Mantenedor de categorias del sistema
 * @author ralf
 */
class Categorias extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'admin/categorias_model',
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'notificaciones',
                'ion_auth'
            ));
    }

    private function __endpoint() {
      $opt = array (
        "controller" => "categorias",
        "path" => "admin"
      );

      return $opt;
    }


    public function index(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                $data['menu'] = $this->menu_model->get_menu_admin( $data['info_usuario']['user_info']->company );
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->categorias_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->categorias_model->get_current_page_records($limit_per_page, $start_index);
                    $config['base_url'] = site_url() . $this->__endpoint()["path"] ."/". $this->__endpoint()["controller"] ."/index";
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'categorias_lista');
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
                $data['menu'] = $this->menu_model->get_menu_admin( $data['info_usuario']['user_info']->company );
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('nombre', 'Nombre categor&iacute;a', 'required|trim|min_length[3]|max_length[40]');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'categorias_create');
                }else{
                    $params['nombre'] = $this->input->post('nombre');
                    $resp = $this->categorias_model->insert($params);
                    if(is_null($resp)){
                        $data['message'] = "Error al crear nueva tipo de categor&iacute;a";
                    }else{
                        $data['message'] = "Exito al crear nueva tipo de categor&iacute;a";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".$this->config->item('url_sistema').$this->__endpoint()["path"]."/".$this->__endpoint()["controller"]."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
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
                    $params['categoria_id'] = $id;
                    $data['categoria_select'] = $this->categorias_model->selectbyid($params);
                }
                $data['info_usuario'] = $this->permisos->get_user_data();
                $data['menu'] = $this->menu_model->get_menu_admin( $data['info_usuario']['user_info']->company );
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('id', 'ID', 'trim');
                $this->form_validation->set_rules('nombre', 'Nombre categor&iacute;a', 'required|trim|min_length[3]|max_length[40]');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'categorias_edit');
                }else{
                    $params['id'] = $this->input->post('id');
                    $params['nombre'] = $this->input->post('nombre');
                    $resp = $this->categorias_model->update($params);
                    if(is_null($resp)){
                        $data['message'] = "Error al editar categor&iacute;a";
                    }else{
                        $data['message'] = "Exito al editar categor&iacute;a";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".$this->config->item('url_sistema').$this->__endpoint()["path"]."/".$this->__endpoint()["controller"]."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
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
                $data['menu'] = $this->menu_model->get_menu_admin( $data['info_usuario']['user_info']->company );
                if($id){
                    $resp = $this->categorias_model->delete($id);
                    if($resp > 0){
                            $data['message'] = "Exito al eliminar categor&iacute;a";
                    }else{
                        $data['message'] = "Error al eliminar categor&iacute;a";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".$this->config->item('url_sistema').$this->__endpoint()["path"]."/".$this->__endpoint()["controller"]."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
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
