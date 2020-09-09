<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\User;
use Auth;
use DB;
use Validator;

class SectionsEditController extends Controller
{
    //

     public function execute(User $user,Section $section,Request $request) {



       /*$user = User::find(Auth::user()->id);
       $sections = $user->section;*/
      
$users = User::with('section')
                   ->get();

        if ($request->isMethod('delete')) {
        	$section->delete();
        	return redirect('section')->with('status','Отдел удален');
        }



		if($request->isMethod('post')) {
          $input = $request->except('_token');
        if(isset($input['user_id'])){

   
            $input['user_id'] = implode(" ; ", $_POST['user_id']);

         } else {
               $input['user_id'] = $input['old_user_id'];
              
            }
			unset($input['old_user_id']);
			
			$validator = Validator::make($input,[
			
				
                'name' => 'required|max:255',
                'description' => 'max:255',
            
			]);
			
			if($validator->fails()) {
				return redirect()
						->route('sectionsEdit',['section'=>$input['id']])
						->withErrors($validator);
			}
			
			if($request->hasFile('logo')) {
				$file = $request->file('logo');
				$file->move(public_path().'/storage/logo',$file->getClientOriginalName());
				$input['logo'] = $file->getClientOriginalName();
			}
			else {
				$input['logo'] = $input['old_logo'];
			}

			
			unset($input['old_logo']);
			
			$section->fill($input);

			if($section->update()) {
				return redirect('section')->with('status','Работа обновлена');
			}
			
		}
 
        $items = User::with('section')
                   ->get();

		$old = $section->toArray();
		if(view()->exists('site.section_edit')) {

			$data = [
					'title' => 'Редактирование Отдела - '.$old['name'],
					'data' => $old,
					'items' => $items,

					];
			return view('site.section_edit',$data);		
			
		}
		
	}
}

