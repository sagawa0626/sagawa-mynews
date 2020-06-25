<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\HTML;

//追記
use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        //投稿日時順に新しい方から並べるという指示を出している
        //それが$postsに代入されている
        $posts = News::all()->sortByDesc('updated_at');
        
        if (count($posts) > 0) {
            //shiftメソッドで配列の最初のデータを削除しその値を返している
            //$headline = $posts->shift();では、最新の記事を変数$headlineに代入し、
            //$postsは代入された最新の記事以外の記事が格納されていることになります。
            //なぜこんなことをしているのかというと、
            //最新の記事とそれ以外の記事とで表記を変えたいために行なっています。
            $headline = $posts->shift();
        } else {
            $headline = null;
        }
        
        // news/index.blade.php ファイルを渡している
        // また　View テンプレートに headline、posts、という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
