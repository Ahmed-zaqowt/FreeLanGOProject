<?php

namespace App\Http\Controllers\Admin\Text;

use App\Events\TextRequested;
use App\Http\Controllers\Controller;
use App\Models\TextMail;
use Illuminate\Http\Request;

class TextMailController extends Controller
{
    function index() {
     return view('admin.texts.index');
    }

    function store(Request $request)  {
       $textMail = TextMail::create([
        'text' => $request->text ,
       ]);

       TextRequested::dispatch($textMail);

       return 'تمت المهمة بنجاح';
    }
}
