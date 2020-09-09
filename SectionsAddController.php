<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Section;
use App\User;
use Auth;
use DB;

use Validator;


class SectionsAddController extends Controller
{

    
   public function execute(User $user,Section $section,Request $request){

    	if($request->isMethod('post')){


           $input = $request->except('_token');   
 
             if(isset($input['user_id'])){

   
             $input['user_id'] = implode(" ; ", $_POST['user_id']);

         } else {
                $input['user_id'] = Auth::user()->name;
              
            }
    
    		$validator = Validator::make($input,
    		[
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'logo' => 'image',
                'user_id' => 'max:255',

    		]);

    		if($validator->fails()){

    			return redirect()->route('sectionsAdd')->withErrors($validator)->withInput();
    		}

    		if($request->hasFile('logo')) {

				$file = $request->file('logo');
        $file->move(public_path().'/storage/logo',$file->getClientOriginalName());
			
				$input['logo'] = $file->getClientOriginalName();
				
				//$file->move(public_path().'/storage/logo',$input['logo']);
			
			} else {
        $input['logo'] = 'index.jpg';
      }
     
			$section = new Section();
			
			
			//$page->unguard();
			
			$section->fill($input);
			
			if($section->save()) {
				return redirect('section')->with('status','Отдел добавлен');
			}
             
    	}

    $items = User::with('section')
                   ->get();
       
           
           if(view()->exists('site.section_add')){

           	$data = ['title' => 'Добавить отдел',
                     
                     'items' => $items,
           ];
          
            return view('site.section_add',$data);
        }
   
    abort(404);

}
}

