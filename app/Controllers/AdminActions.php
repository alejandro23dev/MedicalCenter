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

    //SECCION DE PRODUCTOS
    public function products()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');


        $objMainModel = new MainModel;

        $data = array();
        $data['page'] = 'admin/products';
        $data['adminData']  = $this->objSessionAdmin->get('admin');
        $data['products'] = $objMainModel->objData('productos');
        $data['categories'] = $objMainModel->objData('category');
        $data['countCategories'] = sizeof($data['categories']);

        return view('header/admin', $data);
    }

    public function create()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $name = $this->request->getPost('name');

        $objMainModel = new MainModel;
        $resultCheckDuplicate = $objMainModel->checkDuplicate('productos', 'name', $name);

        if (empty($resultCheckDuplicate)) {

            $data = array();
            $data['name'] = $name;
            $data['price'] = $this->request->getPost('price');
            $data['fkcategory'] = $this->request->getPost('category');
            $data['quantity'] = $this->request->getPost('quantityProducts');
            $data['info'] = $this->request->getPost('info');

            $result = $objMainModel->objCreate('productos', $data);

            if ($result['error'] == 0) {

                $response['error'] = 0;
                $response['id'] = $result['id'];
                $response['code'] = 0;
                $response['msg'] = 'success';
            } else {

                $response['error'] = 1;
                $response['msg'] = 'error on create record';
            }
        } else {

            $response['error'] = 1;
            $response['msg'] = 'error duplicate record';
        }

        return json_encode($response);
    }

    public function showModalProduct()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel();

        $data = array();
        $data['action'] = $this->request->getPost('action');
        $data['categories'] = $objMainModel->getData('category');
        $data['countCategories'] = sizeof($data['categories']);

        if ($data['action'] == 'create')
            $data['title'] = 'Nuevo Producto';
        elseif ($data['action'] == 'update') {
            $data['product'] = $objMainModel->getProductData($this->request->getPost('productID'));
            $data['title'] = 'Actualizando ' . $data['product'][0]->name;
        }

        return view('modals/product', $data);
    } // OK

    public function update()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $table = 'productos';
        $field = 'name';

        $id = $this->request->getPost('productID');

        $value = $this->request->getPost('name');
        $objMainModel = new MainModel;
        $resultCheckProductDuplicate = $objMainModel->checkDuplicate($table, $field, $value, $id);

        if (empty($resultCheckProductDuplicate)) {
            $data = array();
            $data['name'] = $value;
            $data['fkCategory'] = $this->request->getPost('category');
            $data['price'] = $this->request->getPost('price');
            $data['quantity'] = $this->request->getPost('quantityProducts');
            $data['info'] = $this->request->getPost('info');


            $result = $objMainModel->objUpdate($table, $data, $id);

            if ($result['error'] == 0) {
                $response['error'] = 0;
                $response['id'] = $result['id'];
                $response['msg'] = 'Producto Actualizado';
            } else {
                $response['error'] = 1;
                $response['msg'] = 'Ha ocurrido un error en el proceso';
            }
        } else {
            $response['error'] = 1;
            $response['msg'] = 'Ya existe el producto';
        }

        return json_encode($response);
    }

    public function updateCat()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $table = 'category';
        $field = 'name';
        $value = $this->request->getPost('categoryName');
        $id = $this->request->getPost('categoryID');

        $objMainModel = new MainModel;
        $resultCheckProductDuplicate = $objMainModel->checkDuplicate($table, $field, $value, $id);

        if (empty($resultCheckProductDuplicate)) {
            $data = array();
            $data['name'] = $value;

            $result = $objMainModel->objUpdate($table, $data, $id);

            if ($result['error'] == 0) {
                $response['error'] = 0;
                $response['id'] = $result['id'];
                $response['msg'] = 'Categoría Actualizado';
            } else {
                $response['error'] = 1;
                $response['msg'] = 'Ha ocurrido un error en el proceso';
            }
        } else {
            $response['error'] = 1;
            $response['msg'] = 'Ya existe la categoría';
        }

        return json_encode($response);
    }

    public function deleteProduct()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $id = $this->request->getPost('productID');

        $objMainModel = new MainModel;
        $result = $objMainModel->objDelete('productos', $id);

        if ($result == true) {
            $response['error'] = 0;
            $response['msg'] = 'Producto Eliminado';
        } else {
            $response['error'] = 1;
            $response['msg'] = 'Ha ocurrido un error en el proceso';
        }

        return json_encode($response);
    }

    public function deleteCat()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $id = $this->request->getPost('categoryID');

        $objMainModel = new MainModel;
        $result = $objMainModel->objDelete('category', $id);

        if ($result == true) {
            $response['error'] = 0;
            $response['msg'] = 'Categoría Eliminada';
        } else {
            $response['error'] = 1;
            $response['msg'] = 'Ha ocurrido un error en el proceso';
        }

        return json_encode($response);
    }

    public function createCat()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $table = 'category';
        $objMainModel = new MainModel;
        $categoryName = $this->request->getPost('categoryName');
        $resultCheckDuplicate = $objMainModel->checkDuplicate($table, 'name', $categoryName);

        if (empty($resultCheckDuplicate)) {

            $data = array();
            $data['name'] = $categoryName;

            $result = $objMainModel->objCreate('category', $data);

            if ($result['error'] == 0) {
                $response['error'] = 0;
                $response['msg'] = 'Categoría Creada';
            } else {
                $response['error'] = 1;
                $response['msg'] = 'Ha ocurrido un error';
            }
        } else {

            $response['error'] = 1;
            $response['msg'] = 'Ya existe la categoría';
        }

        return json_encode($response);
    } // OK



    public function showModalCat()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $data = array();
        $data['action'] = $this->request->getPost('action');

        if ($data['action'] == 'create') // CREATE
            $data['title'] = 'Nueva Categoría de Producto';
        elseif ($data['action'] == 'update') {
            $objMainModel = new MainModel;
            $data['category'] = $objMainModel->getCatData($this->request->getPost('categoryID'));
            $data['title'] = 'Editando Categoría ' . $data['category'][0]->name;
        }

        return view('modals/category', $data);
    } // OK

    public function uploadPhoto()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $id = $_POST['id'];
        $objMainModel = new MainModel;
        $result = $objMainModel->uploadFile('productos', $id, 'image', $_FILES['file']);


        if ($result['error'] == 0) {
            $response['error'] = 0;
        } else {
            $response['error'] = 1;
            $response['msg'] = 'No se ha podido subir la imagen al servidor';
        }

        return json_encode($response);
    }

    //SECCION DE PEDIDOS

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
            $col['request'] = $requests[$i]->request;
            $col['date'] = $requests[$i]->date;
            $col['dateClose'] = $requests[$i]->dateClose;
            $col['country'] = $requests[$i]->country;
            $col['province'] = $requests[$i]->province;
            $col['municipality'] = $requests[$i]->municipality;
            $col['distribution'] = $requests[$i]->distribution;
            $col['address'] = $requests[$i]->address;
            $col['totalPrice'] = $requests[$i]->totalPrice;
            $col['info'] = $requests[$i]->info;

            $result = $objMainModel->objDataByID('clients', $requests[$i]->client);
            if (!empty($result[0]->user)) {
                $col['client'] = $result[0]->user;
                $col['email'] = $result[0]->email;
            } else{
                $col['client'] = '<span class="text-danger bg-black rounded">Usuario Eliminado</span>';
                $col['email'] = '';
            }



            $row[$i] = $col;
        }

        $data['requests'] = $row;


        $current_datetime = time(); // Obtener el timestamp actual

        for ($i = 0; $i < count($requests); $i++) {
            $request_datetime = strtotime($requests[$i]->dateClose); // Obtener el timestamp Unix del campo dateClose
            $request_date = date('d-m-Y H:i', $request_datetime); // Obtener la fecha del pedido en formato de cadena

            if ($request_date < date('d-m-Y H:i') || $request_datetime === $current_datetime) {
                $objMainModel = new MainModel;

                $requestID = $requests[$i]->id;

                $data['jsonResponse'][$i]['error'] = 7; // Respuesta de error
                $data['jsonResponse'][$i]['msg'] = 'Pedido no realizado';

                $infoRequestsUpdate = $this->request->getPost('infoRequestsUpdate');



                // Actualizar el campo info en la base de datos
                $objMainModel->updateRequestInfo($requestID, $infoRequestsUpdate);
            }
        }

        return view('header/admin', $data);
    }

    public function drivers()
    {

        # VERIFY SESSION
        if (empty($this->objSessionAdmin->get('admin')['role']))
            return view('logoutAdmin');

        $objMainModel = new MainModel;

        $data = array();
        $data['adminData']  = $this->objSessionAdmin->get('admin');
        $data['page'] = 'admin/drivers';
        $drivers = $objMainModel->objData('drivers');


        $row = array();
        for ($i = 0; $i < count($drivers); $i++) {

            $col['id'] = $drivers[$i]->id;
            $col['image'] = '';
            $col['name'] = $drivers[$i]->name;
            $col['phoneNumber'] = $drivers[$i]->phoneNumber;

            $result = $objMainModel->objData('drivers');

            $col['requestID'] = $result[0]->id;

            $row[$i] = $col;
        }

        $data['drivers'] = $row;

        return view('header/admin', $data);
    }
}
