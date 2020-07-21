<?php

namespace App\Http\Controllers;

use App\Chef;
use App\User;
use App\DishImage;
use App\Dish;
use App\FavouriteDish;
use Illuminate\Http\Request;
use Auth; 
Use DB;
use Illuminate\Support\Facades\URL;
class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $dishes = Dish::all();
        return response()->json(['dishes' => $dishes], 200);
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
      
        $chef = $user->chef;
        $chef_id = $chef->id;
        $this->validate($request, [
            'name' => 'required|min:3',
            'price' =>'required|integer',
            'serving_size' => 'required',
            'cuisine_type' => 'required' ,
            'dietary_information' => 'required|min:8',
            'course_type' => 'required',
            'description' => 'required|min:8',
            'ingredients' => 'required|array',
            'dishimages' => 'required|array',
            'servingtime' => 'required|array',
            'halal'=>'required'

            ]);
       
        $dish = Dish::create([
            'name' => $request->name,
            'price' => $request->price,
            'serving_size' => $request->serving_size,
            'cuisine_type' => $request->cuisine_type,
            'dietary_information'=> $request->dietary_information,
            'course_type' => $request->course_type,
            'description' => $request->description,
            'halal'=>$request->halal,
            'chef_id' => $chef_id,
            ]);
        $ingredient = $request->ingredients;
        for($x=0; $x< count($ingredient); $x++)
        {
            $ingredients = $dish->ingredients()->create(['ingredients' => $ingredient[$x] , ]);
        }
        
        $time = $request->servingtime;
        for($x=0; $x< count($time); $x++)
        {
            $servingtime = $dish->servingtime()->create(['servingtime' => $time[$x] , ]);
        }

        $file = $request->file('dishimages');
        for($x=0; $x< count($file); $x++)
        {
            $name = $file[$x]->getClientOriginalName();
            $file[$x]->move('img/dishes',$name);
            $dishimages = URL::asset('img/dishes/').'/'.$name;
            $dishimages = $dish->dishimages()->create(['dishimages' => $dishimages , ]);
        }
        $dish->save();
        return response()->json(['message' => $chef_id], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $chef = $user->chef;
        $chef_id = $chef->id;
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
        return response()->json([ 'dish' => $dish_find], 200);
    }

    public function priceFilter(Request $request)
    {
        $this->validate($request, [
            'min' => 'required|integer',
            'max' =>'required|integer',
            ]);
        $min = $request->min;
        $max = $request->max;
        
        $dishes = DB::table('dishes')
            ->whereBetween('price', [(int)$min,(int)$max])->get();
        return response()->json([ 'dishes' => $dishes], 200);
    }

     public function getdish(Request $request, $id)
    {
        $user = Auth::user();
        $chef = $user->chef;
        $chef_id = $chef->id;
        $dish= DB::table('dishes')->where('id',$id)->get();
        $dish_chef_id = $dish[0]->chef_id;
        if($chef_id == $dish_chef_id)
        {
            $ingredients= DB::table('ingredients')->select('ingredients')->where('dish_id',$id)->get();
            $servingtime= DB::table('serving_timings')->select('servingtime')->where('dish_id',$id)->get();
            $dishimage= DB::table('dish_images')->select(array('id','dishimages'))->where('dish_id',$id)->get();
            $reviews= DB::table('dish_reviews')->select(array('rating','comments'))->where('dish_id',$id)->get();
            $review_count = count($reviews);
            $total_reviews =  DB::table('dish_reviews')->where('dish_id',$id)->avg('rating');
            $dish[0]->total_reviews = $review_count;
            $dish[0]->average_rating = $total_reviews;
            return response()->json([ 
                                      'dish' => $dish, 
                                      'ingredients' => $ingredients,
                                      'dish_images' => $dishimage,
                                      'reviews' => $reviews,
                                      
                                    ], 200);
        }
        else 
        {
            return response()->json([
                                    'message' => 'Record could not Found'
                                    ], 500);
        }
        
    }
    public function cuisineprice(Request $request)
    {
        $min = $request->min;
        $max = $request->max;
        $cuisine = $request->cuisine_type;
        if($cuisine==null && $min!=null && $max!=null)
        {
             $dish = DB::table('dishes')
            ->whereBetween('price', [(int)$min,(int)$max])->get();
        }
        if($cuisine!=null && $min==null && $max==null)
        {
         $dish = DB::table('dishes')->Where('cuisine_type',$cuisine)->get();  
        }
        if($cuisine!=null && $min!=null && $max!=null)
        {
         $dish = DB::table('dishes')->Where('cuisine_type',$cuisine)->whereBetween('price', [(int)$min,(int)$max])->get();   
        }
        
        return response()->json(['dish'=>$dish]);
    }

     public function getDishByCuisine(Request $request)
    {
        $cuisine = $request->cuisine_type;
        $dish= DB::table('dishes')->where('cuisine_type',$cuisine)->get();
        
            return response()->json(['dish' => $dish]);
    }
    public function getDishByCuisine1($cuisine)
    {
        $dish= DB::table('dishes')->where('cuisine_type',$cuisine)->get();
        
            return response()->json(['dish' => $dish]);
    }
    /**
     * Show the form for editing the specified resource. 
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {      
        $user = $request->user();
        $chef = $user->chef;
        $chef_id = $chef->id;
        $dish_id = $request->id;
        $dish = Dish::findOrFail($dish_id);
        $dish_chef_id = $dish->chef_id;
        if($chef_id == $dish_chef_id)
        {
        $this->validate($request, [
            'name' => 'required|min:3',
            'price' =>'required|integer',
            'serving_size' => 'required',
            'cuisine_type' => 'required' ,
            'dietary_information' => 'required|min:8',
            'course_type' => 'required',
            'description' => 'required|min:8',
            'ingredients' => 'required|array',
            'servingtime' => 'required|array',
            'halal' => 'required'  
            ]);
     
        $dishes = $dish->update([
            'name' => $request->name,
            'price' => $request->price,
            'serving_size' => $request->serving_size,
            'cuisine_type' => $request->cuisine_type,
            'dietary_information'=> $request->dietary_information,
            'course_type' => $request->course_type,
            'description' => $request->description,
            'halal' =>$request->halal,
            'chef_id' => $chef_id
            ]);
        $ingredientD = DB::table('ingredients')->where('dish_id',$dish_id)->delete();
        $ingredient = $request->ingredients;
        for($x=0; $x< count($ingredient); $x++)
        {
            $ingredients = $dish->ingredients()->create(['ingredients' => $ingredient[$x] , ]);
        }

        $servingtimeD = DB::table('serving_timings')->where('dish_id',$dish_id)->delete();
        $time = $request->servingtime;
        for($x=0; $x< count($time); $x++)
        {
            $servingtime = $dish->servingtime()->create(['servingtime' => $time[$x] , ]);
        }
         $ingredients_updated= DB::table('ingredients')->select('ingredients')->where('dish_id',$dish_id)->get();
         $servingtime_updated= DB::table('serving_timings')->select('servingtime')->where('dish_id',$dish_id)->get();

        return response()->json(['dish' => $dish,'ingredients' =>$ingredients_updated,'serving time'=>$servingtime_updated], 200);
        }
         else 
        {
            return response()->json([
                'message' => 'Record could not Updated'
            ], 500);
        }
    }
    public function updateImage(Request $request)
    {
        $this->validate($request, [
            'dishimages' => 'required',  
        ]);
       
        $image_id= $request->id;  
        $dishimage = DishImage::findOrFail($image_id);   
       
        if($file = $request->file('dishimages'))
        {
            $name = $file->getClientOriginalName();
            $file->move('img/dishes',$name);
            $image = URL::asset('img/dishes/').'/'.$name;
        }

        $dishes = $dishimage->update([
            'dishimages' => $image,      
            ]);

        return response()->json(['dish' => $image], 200);

    }

    public function dishdelete($id)
    {
       $dishD = DB::table('dishes')->where('id',$id)->delete();
       $ingredientD = DB::table('ingredients')->where('dish_id',$id)->delete();
       $servingtimeD = DB::table('serving_timings')->where('dish_id',$id)->delete();
       $dishimagesD = DB::table('dish_images')->where('dish_id',$id)->delete();
       return response()->json(['dish' => 'Dish Delete Successfully'],200);
    }
    public function favDishStore(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;

        $this->validate($request, [
            'dish_id' => 'required',
        ]);
       
        $dish_id = $request->dish_id;
        $dish = DB::table('favourite_dishes')->where(['dish_id' => $dish_id,'user_id' => $user_id])->get();
       if(count($dish)>0)
        {
            return response()->json(['message'=> 'Dish is already in your favourites'],200);
        }
        else
        {
        $fav = FavouriteDish::create([
            'dish_id' => $dish_id,
            'user_id' => $user_id,
            ]);
        return response()->json(['message' => $fav], 200);
        }
        
    }
     public function favDishShow(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $fav = DB::table('favourite_dishes')->where('user_id',$user_id)->get();
        
         for($x=0; $x< count($fav); $x++)
        {
            $dish_id = $fav[$x]->dish_id;
            $dishes = DB::table('dishes')->where('id', $dish_id)->get();
           
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
                $fav[$x]->dishes= $dishes;
            }
        }
        
        return response()->json([ 'dish' => $fav], 200);
    }
    public function favDishDelete(Request $request)
    {      
       $user = $request->user();
       $user_id = $user->id;
       $dish_id = $request->dish_id;
       $dishD = DB::table('favourite_dishes')->where(['dish_id' => $dish_id,'user_id' => $user_id])->delete();
      
       return response()->json(['dish' => 'Favourite Dish Delete Successfully'],200);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
