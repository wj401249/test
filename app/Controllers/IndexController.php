<?php
declare(strict_types = 1);

namespace practice\Controllers;

use practice\Models\Users;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->assets->addJs("https://unpkg.com/vue@next", false);
        $headerCollection = $this->assets->collection('headerJs');
        $headerCollection->addCss("https://unpkg.com/element-plus/dist/index.css", false);
        $headerCollection->addJs("https://unpkg.com/element-plus", false);
        $headerCollection->addJs("js/index.js");
        $headerCollection->addJs("https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js", false);

        $this->cookies->useEncryption(false);
        if ($this->cookies->has('login')) {
            $phone = $this->cookies->get("login");
            $this->view->setVar('phone', $phone);
            $user = Users::findFirst("phone = {$phone}");
            $this->view->setVar('user', $user);
        }
    }

    public function testAction()
    {
        $this->view->pick('Index/index');
    }
}