<?php
class PageBuilder
{
    var $template;
    var $dirs;
    public function __construct($params)
    {
        $this->template = new stdClass();
        $this->dirs = $params;
        $this->init();
    }

    public function builder_page_title()
    {
        return "Rankings";
    }

    public function builder_Page_meta()
    {
        $url = $this->dirs->path . "templates/html/meta.html";
        return file_get_contents($url);
    }

    public function builder_page_links()
    {
        $url = $this->dirs->path . "templates/html/links.html";
        return file_get_contents($url);
    }

    public function builder_page_scripts()
    {
        $url = $this->dirs->path . "templates/html/scripts.html";
        return file_get_contents($url);
    }

    public function builder_page_header()
    {
        $this->template->header = array();
        $this->template->header[] = "<head>";
        $this->template->header[] = $this->builder_Page_meta();
        $this->template->header[] = "<title>" . $this->builder_page_title() . "</title>";
        $this->template->header[] = $this->builder_page_links();
        $this->template->header[] = '<link rel="stylesheet" href="./src/assets/css/' . $this->template->content->page . '/' . $this->template->content->page . '.css">';
        $this->template->header[] = $this->builder_page_scripts();
        $this->template->header[] = "</head>";
        return $this->template->header;
    }

    public function build_page_content()
    {
        require $this->dirs->path . "config/controladora.php";
        $controller = file_get_contents("php://input");
        $this->template->content = new Controladora($controller, $this->dirs);
        return $this->template;
    }

    public function init()
    {
        $this->build_page_content();
        $this->builder_page_header();
        $this->visualizar();
    }

    public function visualizar()
    {
        echo implode("", $this->template->header);
        echo "<body>";
        //Get Header Page
        echo file_get_contents($this->dirs->path . "templates/page-header/page-header2.html");
        //Get Content Page
        $page_url = $this->dirs->path . "templates/" . $this->template->content->page . "/" . $this->template->content->page;
        if (file_exists($page_url . ".html")) echo file_get_contents($page_url . ".html");
        if (file_exists($page_url . ".php")) include $page_url . ".php";
        //Get Footer Page
        echo file_get_contents($this->dirs->path . "templates/page-footer/page-footer2.html");
        echo "</body>";
    }
}
