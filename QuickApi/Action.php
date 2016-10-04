<?php

class QuickApi_Action implements Widget_Interface_Do
{

    public function execute()
    {
        //Do nothing
    }

    public function action()
    {
        header('Content-Type: application/json');
        if (!isset($_POST['act'])) {

            $this->show_welcome();
            return;
        }

        $this->https(200);
        $act = trim($_POST['act']);
        switch ($act) {
            case 'get_contents':
                $this->act_get_contents();
                break;
            case 'get_contents_count':
                $this->act_get_contents_count();
                break;
            case 'get_categories':
                $this->act_get_categories();
                break;
            case 'get_category_by_cid':
                $this->act_get_category_by_cid();
                break;
            case 'get_cids_by_mid':
                $this->act_get_cids_by_mid();
                break;
            case 'get_brief_contents':
                $this->act_get_brief_contents();
                break;
            default:
                $this->show_unknown();
        }
    }
    //当无命令时显示
    private function show_welcome()
    {
        $msg = array('status' => 200, 'message' =>
                'Welcome to use QuickApi for Typecho. Powered by Meloduet.');
        echo json_encode($msg);
        var_dump($_GET);
    }
    //当遇到未知命令时显示
    private function show_unknown()
    {
        $this->https(404);
        $msg = array('status' => -404, 'message' => 'Invalid action.');
        echo json_encode($msg);
    }
    /**
     * 显示错误, 并终止
     * 
     */
    private function show_error($code, $message,$head=200)
    {
        $this->https($head);
        $msg = array('status' => $code, 'message' => $message);
        echo json_encode($msg);
        exit();
    }
    /**
     * 获取Contents
     *
     * @return string json
     */
    private function act_get_contents()
    {
        $offset = 0;
        $limit = 10;

        if (isset($_POST['offset']) && is_numeric($_POST['offset']))
            $offset = (int)$_POST['offset'];
        else
            $this->show_error(-600, "offset is not set",404);


        if (isset($_POST['limit']) && is_numeric($_POST['limit']))
            $limit = (int)$_POST['limit'];
        else
            $this->show_error(-600, "limit is not set",404);


        $helper = new QuickApi_Helper_Content();
        $result = $helper->getContents($offset, $limit);
        echo json_encode($result);
    }
    
    private function act_get_brief_contents()
    {
        $offset = 0;
        $limit = 10;

        if (isset($_POST['offset']) && is_numeric($_POST['offset']))
            $offset = (int)$_POST['offset'];
        else
            $this->show_error(-600, "offset is not set",404);


        if (isset($_POST['limit']) && is_numeric($_POST['limit']))
            $limit = (int)$_POST['limit'];
        else
            $this->show_error(-600, "limit is not set",404);


        $helper = new QuickApi_Helper_Content();
        $result = $helper->getBriefContents($offset, $limit);
        echo json_encode($result);
    }

    /**
     * 获取Contents总数
     *  
     * @return string json
     */
    private function act_get_contents_count()
    {
        $helper = new QuickApi_Helper_Content();
        $result = $helper->getContentsCount();
        echo json_encode($result);
    }

    private function act_get_categories()
    {
        $helper = new QuickApi_Helper_Category();
        $result = $helper->getCategories();
        echo json_encode($result);
    }

    private function act_get_cids_by_mid()
    {
        $mid = 1;
        if (isset($_POST['mid']) && is_numeric($_POST['mid']))
            $mid = (int)$_POST['mid'];
        else
            $this->show_error(-602, "mid is not set",404);
        $helper = new QuickApi_Helper_Category();
        $result = $helper->getCidsByMid($mid);
        echo json_encode($result);
    }

    private function act_get_category_by_cid()
    {
        $cid = 1;
        if (isset($_POST['cid']) && is_numeric($_POST['cid']))
            $cid = (int)$_POST['cid'];
        else
            $this->show_error(-603, "cid is not set",404);
        $helper = new QuickApi_Helper_Category();
        $result = $helper->getCategoryByCid($cid);
        if($result==false)
            $this->show_error(-604, "cid doesn't belong to any category",404);
        echo json_encode($result);
    }
    private function https($num)
    {
        $http = array(
            100 => "HTTP/1.1 100 Continue",
            101 => "HTTP/1.1 101 Switching Protocols",
            200 => "HTTP/1.1 200 OK",
            201 => "HTTP/1.1 201 Created",
            202 => "HTTP/1.1 202 Accepted",
            203 => "HTTP/1.1 203 Non-Authoritative Information",
            204 => "HTTP/1.1 204 No Content",
            205 => "HTTP/1.1 205 Reset Content",
            206 => "HTTP/1.1 206 Partial Content",
            300 => "HTTP/1.1 300 Multiple Choices",
            301 => "HTTP/1.1 301 Moved Permanently",
            302 => "HTTP/1.1 302 Found",
            303 => "HTTP/1.1 303 See Other",
            304 => "HTTP/1.1 304 Not Modified",
            305 => "HTTP/1.1 305 Use Proxy",
            307 => "HTTP/1.1 307 Temporary Redirect",
            400 => "HTTP/1.1 400 Bad Request",
            401 => "HTTP/1.1 401 Unauthorized",
            402 => "HTTP/1.1 402 Payment Required",
            403 => "HTTP/1.1 403 Forbidden",
            404 => "HTTP/1.1 404 Not Found",
            405 => "HTTP/1.1 405 Method Not Allowed",
            406 => "HTTP/1.1 406 Not Acceptable",
            407 => "HTTP/1.1 407 Proxy Authentication Required",
            408 => "HTTP/1.1 408 Request Time-out",
            409 => "HTTP/1.1 409 Conflict",
            410 => "HTTP/1.1 410 Gone",
            411 => "HTTP/1.1 411 Length Required",
            412 => "HTTP/1.1 412 Precondition Failed",
            413 => "HTTP/1.1 413 Request Entity Too Large",
            414 => "HTTP/1.1 414 Request-URI Too Large",
            415 => "HTTP/1.1 415 Unsupported Media Type",
            416 => "HTTP/1.1 416 Requested range not satisfiable",
            417 => "HTTP/1.1 417 Expectation Failed",
            500 => "HTTP/1.1 500 Internal Server Error",
            501 => "HTTP/1.1 501 Not Implemented",
            502 => "HTTP/1.1 502 Bad Gateway",
            503 => "HTTP/1.1 503 Service Unavailable",
            504 => "HTTP/1.1 504 Gateway Time-out");
        header($http[$num]);
    }
}
