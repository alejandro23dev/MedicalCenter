<?php

namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function objData($table)
    {
        $query = $this->db->table($table)
            ->select('*');

        return $query->get()->getResult();
    }

    public function objSelectFieldByID($table, $field, $id)
    {
        $query = $this->db->table($table)
            ->select($field)
            ->where('id', $id);

        return $query->get()->getResult();
    }

    public function objCreateInField($table, $token, $email)
    {
        $data = [
            'token' => $token,
        ];

        $query = $this->db->table($table)
            ->where('email', $email)
            ->update($data);

        return $query;
    }

    public function checkDuplicate($table, $field, $value, $id = '')
    {
        $query = $this->db->table($table)
            ->where($field, $value);

        if (!empty($id)) {
            $IDs = array();
            $IDs[0] = $id;
            $query->whereNotIn('id', $IDs);
        }

        return $query->get()->getResult();
    }

    public function checkUserExist($user, $id = '')
    {
        $query = $this->db->table('clients')
            ->where('user', $user);

        if (!empty($id)) {
            $IDs = array();
            $IDs[0] = $id;
            $query->whereNotIn('id', $IDs);
        }

        return $query->get()->getResult();
    }

    public function checkCardNumberExist($cardNumber, $id = '')
    {
        $query = $this->db->table('clients')
            ->where('number', $cardNumber);

        if (!empty($id)) {
            $IDs = array();
            $IDs[0] = $id;
            $query->whereNotIn('id', $IDs);
        }

        return $query->get()->getResult();

        if (!empty($result)) {
            // La tarjeta existe en la base de datos
            return true;
        } else {
            // La tarjeta no existe en la base de datos
            return false;
        }
    }

    public function checkEmailExist($email, $id = '')
    {
        $query = $this->db->table('clients')
            ->where('email', $email);

        if (!empty($id)) {
            $IDs = array();
            $IDs[0] = $id;
            $query->whereNotIn('id', $IDs);
        }

        return $query->get()->getResult();
    }

    public function objCreate($table, $data)
    {
        $query = $this->db->table($table)
            ->insert($data);

        $result = array();

        if ($query->resultID == true) {

            $result['error'] = 0;
            $result['id'] = $query->connID->insert_id;
        } else
            $result['error'] = 1;

        return $result;
    }

    public function objDataByField($table, $field, $value)
    {
        $query = $this->db->table($table)
            ->where($field, $value);

        return $query->get()->getResult();
    }

    public function updateRequestInfo($requestID, $infoRequestsUpdate)
    {
        $this->db->table('requests')
            ->where('id', $requestID)
            ->update(['info' => $infoRequestsUpdate]);
    }

    public function objDataByID($table, $id)
    {
        $query = $this->db->table($table)
            ->where('id', $id);

        return $query->get()->getResult();
    }

    public function objUpdate($table, $data, $id)
    {
        $result = array();

        $query = $this->db->table($table)
            ->where('id', $id)
            ->update($data);

        if ($query === true) {
            $result['error'] = 0;
            $result['id'] = $id;
        } else {
            $result['error'] = 1;
        }

        return $result;
    }

    public function objDelete($table, $id)
    {
        $query = $this->db->table($table)
            ->where('id', $id)
            ->delete();

        return $query->resultID;
    }

    public function getData($table)
    {
        $query = $this->db->table($table);
        return $query->get()->getResult();
    }

    public function getProductData($id)
    {
        $query = $this->db->table('productos')
            ->where('id', $id);

        return $query->get()->getResult();
    }

    public function getCatData($id)
    {
        $query = $this->db->table('category')
            ->where('id', $id);

        return $query->get()->getResult();
    }

    public function uploadFile($table, $id, $field, $file)
    {
        $fileContent = file_get_contents($file['tmp_name']);

        $data = array(
            $field => $fileContent
        );

        $query = $this->db->table($table)
            ->where('id', $id)
            ->update($data);

        $result = array();

        if ($query == true) {

            $result['error'] = 0;
            $result['id'] = $id;
        } else
            $result['error'] = 1;

        return $result;
    }

    public function addComment($comment,$id)
    {
        $result = array();

        $query = $this->db->table('productos')
            ->set('comments', $comment)
            ->where('id', $id)
            ->update();

        if ($query === true) {
            $result['error'] = 0;
            $result['id'] = $id;
        } else {
            $result['error'] = 1;
        }

        return $result;
    }
}
