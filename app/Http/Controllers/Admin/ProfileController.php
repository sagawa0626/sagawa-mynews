<?php

namespace News\Http\Controllers\Admin;

use Illuminate\Http\Request;
use News\Http\Controllers\Controller;
use News\Profile;
use News\ProfileHistory;
use Carbon\carbon;

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
    
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        return view('admin.profile.edit', ['profile_form'=> $profile]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        unset($profile_form['_token']);
        $profile->fill($profile_form)->save();
        $ProfileHistory = new ProfileHistory;
        $ProfileHistory->profile_id = $profile->id;
        $ProfileHistory->edited_at = Carbon::now();
        $ProfileHistory->save();
        return redirect('admin/profile/edit?id='.$request->id);
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Profile::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのプロフィールを取得する
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
  
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $profile = Profile::find($request->id);
        // 削除する
        $profile->delete();
        return redirect('admin/profile/');
    }
}
