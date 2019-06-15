<?php
/**
 * Created by PhpStorm.
 * User: xfh
 * Date: 2019-06-06
 * Time: 12:18
 */
class Db
{
    public function query()
    {
        return 'query';
    }

}
class Paginate
{
    public function page()
    {
        return 'page';
    }
}

class Vcode
{
    public function code()
    {
        return 'code';
    }
}

class Controller
{
    /*public function index()
    {
        $db = new Db();
        $page = new Paginate();
        $code = new Vcode();

        echo $db->query().$page->page().$code->code();
    }*/
    private $db;
    private $page;
    private $code;
    public function __construct($db, $page, $code) {
        $this->db = $db;
        $this->page = $page;
        $this->code = $code;
    }
    public function index()
    {
        echo $this->db->query().$this->page->page().$this->code->code();
    }
}
$db = new Db();
$page = new Paginate();
$code = new Vcode();
(new Controller($db, $page, $code))->index();