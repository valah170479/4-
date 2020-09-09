<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Section;

use App\User;


class SectionsController extends Controller
{
    public function execute(){

 $users = User::with('section')
                   ->get();



    	if(view()->exists('site.section')){
    		
      $sections = Section::paginate(4);
     
			$data = [
					'title'=>'Все отделы',
					'sections'=> $sections
					];
         
       return view('site.section', $data);
    }

   }  
}
