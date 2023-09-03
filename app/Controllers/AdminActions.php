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

    public function requests()
    {
        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel;

        $data = array();
        $data['page'] = 'admin/requests';
        $data['adminData']  = $this->objSessionAdmin->get('admin');
        $requests = $objMainModel->objData('requests');


        $row = array();
        for ($i = 0; $i < count($requests); $i++) {

            $col['id'] = $requests[$i]->id;
            $col['name'] = $requests[$i]->name;
            $col['email'] = $requests[$i]->email;
            $col['phone'] = $requests[$i]->phone;
            $col['patientDOB'] = $requests[$i]->patientDOB;
            $col['patientHeight'] = $requests[$i]->patientHeight;
            $col['diagnosis'] = $requests[$i]->diagnosis;
            $col['referralName'] = $requests[$i]->referralName;
            $col['referralPhone'] = $requests[$i]->referralPhone;
            $col['orderNotes'] = $requests[$i]->orderNotes;
            $col['image'] = $requests[$i]->image;

            $row[$i] = $col;
        }

        $data['requests'] = $row;

        return view('header/admin', $data);
    }
}
