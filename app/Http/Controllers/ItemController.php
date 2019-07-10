<?php

namespace App\Http\Controllers;

use Base\Request; 
use App\Models\Item; 

class ItemController extends Controller
{

    public function __construct() {
        $this->guard('CheckAuth');
        $this->item = new Item; 
    }

    public function index() 
    {
        $items = $this->item->getItems();
        return $this->view('items.index', compact('items'));
    }

    public function error() 
    {
        $this->abort(404);
    }

}