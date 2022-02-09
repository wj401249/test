<?php
declare(strict_types = 1);
namespace practice\Controllers;

use Phalcon\Security\JWT\Builder;
use Phalcon\Security\JWT\Signer\Hmac;
use Phalcon\Security\JWT\Token\Parser;
use Phalcon\Security\JWT\Validator;
use practice\Models\Users;
use practice\Validations\RegisterValidation;
use Phalcon\Flash\Session;

class UserController extends BaseController
{
    public function indexAction()
    {
        $headers = $this->assets->collection("headers");
        $headers->addCss('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', false);
        $this->cookies->useEncryption(false);
        if ($this->cookies->has('login')) {
            $phone = $this->cookies->get("login");
            $this->view->setVar('phone', $phone);
            $user = Users::findFirst("phone = {$phone}");
            $this->view->setVar('user', $user);
        }
        else {
            echo "error";
        }
    }

    public function loginPageAction()
    {
        $headers = $this->assets->collection("headers");
        $headers->addCss('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', false);
        $this->view->pick("Index/login");
    }

    public function loginAction()
    {
        $phone = $this->request->getPost("phone");
        $password = $this->request->getPost("password", 'trim');

        $user = Users::findFirst([
            'conditions' => 'phone = :phone:',
            'bind' => ['phone' => $phone]
        ]);

        if ($user) {
            // Defaults to 'sha512'
            $signer  = new Hmac();

// Builder object
            $builder = new Builder($signer);

            $now        = new \DateTimeImmutable();
            $issued     = $now->getTimestamp();
            $notBefore  = $now->modify('-1 minute')->getTimestamp();
            $expires    = $now->modify('+1 day')->getTimestamp();
            $passphrase = 'QcMpZ&b&mo3TPsPk668J6QH8JA$&U&m2';

// Setup
            $builder
                ->setAudience('https://target.phalcon.io')  // aud
                ->setContentType('application/json')        // cty - header
                ->setExpirationTime($expires)               // exp
                ->setId('abcd123456789')                    // JTI id
                ->setIssuedAt($issued)                      // iat
                ->setIssuer('https://phalcon.io')           // iss
                ->setNotBefore($notBefore)                  // nbf
                ->setSubject('my subject for this claim')   // sub
                ->setPassphrase($passphrase)                // password
            ;

// Phalcon\Security\JWT\Token\Token object
            $tokenObject = $builder->getToken();

            echo $tokenObject->getToken();
            $this->response->setJsonContent(['code' => 200, 'message' => 'login success', 'content' => $tokenObject->getToken()])->send();

            /*$check = $this->security->checkHash($password, $user->password);
            if ($check === true) {
                $this->cookies->useEncryption(false);
                $this->cookies->set('login', $user->phone, time()+86400);
                $this->response->setJsonContent(['code' => 200, 'message' => 'login success'])->send();
            }
            else {
                var_dump('b');
                $this->response->setJsonContent(['code' => 400, 'message' => 'login fail'])->send();
            }*/
        }
        else {
            var_dump('c');
            $this->response->setJsonContent(['code' => 401, 'message' => 'login fail'])->send();
        }
        die();
    }

    public function testAction()
    {
        $tokenReceived = $this->request->get('token');
        $audience      = 'https://target.phalcon.io';
        $now           = new \DateTimeImmutable();
        $issued        = $now->getTimestamp();
        $notBefore     = $now->modify('-1 minute')->getTimestamp();
        $expires       = $now->getTimestamp();
        $id            = 'abcd123456789';
        $issuer        = 'https://phalcon.io';

// Defaults to 'sha512'
        $signer     = new Hmac();
        $passphrase = 'QcMpZ&b&mo3TPsPk668J6QH8JA$&U&m2';

// Parse the token
        $parser      = new Parser();

// Phalcon\Security\JWT\Token\Token object
        $tokenObject = $parser->parse($tokenReceived);

// Phalcon\Security\JWT\Validator object
        $validator = new Validator($tokenObject, 100); // allow for a time shift of 100

// Throw exceptions if those do not validate
        echo "<pre>";
        var_dump($tokenObject);
        $a = $tokenObject->getPayload();
        foreach($a as $k => $v) {
            echo "{$k}=> {$v}";
        }
        var_dump($a);
        echo "</pre>";
    }

    public function storeAction()
    {
        $post = $this->request->getPost();
        $validation = (new RegisterValidation())->validateData();
        $message = $validation->validate($post);
        $output = ['code' => 200, 'message'=> 'success'];

        if(count($message) > 0) {
            foreach ($message as $v) {
                $output['message'] .= $v."|";
            }
            $output['code'] = 500;
            $this->response->setJsonContent($output)->send();exit();
        }

        $user = new Users();
        try {
            unset($post['confirm_password']);
            $post['password'] = $this->security->hash($post['password']);
            $re = $user->assign($post)->create();
            if(!$re) {
                $output['code'] = 400;
                $output['message'] = 'fail';
            }
        }
        catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        $this->response->setJsonContent($output)->send();exit();
    }

    public function showAction(int $id)
    {
        $user = Users::findFirst($id);
        $this->view->setVar("user", $user);
    }

    public function editAction(int $id)
    {
        $headers = $this->assets->collection("headers");
        $headers->addCss('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', false);
        $user = Users::findFirst($id);
        $this->view->setVar("user", $user);
        $this->view->pick('User/edit');
    }

    public function registerPageAction()
    {
        $headers = $this->assets->collection("headers");
        $headers->addCss('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', false);
        $this->flashSession->error('test');
        $this->view->pick('User/register');
    }

    public function registerAction()
    {
        $post = $this->request->getPost();
        $validation = (new RegisterValidation())->validateData();
        $message = $validation->validate($post);
        $message_str = '';

        if(count($message) > 0) {
            foreach ($message as $v) {
                $message_str .= $v."|";
            }
            $this->flashSession->error($message_str);
            return $this->response->redirect('User/registerPage');
        }

        $user = new Users();
        try {
            unset($post['confirm_password']);
            $post['password'] = $this->security->hash($post['password']);
            $re = $user->assign($post)->create();
            if(!$re) {
                $this->flashSession->error('注册失败');
                $this->response->redirect('User/registerPage');
            }
        }
        catch (\Exception $e) {
            $this->flashSession->error($e->getMessage());
            $this->response->redirect('User/registerPage');
        }
        $this->cookies->set('login', $user->phone, time()+86400);
        $this->response->redirect('User/index');
    }

    public function updateAction()
    {

    }

}
