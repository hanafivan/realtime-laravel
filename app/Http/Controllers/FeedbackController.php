<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //
    public function store(Requst $request){
        $words -> $request get('words');
        if (strpos($word,"") !== false){
            return response() -> json([
                "message" : "tidak boleh ada tanda kosong",
            ], 400);
        }
        $words = explode($words, "");
        if (count($words) > 3){
            return response() ->json([
                "message": "tidak boleh lebih dari 3",
            ], 400)
        }
        foreach ($words as $keys => $word){
            this->createOrIncrement($word);
        }
        return response() -> json("ok");
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function dashboardData(){
        return response() -> json($this->getData());
    }

    protected function createOrIncrement(String$word){
        // jadikan lowercase
        $word = strtolower($word);
        $feedback = Feedback::where('word', $word)->first();
        
        if ($feedback){
            $feedback->increment('count');
        } else {
            Feedback::create([
                "word" => $word,
                "count" => 1,
            ]);
        }
    }
}
