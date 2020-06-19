<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
      return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
      //Varidationを行う指示
      $this->validate($request, Profile::$rules);
      
      $profile = new Profile;
      $form = $request->all();
      
      //フォームから送られてきた_token削除指示
      unset($form['_token']);
      
      //データベース保存指示
      $profile->fill($form);
      $profile->save();
      
      
      return redirect('admin/profile/create');
    }
    
    public function edit()
    {
      return view('admin.profile.edit');
    }
    
    public function update(Request $request)
    {
      return redirect('admin/profile/edit');
    }
}
