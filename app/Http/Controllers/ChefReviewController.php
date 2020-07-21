<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ChefReview;
use DB;
class ChefReviewController extends Controller
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
            'chef_id' => 'required',
            ]);
        $chef_id = $request->chef_id;
        $chef_order = DB::table('orders')->where(['chef_id' => $chef_id,'user_id' => $user_id])->get();
        $chef_order_count = count($chef_order);
        if($chef_order_count>0)
        {
            $review = ChefReview::create([

            'rating' => $request->rating,
            'comments' => $request->comments,
            'chef_id' => $chef_id,
            'user_id' => $user_id,
            ]);
           
            return response()->json(['message' => $review], 200);
        }
        else
        {
            return response()->json(['message' => 'You can not add review for a chef, to whom you have not placed a order'], 200);
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
        $reviews = DB::table('chef_reviews')->where('user_id',$user_id)->get();
        return response()->json(['reviews' => $reviews], 200);
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
