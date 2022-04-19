<?php
class Controladora
{
    var $entry;
    var $dirs;
    var $page;
    public function __construct($params, $dirs)
    {
        $this->dirs = $dirs;
        $this->entry = $params;
        $this->init();
    }

    public function get_pages()
    {
        $removes = array(".php", ".html", "/");
        $the_path = explode($this->dirs->project, $_SERVER["REQUEST_URI"])[1];
        $the_Page = mb_strtolower(str_replace($removes, "", $the_path), "utf-8");
        //If Page Empty OR Init
        if ($the_Page == "") return $this->get_default_page();
        //If Page not Empty
        if ($the_Page != "") return $this->get_default_page();
    }

    public function get_default_page()
    {
        return "ranking";
    }

    public function init()
    {
        $this->page = $this->get_pages();
        return $this->visualizar();
    }

    public function visualizar()
    {
        return $this->dirs->path . "templates/" . $this->page . "/" . $this->page;
    }
}
