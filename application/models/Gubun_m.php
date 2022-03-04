<?php

class Gubun_m extends CI_Model {

	
	public function getlist($search_key,$start,$limit)
	{
		if(!$search_key)
		{
        	$sql ="select * from gubun order by no desc limit $start, $limit";
		}
		else
		{
			 $sql ="select * from gubun where  name like'%$search_key%'order by no desc limit $start, $limit";		
		}
		return $this->db->query($sql)->result();
	}
	
	public function rowcount($search_key)
	{
		if(!$search_key)
		{
        	 $sql ="select * from gubun order by no";
		}
		else
		{
			 $sql ="select * from gubun where  name like'%$search_key%'order by no";		
		}
        return $this->db->query($sql)->num_rows();
	}

	public function getrow($no)
	{
        $sql ="select * from gubun where no = $no";
        return $this->db->query($sql)->row();
	}

	public function deleterow($no)
	{
        $sql ="delete from gubun where no = $no";
        return $this->db->query($sql);
	}

	public function insertrow($row)
	{
		//print_r($row);
		//exit;
		 return $this->db->insert("gubun",$row);
	}

	public function updaterow($row, $no)
	{
		//print_r($row);
		//exit;
		$where = array(
			"no" => $no
		);
		 return $this->db->update("gubun",$row, $where);
	}
	
}
?>