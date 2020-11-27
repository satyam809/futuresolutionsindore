<?php
class data_model extends CI_Model
{

    public function islogin($data)
    {
        //return $data['username'];
        $query = $this->db->query("select * from user where username='" . $data['username'] . "' and password='" . $data['password'] ."'");
        return $query->num_rows();
    }
}
