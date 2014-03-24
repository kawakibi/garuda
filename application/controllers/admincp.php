<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admincp extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_admin');

		$this->_admin = $this->model_admin->get_session();
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	private function var_setter()
	{
		$data['option'] = array(
							'1Xa'		=> '1Xa',
							'scV'		=> 'scV',
							'4Fr'		=> '4Fr',
							't0i'		=> 't0i',
							'k9m'		=> 'k9m'
							);

		$data['atype'] = array(
							'approval'	=> 'approval',
							'telex'		=> 'telex'
							);

		return $data;
	}
	public function index()
	{
		$data['admin'] = $this->_admin;

		if( $data['admin'] == FALSE )
		{
			$this->login();
			return;
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/index.php');
		$this->load->view('admin/footer');

	}

	public function login()
	{

		if( $this->_admin)
		{
			$this->index();
			return;
		}

		$config = array(
		array(
				'field'=>'password', 
				'label'=>'password', 
				'rules'=>'required'
			),
		array(
				'field'=>'username', 
				'label'=>'username', 
				'rules'=>'required'
			)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/login');
			$this->load->view('admin/footer');
		}
		else
		{
			if ( $this->model_admin->authenticate_user($this->input->post('username'),$this->input->post('password')) === FALSE )
			{
				$data['error'] = "Wrong password or username";
				$this->load->view('admin/header',$data);
				$this->load->view('admin/login');
				$this->load->view('admin/footer');
				return;
			}
			$this->_admin = TRUE;
			$this->index();
			
		}
	}

	public function logout()
	{
		setcookie('x','',0,"/");
		header("Location: http".base_url());
	}

	public function reset_telex()
	{
		if( !$this->_admin)
		{
			$this->index();
			return;
		}

		$data['template'] = 'reset_telex';
		$data['current']  = $this->model_admin->get_telnum();

		$config = array(
		array(
				'field'=>'telexnum', 
				'label'=>'telexnum', 
				'rules'=>'required'
			)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
		else
		{
			$this->model_admin->reset_telnum($this->input->post('telexnum'));
			$data['alert_success'] = "Telex number has been saved successfully";

			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
	}

	public function reset_approval()
	{
		if( !$this->_admin)
		{
			$this->index();
			return;
		}

		$data['template'] = 'reset_approval';
		$data['current']  = $this->model_admin->get_appnum();

		$config = array(
		array(
				'field'=>'approvalnum', 
				'label'=>'approvalnum', 
				'rules'=>'required'
			)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
		else
		{
			$this->model_admin->reset_approval($this->input->post('approvalnum'));
			$data['alert_success'] = "Approval number has been saved successfully";

			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
	}

	public function reset_reg()
	{
		if( !$this->_admin)
		{
			$this->index();
			return;
		}

		$data['template'] = 'reset_reg';
		$data['current']  = $this->model_admin->get_regnum();

		$config = array(
		array(
				'field'=>'regnum', 
				'label'=>'regnum', 
				'rules'=>'required'
			)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
		else
		{
			$this->model_admin->reset_regnum($this->input->post('regnum'));
			$data['alert_success'] = "Registration number has been saved successfully";

			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
	}

	public function set_signcode()
	{
		if( !$this->_admin)
		{
			$this->index();
			return;
		}

		$data['template'] = 'set_signcode';
		$data['current']  = $this->model_admin->get_signcode();

		$config = array(
						array(
								'field'=>'name', 
								'label'=>'name', 
								'rules'=>'required'
							),
							array(
								'field'=>'code', 
								'label'=>'code', 
								'rules'=>'required'
							)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
		else
		{
			$this->model_admin->set_signcode(array("name" => $this->input->post("name"), "code" => $this->input->post("code")));
			$data['alert_success'] = "Changes to sign code has been saved successfully";

			$data['current']  = $this->model_admin->get_signcode();

			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
	}

	public function delete_signcode($id)
	{
		$this->model_admin->delete_signcode($id);

		$data['template'] = 'set_signcode';
		$data['alert_success'] = "Changes to sign code has been saved successfully";
		$data['current']  = $this->model_admin->get_signcode();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/index');
		$this->load->view('admin/footer');
	}

	public function puser()
	{
		if( !$this->_admin)
		{
			$this->index();
			return;
		}

		$data['template'] 	= 'password_user';
		$mdata 				= $this->model_admin->get_masterdata();

		$config = array(
						array(
								'field'=>'currentpassword', 
								'label'=>'currentpassword', 
								'rules'=>'required'
							),
							array(
								'field'=>'newpassword', 
								'label'=>'newpassword', 
								'rules'=>'required'
							)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
		else
		{
			$currentpassword = $this->input->post('currentpassword');
			if( $currentpassword != $mdata['password_orduser'])
			{
				$data['error_pu'] = 'Wrong Current password';
				$this->load->view('admin/header',$data);
				$this->load->view('admin/index');
				$this->load->view('admin/footer');

				return;
			}

			$data['alert_success'] = "New Password for user has been saved successfully";
			$this->model_admin->save_password_user($this->input->post('newpassword'));

			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
	}

	public function padmin()
	{
		if( !$this->_admin)
		{
			$this->index();
			return;
		}

		$data['template'] 	= 'password_admin';
		$mdata 				= $this->model_admin->get_masterdata();

		$config = array(
						array(
								'field'=>'currentpassword', 
								'label'=>'currentpassword', 
								'rules'=>'required'
							),
							array(
								'field'=>'newpassword', 
								'label'=>'newpassword', 
								'rules'=>'required'
							)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
		else
		{
			$currentpassword = $this->input->post('currentpassword');
			if( $mdata['password_admin'] !=  md5(md5($currentpassword).$mdata['salt']))
			{
				$data['error_pu'] = 'Wrong Current password';
				$this->load->view('admin/header',$data);
				$this->load->view('admin/index');
				$this->load->view('admin/footer');

				return;
			}

			$data['alert_success'] = "New Password for admin has been saved successfully.<br>Because you Change the password, you will be logout from admin panel.";
			$this->model_admin->save_password_admin(md5($this->input->post('newpassword')),$this->_set_salt());

			$this->load->view('admin/header',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		}
	}

	private function _set_salt($length = 3)
	{
		
		$salt = '';

		for ($i = 0; $i < $length; $i++)
		{
				$salt .= chr(rand(33, 126));
		}

		return $salt;
	
	}
}

/* End of file admincp.php.php */
/* Location: ./application/controllers/admincp.php */