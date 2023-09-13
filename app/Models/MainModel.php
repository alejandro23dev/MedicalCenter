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
            ->where('emailVerified', '1')
            ->select('*');

        return $query->get()->getResult();
    }

    public function objDataChats()
    {
        $query = $this->db->table('chats')
            ->where('response !=', '')
            ->select('*');

        return $query->get()->getResult();
    }

    public function objDataChatsByAdmin()
    {
        $query = $this->db->table('chats')
            ->where('response', '')
            ->where('role', '2')
            ->select('*');

        return $query->get()->getResult();
    }

    public function objCreate($table, $data)
    {
        $this->db->table($table)
            ->insert($data);

        $result = array();
        if ($this->db->resultID !== null) {
            $result['error'] = 0; // Éxito en la inserción
            $result['id'] = $this->db->connID->insert_id;
        } else {
            $result['error'] = 1; // Error en la inserción
        }

        return $result;
    }

    public function objDeleteByTime($table, $currentDateTime)
    {
        $this->db->table($table)
            ->where('dateClose <', $currentDateTime)
            ->delete();

        return $this->db->resultID;
    }

    public function objDelete($table, $id)
    {
        $this->db->table($table)
            ->where('id', $id)
            ->delete();

        return $this->db->resultID;
    }

    public function objUpdateToken($table, $data, $email)
    {
        $this->db->table($table)
            ->where('email', $email)
            ->where('emailVerified', '0')
            ->update($data);

        $id = $this->db->table($table)
            ->where('email', $email)
            ->get()->getResult()[0]->id;

        $result = array();
        if ($this->db->resultID !== null) {
            $result['error'] = 0; // Éxito en la inserción
            $result['id'] = $id;
        } else {
            $result['error'] = 1; // Error en la inserción
        }

        return $result;
    }

    public function objDataByID($table, $id)
    {
        $query = $this->db->table($table)
            ->where('id', $id);

        return $query->get()->getResult();
    }

    public function checkDuplicate($table, $field, $email, $id = '')
    {
        $query = $this->db->table($table)
            ->where($field, $email);

        if (!empty($id)) {
            $IDs = array();
            $IDs[0] = $id;
            $query->whereNotIn('id', $IDs);
        }

        return $query->get()->getResult();
    }

    public function uploadFile($table, $id, $field, $file)
    {
        $fileContent = file_get_contents($file['tmp_name']);

            $data = array(
                $field => ($fileContent)
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

    public function objDataByField($table, $field, $value)
    {
        $query = $this->db->table($table)
            ->where($field, $value);

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
}
