<?php
declare(strict_types = 1);
namespace practice\Controllers;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return "hello world";
    }
}