<?php

namespace App\Controllers;

use App\Models\MainModel;

class AdminActions extends BaseController
{
    protected $objSessionAdmin;
    public $objMainModel;

    public function __construct()
    {
        $this->objSessionAdmin = session();
    }

    public function patientsReferrals()
    {
        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel;

        $data = array();
        $data['page'] = 'admin/requests';
        $requests = $objMainModel->objData('requests');

        $row = array();
        for ($i = 0; $i < count($requests); $i++) {

            $col['id'] = $requests[$i]->id;
            $col['name'] = $requests[$i]->name;
            $col['email'] = $requests[$i]->email;
            $col['phone'] = $requests[$i]->phone;
            $col['patientDOB'] = $requests[$i]->patientDOB;
            $col['patientHeight'] = $requests[$i]->patientHeight;
            $col['patientWeight'] = $requests[$i]->patientWeight;
            $col['diagnosis'] = $requests[$i]->diagnosis;
            $col['referralName'] = $requests[$i]->referralName;
            $col['referralPhone'] = $requests[$i]->referralPhone;
            $col['orderNotes'] = $requests[$i]->orderNotes;
            $col['date'] = $requests[$i]->date;
            $col['emailVerified'] = $requests[$i]->emailVerified;
            $col['document'] = $requests[$i]->document;

            $row[$i] = $col;
        }

        $data['requests'] = $row;

        return view('header/admin', $data);
    }

    public function messages()
    {
        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel;

        $data = array();
        $data['page'] = 'admin/messages';
        $data['messages'] = $objMainModel->objDataChatsByAdmin();

        return view('header/admin', $data);
    }

    public function showModalChatOnline()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel;

        $data = array();
        $data['role'] = '1';
        $data['user'] = 'Admin';
        $data['messages'] = $objMainModel->objDataChats();

        return view('modals/chat', $data);
    }

    public function deleteMessage()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel;

        $id = $this->request->getPost('id');

        $result = $objMainModel->objDelete('chats', $id);

        if ($result == true) {
            $response['error'] = '0';
            $response['msg'] = 'success';
        } else {
            $response['error'] = '1';
            $response['msg'] = 'error on delete';
        }

        return json_encode($response);
    }

    public function showModalRespondMessage()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel;
        $id = $this->request->getPost('id');

        $data = array();
        $data['messages'] = $objMainModel->objDataByID('chats', $id);

        return view('modals/responseMessage', $data);
    }

    public function showModalChangeKey()
    {
        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $data = array();
        $data['title'] = 'Admin Password';

        return view('modals/keyChange', $data);
    }

    public function updateKey()
    {
        $response = array();

       # VERIFY SESSION
       if (empty($this->objSessionAdmin->get('admin')['role']))
       return view('logoutAdmin');
       $objMainModel = new MainModel;

        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $data = array();
        $data['password'] = $password;

        $result = $objMainModel->objUpdate('admin', $data, 1);

        if ($result['error'] == 0) { // SUCCESS

            $response['error'] = 0;
            $response['id'] = 1;
            $response['msg'] = 'Password Updated';
        } else { // ERROR UPDATE RECORD

            $response['error'] = 1;
            $response['code'] = 100;
            $response['msg'] = 'An error has ocurred';
        }

        return json_encode($response);
    }

    public function respondMessage()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel;

        $id = $this->request->getPost('id');
        $data['response'] = $this->request->getPost('response');

        $result = $objMainModel->objUpdate('chats', $data, $id);

        if ($result == true) {
            $response['error'] = '0';
            $response['msg'] = 'success';
        } else {
            $response['error'] = '1';
            $response['msg'] = 'error on delete';
        }

        return json_encode($response);
    }

    public function getFile()
    {
        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

            $objMainModel = new MainModel;

        $id = $this->request->getPost('id');

        $data['document'] = $objMainModel->objDataByID('requests', $id)[0]->document;

        return view('modals/pdf', $data);
    }

    public function deletePatient()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel;
        $id = $this->request->getPost('id');

        $result = $objMainModel->objDelete('requests', $id);
        if ($result == true) {
            $response['error'] = '0';
            $response['msg'] = 'success';
        } else {
            $response['error'] = '1';
            $response['msg'] = 'error on delete';
        }

        return json_encode($response);
    }
    
}
