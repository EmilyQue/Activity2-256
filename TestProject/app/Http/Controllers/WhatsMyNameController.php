<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsMyNameController extends Controller
{
    //
    public function index(Request $request) {
        //Display the Form Data
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
//          echo "Your name is: " . $firstName . " " . $lastName;
//          echo '<br>';
        
        //Usage of path method
        $path = $request->path();
        echo 'Path Method: ' . $path;
        echo '<br>';
        
        //Usage of is method
        $method = $request->isMethod('get') ? "GET" : "POST";
        echo 'GET or POST method: ' . $method;
        echo '<br>';
        
        //Usage of url method
        $url = $request->url();
        echo 'URL method: ' . $url;
        echo '<br>';
        
        //Render a response View and pass the Form Data to it
        $data = ['firstName' => $firstName, 'lastName' => $lastName];
        return view('thatswhoiam')->with($data);
   
    }
}
