<?php

class AuthModel extends CI_Model {

	
	public function check_login($mb_id,$mb_password)
	{
        $sql ="select * from member where mb_id = '$mb_id' and mb_password='$mb_password'";
        return $this->db->query($sql)->row();
	}
	

	
}

?>