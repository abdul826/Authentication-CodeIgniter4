<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\Hash;

class Auth extends BaseController
{

     // Enabling features
     public function __construct()
     {
         helper(['url', 'form']);
     }

    public function index()
    {
       return view("auth/login");
    }

    public function register()
    {
       return view("auth/register");
       
    }

    // Register User
    public function registerUser()
    {
        $validated = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Your full name is required', 
                ]
            ],
            'email'=> [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your email is required', 
                    'valid_email' => 'Email is already used.',
                ]
            ],
            'password'=> [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required', 
                    'min_length' => 'Password must be 5 charectars long',
                    'max_length' => 'Password cannot be longer than 20 charectars'
                ]
            ],
            'confirmpassword'=> [
                'rules' => 'required|min_length[5]|max_length[20]|matches[password]',
                'errors' => [
                    'required' => 'Your confirm password is required', 
                    'min_length' => 'Password must be 5 charectars long',
                    'max_length' => 'Password cannot be longer than 20 charectars',
                    'matches' => 'Confirm password must match the password',
                ]
            ],
        ]);

        if(!$validated)
        {
            return view('auth/register', ['validation' => $this->validator]);
        }

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmpassword = $this->request->getPost('confirmpassword');

        $data = [
            "name"=> $name,
            "email"=> $email,
            "password"=> Hash::encrypt($password)
        ];

        $userModel = new UserModel();

        $query = $userModel->insert($data);

        if(!$query){
            return redirect()->back()->with("fail",'User Not Registered');
        }else{
            return redirect()->back()->with("success",'User Registered Successfully');
        }
    
    }

    // Login User
    public function loginUser()
      {
        // Validating user input.


        $validated = $this->validate([
            'email'=> [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your email is required', 
                    'valid_email' => 'Email is already used.',
                ]
            ],
            'password'=> [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required', 
                    'min_length' => 'Password must be 5 charectars long',
                    'max_length' => 'Password cannot be longer than 20 charectars'
                ]
            ],
        ]);



        if(!$validated)
        {
            return view('auth/login', ['validation' => $this->validator]);
        }
        else
        {
            // Checking user details in database.


            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');


            $userModel = new UserModel();
            $userInfo = $userModel->where('email', $email)->first();

            $checkPassword = Hash::check($password, $userInfo['password']);

            // if(!$checkPassword)
            // {
            //     session()->setFlashdata('fail', 'Incorrect password provided');
            //     return redirect()->to('auth');
            // }
            // else
            // {
                // Process user info.


                $userId = $userInfo['id'];


                session()->set('loggedInUser', $userId);
                return redirect()->to('/dashboard');


            }
        //}
      }

    /**
       * Upload user image.
       */
      public function uploadImage()
      {
        try
        {
           
            $loggedInUserId = session()->get('loggedInUser');
            $config['upload_path'] = getcwd().'/images';
            $imageName = $this->request->getFile('userImage')->getName();
  
            // if Directory not present then create.
  
            if(!is_dir( $config['upload_path']))
            {
                mkdir( $config['upload_path'], 0777 );
            }
  
            // Get image.
  
            $img = $this->request->getFile('userImage');  // form se jo image upload ho rahe hai us ko access kr rahe hai  
              
            if(!$img->hasMoved() && $loggedInUserId)
            {
                
                $img->move($config['upload_path'], $imageName);
  
                $data = [
                    'avatar' => $imageName,
                ];
  
                $userModel = new UserModel();
                $userModel->update($loggedInUserId, $data);
  
                return redirect()->to('dashboard/index')->with('notification',
                  'Image uploaded successfully'
              );
  
            }
            else
            {
              return redirect()->to('dashboard')->with('notification',
              'Image uploaded failed');
            }
  
  
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
      }

      public function logout(){
        if(session()->has('loogedInUser')){
            session()->remove('loogedInUser');
        }
        return redirect()->to('/auth?access=loggedout')->with('fail','You are loggedOut');
      }
}
