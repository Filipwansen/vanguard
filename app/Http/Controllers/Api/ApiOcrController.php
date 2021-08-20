<?php

namespace Vanguard\Http\Controllers\Api;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Vanguard\Companies;
use Vanguard\User;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use GuzzleHttp\Client;
use Auth;

class ApiOcrController extends Controller
{
    //OCR engine API link
    // Protected $ocrEngineApi = 'http://localhost/spelling/server.php';
    Protected $ocrEngineApi = 'http://0.0.0.0:4000/detection';

    public function __construct(){

        // $this->ocrEngineApi = url('api/ocr');
    }

    //api for the ocr
    function api_ocr_process(Request $request){

        $validator = Validator::make($request->all(), [ 
            'key' => 'required|string|exists:companies,key',
            'img' => 'mimes:jpeg,jpg,png|required|max:10000',
    	]);

    	if ( $validator->fails() )
            return response()->json(['error' => [
                            'message'     => 'Invalid Param: '.$validator->messages()->first(),
                            'status_code' => 403
                        ]
            ], 403);

        //key check
        $companyKey = User::find(Auth::user()->id)->company->key;

        if($companyKey != $request->key)
            return response()->json(['error' => [
                'message'     => 'Invalid Key code',
                'status'      => 'Invalid key for this user',
                'status_code' => 403
                ]
            ], 403);
        
        //expire check
        $expiredKey = Auth::user()->company->where('expire_date', '<', date('Y-m-d'))->exists();
        if($expiredKey)
            return response()->json(['error' => [
                'message'     => 'Invalid Key code',
                'status'      => 'Expired Key, need to purchase new key',
                'status_code' => 403
                ]
            ], 403);       

        $companyName = User::find(Auth::user()->id)->company->name;

        try{
            $file = $request->file('img');

            $imagedata = base64_encode(file_get_contents($file));

            $ext = $file->getClientOriginalExtension();
            $template_path = public_path('upload/templates/').$companyName;            

            //Get the tempalte lists
                $lists = []; $cnt = 0;
                $files = \File::files($template_path);
                foreach($files as $file){
                    array_push($lists, json_decode(trim(file_get_contents($file))) );
                    $cnt++;
                }
            $template_json = ["cnt" => $cnt, 'lists' => $lists];
            
            $data = [
                    'company_user' => $companyName, 
                    'template_json'=> $template_json,
                    'ext'          => $ext,
                    'image'        => $imagedata
                    ];
            
            // $json = an encoded JSON string
            $header = 'data:application/json;base64,';
            // $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
            $base64Data = base64_encode(json_encode($data));
            $_data = $header.$base64Data;

            //fetch the data from OCR engine API
            $client = new Client();
            // $params['headers'] = ['Content-Type' => 'application/json', 'Authorization' => 'Bear token'];
            // $params['form_params'] = array('username' => 'killer', 'password' => '123456', 'lang' => 'es');
            $params['form_params'] = ['video'=>$_data, 'image_file'=>''];
            $response = $client->post($this->ocrEngineApi, $params);
            
            return response()->json([
                'response'=>'success', 
                'content' => json_decode($response->getBody())
               ], 200);
            
        }
        catch(\Exeption $e){

            return response()->json([
                    'response'=>'error', 
                    'content' => $e->getMessage()
                   ], 200);
        }

    } 
    
    //test API #############################################################################
    function api_ocr_test_process(Request $request){
        
        $validator = Validator::make($request->all(), [ 
            'img' => 'mimes:jpeg,jpg,png|required|max:10000',
    	]);
        
    	if ( $validator->fails() )
            return response()->json(['error' => [
                            'message'     => 'Invalid Param: '.$validator->messages()->first(),
                            'status_code' => 403
                        ]
            ], 403);
        
        //key check
        $companyKey = User::find(Auth::user()->id)->company->key;
		
		dd($request->img);

        //expire check
        $expiredKey = Auth::user()->company->where('expire_date', '<', date('Y-m-d'))->exists();
        if($expiredKey)
            return response()->json(['error' => [
                'message'     => 'Invalid Key code',
                'status'      => 'Expired Key, need to purchase new key',
                'status_code' => 403
                ]
            ], 403);       

        $companyName = User::find(Auth::user()->id)->company->name;

        try{
            $file = $request->file('img');

            $imagedata = base64_encode(file_get_contents($file));
            $ext = $file->getClientOriginalExtension();
            $template_path = public_path('upload/templates/').$companyName;            

            //Get the tempalte lists
                $lists = []; $cnt = 0;
                $files = \File::files($template_path);
                foreach($files as $file){
                    array_push($lists, json_decode(trim(file_get_contents($file))) );
                    $cnt++;
                }
            $template_json = ["cnt" => $cnt, 'lists' => $lists];
            
            $data = [
                    'company_user' => $companyName, 
                    'template_json'=> $template_json,
                    'ext'          => $ext,
                    'image'        => $imagedata
                    ];
            
            // $json = an encoded JSON string
            $header = 'data:application/json;base64,';
            // $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
            $base64Data = base64_encode(json_encode($data));
            $_data = $header.$base64Data;

            //fetch the data from OCR engine API
            $client = new Client();
            // $params['headers'] = ['Content-Type' => 'application/json', 'Authorization' => 'Bear token'];
            // $params['form_params'] = array('username' => 'killer', 'password' => '123456', 'lang' => 'es');
            $params['form_params'] = ['video'=>$_data, 'image_file'=>''];
            $response = $client->post($this->ocrEngineApi, $params);
            
            return response()->json([
                'response'=>'success', 
                'content' => json_decode($response->getBody())
               ], 200);
            
        }
        catch(\Exeption $e){

            return response()->json([
                    'response'=>'error', 
                    'content' => $e->getMessage()
                   ], 200);
        }
    }
}
