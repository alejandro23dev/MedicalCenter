<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Admin extends BaseController
{
    protected $objSessionAdmin;
    public $objLoginModel;

    function __construct()
    {
        $this->objSessionAdmin = session();
        $this->objLoginModel = new LoginModel;

        # DESTROY SESSION
        $sessionArray = array();
        $sessionArray['id'] = '';
        $sessionArray['user'] = '';
        $sessionArray['role'] = '';

        $this->objSessionAdmin->set('admin', $sessionArray);
    }

    public function index()
    {

        return view('admin/login');
    }

    public function login()
    {
        $password = $this->request->getPost('password');
        $jsonResponse = array();

            $objLoginModel = new LoginModel;
            $resultLogin = $objLoginModel->loginAdmin($password);

            if ($resultLogin['authentication'] === true) { // SUCCESS AUTHENTICATION

                # CREATE SESSION
                $sessionArray = array();
                $sessionArray['id'] = $resultLogin['data'][0]->id;
                $sessionArray['user'] = $resultLogin['data'][0]->user;
                $sessionArray['role'] = $resultLogin['data'][0]->role;

                $this->objSessionAdmin->set('admin', $sessionArray);
               
                $jsonResponse['error'] = 0;
                $jsonResponse['code'] = 0;
                $jsonResponse['msg'] = 'success';
            } else { // INVALID PASSWORD

                $jsonResponse['error'] = 1;
                $jsonResponse['code'] = 1;
                $jsonResponse['msg'] = 'Contraseña Incorrecta';
            }
        
        return json_encode($jsonResponse);
        
    }
}
