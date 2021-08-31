<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\restaurant;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;


class RestoController extends Controller
{
    //
    function index()
    {
        return view('home');
    }
    function list()
    {
        $data= restaurant::all();
        return view('list',["data"=>$data]);
    }
    function add(Request $req)
    {    
        $resto = new restaurant;
        $resto->name = $req->input('name');
        $resto->email = $req->input('email');
        $resto->address = $req->input('address');
        $resto->save();
        $req->session()->flash('status','Resturant enter successfully');
        return redirect('list');
        //return $req->input();
    }

    function delete($id)
    {
        restaurant::find($id)->delete();
        session()->flash('status','Resturant deleted successfully');
        return redirect('list');

    }

    function edit($id)
    {
        $data= restaurant::find($id);
        return view('edit',['data'=>$data]);
    }

    function update(Request $req)    
    {
        $resto = restaurant::find($req->id);
        $resto->name = $req->input('name');
        $resto->email = $req->input('email');
        $resto->address = $req->input('address');
        $resto->save();
        $req->session()->flash('status','Resturant updated successfully');
        return redirect('list');
        $resto->name = $req->input('name');
        $resto->email = $req->input('email');
        $resto->address = $req->input('address');
        $resto->save();
        $req->session()->flash('status','Resturant enter successfully');
        return redirect('list');
    }

    function register(Request $req)
    {
      //return $req->input();
       $user = new User;
       $user->name = $req->input('name');
       $user->email = $req->input('email');
       $user->password = Crypt::encrypt($req->input('password'));
       $user->contact = $req->input('contact');
       $user->save();
       $req->session()->put('user',$req->input('name'));
       return redirect('/');

    }
    function login(Request $req)
    {
       $user = User::where('email',$req->input('email'))->get();
     if(Crypt::decrypt($user[0]->password) == $req->input('password'))
        {
          $req->session()->put('user',$user[0]->name);
          return redirect('/');
      }
       else{
                   return "hello";
        }

    }

    function logout()
    {
        Session()->forget('user');
        return redirect('/');
    }
}
