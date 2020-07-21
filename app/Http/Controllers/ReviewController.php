<?php

namespace App\Http\Controllers;

use App\DishReview;
use App\Dish;
use App\DishOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ReviewController extends Controller
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
            'rating' => 'required|integer',
            'comments' =>'required|min:4',
            'dish_id' => 'required',
        ]);
       
        $dish_id = $request->dish_id;
        $dish_order = DB::table('dish_orders')->where(['dish_id' => $dish_id,'user_id' => $user_id])->get();
        $dish_order_count = count($dish_order);
        if($dish_order_count>0)
        {
            $review = DishReview::create([

            'rating' => $request->rating,
            'comments' => $request->comments,
            'dish_id' => $dish_id,
            'user_id' => $user_id,
            ]);
        return response()->json(['message' => $review], 200);
        }
        else
        {
            return response()->json(['message' => 'You can not add review for a dish you have not ordered'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DishReview  $dishReview
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $reviews = DB::table('dish_reviews')->where('user_id',$user_id)->get();
        return response()->json(['reviews' => $reviews], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DishReview  $dishReview
     * @return \Illuminate\Http\Response
     */
    public function edit(DishReview $dishReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DishReview  $dishReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DishReview $dishReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DishReview  $dishReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(DishReview $dishReview)
    {
        //
    }
}
