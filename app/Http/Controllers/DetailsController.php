<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Dish;
use App\Chef;
use Illuminate\Http\Request;
use Auth; 
Use DB;
use Illuminate\Support\Facades\URL;
class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        $chef = Chef::all();
        for($x=0; $x< count($chef); $x++)
        {     
          $chef_id = $chef[$x]->id;
          $awards= DB::table('awards')->select('award')->where('chef_id',$chef_id)->get();
          $cuisines = DB::table('cuisines')->select('cuisine')->where('chef_id',$chef_id)->get();
          $dish_find =DB::table('dishes')->where('chef_id', '=', $chef_id)->get();
         
          for($y=0; $y< count($dish_find); $y++)
            {
                $dish_id = $dish_find[$y]->id;
                $dish = Dish::findOrFail($dish_id);
                $ingredient= DB::table('ingredients')->select('ingredients')->where('dish_id',$dish_id)->get();
                $dish_find[$y]->ingredients= $ingredient;
                $servingtime= DB::table('serving_timings')->select('servingtime')->where('dish_id',$dish_id)->get();
                $dish_find[$y]->servingtime= $servingtime;
                $dishimage= DB::table('dish_images')->select(array('id', 'dishimages'))->where('dish_id',$dish_id)->get();
                $dish_find[$y]->dishimages= $dishimage;
                $reviews= DB::table('dish_reviews')->select(array('rating', 'comments'))->where('dish_id',$dish_id)->get();
                $review_count = count($reviews);
                $total_reviews =  DB::table('dish_reviews')->where('dish_id',$dish_id)->avg('rating');
                $dish_find[$y]->total_reviews = $review_count;
                $dish_find[$y]->average_rating = $total_reviews;
                $dish_find[$y]->reviews= $reviews;
                $chef[$x]->dish = $dish_find;
            }
        }
        return response()->json([ 'chef' => $chef], 200);
    }

    public function userData(Request $request)
    {
        $user = $request->user();
        if($user->role==2)
        {
            $chef = $user->chef;
            $chef_id = $chef->id;
    
            $cuisines = DB::table('cuisines')->select('cuisine')->where('chef_id',$chef_id)->get();
            $chef->cuisines = $cuisines;
            $awards= DB::table('awards')->select('award')->where('chef_id',$chef_id)->get();
            $chef->awards = $awards;
            $dish_find =DB::table('dishes')->where('chef_id', '=', $chef_id)->get();
            for($x=0; $x< count($dish_find); $x++)
            {
                $dish_id = $dish_find[$x]->id;
                $dish = Dish::findOrFail($dish_id);
                $ingredient= DB::table('ingredients')->select('ingredients')->where('dish_id',$dish_id)->get();
                $dish_find[$x]->ingredients= $ingredient;
                $servingtime= DB::table('serving_timings')->select('servingtime')->where('dish_id',$dish_id)->get();
                $dish_find[$x]->servingtime= $servingtime;
                $dishimage= DB::table('dish_images')->select(array('id', 'dishimages'))->where('dish_id',$dish_id)->get();
                $dish_find[$x]->dishimages= $dishimage;
                $reviews= DB::table('dish_reviews')->select(array('rating', 'comments'))->where('dish_id',$dish_id)->get();
                $review_count = count($reviews);
                $total_reviews =  DB::table('dish_reviews')->where('dish_id',$dish_id)->avg('rating');
                $dish_find[$x]->total_reviews = $review_count;
                $dish_find[$x]->average_rating = $total_reviews;
                $dish_find[$x]->reviews= $reviews;
            }
            $chef->dishes = $dish_find;
            return response()->json([ 'user' => $user], 200);
        }
        else {
            
            return response()->json([ 'user' => $user], 200);
        }
 
       
    }
    public function chefdetail(Request $request)
    {

        $chef = Chef::all();
        for($x=0; $x< count($chef); $x++)
        {     
          $chef_id = $chef[$x]->id;
          $awards= DB::table('awards')->select('award')->where('chef_id',$chef_id)->get();
          $chef[$x]->awards = $awards;
          $cuisines = DB::table('cuisines')->select('cuisine')->where('chef_id',$chef_id)->get();
          $chef[$x]->cuisines = $cuisines;
        }
        return response()->json([ 'chef' => $chef], 200);
    }

     public function dishdetail(Request $request)
    {

        $dish = Dish::all();
        for($x=0; $x< count($dish); $x++)
        {     
          $dish_id = $dish[$x]->id;
          $ingredient= DB::table('ingredients')->select('ingredients')->where('dish_id',$dish_id)->get();
          $dish[$x]->ingredients = $ingredient;
          $servingtime= DB::table('serving_timings')->select('servingtime')->where('dish_id',$dish_id)->get();
          $dish[$x]->servingtime = $servingtime;
          $dishimage= DB::table('dish_images')->select(array('id', 'dishimages'))->where('dish_id',$dish_id)->get();
          $dish[$x]->dishimage = $dishimage;
          $reviews= DB::table('dish_reviews')->select(array('rating', 'comments'))->where('dish_id',$dish_id)->get();
          $dish[$x]->reviews = $reviews;
        }
        return response()->json([ 'dish' => $dish], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
