<?php
Class Model_doc extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_password()
	{
		$d = $this->db->query("SELECT password_orduser from masterdata " )->row_array();

		return $d['password_orduser'];
	}
	function save_doc($data=array(),$atype)
	{
		$this->db->query("INSERT INTO regnum_incr values()");

		$data['register_num'] = $this->db->insert_id();
		
		if($atype == 'approval')
		{
			$this->db->query("INSERT INTO approvalnum_incr values()");

			$data['approval_docnum'] = $this->db->insert_id();

			$this->db->insert('approval_document', $data); 
		}
		else
		{
				$this->db->query("INSERT INTO telex_num values()");

				$data['telex_docnum'] = $this->db->insert_id();

				$this->db->insert('telex_document', $data); 

		}
		return $data;
	}

	function get_history_document($time='',$signcode,$docnum,$atype,$type="")
	{
		if($atype == 'approval')
		{

			$qw = "";
			if($time != "" )
			{
				$q1 = "tanggal='".$this->db->escape_str($time)."'";
				$qw = "WHERE";
			}
			if($signcode != "0")
			{
				if($qw != "" )
					$q2 = "AND signcode='".$this->db->escape_str($signcode)."'";
				else
					$q2 = "signcode='".$this->db->escape_str($signcode)."'";

				$qw = "WHERE";
			}
			if($docnum != 0)
			{
				if($qw != "" )
					$q3 = "AND approval_docnum='".$this->db->escape_str($docnum)."'";
				else
					$q3 = "approval_docnum='".$this->db->escape_str($docnum)."'";
				$qw = "WHERE";
			}

			if($type != "" && $type != "all")
			{
				if($qw != "" )
					$q4 = "AND type='".$this->db->escape_str($type)."'";
				else
					$q4 = "type='".$this->db->escape_str($type)."'";
				$qw = "WHERE";
			}

			$d = $this->db->query("SELECT * from approval_document ".$qw." ".$q1." ".$q2." ".$q3." ".$q4)->result_array();
		}
		else
		{
			$qw = "";
			if($time != "" )
			{
				$q1 = "tanggal='".$this->db->escape_str($time)."'";
				$qw = "WHERE";
			}
			if($signcode != "0")
			{
				if($qw != "" )
					$q2 = "AND signcode='".$this->db->escape_str($signcode)."'";
				else
					$q2 = "signcode='".$this->db->escape_str($signcode)."'";

				$qw = "WHERE";
			}
			if($docnum != 0)
			{
				if($qw != "" )
					$q3 = "AND telex_docnum='".$this->db->escape_str($docnum)."'";
				else
					$q3 = "telex_docnum='".$this->db->escape_str($docnum)."'";
				$qw = "WHERE";
			}

			$d = $this->db->query("SELECT * from telex_document ".$qw." ".$q1." ".$q2." ".$q3)->result_array();
		}
		return $d;
	}

	function get_signcode()
	{
		$r = $this->db->query("SELECT * from signcode ".$q_w." ")->result_array();

		$r_a =array();
		foreach ($r as $key => $value) {
			$r_a[$value['code']] = $value['code'];
		}

		return $r_a;
	}
}
?>