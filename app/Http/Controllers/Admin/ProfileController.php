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
      
      $profiles = new Profile;
      $form = $request->all();
      
      //フォームから送られてきた_token削除指示
      unset($form['_token']);
      
      //データベース保存指示
      $profiles->fill($form);
      $profiles->save();
      
      
      return redirect('admin/profile/create');
    }
    
    public function edit(Request $request)
    {
      $profiles = Profile::find($request->id);
      return view('admin.profile.edit', ['profiles_form'=> $profiles]);
    }
    
    public function update(Request $request)
    {
      $this->validate($request, Profile::$rules);
      $profiles = Profile::find($request->id);
      $profiles_form = $request->all();
      unset($profiles_form['_token']);
      $profiles->fill($profiles_form)->save();
      return redirect('admin/profile/edit?id='.$request->id);
    }
}
