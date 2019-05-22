<?php

namespace App\Http\Controllers;

use App\Models\Website\Blog;
use App\Models\Website\Content; 
use App\Models\Website\Gallery; 
use App\Models\Advanced\Notice; 
use App\Models\Website\BlogCategory;

class HomeController extends Controller
{

    private $blog; 
    private $content; 
    private $notice; 
    private $gallery; 
    private $category;

    public function __construct() {
        $this->blog = new Blog; 
        $this->notice = new Notice;
        $this->content = new Content;
        $this->gallery = new Gallery;
        $this->category = new BlogCategory; 
    }

    public function welcome() 
    {
        return $this->view('welcome');
    }

    public function error() 
    {
        $this->abort(404);
    }

}