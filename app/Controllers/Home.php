<?php

namespace App\Controllers;

use App\Models\MainModel;

class Home extends BaseController
{
    public $objMainModel;

    public function __construct()
    {
        $this->objMainModel = new MainModel;
    }

    public function index()
    {
        $data['page'] = 'pages/aboutUs';
        return view('header/index', $data);
    }

    public function patientReferral()
    {
        $data['page'] = 'pages/patientReferral';

        return view('header/index', $data);
    }

    public function missionAndPhilosophy()
    {
        $data['page'] = 'pages/missionAndPhilosophy';

        return view('header/index', $data);
    }

    public function services()
    {
        $data['page'] = 'pages/services';

        return view('header/index', $data);
    }

    public function verifyEmail()
    {

        $objMainModel = new MainModel();

        $email = $this->request->getPost('email');
        $resultCheckEmailDuplicate = $objMainModel->checkEmailExist($email);

        if (
            empty($this->request->getPost('name')) || empty($email) || empty($this->request->getPost('phone')) ||
            empty($this->request->getPost('patientDOB')) || empty($this->request->getPost('patientHeight')) ||
            empty($this->request->getPost('patientWeight')) || empty($this->request->getPost('diagnosis')) || empty($this->request->getPost('referralName')) ||
            empty($this->request->getPost('referralPhone')) ||  empty($this->request->getPost('orderNotes'))
        ) {
            $response['error'] = 2;
            $response['msg'] = 'Por favor introduzca todos los datos correctamente';
        } else {
            if (empty($resultCheckEmailDuplicate)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $name = $this->request->getPost('name');
                    $email = $email;
                    $phone = $this->request->getPost('phone');
                    $patientDOB = $this->request->getPost('patientDOB');
                    $patientHeight = $this->request->getPost('patientHeight');
                    $patientWeight = $this->request->getPost('patientWeight');
                    $diagnosis = $this->request->getPost('diagnosis');
                    $referralName = $this->request->getPost('referralName');
                    $referralPhone = $this->request->getPost('referralPhone');
                    $orderNotes = $this->request->getPost('orderNotes');
                    $token = md5(uniqid());

                    //INSERTAR EN LA TABLA (REQUESTS) LOS DATOS DE LA COMPRA PARA MOSTRARLOS EN LA TABLA PEDIDOS
                    $insertData = [
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'patientDOB' => $patientDOB,
                        'patientHeight' => $patientHeight,
                        'patientWeight' => $patientWeight,
                        'diagnosis' => $diagnosis,
                        'referralName' => $referralName,
                        'referralPhone' => $referralPhone,
                        'orderNotes' => $orderNotes,
                        'token' => $token,
                    ];

                    $result = $objMainModel->objCreate('requests', $insertData);

                    if ($result['error'] == 0) {
                        $response['id'] = $result['id'];
                        $emailData = array();
                        $emailData['title'] = 'Verify your Email';
                        $emailData['token'] = $token;
                        $emailData['url'] = base_url('Home/confirmEmail') . '/' . $token;

                        $objEmail = \Config\Services::email();
                        $objEmail->setFrom('info@axleyherrera.com', 'Making Memories Home Health');
                        $objEmail->setTo($email);
                        $objEmail->setSubject('Verify your Email');
                        $objEmail->setMessage(view('email/verifyEmail', $emailData));

                        if ($objEmail->send(false)) {
                            $response['error'] = 0;
                            $response['msg'] = 'success send mail.';
                        } else {
                            $response['error'] = 1;
                            $response['msg'] = 'error send email';
                        }
                    }
                } else {
                    $response['error'] = 3;
                    $response['msg'] = 'email invalid format.';
                }
            } else {
                $response['error'] = 4;
                $response['msg'] = 'email exist.';
            }
        }
        return json_encode($response);
    }

    public function resendVerifyEmail()
    {

        $objMainModel = new MainModel();

        $email = $this->request->getPost('email');


        if (empty($email)) {
            $response['error'] = 2;
            $response['msg'] = 'Por favor introduzca el email';
        } else {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $token = md5(uniqid());

                    //INSERTAR EN LA TABLA (REQUESTS) LOS DATOS DE LA COMPRA PARA MOSTRARLOS EN LA TABLA PEDIDOS
                    $insertData = [
                        'token' => $token,
                    ];

                    $result = $objMainModel->objCreateByEmail('requests', $insertData, $email);

                    if ($result['error'] == 0) {
                        $response['id'] = $result['id'];
                        $emailData = array();
                        $emailData['title'] = 'Verify your Email';
                        $emailData['token'] = $token;
                        $emailData['url'] = base_url('Home/confirmEmail') . '/' . $token;

                        $objEmail = \Config\Services::email();
                        $objEmail->setFrom('info@axleyherrera.com', 'Making Memories Home Health');
                        $objEmail->setTo($email);
                        $objEmail->setSubject('Verify your Email');
                        $objEmail->setMessage(view('email/verifyEmail', $emailData));

                        if ($objEmail->send(false)) {
                            $response['error'] = 0;
                            $response['msg'] = 'success send mail.';
                        } else {
                            $response['error'] = 1;
                            $response['msg'] = 'error send email';
                        }
                    }
                } else {
                    $response['error'] = 3;
                    $response['msg'] = 'email invalid format.';
                }
           
        }
        return json_encode($response);
    }

    public function uploadFile()
    {

        $id = $_POST['id'];
        $objMainModel = new MainModel;

        if (empty($_FILES['file'])) {

            $response['error'] = 1;
            $response['msg'] = 'Empty File';
        } else {

            $result = $objMainModel->uploadFile('requests', $id, 'image', $_FILES['file']);


            if ($result['error'] == 0) {
                $response['error'] = 0;
            } else {
                $response['error'] = 1;
                $response['msg'] = 'Failed to upload image to server';
            }
        }

        return json_encode($response);
    }

    public function confirmEmail()
    {

        $token = $this->request->uri->getSegment(3);


        if (empty($token))
            return view('emptyToken');

        $result = $this->objMainModel->objDataByField('requests', 'token', $token);

        if (!empty($result)) {

            $data = array();
            $data['emailVerified'] = 1;
            $data['token'] = '';

            $this->objMainModel->objUpdate('requests', $data, $result[0]->id);

            return view('successVerify');
        } else
            return view('tokenExpired');
    }

    public function sendInfo()
    {
        $id = $this->request->getPost('id');
        $result = $this->objMainModel->objDataByID('requests', $id);

        $emailData = array();
        $emailData['title'] = 'Patient Referral';
        $emailData['name'] = $result[0]->name;

        $objEmail = \Config\Services::email();
        $objEmail->setFrom('info@axleyherrera.com', 'Making Memories Home Health');
        $objEmail->setTo('alejandro23dev@gmail.com');
        $objEmail->setSubject('Patient Referral');
        $objEmail->setMessage(view('email/sendInfo', $emailData));

        if ($objEmail->send(false)) {
            $response['error'] = 0;
            $response['msg'] = 'success send mail.';
        } else {
            $response['error'] = 1;
            $response['msg'] = 'error send email';
        }
        return json_encode($response);
    }
}
