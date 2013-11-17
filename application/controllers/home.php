<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$data['password_orduser'] = $this->model_doc->get_password();
		$data['option'] = $this->model_doc->get_signcode();

		$this->load->model('model_admin');
		$data['admin'] = $this->model_admin->get_session();
		$data['tipe']  = array( "promo"		=>	"Promo",
								"adhoc"		=>	"Adhoc",
								"policy"	=>	"Policy",
								"others"	=>	"Others");
		return $data;
	}

	public function index()
	{
		$data 				= $this->var_setter();

		$this->load->view('header',$data);
		$this->load->view('index.php');
		$this->load->view('footer');
	}
	public function approval_doc()
	{

		$config = array(
			array(
					'field'=>'signcode', 
					'label'=>'signcode', 
					'rules'=>''
				),
			array(
					'field'=>'remarks', 
					'label'=>'remarks', 
					'rules'=>'required'
				),
			array(
					'field'=>'password', 
					'label'=>'password', 
					'rules'=>'required'
				)
			);

		$data 				= $this->var_setter();
		$data['typeform'] 	= 'APPROVAL';

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('insert_doc.php');
			$this->load->view('footer');
		}
		else
		{
			
			$password = $this->input->post('password');
			if($password  != $data['password_orduser'])
			{
				$data['error_pass'] = 'Wrong password';
				$data = array_merge($data, array(
								'remarks' 	=> $remarks,
								'signcode' => $signcode
								));
				$this->load->view('header',$data);
				$this->load->view('insert_doc.php');
				$this->load->view('footer');
				return;
			}
			
			$remarks	= $this->input->post('remarks');
			$signcode	= $this->input->post('signcode');
			$type		= $this->input->post('type');
			$tanggal	= mktime(0,0,0,date('m'),date('d'),date('Y'));

			$insert		= array(
								'remarks' 	=> $remarks,
								'signcode' => $signcode,
								'tanggal'	=> $tanggal,
								'type'		=> $type
								);

			$data = array_merge($data,$this->model_doc->save_doc($insert,'approval'));

			//send mail
			$this->send_mail($data);

			$this->load->view('header',$data);
			$this->load->view('success.php');
			$this->load->view('footer');
		}

	}

	public function telex_doc()
	{

		$config = array(
			array(
					'field'=>'signcode', 
					'label'=>'signcode', 
					'rules'=>''
				),
			array(
					'field'=>'remarks', 
					'label'=>'remarks', 
					'rules'=>'required'
				),
			array(
					'field'=>'password', 
					'label'=>'password', 
					'rules'=>'required'
				)
			);

		$data 				= $this->var_setter();
		$data['typeform'] 	= 'TELEX';
	
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('insert_doc.php');
			$this->load->view('footer');
		}
		else
		{
			$password = $this->input->post('password');
			if($password  != $data['password_orduser'])
			{
				$data['error_pass'] = 'Wrong password';
				$data = array_merge($data, array(
								'remarks' 	=> $remarks,
								'signcode' => $signcode
								));
				$this->load->view('header',$data);
				$this->load->view('insert_doc.php');
				$this->load->view('footer');
				return;
			}
			$remarks	= $this->input->post('remarks');
			$signcode	= $this->input->post('signcode');
			$tanggal	= mktime(0,0,0,date('m'),date('d'),date('Y'));

			$insert		= array(
								'remarks' 	=> $remarks,
								'signcode' => $signcode,
								'tanggal'	=> $tanggal
								);

			$data = array_merge($data,$this->model_doc->save_doc($insert,'telex'));

			//send mail
			$this->send_mail($data);

			$this->load->view('header',$data);
			$this->load->view('success.php');
			$this->load->view('footer');
		}

	}

	public function history()
	{
		$config = array(
				array(
					'field'=>'tanggal', 
					'label'=>'tanggal', 
					'rules'=>''
				),
					array(
					'field'=>'docnum', 
					'label'=>'docnum', 
					'rules'=>''
				),
			array(
					'field'=>'signcode', 
					'label'=>'signcode', 
					'rules'=>''
				),
			array(
					'field'=>'approvaltype', 
					'label'=>'approvaltype', 
					'rules'=>'required'
				),
			array(
					'field'=>'type', 
					'label'=>'type', 
					'rules'=>''
				)
			);

		$data 				= $this->var_setter();
		array_unshift($data['option'], 'None');
		$data['atype']		= array("approval" => "Approval", "telex"=>"telex");
		$data['type']		= array( 	"all"		=> "All",
										"promo"		=>	"Promo",
										"adhoc"		=>	"Adhoc",
										"policy"	=>	"Policy",
										"others"	=>	"Others");
		$data['tanggal'] 	= date("d-m-Y");

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('history');
			$this->load->view('footer');
		}
		else
		{
			$data['tanggal'] 		= $this->input->post('tanggal');
			$data['type_choosen'] 	= $this->input->post('approvaltype');
			
			$sc = $this->input->post('signcode');
			$dn = $this->input->post('docnum');
			$t 	= explode('-',$data['tanggal']);
			$t 	= mktime(0,0,0,$t[1],$t[0],$t[2]);

			$data['docs'] = $this->model_doc->get_history_document($t,$sc,$dn,$this->input->post('approvaltype'), $this->input->post('type'));

			if($this->input->post('download'))
			{
				$data_old[] = array(
									1   => 'Register Number',
									2   => 'Approval document number',
									3   => 'Date',
									4   => 'Sign Code',
									5   => 'type',
									6   => 'Remarks'
								);
				
				// merge the header and data
				foreach ($data['docs'] as $row)
				{
					$filtered = array(
										1   => $row['register_num'],
										2   => $row['approval_docnum'],
										3   => date( "d-m-Y" ,$row['tanggal']),
										4   => $row['signcode'],
										5   => $row['type'],
										6   => $row['remarks']
									);
					$data_old[] = $filtered;
				}

				array_to_csv($data_old, "History_".$sc."_".$this->input->post('type')."_".$this->input->post('approvaltype')."_".$t.".csv");
				return;
			}
			$this->load->view('header',$data);
			$this->load->view('history');
			$this->load->view('footer');
		}
		
	}

	private function send_mail($data)
	{
		//[typeform] => TELEX [remarks] => adasd [signcode] => ZA [tanggal] => 1377388800 [register_num] => 9 [telex_docnum] => 4
		//[typeform] => APPROVAL [remarks] => asdasd [signcode] => ZA [tanggal] => 1377388800 [type] => promo [register_num] => 10 [approval_docnum] => 6

		$message = "";
		$message .= "Form Type :\t".$data['typeform']."\n";
		$message .= "Remarks :\t".$data['remarks']."\n";
		$message .= "Signcode:\t".$data['signcode']."\n";
		$message .= "Date :\t".date('d-m-Y',$data['tanggal'])."\n";
		$message .= "Register Number :\t".$data['register_num']."\n";

		if( $data['typeform'] == "APPROVAL")
		{
			$message .= "Type :\t".$data['type']."\n";
			$message .= "Appproval document Num :\t".$data['approval_docnum']."\n";
		}
		else
		{
			$message .= "Telex document Num :\t".$data['telex_docnum']."\n";
		}
		$message = wordwrap($message);
		$strHeader = "From: Garuda Approval Apps Server";

		// Send
		mail('lognumberjktrziga@yahoo.com', "JKTRZIGA Document Management [Register Number: ".$data['register_num']."]", $message);
	}
	
	public function download_history($type='approval')
	{
		$data 	= $this->model_doc->get_history_document('',0,0,$type);
		
		$data_old[] = array(
			1   => 'Register Number',
			2   => 'Approval document number',
			3   => 'Date',
			4   => 'Sign Code',
			5   => 'type',
			6   => 'Remarks'
		);
		
		// merge the header and data
		foreach ($data as $row) {
			$filtered = array(
				1   => $row['register_num'],
				2   => $row['approval_docnum'],
				3   => date( "d-m-Y" ,$row['tanggal']),
				4   => $row['signcode'],
				5   => $row['type'],
				6   => $row['remarks']
			);
			$data_old[] = $filtered;
		}

		array_to_csv($data_old, "History_".$type.".csv");

	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
