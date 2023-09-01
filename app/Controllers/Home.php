<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['page'] = 'index';
        return view('header/index', $data);
    }

    public function patientReferral()
    {
        $data['page'] = 'pages/patientReferral';

        return view('header/index', $data);
    }
}
