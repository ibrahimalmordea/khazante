<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Stores;
use App\User;
use App\products;

class StoreController extends Controller
{
    //get all stores
    public function store()
    {
        $store = stores::all();
        $user = User::all();
        $Product = products::all();
        if (Auth::user()->type == '0')
        {
            return view('store.store', compact('Product','store','user'));
        }
        return view('home');
    }

    //add new stores
    public function AddNewstore(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name'); 
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        $user->password = Hash::make($request['password']);
        $user->save();

        $store = new Stores();
        $store->phone = $request->input('phone');
        $store->location = $request->input('location');
        $store->useridfk =  $user->id;
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);


        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move('images', $imageName);
        $Image= '/images/'.$imageName;

        $storedis = $request->input('text');
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $dom->loadHtml($storedis, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            Storage::disk('public')->put($image_name, $data);
            $image_name= '/images/'.$image_name;
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);

        }
        
        $store->image = $Image;
        $store->description = $request->input('text');
        $store->save();

        return redirect('store')->with('success', 'Store Added successfully');    
    }

    //delete the stores
    public function delete_store(Request $request)
    {
        Stores::find($request->get('id'))->delete();
        User::find($request->get('useridfk'))->delete();
        return redirect('store')->with('error', 'store deleted successfully');
    }
 
    //open edit page and get the data
    public function edit_store(Request $request)
    {
       $store = Stores::find($request->get('id'));
       $user = User::find($request->get('useridfk'));
       return view('store.edit_store', compact('store','user'));
    } 

    public function edit_profile_store(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $store = Stores::where('useridfk', Auth::user()->id)->first();
        
        return view ('store.edit_profile_store' , compact('store','user'));
    } 

    //function for save the edit
    public function submit_edit_store(Request $request)
    {
        $user = User::find($request->get('ids'));
        $user->name = $request->input('name'); 
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        $user->save();

        $store = Stores::where('useridfk', $request->get('ids'))->first();
        $store->phone = $request->input('phone');
        $store->location = $request->input('location');
        $store->useridfk =  $user->id;
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);


        if(isset(request()->image)){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move('images', $imageName);
            $Image= '/images/'.$imageName;
            
            $store->image = $Image;
        }
        $storedis = $request->input('text');
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $dom->loadHtml($storedis, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            Storage::disk('public')->put($image_name, $data);
            $image_name= '/images/'.$image_name;
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);

        }
        $store->description = $request->input('text');
        $store->save(); 

        return redirect('store')->with('success', 'Store Editing successfully');   
    }



}
