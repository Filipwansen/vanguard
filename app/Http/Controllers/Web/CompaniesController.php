<?php

namespace Vanguard\Http\Controllers\web;

use Illuminate\Http\Request;
use Vanguard\Http\Requests\Company\UpdateCompanyRequest;
use Vanguard\Http\Requests\Company\CompanyRequest;
use Vanguard\Http\Requests\Company\OcrKeyRequest;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Vanguard\Companies;
use Vanguard\User;
use Storage;
use File;

class CompaniesController extends Controller
{
    //company home page
    function index(){

        $companies = Companies::all();
        return view('companies.index', ['companies' => $companies]);
    }

    //Add company page
    function add_get_company(){

        return view('companies.add');
    }

    //create new company
    function add_post_company(CompanyRequest $request){

        $validator = Validator::make($request->all(), [ 
            'name'    => 'required|unique:companies|min:3|max:255',
            'cif'     => 'required|string|max:255',
            'address' => 'required|string|min:5|max:255',
    	]);

    	if ( $validator->fails() )
            return back()->with(['error_notify' => 'Invalid Param: '.$validator->messages()->first()]);
        
        try{
            $company = Companies::create([  'name'   => $request->name, 
                                            'cif'    => $request->cif, 
                                            'address'=> $request->address
                            ]);
            //Create new folder 
            $this->CreateCompanyFolder($company->name);
            if(!empty($company->id)){
                $uIDs = explode(',', $request->users);
                User::whereIn('id', $uIDs)->update(['company_id'=>$company->id]); 
            }
        }
        catch(\Exception $e){

            return back()->with(['error_notify' => $e->getMessage()]);
        }

		return redirect('company')->withSuccess(__('Successfully Created : '.$request->name.' Company'));
    }

    //Update company
    function update_post_company(UpdateCompanyRequest $request, $id){

        $company = Companies::find($id);
        if(!$company) return back()->with(['error_notify' => 'Invalid Company ID: '.$id]);

        try{
            //folder rename
            $oldPath = public_path().'/upload/templates/' . $company->name;
            $newPath = public_path().'/upload/templates/' . $request->name;
            rename($oldPath, $newPath);

            $company->name = $request->name;
            $company->cif = $request->cif;
            $company->address = $request->address;
            $company->save();

            //update user tbl with company_id
            $uIDs = explode(',', $request->users);
            User::whereIn('id', $uIDs)->update(['company_id'=>$id]);            
        }
        catch(\Exception $e){

            return back()->with(['error_notify' => $e->getMessage()]);
        }

		return back()->withSuccess(__('Successfully Updated Company ID: '.$id));    
    }

    //company perform
    function perform($id, $slug){

        $company = Companies::find($id);
    	if ( !$company )
            return redirect('company')->with(['error_notify' => 'Invalid Company ID: '.$id]);
        
        switch($slug){
            case 'view':                 
                return view('companies/view', ['company'=>$company, 'users'=>User::where('company_id', $id)->get()]); break;

            case 'edit':
                return view('companies/edit', ['company'=>$company]); break;

            default: 
                return back()->with(['error_notify' => 'Invalid Action Type: '.$slug]); break;
        }
    }

    function delete_company($id){
        $company = Companies::find($id);
    	if ( !$company ) return redirect('company')->with(['error_notify' => 'Invalid Company ID: '.$id]);
        
        try{
            //remove folder
            $this->RemoveCompnayFolder($company->name);

            User::where('company_id', $id)->update(['company_id'=>null]);
            $company->delete();
        }
        catch(\Exception $e){            
            return redirect('company')->with(['error_notify' => $e->getMessage()]);
        }

        return redirect('company')->withSuccess(__('Successfully Removed Company: "'.$company->name.'"'));
    }

    /* 
    * OCR key blade
    */
    function keygen(){
        $companies = Companies::all();
        return view('companies.ocrkey', ['companies'=>$companies]);
    }

    function save_keygen(OcrKeyRequest $request){
        $company = Companies::find($request->company_id);
        if(!$company) return back()->with(['error_notify' => 'Invalid Company ID: '.$request->company_id]);

        try{
            $company->key = $request->key;

            $company->expire_date = date('Y-m-d H:i:s', strtotime($request->expire_date.' +1 day') );
            $company->save();           
        }
        catch(\Exception $e){

            return back()->with(['error_notify' => $e->getMessage()]);
        }

		return back()->withSuccess(__('Successfully Generated Company :'.$company->name.', key: '.$company->key));
    }
    
    //Create the new folder for new companies
    function CreateCompanyFolder($companyName=""){
        if(empty($companyName)) return false;

        $path = public_path().'/upload/templates/' . $companyName;
        return File::makeDirectory($path, $mode = 0755, true, true);
    }

    function RemoveCompnayFolder($companyName=""){
        if(empty($companyName)) return false;

        return File::deleteDirectory(public_path('/upload/templates').'/'.$companyName);
    }

}
