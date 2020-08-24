<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sub_Categories;
use Illuminate\Support\Facades\Auth;
use App\Categories;
use App\User;

class Sub_CategoriesController extends Controller
{
    //get all Sub_Categories
    public function Sub_Categories()
    {
        $Sub_Categories = Sub_Categories::all();
        $Categories = Categories::all();
        $Categories = Categories::all();
        $User = User::all();
        if (Auth::user()->type == '0')
        {
        return view('user.Sub_Categories', compact('Sub_Categories','Categories'));
        }
        return view('home');
    }

    //add new Sub_Categories
    public function AddNewSub_Categories(Request $request)
    {
        $Sub_Categories = new Sub_Categories();
        $Sub_Categories->name = $request->input('name'); 
        $Sub_Categories->Category = $request->input('Categories'); 
        $Sub_Categories->save();

        return redirect()->back()->with('success', 'Sub_Categories Added successfully');    
    }

    //delete the sub_categories
    public function delete_Sub_Categories(Request $request)
    {
        Sub_Categories::find($request->get('id'))->delete();
        return redirect()->back()->with('error', 'Sub_Categories deleted successfully');
    }

    //open edit page and get the data
    public function edit_Sub_Categories(Request $request)
    {
        $Sub_Categories = Sub_Categories::find($request->get('id'));
        $Categories = Categories::all();
        $User = User::all();
        if (Auth::user()->type == '0')
        {
        return view('user.Edit_Sub_Categories', compact('Sub_Categories','Categories'));
        }
        return view('home');
    }   

     //function for save the edit
    public function submit_edit_Sub_Categories(Request $request)
    {
        $Sub_Categories = Sub_Categories::find($request->get('id'));
        $Sub_Categories->name = $request->input('name'); 
        $Sub_Categories->Category = $request->input('Categories'); 
        $Sub_Categories->save();

        return redirect('Sub_Categories')->with('success', 'Sub_Categories edit successfully');    
    }

}
