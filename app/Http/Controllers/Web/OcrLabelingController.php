<?php

namespace Vanguard\Http\Controllers\web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\template\UpdateTemplateRequest;
use Vanguard\Templates;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Session;
use Auth;
use Vanguard\User;

class OcrLabelingController extends Controller
{
    //
    function index(Request $request){         

        session_start(); 
        $_SESSION['ocrlabeling'] = json_encode(['user_name'    => Auth::user()->username, 
                                                'company_name' => empty(Auth::user()->company->name) ? "" : Auth::user()->company->name,
                                                'upload_url'   => url('ocrupload')
                                                ]);
    	return view('ocr.index');
    }

    function invalid_ocr(){
        return view('ocr.invalid');
    }

    //
    function api_checker(Request $request){

        // $validator = Validator::make($request->all(), [ 
        //     'file_name'     => 'required|string',
        //     'user_name'     => 'required|string|exists:users,username',
        //     'data'          => 'required|string'
    	// ]);
    }

    function ocr_upload(Request $request){

        $validator = Validator::make($request->all(), [ 
            'file_name'     => 'required|string',
            'user_name'     => 'required|string|exists:users,username',
            'data'          => 'required|string'
    	]);

    	if ( $validator->fails() )
            return response()->json([
                    'response'=>'error', 
                    'content' => $validator->messages()->first()
                ], 200);
        
        try{
            // Write File
            $newJsonString = json_encode(json_decode($request->data), JSON_PRETTY_PRINT);
            $companyName = User::find(Auth::user()->id)->company->name;
            
            $res = file_put_contents(public_path('upload/templates/'.$companyName.'/'.$request->file_name), stripslashes($newJsonString));
            Templates::create([
                'user_id'       => Auth::user()->id,
                'template_name' => $request->file_name,
                'description'   => $request->description
            ]);
        }
        catch(\Exeption $e){

            return response()->json([
                    'response'=>'error', 
                    'content' => $e->getMessage()
                   ], 200);
        }

        //download link
        // $file_path = base_path('public/upload/templates/'.$request->file_name);
        // $headers = array(
        //     'Content-Type: json',
        //     'Content-Disposition: attachment; filename='.$request->file_name,
        // );
        // if ( file_exists( $file_path ) ) {
        //     // Send Download
        //     $res = \Response::download( $file_path, $request->file_name, $headers );
        // } else {
        //     // Error
        //     return response()->json([
        //         'response'=>'error', 
        //         'content' => 'file not exists on server!'
        //     ], 200);
        // }

        return response()->json([
            'response'=>'success', 
            'content' => $request->file_name
           ], 200);
    }

    //
    function template_index(Request $request){
        $templates = Templates::all();
        return view('ocr/template_index', ['templates'=>$templates]);
    }

    //
    function perform($id, $slug){

        $template = Templates::find($id);
    	if ( !$template )
            return redirect('template')->with(['error_notify' => 'Invalid Template ID: '.$id]);
        
        switch($slug){           

            case 'edit':
                return view('ocr/template_edit', ['template'=>$template]); break;

            default: 
                return back()->with(['error_notify' => 'Invalid Action Type: '.$slug]); break;
        }
    }

    //
    function update_post_template(UpdateTemplateRequest $request, $id){

        $template = Templates::find($id);
        if(!$template) return back()->with(['error_notify' => 'Invalid Template ID: '.$id]);
        if(!Str::contains($request->template_name, '.json')) return back()->with(['error_notify' => 'File Name must be *.json']);        
        
        try{
            
            $companyName = User::find($template->user_id)->company->name;

            /* Existing File name */
            $filePath = public_path('upload/templates').'/'.$companyName.'/'.$template->template_name;
            
            /* New File name */
            $newFileName = public_path('upload/templates').'/'.$companyName.'/'.$request->template_name;
            
            /* Rename File name */
            if( !rename($filePath, $newFileName) ) {  
                return back()->with(['error_notify' => 'File not found or Cannot change the name.']);
            }  
            else {  

                $template->template_name = $request->template_name;
                $template->description = $request->description;
                $template->save();                
            } 

            
        }
        catch(\Exception $e){

            return back()->with(['error_notify' => $e->getMessage()]);
        }

		return back()->withSuccess(__('Successfully Updated Template ID: '.$id));  
    }

    //
    function download($id){
        
        $template = Templates::find($id);
    	if ( empty($template) )
            return back()->with(['error_notify' => 'Invalid Template ID: '.$id]);        

        $filename = $template->template_name;
        $companyName = User::find($template->user_id)->company->name;

        // Check if file exists in public/upload/templates folder
        $file_path = public_path('upload/templates').'/'.$companyName.'/'.$filename;
        if (file_exists($file_path))
        {
            // Send Download
            return \Response::download($file_path, $filename, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

    //
    function delete_template($id){
        $template = Templates::find($id);
    	if ( !$template ) return redirect('template')->with(['error_notify' => 'Invalid Company ID: '.$id]);
        
        try{
            $companyName = User::find($template->user_id)->company->name;             
            \File::delete(public_path('upload/templates').'/'.$companyName.'/'.$template->template_name);
            $template->delete();
        }
        catch(\Exception $e){            
            return redirect('template')->with(['error_notify' => $e->getMessage()]);
        }

        return redirect('template')->withSuccess(__('Successfully Removed template: "'.$template->template_name.'"'));
    }

    //API how to
    function api_howto(Request $request){        
        return view('ocr.api-index');
    }

    function api_test(Request $request){

        $user = Auth::user();
        // $token = $user->createToken($request->device_name)->plainTextToken;
        $token = $user->createToken('device1')->plainTextToken;
        $bearer_token = explode('|', $token)[1];

        return view('ocr.api-test', ['token'=>$bearer_token]);
    }
   

}
