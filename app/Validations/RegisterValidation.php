<?php
declare(strict_types = 1);
namespace practice\Validations;

use Phalcon\Validation;

class RegisterValidation
{
    public function validateData() : Validation
    {
        $validation = new Validation();
        $validation->add(
            ['phone', 'password'],
            new Validation\Validator\PresenceOf([
                'message' => [
                    'phone' => '请填写手机号',
                    'password' => '请填写密码'
                ]
            ])
        );
        $validation->add(
            'email',
            new Validation\Validator\Email([
                'message' => '邮箱格式错误'
            ])
        );
        $validation->add(
            'password',
            new Validation\Validator\Confirmation([
                'message' => ['password' => '两次密码不一致'],
                'with' => ['password' => 'confirm_password']
            ])
        );

        return $validation;
    }
}