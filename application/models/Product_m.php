<?php

class product_m extends CI_Model {

	
	public function getlist($search_key,$start,$limit)
	{
		if(!$search_key)
		{
        	$sql ="select p.*,g.name as gubun_name 
                    from product p, gubun g 
                    where  p.gubun_no = g.no
                    order by p.no desc limit $start, $limit";
		}
		else
		{
            $sql ="select p.*,g.name as gubun_name 
                    from product p, gubun g 
                    where  p.gubun_no = g.no
                    and g.name like'%$search_key%'
                    order by p.no desc limit $start, $limit";

		}
		return $this->db->query($sql)->result();
	}
	
	public function rowcount($search_key)
	{
		if(!$search_key)
		{
        	$sql ="select * from product order by no";
		}
		else
		{
			 $sql ="select * from product where  name like'%$search_key%'order by no";		
		}
		return $this->db->query($sql)->num_rows();
	}

	public function getrow($no)
	{
        $sql ="select p.*,g.name as gubun_name 
                    from product p, gubun g 
                    where  p.gubun_no = g.no
                    and p.no = $no";
                   
        return $this->db->query($sql)->row();
	}

    public function getlist_gubun()
	{
        $sql ="select no,name from gubun order by no";   
        return $this->db->query($sql)->result();
	}

	public function deleterow($no)
	{
        $sql ="delete from product where no = $no";
        return $this->db->query($sql);
	}

	public function insertrow($row)
	{
		//print_r($row);
		//exit;
		 return $this->db->insert("product",$row);
	}

	public function updaterow($row, $no)
	{
		//print_r($row);
		//exit;
		$where = array(
			"no" => $no
		);
		 return $this->db->update("product",$row, $where);
	}
	
}
?>