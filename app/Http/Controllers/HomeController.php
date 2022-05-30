<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RandomWord;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $randomWords =  RandomWord::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('home',compact("randomWords"));
    }

    function generateRandomAlphabetWords(Request $request) {

        $type = $request->random_words;
        $quantity = $request->quantity;
        
        if($type == 'alphabet'){
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }else if($type == 'numerical'){
            $characters = '0123456789';
        }else if($type == 'both'){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        $charactersLength = strlen($characters);

        $randomWord ='';
        if($quantity > 0){
            for($j = 0; $j < $quantity; $j++){
                $randomWord ='';
                for($i = 0; $i < 5; $i++){
                    $randomWord .= $characters[rand(0, $charactersLength-1)];
                }

                //Insert Enter to table for Random Word
                RandomWord::create(
                    array(
                        "name" => $request->name,
                        "word" => $randomWord,
                        "user_id" =>Auth::user()->id
                    )
                );
            }

            return redirect()->back()->with('doneMessage', "Random Words Saved Successfully!");
        }
        return redirect()->back()->with('errorMessage', "There is not data to insert!");
    }
}
