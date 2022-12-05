<?php

namespace App\Controllers;

use App\core\Controller;
use App\core\Request;
use App\Models\RegisterModel;

class AuthController extends Controller
{

    public function login()
    {
        // echo 'u here';
        $this->setLayout('Auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();

        print_r($registerModel);


        print_r($request->getBody());

        if ($request->is_post()) {
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->register()) {
                return 'Succuss';
            }

            return $this->render('register', ['model' => $registerModel]);
        }


        $this->setLayout('Auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
}
