<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){
        //return view('pages.index');
        $title='Index';
        return view('pages.index')->with('title',$title);
    }
    public function about(){
        $title ='About';
        return view('pages.about')->with('title',$title);
       // return view('pages.about');
    }

    public function services(){
        $data= array(
           'title' => 'Services',
            'services' => ['Computer','Network','Administration','HCM']

        );
        return view('pages.services')->with($data);
   
    }

}
