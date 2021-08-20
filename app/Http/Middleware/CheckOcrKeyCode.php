<?php

namespace Vanguard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckOcrKeyCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user()->role->name == 'Admin') return $next($request);

        // Perform action
        $validCompany = Auth::user()->company->where('expire_date', '>=', date('Y-m-d'))->first();

        if( $validCompany ){
			
			if(empty($validCompany->key)){
                $response = [
                    'response' => 'Error',
                    'message' => 'You need to purchase Key Code',
                ];
        
                return redirect('ocr/invalid')->with(['error_notify' => 'You need to purchase Key Code']);
            }                
            else
                return $next($request);
        }
        else{
            $response = [
                'response' => 'Error',
                'message' => 'You need to purchase Key Code',
            ];
    
            return redirect('ocr/invalid')->with(['error_notify' => 'You need to purchase Key Code']);
        }
    }
}
