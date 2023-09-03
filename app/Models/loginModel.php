<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function loginAdmin($password)
    {
        $query = $this->db->table('admin')
            ->where('role', 1);

        $data = $query->get()->getResult();
        $result = array();

        if (password_verify($password, $data[0]->password)) {

            $result['authentication'] = true;
            $result['data'] = $data;
        } else
            $result['authentication'] = false;

        return $result;
    }

}
