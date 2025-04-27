<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sidebarcontroller extends Controller
{

    public function button(){
        return view('page.boards.createTontine');
    }
    public function cards(){
        return view('page.boards.cards');
    }
    public function tirages(){
        return view('page.boards.tirages');
    }
    public function border(){
        return view('page.boards.border');
    }
    public function animation(){
        return view('page.boards.animation');
    }
    public function other(){
        return view('page.boards.other');
    }
    public function Notfound(){
        return view('page.boards.404');
    }

    public function charts(){
        return view('page.boards.charts');
    }
    public function tables(){
        return view('page.boards.tables');
    }

    }

