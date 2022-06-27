<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Login
 *
 * @author ralf
 * @desc Login general para la aplicación, determina según el tipo de perfil de
 * usuario a que controlador debe ingresar
 */
class Login extends CI_Controller{
    private $remember = TRUE;

    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'ion_auth',
                'form_validation'
            ));
        $this->load->helper(array('url','language'));
        $this->form_validation->set_error_delimiters(
        $this->config->item('error_start_delimiter', 'ion_auth'),
        $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }


    public function index(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                redirect('admin/usuarios', 'refresh');
            }else{
                redirect($this->config->item('template_custom').'/dashboard', 'refresh');
            }
        }else{
            $data['message'] = "";
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            //
            $this->form_validation->set_error_delimiters(
                    '<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules(
                    'correo', str_replace(':', '',
                            $this->lang->line('login_identity_label')),
                    'required');
            $this->form_validation->set_rules(
                    'password', str_replace(':', '',
                            $this->lang->line('login_password_label')),
                    'required');

            if ($this->form_validation->run() == FALSE){
                $this->vistas->__render_login(NULL,'index');
            }else{
                if($this->ion_auth->login(
                        $this->input->post('correo'),
                        $this->input->post('password'),
                        $this->remember)){
                    $this->session->set_flashdata(
                            'message', $this->ion_auth->messages());
                    if($this->ion_auth->is_admin()){
                        redirect('admin/usuarios', 'refresh');
                    }else{
                        redirect($this->config->item('template_custom').'/dashboard', 'refresh');
                    }
                }else{
                    if(validation_errors() == FALSE){
                        $data['message'] = $this->input->post('correo')." usuario o password incorrecto.";
                    }
                    $this->vistas->__render_login($data, 'index');
                }
            }
        }
    }

    /**
     * Olvido contraseña
     * **/
	public function forgot()
	{
		// setting validation rules by checking whether identity is username or email
		if ($this->config->item('identity', 'ion_auth') != 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() === FALSE)
		{
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			if ($this->config->item('identity', 'ion_auth') != 'email')
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->vistas->__render_login($this->data, 'forgot');
		}else{
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity))
			{

				if ($this->config->item('identity', 'ion_auth') != 'email')
				{
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}
				else
				{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("login/forgot", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("login/index", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("login/forgot", 'refresh');
			}
		}
	}

	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				);
				$this->data['user_id'] = array(
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
                                $this->vistas->__render_login($this->data, 'reset_password');
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("login/index", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('login/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("login/forgot", 'refresh');
		}
	}

    public function logout(){
        $this->ion_auth->logout();
        redirect('login/index', 'refresh');
    }

}
