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
        $phone = $this->request->getPost('phone');
        $referralPhone = $this->request->getPost('referralPhone');
        $patientWeight = $this->request->getPost('patientWeight');
        $patientHeight = $this->request->getPost('patientHeight');
        $patientDOB = $this->request->getPost('patientDOB');

        $resultCheckEmailDuplicate = $objMainModel->checkDuplicate('requests', 'email', $email);
        $resultPhoneDuplicate = $objMainModel->checkDuplicate('requests', 'phone', $phone);

        if (strlen($patientDOB) == 10) {
            if (strlen($referralPhone) == 16) {
                if (strlen($phone) == 16) {
                    if (
                        empty($this->request->getPost('name')) || empty($email) || empty($phone) ||
                        empty($patientDOB) || empty($patientHeight) ||
                        empty($patientWeight) || empty($this->request->getPost('diagnosis')) || empty($this->request->getPost('referralName')) ||
                        empty($referralPhone) ||  empty($this->request->getPost('orderNotes'))
                    ) {
                        $response['error'] = 2;
                        $response['msg'] = 'Por favor introduzca todos los datos correctamente';
                    } else {
                        if (empty($resultCheckEmailDuplicate)) {
                            if (empty($resultPhoneDuplicate)) {
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
                                        'date' => date('m-d-Y h:i A'),
                                    ];

                                    $result = $objMainModel->objCreate('requests', $insertData);

                                    if ($result['error'] == 0) {
                                        $response['id'] = $result['id'];
                                        $emailData = array();
                                        $emailData['title'] = 'Verify your Email';
                                        $emailData['token'] = $token;
                                        $emailData['url'] = base_url('Home/confirmEmail') . '/' . $token;

                                        $objEmail = \Config\Services::email();
                                        $objEmail->setFrom('info@makingmemorieshh.com', 'Making Memories Home Health');
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
                                $response['error'] = 7;
                                $response['msg'] = 'number exist.';
                            }
                        } else {
                            $response['error'] = 4;
                            $response['msg'] = 'email exist.';
                        }
                    }
                } else {
                    $response['error'] = 8;
                    $response['msg'] = 'number invalid.';
                }
            } else {
                $response['error'] = 9;
                $response['msg'] = 'referral phone Number invalid.';
            }
        } else {
            $response['error'] = 10;
            $response['msg'] = 'invalid patient dob';
        }


        return json_encode($response);
    }

    public function resendVerifyEmail()
    {

        $objMainModel = new MainModel();

        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');

        if (
            empty($this->request->getPost('name')) || empty($email) || empty($phone) ||
            empty($this->request->getPost('patientDOB')) || empty($this->request->getPost('patientHeight')) ||
            empty($this->request->getPost('patientWeight')) || empty($this->request->getPost('diagnosis')) || empty($this->request->getPost('referralName')) ||
            empty($this->request->getPost('referralPhone')) ||  empty($this->request->getPost('orderNotes'))
        ) {
            $response['error'] = 2;
            $response['msg'] = 'incomplete fields';
        } else {

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $token = md5(uniqid());

                //INSERTAR EN LA TABLA (REQUESTS) LOS DATOS DE LA COMPRA PARA MOSTRARLOS EN LA TABLA PEDIDOS
                $insertData = [
                    'token' => $token,
                ];

                $result = $objMainModel->objUpdateToken('requests', $insertData, $email);

                if ($result['error'] == 0) {
                    $response['id'] = $result['id'];
                    $emailData = array();
                    $emailData['title'] = 'Verify your Email';
                    $emailData['token'] = $token;
                    $emailData['url'] = base_url('Home/confirmEmail') . '/' . $token;

                    $objEmail = \Config\Services::email();
                    $objEmail->setFrom('info@makingmemorieshh.com', 'Making Memories Home Health');
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

            $result = $objMainModel->uploadFile('requests', $id, 'document', $_FILES['file']);


            if ($result['error'] == 0) {
                $response['error'] = 0;

            } if ($result['error'] == 1){
                $response['error'] = 1;
                $response['msg'] = 'Failed to upload document to server';

            } if ($result['error'] == 2){
                $response['error'] = 2;
                $response['msg'] = 'corrupt file';
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

            return view('successVerify', $data = array('id' => $result[0]->id));
        } else
            return view('tokenExpired');
    }

    public function sendInfo()
    {
        $id = $this->request->getPost('id');
        $result = $this->objMainModel->objDataByID('requests', $id);
        $decodedFile = $result[0]->document;

        $emailData = array();
        $emailData['title'] = 'Patient Referral';
        $emailData['name'] = $result[0]->name;
        $emailData['email'] = $result[0]->email;
        $emailData['phone'] = $result[0]->phone;
        $emailData['patientDOB'] = $result[0]->patientDOB;
        $emailData['patientHeight'] = $result[0]->patientHeight;
        $emailData['patientWeight'] = $result[0]->patientWeight;
        $emailData['diagnosis'] = $result[0]->diagnosis;
        $emailData['referralName'] = $result[0]->referralName;
        $emailData['referralPhone'] = $result[0]->referralPhone;
        $emailData['orderNotes'] = $result[0]->orderNotes;
        $emailData['document'] = $result[0]->document;


        $objEmail = \Config\Services::email();
        $objEmail->setFrom('info@makingmemorieshh.com', 'Making Memories Home Health');
        $objEmail->setTo('alejandro23dev@gmail.com');
        $objEmail->setSubject('Patient Referral');
        $objEmail->setMessage(view('email/sendInfo', $emailData));
        $objEmail->attach($decodedFile, 'attachment', 'file.pdf', 'application/pdf');

        if ($objEmail->send(false)) {
            $response['error'] = 0;
            $response['msg'] = 'success send mail.';
        } else {
            $response['error'] = 1;
            $response['msg'] = 'error send email';
        }
        return json_encode($response);
    }

    public function showModalChatOnline()
    {
        $data = array();
        $data['role'] = '2';
        $data['user'] = 'Guest';
        $data['messages'] = $this->objMainModel->objDataChats();

        return view('modals/chat', $data);
    }

    public function getMessages()
    {
        $data = $this->objMainModel->objDataChats();

        $currentDateTime = date('d-m-Y h:i A');

        $result = $this->objMainModel->objDeleteByTime('chats', $currentDateTime);


        return json_encode($data);
    }

    public function sendMessages()
    {
        $objMainModel = new MainModel();

        $message = $this->request->getPost('message');
        $role = $this->request->getPost('role');
        $user = $this->request->getPost('user');

        if (empty($message)) {
            $response['error'] = 2;
            $response['msg'] = 'empty msg';
        } else {
            if ($role == 1) {
                $insertData = [
                    'user' => $user,
                    'message' => $message,
                    'role' => $role,
                    'date' => date('h:i A'),
                    'response' => 'admin',
                    'dateClose' => date('d-m-Y h:i A', strtotime('+24 Hours')),

                ];
            } else {
                $insertData = [
                    'user' => $user,
                    'message' => $message,
                    'role' => $role,
                    'date' => date('h:i A'),
                    'dateClose' => date('d-m-Y h:i A', strtotime('+24 Hours')),

                ];
            }


            $result = $objMainModel->objCreate('chats', $insertData);

            if ($result['error'] == 0) {
                $response['error'] = 0;
                $response['msg'] = 'success send';
            } else {
                $response['error'] = 1;
                $response['msg'] = 'error send';
            }
        }

        return json_encode($response);
    }
}
