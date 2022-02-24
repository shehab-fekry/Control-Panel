<?php

namespace App\Http\Controllers\API;

use App\Models\Child;
use App\Models\Father;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FatherResource;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Trip;

class FatherController extends BaseController
{


    public function show()
    {

        $id=Auth::guard("api-fathers")->id();
        $father=Father::where("id",$id)->get();


        return $this->sendResponse(FatherResource::collection($father),'fathers retrived successfully');


    }



    public function update(Request $request,)
    {
        $id=Auth::guard('api-fathers')->id();
        $father=Father::get()->find($id);

        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required','string', 'max:30',],
            'mobileNumber'=>['required',],
            'region' => ['required','string',],
            'lng' => ['required','numeric'],
            'lit' => ['required','numeric'],
            'email' => ['required','string', 'email', 'max:255',Rule::unique('fathers')->ignore($id),],

        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }
        $father->name=$input['name'];
        $father->email=$input['email'];
        $father->mobileNumber=$input['mobileNumber'];
        $father->region=$input['region'];
        $father->lng=$input['lng'];
        $father->lit=$input['lit'];
        $father->save();



        return $this-> sendResponse(new fatherResource($father),'father information updated successfully');
    }
    public function showTrip(){
        $id=Auth::guard('api-fathers')->id();
        $father=Father::get()->find($id);
        $trip=Trip::get()->find($father->trip_id);
        if($father->confirmed==false){
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($father->trip_id==null){

            return $this->sendError('please validate errors','your account do not assigned to any trip yet please contact with one of school admins');
        }elseif($father->status==0){

                 if($trip->status==0){
                      return $this->sendError('please validate errors','you do not have any child  going to school today please update your children status before the trip is start');
                    }else{
                       return $this->sendError('please validate errors','you do not have any child  going to school today and the trip is alredy started');
                    }
        }elseif($trip->status==0){
            return $this->sendError('please validate errors','the trip is not started yet');
        }else{
            if($trip->status==1){
                 return $this-> sendResponse("the trip is started and going to school",$trip->id);
            }elseif($trip->status==2){
                return $this-> sendResponse("the trip is started and arrived to school",$trip->id);
            }elseif($trip->status==3){
                return $this-> sendResponse("the trip is started and back from school",$trip->id);
            }

        }



    }


    public function destroy()
    {
        $id=Auth::guard('api-fathers')->id();
        $children=Child::where('father_id',$id)->get();
        if(count($children)>0){
          $children->delete();
        }
        Father::find($id)->delete();

        return $this-> sendResponse("you are logged out",'Account deleted successfully');
    }


}
