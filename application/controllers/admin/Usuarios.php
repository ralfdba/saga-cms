<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Usuarios
 * Controlador para listar, crear, editar y eliminar usuarios
 * @author ralf
 */
class Usuarios extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'ion_auth_model',
            'admin/usuarios_model',
            'admin/empresas_model'
        ));
        $this->load->library(
            array(
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
                $total_records = $this->usuarios_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->usuarios_model->get_current_page_records($limit_per_page, $start_index);
                    $config['base_url'] = site_url() . '/admin/usuarios/index';
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'usuarios_lista');
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
                    $params['usuarios_id'] = trim($id);
                    $data['usuarios_select'] = $this->usuarios_model->selectbyid($params);
                }
                $data['info_usuario'] = $this->permisos->get_user_data();
                $data['grupos'] = $this->ion_auth->groups()->result();
                $data['empresas'] = $this->empresas_model->select_all();
                //form
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('id', 'ID', 'trim');
                $this->form_validation->set_rules('passwordoriginal', 'Campo contrase&ntilde;a', 'trim|min_length[6]');
                $this->form_validation->set_rules('passwordcheck', 'Contrase&ntilde;a no coincide', 'trim|matches[passwordoriginal]');
                $this->form_validation->set_rules('nombre', 'Campo nombre es necesario', 'required|trim|min_length[3]');
                $this->form_validation->set_rules('apellidos', 'Campo apellidos es necesario', 'required|trim|min_length[3]');
                $this->form_validation->set_rules('direccion', 'Campo Direcci&oacute;n es necesario', 'required|trim|min_length[8]');
                $this->form_validation->set_rules('grupo', 'Campo grupo', 'trim');
                $this->form_validation->set_rules('empresa', 'Empresa', 'trim');
                $this->form_validation->set_rules('fono', 'Fono', 'trim|max_length[12]');
                $this->form_validation->set_rules('run', 'RUN', 'trim|max_length[12]');
                $this->form_validation->set_rules('correo', 'E-Mail', 'required|trim|valid_email');
                //
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'usuarios_edit');
                }else{
                    if($this->input->post('passwordoriginal')){
                        $opc = array(
                            'first_name' => $this->input->post('nombre'),
                            'last_name' => $this->input->post('apellidos'),
                            'direccion'=>$this->input->post('direccion'),
                            'password'=>$this->input->post('passwordoriginal'),
                            'rut'=>$this->input->post('run'),
                            'phone'=>$this->input->post('fono'),
                            'email'=>$this->input->post('correo')
                        );
                    }else{
                        $opc = array(
                            'first_name' => $this->input->post('nombre'),
                            'last_name' => $this->input->post('apellidos'),
                            'direccion'=>$this->input->post('direccion'),
                            'company'=>$this->input->post('empresa'),
                            'rut'=>$this->input->post('run'),
                            'phone'=>$this->input->post('fono'),
                            'email'=>$this->input->post('correo')
                        );
                    }
                    $group = $this->input->post('grupo');
                    if($this->ion_auth->update($this->input->post('id'), $opc)){
                        $this->ion_auth->remove_from_group($group, $this->input->post('id'));
                        $this->ion_auth->add_to_group($group, $this->input->post('id'));
                        $data['message'] = "Exito en la actualizaci&oacute;n del usuario."
                                . "&nbsp; <a href=\"".$this->config->item('url_sistema')."admin/usuarios"."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    }else{
                        $data['message'] = "Error en la actualizaci&0acute;n del usuario. Intente nuevamente."
                                . "&nbsp; <a href=\"".$this->config->item('url_sistema')."admin/usuarios"."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
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
                if($id){
                    $data['info_usuario'] = $this->permisos->get_user_data();
                    if($this->ion_auth->deactivate($id)){
                        $data['message'] = "Exito al eliminar"
                            . "&nbsp; <a href=\"".$this->config->item('url_sistema')."admin/usuarios"."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    }else{
                        $data['message'] = "Error al eliminar"
                            . "&nbsp; <a href=\"".$this->config->item('url_sistema')."admin/usuarios"."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    }
                    $this->vistas->__render_admin($data,'error');
                }else{
                    redirect("login/index", 'refresh');
                }
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }
    public function activate($id = NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                if($id){
                    $data['info_usuario'] = $this->permisos->get_user_data();
                    if($this->ion_auth->activate($id)){
                        $data['message'] = "Exito al activar."
                            . "&nbsp; <a href=\"".$this->config->item('url_sistema')."admin/usuarios"."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    }else{
                        $data['message'] = "Error al activar."
                            . "&nbsp; <a href=\"".$this->config->item('url_sistema')."admin/usuarios"."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    }
                    $this->vistas->__render_admin($data,'error');
                }else{
                    redirect("login/index", 'refresh');
                }
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
                $data['grupos'] = $this->ion_auth->groups()->result();
                $data['empresas'] = $this->empresas_model->select_all();
                //form
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('passwordoriginal', 'Campo contrase&ntilde;a', 'required|trim|min_length[6]');
                $this->form_validation->set_rules('passwordcheck', 'Contrase&ntilde;a no coincide', 'required|trim|matches[passwordoriginal]');
                $this->form_validation->set_rules('correo', 'Debe registrar un e-mail valido', 'required|trim|valid_email');
                $this->form_validation->set_rules('nombre', 'Campo nombre es necesario', 'required|trim|min_length[3]');
                $this->form_validation->set_rules('apellidos', 'Campo apellidos es necesario', 'required|trim|min_length[3]');
                $this->form_validation->set_rules('rut', 'Campo RUT es necesario', 'required|trim|min_length[6]');
                $this->form_validation->set_rules('direccion', 'Campo Direcci&oacute;n es necesario', 'required|trim|min_length[8]');
                $this->form_validation->set_rules('grupo', 'Campo grupo', 'trim');
                $this->form_validation->set_rules('empresa', 'Empresa', 'trim');
                $this->form_validation->set_rules('fono', 'Fono', 'trim|max_length[12]');
            //
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'usuarios_create');
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
                                'direccion'=>$this->input->post('direccion'),
                                'company'=>$this->input->post('empresa'),
                                'phone'=>$this->input->post('fono')
                            );
                            $group = array($this->input->post('grupo'));
                            $result = $this->ion_auth->register('', $password, $email, $additional_data, $group);
                            if($result != FALSE){
                                $data['message'] = "Exito en la creaci&oacute;n del nuevo registro."
                                        . "&nbsp; Un e-mail de confirmaci&oacute;n ha sido enviado a: ".$email
                                        . "&nbsp; <a href=\"".$this->config->item('url_sistema')."admin/usuarios"."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                                $this->notificaciones->sent_notificacion_registro_confirmacion($result);
                            }else{
                                $data['message'] = "Error en la creaci&oacute;n del nuevo registro. Intente nuevamente.";
                            }
                        }else{
                            $data['message'] = "Error, e-mail: <strong>".$this->input->post('correo')."</strong> ya existe.";
                        }
                    }else{
                        //retorna error de validez de rut
                        $data['message'] = "RUN: <strong>".$this->input->post('rut')."</strong> no v&aacute;lido.";
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
}
