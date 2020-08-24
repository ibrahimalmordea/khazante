<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\products;
use App\Stores;
use App\categories;
use App\sub_categories;
use App\User;

class productController extends Controller
{
         
    //get all product in table
    public function Product(Request $request)
    {
        
        $Sub_Categories = Sub_Categories::all();
        $Categories = Categories::all();
        $Stores = Stores::all();
        $Product = products::all();
        $User = User::all();
        $store = Stores::where('useridfk', Auth::user()->id)->first();
        if (Auth::user()->type == '1')
        {
            return view('Product.Product', compact('Product','Sub_Categories','Categories','User','store'));
        }else
        {
            return view('home');
        }
        
    }

    public function getProduct(Request $request)
    {
        $subcategories = sub_categories::where('Category', $request->get('categories'))->get();
        return $subcategories;
    }

    //to get all product in cards
    public function view_all_product(Request $request)
    {
        $Sub_Categories = Sub_Categories::all();
        $Categories = Categories::all();
        $Product = products::all();
        $store = Stores::where('useridfk', Auth::user()->id)->first();
        $Product2 = products::where('storeidfk', $request->get('id'))->get();
        return view('Product.view_all_product', compact('Product','Sub_Categories','Categories','store','Product2'));
    }

    //for more details 
    public function view_product(Request $request)
    {
        $Product = products::find($request->get('id'));
        return view('Product.view_product', compact('Product'));
    }

    //add new product
    public function AddNewProduct(Request $request)
    {
        $Product = new products();
        $Stores = Stores::find($request->get('id'));

        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move('images', $imageName);
        $Image= '/images/'.$imageName;

        $Product->image = $Image;
        $Product->price = $request->input('price'); 
        $Product->name = $request->input('name'); 
        $Product->details = $request->input('details'); 
        $Product->size = $request->input('size'); 
        $Product->color = $request->input('color'); 
        $Product->categories = $request->input('categories'); 
        $Product->subcategories = $request->input('sub_categories'); 
        $Product->storeidfk =  $Stores->id;

        $Product->save();

        return redirect('product')->with('success', 'Product Added successfully');  
    }

    //delete product
    public function delete_Product(Request $request)
    {
        $Product = products::find($request->get('id'))->delete();
        return redirect()->back()->with('error', 'products deleted successfully');
    }

    //open edit page and get the data
    public function edit_Product(Request $request)
    {
        $Product = products::find($request->get('id'));
        $Sub_Categories = Sub_Categories::where('Category', $Product->categories)->get();
        $Categories = Categories::all();
        $User = User::all();
        if (Auth::user()->type == '1')
        {
            return view('product.edit_Product', compact('User','Product','Sub_Categories','Categories'));
        }else
        {
            return view('home');
        }
        
    }   

    //function for save the edit
    public function submit_edit_Product(Request $request)
    {      
        $Product = products::find($request->get('id'));
        $Stores = Stores::find($request->get('id'));

        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move('images', $imageName);
        $Image= '/images/'.$imageName;

        $Product->image = $Image;
        $Product->price = $request->input('price'); 
        $Product->name = $request->input('name'); 
        $Product->details = $request->input('details'); 
        $Product->size = $request->input('size'); 
        $Product->color = $request->input('color'); 
        $Product->categories = $request->input('categories'); 
        $Product->subcategories = $request->input('sub_categories'); 

        $Product->save();

        return redirect('product')->with('success', 'Product Editing successfully'); 
    }
}
