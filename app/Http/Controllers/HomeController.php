<?php

namespace App\Http\Controllers;

use Base\Sitemap; 
use App\Helpers\ApiHelper; 

class HomeController extends Controller
{

    public function welcome() 
    {
        return $this->view('welcome');
    }

    public function home() 
    {
        $this->guard('CheckAuth');
        return $this->view('home');
    }

    public function sitemapUpdate() 
    {
        try{
            $sitemap = new Sitemap;
            $sitemap->rewriteXml(['items']);
            echo ApiHelper::success();
        }
        catch (\Exception $e) {
            echo ApiHelper::fail($e->getMessage());
        }
    }

    public function error() 
    {
        $this->abort(404);
    }

}