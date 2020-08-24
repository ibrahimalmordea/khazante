<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Categories;
use App\User;

class CategoriesController extends Controller
{
    //get all Categories in table
    public function Categories()
    {
        $Categories = Categories::all();
        $User = User::all();
        if (Auth::user()->type == '0')
        {
            return view('user.Categories', compact('Categories'));
        }else
        {
            return view('home');
        }
    }

    //add new Categories
    public function AddNewCategories(Request $request)
    {
        $Categories = new Categories();
        $Categories->name = $request->input('name'); 
        $Categories->save();

        return redirect()->back()->with('success', 'Category Added successfully');    
    }

    //delete the categories
    public function delete_Categories(Request $request)
    {
        Categories::find($request->get('id'))->delete();
        return redirect()->back()->with('error', 'Category deleted successfully');
    }

    //open edit page and get the data
    public function edit_Categories(Request $request)
    {
        $Categories = Categories::find($request->get('id'));
        $User = User::all();
        if (Auth::user()->type == '0')
        {
            return view('user.edit_Categories', compact('Categories'));
        }else
        {
            return view('home');
        }
    }   

    //function for save the edit
    public function submit_edit_Categories(Request $request)
    {
        $Categories = Categories::find($request->get('id'));
        $Categories->name = $request->input('name'); 
        $Categories->save();
        return redirect('Categories')->with('success', 'Category edit successfully');
    }

}
