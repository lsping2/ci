<?php

class Login_m extends CI_Model {

	
	public function getrow($mb_id,$mb_password)
	{
        $sql ="select * from member where mb_id = '$mb_id' and mb_password='$mb_password'";
        return $this->db->query($sql)->row();
        
    }
	
}
?>