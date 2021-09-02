<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Menu
 * Creación y administración de items de menú para el sistema
 * @author ralf
 */
class Menu extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'menu_model',
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'ion_auth'
            ));
    }

    private function __endpoint() {
      $opt = array (
        "controller" => "menu",
        "path" => "admin"
      );

      return $opt;
    }

    public function index(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->menu_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->menu_model->get_current_page_records($limit_per_page, $start_index);
                    $config['base_url'] = site_url() . $this->__endpoint()["path"] ."/". $this->__endpoint()["controller"] ."/index";
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'menu');
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }

    public function add(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                //form
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('nombre', 'Nombre men&uacute;', 'required|trim|min_length[2]|max_length[15]');
                $this->form_validation->set_rules('desc', 'Descripci&oacute;n men&uacute;', 'trim|min_length[2]|max_length[40]');
                $this->form_validation->set_rules('controlador', 'Ruta controlador', 'required|trim|min_length[2]|max_length[150]');
                $this->form_validation->set_rules('orden', 'Orden de muestra', 'required|trim|integer|min_length[1]|max_length[2]');
                $this->form_validation->set_rules('front', 'Front', 'required|trim|integer|min_length[1]|max_length[2]');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data,'menu_add');
                }else{
                    $params['nombre'] = $this->input->post('nombre');
                    if(empty($this->input->post('desc'))){
                        $params['desc'] = 'Sin descripción';
                    }else{
                        $params['desc'] = $this->input->post('desc');
                    }
                    $params['controlador'] = $this->input->post('controlador');
                    $params['orden'] = $this->input->post('orden');
                    $params['front'] = $this->input->post('front');
                    $resp = $this->menu_model->insert($params);
                    if(is_null($resp)){
                        $data['message'] = "Error al crear el nuevo &iacutetem";
                    }else{
                        $data['message'] = "Exito al crear el nuevo &iacutetem";
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
    public function delete($id = NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                if($id){
                    $resp = $this->menu_model->delete($id);
                    if($resp > 0){
                            $data['message'] = "Exito al eliminar &iacutetem";
                    }else{
                        $data['message'] = "Error al eliminar &iacutetem";
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
    public function edit($id = NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                if($id){
                    $pos = strpos($id, '-');
                    if($pos === FALSE){
                        $params['menu_id'] = $id;
                        $params['menu_name'] = '';
                    }else{
                        $datos = explode('-', $id);
                        $params['menu_id'] = $datos[1];
                        $params['menu_name'] = $datos[0];
                    }
                    $data['menu_select'] = $this->menu_model->selectbyid($params);
                }
                $data['info_usuario'] = $this->permisos->get_user_data();
                //form
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('menu_id', 'Nombre men&uacute;', 'trim');
                $this->form_validation->set_rules('nombre', 'Nombre men&uacute;', 'required|trim|min_length[2]|max_length[15]');
                $this->form_validation->set_rules('desc', 'Descripci&oacute;n men&uacute;', 'trim|min_length[2]|max_length[40]');
                $this->form_validation->set_rules('controlador', 'Ruta controlador', 'required|trim|min_length[2]|max_length[150]');
                $this->form_validation->set_rules('orden', 'Orden de muestra', 'required|trim|integer|min_length[1]|max_length[2]');
                $this->form_validation->set_rules('front', 'Front', 'required|trim|integer|min_length[1]|max_length[2]');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data,'menu_edit');
                }else{
                    $params['nombre'] = $this->input->post('nombre');
                    if(empty($this->input->post('desc'))){
                        $params['desc'] = 'Sin descripción';
                    }else{
                        $params['desc'] = $this->input->post('desc');
                    }
                    $params['controlador'] = $this->input->post('controlador');
                    $params['orden'] = $this->input->post('orden');
                    $params['menu_id'] = $this->input->post('menu_id');
                    $params['front'] = $this->input->post('front');
                    $resp = $this->menu_model->update($params);
                    if($resp == 0){
                        $data['message'] = "Error al crear el nuevo &iacutetem";
                    }else{
                        $data['message'] = "Exito al crear el nuevo &iacutetem";
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

    public function associate(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                $data['lista_grupos'] = $this->ion_auth->groups()->result();
                $data['lista_menu'] = $this->menu_model->select();
                //form
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('roles', 'Roles', 'trim');
                $this->form_validation->set_rules('menu[]', 'Descripci&oacute;n men&uacute;', 'trim|required');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data,'menu_associate');
                }else{
                    $params['roles'] = $this->input->post('roles');
                    $params['menus'] = $this->input->post('menu[]');
                    $resp = $this->menu_model->associatemenurol($params);
                    if($resp == 0){
                        $data['message'] = "Error al asociar el nuevo &iacutetem";
                    }else{
                        $data['message'] = "Exito al asociar el nuevo &iacutetem";
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
    public function remove_associate($id=NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                $data['lista_associate'] = $this->menu_model->get_all_rol_menu_associate();
                //form
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('roles', 'Roles', 'trim');
                $this->form_validation->set_rules('menu[]', 'Descripci&oacute;n men&uacute;', 'trim');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data,'menu_remove_associate');
                }else{
                    $params['roles'] = $this->input->post('roles');
                    $params['menus'] = $this->input->post('menu[]');
                    $resp = $this->menu_model->associatemenurol($params);
                    if($resp == 0){
                        $data['message'] = "Error al asociar el nuevo &iacutetem";
                    }else{
                        $data['message'] = "Exito al asociar el nuevo &iacutetem";
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

    public function remove_associate_action($id = NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                if($id){
                    $resp = $this->menu_model->delete_menu_associate($id);
                    if($resp > 0){
                            $data['message'] = "Exito al quitar &iacutetem";
                    }else{
                        $data['message'] = "Error al quitar &iacutetem";
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
