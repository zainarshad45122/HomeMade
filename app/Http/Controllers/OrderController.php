<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Dish;
class OrderController extends Controller
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
        $user = $request->user();
        $user_id = $user->id;
       
        $this->validate($request, [
            'total_price' => 'required',
            'dish_id' => 'required',
        ]);
       
        
        $dishid = $request->dish_id;
        $dish = Dish::findOrFail($dishid);
        $isSameChef = true;
         for($x=0; $x< count($dish); $x++)
        {  
            if($dish[0]->chef_id != $dish[$x]->chef_id)
            {
               $isSameChef = false; 
               break; 
            }
           
        } 
        if($isSameChef)
        {
        $order = $user->orders()->create([
                'total_price' => $request->total_price,
                'chef_id' => $dish[0]->chef_id,
                'user_id' => $user_id,
                ]);
        $order_id= $order->id;
                for($y=0; $y< count($dishid); $y++)
                {
                    $dish_id = $order->dishorder()->create([
                        'dish_id' => $dishid[$y] ,
                        'order_id' => $order_id,
                        'user_id' => $user_id,
                        ]);
                }
                return response()->json(['message' =>'Ordered successfully'], 200);
        }
        else
        {   
            return response()->json(['message' =>'Order cannot be added, All the dishes should be of the same chef'], 200);
        }
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $user = $request->user();
        $user_id = $user->id;
        $orders = DB::table('orders')->where('user_id',$user_id)->get();
        
         for($x=0; $x< count($orders); $x++)
        {
            $order_id = $orders[$x]->id;
            $dish_order = DB::table('dish_orders')->where('order_id', $order_id)->get();
            for ($i=0; $i < count($dish_order) ; $i++) { 
                $dish_id = $dish_order[$i]->dish_id;
                $dishes = DB::table('dishes')->where('id',$dish_id)->get();
                for($y=0; $y< count($dishes); $y++)
                {
                    $dish_id = $dishes[$y]->id;
                    $dish = Dish::findOrFail($dish_id);
                    $ingredient= DB::table('ingredients')->select('ingredients')->where('dish_id',$dish_id)->get();
                    $dishes[$y]->ingredients= $ingredient;
                    $servingtime= DB::table('serving_timings')->select('servingtime')->where('dish_id',$dish_id)->get();
                    $dishes[$y]->servingtime= $servingtime;
                    $dishimage= DB::table('dish_images')->select(array('id', 'dishimages'))->where('dish_id',$dish_id)->get();
                    $dishes[$y]->dishimages= $dishimage;
                    $reviews= DB::table('dish_reviews')->select(array('rating', 'comments'))->where('dish_id',$dish_id)->get();
                    $review_count = count($reviews);
                    $total_reviews =  DB::table('dish_reviews')->where('dish_id',$dish_id)->avg('rating');
                    $dishes[$y]->total_reviews = $review_count;
                    $dishes[$y]->average_rating = $total_reviews;
                    $dishes[$y]->reviews= $reviews;
                    $orders[$x]->dishes= $dishes;
                }
            }
           
            
        }
         return response()->json([ 'order' => $orders], 200);
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
