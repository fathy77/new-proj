<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\phones as ControllersPhones;
use App\Models\phones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class phone extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   

        $phone = phones::all();  //phones::where('user_id',Auth::id())->get();
      //  $user=  $phone->User;
       // $name= $user->name;


        return view('artical.data',['phone'=>$phone]);
     //$phone =phones::find(auth::id());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

     return view("artical.create");

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(['phone'=>['required','digits:11','regex:/^(012|010|011)/',
        Rule::unique('phones')->where(function ($query) {
            return $query->whereNull('deleted_at');})]]);  




  

    $phone= new Phones;

$phone->create(['user_id'=>Auth::id(),'phone'=>$request->phone]);

      //$phone->user_id=Auth::id();
     // $phone->phone=$request->phone;
     //$phone->save();
     return redirect()->route('phone.index');
   
    
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(phones $phone)
    {
       // $phone = phones::find($id);

    return view("artical.edit",['phone'=>$phone]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$phone =new phones();
    $this->authorize('update',$id);
    $request->validate(['phone'=>['required','digits:11','regex:/^(012|010|011)/',
    Rule::unique('phones')->where(function ($query) {
        return $query->whereNull('deleted_at');})->ignore($id) ]]);

    
$phone =phones::find($id);

$phone->update(['phone'=>$request->phone]);
//$phone->user_id=Auth::id();
//$phone->phone=$request->phone;
//$phone->save();

return redirect()->route('phone.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('update',$id);
        $phone =phones::find($id);


$phone->delete();
$phone =phones::where('user_id',Auth::id())->get();
return redirect()->back();

  
    }
}
