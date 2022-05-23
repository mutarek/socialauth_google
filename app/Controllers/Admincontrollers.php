<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Adminmodels;
use Google_Client;
use Google_Service;

class Admincontrollers extends Controller
{
    public function __construct() {
        helper('form');
    }
    public function login()
    {
        $data = [];
        require_once APPPATH. 'libraries/vendor/autoload.php';
        $client = new Google_Client();
$client->setClientId('160811839710-v3c1enlg9t1h5e1annfhea4i0kjcb96u.apps.googleusercontent.com');
        $client->setClientSecret('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');
        $client->setRedirectUri(base_url('/Admincontrollers/login/'));
        $client->addScope('email');
        $client->addScope('profile');

        if($this->request->getVar('code'))
        {
            $token = $client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
            if(!isset($token['error']))
            {
                $client->setAccessToken($token['access_token']);
                session()->set('access_token',$token['access_token']);
                $google_service = new \Google_Service_Oauth2($client);
                $gdata = $google_service->userinfo->get();
                $model = new Adminmodels();
                if($model->google_user_exist($gdata['id']))
                {
                    $userdata = [
                        'first_name'=>$gdata['given_name'],
                        'last_name'=>$gdata['family_name'],
                        'email'=>$gdata['email'],
                        'profile_pic'=>$gdata['picture'],
                    ];
                    if($model->updateGoogleUser($userdata,$gdata['id']))
                    {
                        echo "Updated";
                    }
                    else{
                        echo "wrong";
                    }
                }
                else
                {
                    $userdata = [
                        'oauth_id'=>$gdata['id'],
                        'first_name'=>$gdata['given_name'],
                        'last_name'=>$gdata['family_name'],
                        'email'=>$gdata['email'],
                        'profile_pic'=>$gdata['picture'],
                    ];
                   if( $model->createUser($userdata)){
                       echo "Successfully inserted";
                   }
                   else
                   {
                       echo 'insert wrong';
                   }

                }
            }
        }
        if(!session()->get('access_token'))
        {
            $data['loginButton'] = $client->createAuthUrl();
        }
        return view('login',$data);
    }

    public function createaccount()
    {
        if($this->request->getMethod() =="post")
        {
            $data = [
                'name'=>$this->request->getVar('name'),
                'email'=>$this->request->getVar('email'),
                'pass'=>password_hash($this->request->getVar('psw'),PASSWORD_DEFAULT)
            ];
            $admin = new Adminmodels();
            if($admin->insertData($data)){
                echo 'inserted';
            }
            else
            {
                echo "wrong";
            }
        }
        return view('signup');
    }
}