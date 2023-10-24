<?php

namespace App\Controllers;
use App\Models\UserModel;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

    public function index()
    {
        
        $userModel = new UserModel();
        $loggedInUser = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUser);

        $data = [
            "title"=> "Dashboard",
            "userInfo" => $userInfo,
        ];

        return view('dashboard/index', $data);
    }
}
