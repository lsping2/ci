<?php

class Member_m extends CI_Model {

	
	public function getlist($search_key,$start,$limit)
	{
		if(!$search_key)
		{
        	$sql ="select * from member order by mb_no desc limit $start, $limit";
		}
		else
		{
			 $sql ="select * from member where  mb_id like'%$search_key%'order by mb_no desc limit $start, $limit";		
		}
		return $this->db->query($sql)->result();
	}

	public function getlist_all($search_key)
	{
		if(!$search_key)
		{
        	$sql ="select * from member order by mb_no desc";
		}
		else
		{
			 $sql ="select * from member where  mb_id like'%$search_key%'order by mb_no desc";		
		}
		return $this->db->query($sql)->result();
	}
	
	public function rowcount($search_key)
	{
		if(!$search_key)
		{
        	 $sql ="select * from member order by mb_no";
		}
		else
		{
			 $sql ="select * from member where  mb_id like'%$search_key%'order by mb_no";		
		}
		return $this->db->query($sql)->num_rows();
	}

	public function getrow($mb_no)
	{
        $sql ="select * from member where mb_no = $mb_no";
        return $this->db->query($sql)->row();
	}

	public function deleterow($mb_no)
	{
        $sql ="delete from member where mb_no = $mb_no";
        return $this->db->query($sql);
	}

	public function insertrow($row)
	{
		//print_r($row);
		//exit;
		 return $this->db->insert("member",$row);
	}

	public function updaterow($row, $mb_no)
	{
		//print_r($row);
		//exit;
		$where = array(
			"mb_no" => $mb_no
		);
		 return $this->db->update("member",$row, $where);
	}
	
	//가입통계
	public function getstat_member()
	{
		$sql ="SELECT left( reg_date, 10 ) AS subdate,count(*) ct FROM `member` group by left( reg_date, 10 ) ";   
		return $this->db->query($sql)->result();
	}
	
}

?>