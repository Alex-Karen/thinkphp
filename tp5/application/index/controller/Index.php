<?php

namespace app\index\controller;

class Index
{
    public function index()
    {
        return 'PHP是世界上最好的语言';
    }

    public function demo()
    {
        dump($_SERVER);
    }

}
