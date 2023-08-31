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
        $query = $this->db->table('login')
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

    public function loginClient($user, $password)
    {
        $query = $this->db->table('clients')
            ->where('role', 2)
            ->where('user', $user);

        $data = $query->get()->getResult();
        $result = array();

        if (empty($data)) {
            $result['authentication'] = 'UserNotFound';
            $result['msg'] = 'UserNotFound';

            return $result;
        }

        if (password_verify($password, $data[0]->password)) {

            $result['authentication'] = true;
            $result['data'] = $data;
        } else
            $result['authentication'] = false;

        return $result;
    }

    public function verifyAccount($user)
    {
        $query = $this->db->table('clients')
            ->where('role', 2)
            ->where('user', $user);


        $data = $query->get()->getResult();
        $result = array();

        if (empty($data)) {
            $result['verifyAccount'] = 'NotExist';

            return $result;
        }

        if ($data[0]->accountStatus == 1) {

            $result['verifyAccount'] = true;
            $result['data'] = $data;
        } else
            $result['verifyAccount'] = false;

        return $result;
    }

    public function verifyEmailExist($table, $email)
    {
        $query = $this->db->table($table)
            ->where('role', 2)
            ->where('email', $email);


        $data = $query->get()->getResult();
        $result = array();

        if (empty($data)) {
            $result['verifyEmailExist'] = false;
            $result['error'] = 1;
        } else {
            $result['verifyEmailExist'] = true;
            $result['error'] = 0;
        }

        return $result;
    }

    public function loginDriver($user, $password)
    {
        $query = $this->db->table('drivers')
            ->where('role', 3)
            ->where('name', $user);

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
