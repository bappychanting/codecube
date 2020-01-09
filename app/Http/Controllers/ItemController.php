<?php

namespace App\Http\Controllers;

use Base\Request; 
use Base\Authenticable; 
use App\Models\Item; 

class ItemController extends Controller
{

    private $item;
    private $request;

    public function __construct() {
        $this->guard('CheckAuth');
        $this->item = new Item;
        $this->request = new Request;  
    }

    public function index() 
    {
        $auth_user = Authenticable::getAuth(); 
        $this->item->setUser($auth_user->id);
        $items = $this->item->getItems();
        return $this->view('items.index', compact('items'));
    }

    public function create() 
    {
        $auth_user = Authenticable::getAuth(); 
        return $this->view('items.create', compact('auth_user'));
    }

    public function store() 
    {
        $store = $this->item->setData($_POST)->validateData()->storeItem();
        if($store){
            $this->request->destroy('post');
            $this->request->setFlash(['success' => locale('message', 'success')]);
            $this->redirect('items/show', ['id' => $this->item->getLastId()]);
        }
        else{
            $this->redirect(back());
        }
    }

    public function show() 
    {
        $item = $this->item->setData($_GET)->getItem();
        return $this->view('items.show', compact('item'));  
    }

    public function edit() 
    {
        $item = $this->item->setData($_GET)->getItem();
        return $this->view('items.edit', compact('item'));  
    }

    public function update() 
    {
        $update = $this->item->setData($_POST)->validateData()->updateItem();
        if($update){
            $this->request->destroy('post');
            $this->request->setFlash(['success' => locale('message', 'success')]);
            $this->redirect('items/show', ['id' => $_POST['id']]);
        }
        else{
            $this->redirect(back());
        }
    }

    public function delete() 
    { 
        $delete = $this->item->setData($_POST)->deleteItem();
        if($delete){
            $this->request->setFlash(['success' => locale('message', 'success')]);
            $this->redirect('items/all');
        }
        else{
            $this->request->setFlash(['danger' => locale('message', 'danger')]);
            $this->redirect(back());
        }  
    }

}