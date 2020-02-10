<?php

class User_m extends CI_Model{
    
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }
    public function jumlahuser()
    {
        $query = $this->db->get('user');
        if ($query->num_rows()>0) {
            return $query->num_rows();
        }else{
            return 0;
        }
    }
    public function get($id = null)
    {
    	$this->db->from('user');
    	if ($id != null) {
    		$this->db->where('user_id', $id);
    	}
    	$query = $this->db->get();
    	return $query;
    }
    public function add($post)
    {
    	$params['name'] = $post['fullname'];
    	$params['username'] = $post['username'];
    	$params['password'] = sha1($post['password']);
    	$params['address'] = $post['address'];
    	$params['level'] = $post['level'];
    	$this->db->insert('user', $params);

    }
    function edit_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	public function del($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete('user');
	}
    public function getInfoToko($id)
    {
        $this->db->from('info');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
}

?>