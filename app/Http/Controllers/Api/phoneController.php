<?php

namespace App\Http\Controllers\Api;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Controllers\phone;
use App\Models\phones;
use Illuminate\Http\Request;
use App\Http\Resources\PhoneResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class phoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $phones = Phones::all();
        return response()->jason([ PhoneResource::collection($phones)]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(),[
            'phone' => ['required','digits:11','regex:/^(012|010|011)/',
            Rule::unique('phones')->where(function ($query) {
                return $query->whereNull('deleted_at');}) ]
           
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $phones = phones::create([
            'phone' => $request->phone,
            'user_id' => Auth::id()
         ]);
        
        return response()->json(['Phone created successfully.', new phoneResource($phones)]);



        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\phones  $phones
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $phone = phones::find($id);
        if (is_null($phone)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new phoneResource($phone)]);

        //
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\phones  $phones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,phones $phone)
    {
        //authorization
        $this->authorize('update',$phone);
     
        //validation
      
            $validator = Validator::make($request->all(),[
                'phone' => ['required','digits:11','regex:/^(012|010|011)/',
                Rule::unique('phones')->where(function ($query) {
                    return $query->whereNull('deleted_at');})->ignore($phone->id) ]
               
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors());       
            }

        
            //update

          $phone->update(["phone" =>$request->phone]);
       
       
        return response()->json(['Phone updated successfully.',new PhoneResource($phone)]);



        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\phones  $phones
     * @return \Illuminate\Http\Response
     */
    public function destroy(phones $phone)
    {
       // authorzation
        $this->authorize('update',$phone); 
        $phone->delete();
        return 'deleted done';
    }
}
