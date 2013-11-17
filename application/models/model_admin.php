<?php
Class Model_admin extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function authenticate_user($username = '',$password='')
	{
		$result = $this->db->query("SELECT un_admin,password_admin,salt FROM masterdata")->row_array();

		if($result['un_admin'] == $username)
		{

			if( md5(md5($password).$result['salt']) == $result['password_admin'])
			{
				setcookie('x',md5($result['password_admin'].$username),0,"/");
				return TRUE;
			}
		}
		return FALSE;
	}

	function get_session()
	{
		$cookie = $_COOKIE['x'];
		
		$result = $this->db->query("SELECT un_admin,password_admin FROM masterdata")->row_array();
	
		if( $cookie == md5($result['password_admin'].$result['un_admin']))
		{
			return TRUE;
		}
		return FALSE;
	}

	function update_password_admin($password='')
	{
		$this->db->query("UPDATE masterdata set password_admin = '".$this->db->escape_str($password)."'");
	}

	function update_password_general($password='')
	{
		$this->db->query("UPDATE masterdata set password_orduser = '".$this->db->escape_str($password)."'");
	}

	function get_regnum()
	{
		$r = $this->db->query("SELECT max(regnum) as regnum FROM regnum_incr")->row_array();
		return $r['regnum'];
	}

	function reset_regnum($number=0)
	{
		$this->db->query("DELETE FROM regnum_incr");

		$this->db->query("ALTER TABLE regnum_incr AUTO_INCREMENT = ".$this->db->escape_str($number));

		$this->db->query("INSERT INTO regnum_incr values(".$this->db->escape_str($number).")");

		return TRUE;
	}

	function reset_telnum($number=0)
	{
		$this->db->query("DELETE FROM telex_num");

		$this->db->query("ALTER TABLE telex_num AUTO_INCREMENT = ".$this->db->escape_str($number));

		$this->db->query("INSERT INTO telex_num values(".$this->db->escape_str($number).")");

		return TRUE;
	}

	function get_appnum()
	{
		$r = $this->db->query("SELECT max(docnum) as appnum FROM approvalnum_incr")->row_array();
		return $r['appnum'];
	}

	function reset_approval($number=0)
	{
		$this->db->query("DELETE FROM approvalnum_incr ");

		$this->db->query("ALTER TABLE approvalnum_incr AUTO_INCREMENT = ".$this->db->escape_str($number));

		$this->db->query("INSERT INTO approvalnum_incr values(".$this->db->escape_str($number).")");

		return TRUE;
	}

	function get_masterdata()
	{
		return $this->db->query("SELECT * from masterdata")->row_array();
	}

	function get_telnum()
	{
		$r = $this->db->query("SELECT max(telexnum) as telnum FROM telex_num")->row_array();
		return $r['telnum'];
	}

	function get_signcode()
	{
		$r = $this->db->query("SELECT * from signcode")->result_array();

		return $r;
	}

	function set_signcode($data)
	{
		$this->db->insert('signcode', $data); 

		return;
	}

	function delete_signcode($id)
	{
		$this->db->query("DELETE FROM signcode where  id='".mysql_real_escape_string($id)."'"); 

		return;
	}

	function save_password_user($p)
	{
		$this->db->query("UPDATE masterdata set password_orduser ='".$this->db->escape_str($p)."'"); 

		return;
	}

	function save_password_admin($p,$s)
	{
		$this->db->query("UPDATE masterdata set password_admin ='".md5($p.$s)."' , salt='".$s."'"); 

		return;
	}

}
?>
