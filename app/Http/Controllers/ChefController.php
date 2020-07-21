<?php

namespace App\Http\Controllers;

use App\Chef;
use App\User;
use Illuminate\Http\Request;
use Auth; 
Use DB;
use Illuminate\Support\Facades\URL;
class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $chef = Chef::all();
        return response()->json(['chef' => $chef], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $this->validate($request, [
            'business_name' => 'required|min:3',
            'business_email' => 'required|email|unique:chefs',
            'business_phone' => 'required',
            'business_image' => 'required|mimes:jpg,jpeg,png',
            'experience' => 'required|integer',
            'pickup_location'=>'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'chef_description' => 'required|min:8',
            'cuisines' => 'required|array|min:1',
            'awards' => 'required|array'
        ]);
        if($file = $request->file('business_image'))
       {
           $name = $file->getClientOriginalName();
           $file->move('img/chefs',$name);
           $image = URL::asset('img/chefs/').'/'.$name;
       }

        $chef = $user->chef()->create([
            'business_name' => $request->business_name,
            'business_email' => $request->business_email,
            'business_phone' => $request->business_phone,
            'business_image' => $image,
            'pickup_location'=> $request->pickup_location,
            'experience' => $request->experience,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'chef_description' => $request->chef_description,
        ]);
        $awards= $request->awards;
        for($x=0; $x< count($awards); $x++)
        {     
            $awrd = $chef->award()->create([    
            'award' => $awards[$x] ,
            ]);

        }
        $cuisines= $request->cuisines;
        for($x=0; $x< count($cuisines); $x++)
        {     
            $cuisine = $chef->cuisine()->create([    
            'cuisine' => $cuisines[$x] ,
            ]);

        }
        $user->role = 2;
        $user->save();
       
        return response()->json(['message' => 'Chef registered sucessfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $chef = $user->chef;
        $chef_id = $chef->id;
        $awards= DB::table('awards')->select('award')->where('chef_id',$chef_id)->get();
        $cuisines = DB::table('cuisines')->select('cuisine')->where('chef_id',$chef_id)->get();
        return response()->json(['chef' => $chef, 'awards' => $awards, 'cuisines' => $cuisines], 200);
    }


     public function getChefByCuisine(Request $request)
    {
        $cuisine = $request->cuisine;
        $cuisines= DB::table('cuisines')->where('cuisine',$cuisine)->get();
        $chefs = [];
        for($x=0; $x< count($cuisines); $x++)
        {     
            $chef_id = $cuisines[$x]->chef_id;
            $chef= DB::table('chefs')->where('id',$chef_id)->get();
            $chefs[$x]= $chef[0];
        }
            return response()->json(['chefs' => $chefs]);
    }
    
    public function getChefByCuisine1($chef_id)
    {
        $chef= DB::table('cuisines')->where('chef_id',$chef_id)->get();
        
            return response()->json(['cuisines' => $chef]);
    }


    public function updateImage(Request $request)
    {
        $this->validate($request, [
            'business_image' => 'required|mimes:jpg,jpeg,png',           
        ]);

        $user = $request->user();
        $user_id = $user->id;
        $chef_find =DB::table('chefs')->where('user_id', '=', $user_id)->get();
        $chef_id = $chef_find[0]->id;
        $chef = Chef::findOrFail($chef_id);

        

        if($file = $request->file('business_image'))
        {
            $name = $file->getClientOriginalName();
            $file->move('img/chefs',$name);
            $image = URL::asset('img/chefs/').'/'.$name;
        }

        $chefs = $chef->update([
            'business_image' => $image,      
        ]);

        return response()->json(['image' => $image], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function edit(Chef $chef)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chef $chef)
    {
        $user = $request->user();
        $chef = $user->chef;
        $chef_id = $chef->id;
        $this->validate($request, [
            'business_name' => 'required|min:3',
            'business_email' => 'required|email|unique:chefs',
            'business_phone' => 'required',
            'experience' => 'required|integer',
            'pickup_location'=>'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'chef_description' => 'required|min:8',
            'cuisines' => 'required|array|min:1',
            'awards' => 'required|array',

        ]);

        $chefs = $chef->update([
            'business_name' => $request->business_name,
            'business_email' => $request->business_email,
            'business_phone' => $request->business_phone,
            'pickup_location'=> $request->pickup_location,
            'experience' => $request->experience,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'chef_description' => $request->chef_description,
        ]);
        $cuisineD = DB::table('cuisines')->where('chef_id',$chef_id)->delete();
        $cuisines= $request->cuisines;
        for($x=0; $x< count($cuisines); $x++)
        {     
            $cuisine = $chef->cuisine()->create([    
            'cuisine' => $cuisines[$x] ,
            ]);

        }

        $awardD= DB::table('awards')->where('chef_id',$chef_id)->delete();
        $awards= $request->awards;
        for($x=0; $x< count($awards); $x++)
        {     
            $awrd = $chef->award()->create([    
            'award' => $awards[$x] ,
            ]);

        }
        $user = $request->user();
        $chef = $user->chef;
        $chef_id = $chef->id;
        $awards= DB::table('awards')->select('award')->where('chef_id',$chef_id)->get();
        $cuisines = DB::table('cuisines')->select('cuisine')->where('chef_id',$chef_id)->get();
       return response()->json(['chef' => $chef,'awards' => $awards, 'cuisines' =>$cuisines], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chef $chef)
    {
        //
    }
}
