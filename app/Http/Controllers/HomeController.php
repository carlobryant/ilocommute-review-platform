<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Person;
use App\Models\Review;
use App\Models\Driver;

class HomeController extends Controller
{
    public function redirect()
    {       
        if (Auth::user()===null) return view('auth.login');
        else return redirect()->route('your_reviews');
    }

    public function result(Request $request)
    {
        $search_query = $request->input('plate_no');
        $drivers = Driver::where('plate_no', 'LIKE', "%$search_query%")->get();

        if ($drivers->isEmpty()) {
            return view('search-none')->with('search_query', $search_query);
        }
        
        foreach ($drivers as $driver){
            $reviews = Review::where('driver_id', $driver->id)->get();
            $review_sum = Review::where('driver_id', $driver->id)->sum('rating');
            if($review_sum === 0) $driver->rating_tot = 0;
            else $driver->rating_tot = round($review_sum / $reviews->count());
            $driver->save();
        }
        
    
        return view('search-results')->with('search_query', $search_query)->with(compact('drivers'));
    }

    public function result_prev($search_query)
    {
        $drivers = Driver::where('plate_no', 'LIKE', "%$search_query%")->get();

        if ($drivers->isEmpty()) {
            return view('search-none')->with('search_query', $search_query);
        }
        return view('search-results')->with('search_query', $search_query)->with(compact('drivers'));
    }

    public function result_info(Request $request)
    {
        $search_query = $request->input('plate_no');
        $driver_id = $request->input('driver_id');

        if (!is_null($request->input('rating')) && !is_null($request->input('comment')))
        {
            $review = new Review();
            $review->user_id = Auth::user()->id;
            $review->driver_id = $driver_id;
            $review->pickup = $request->input('pickup');
            $review->destination = $request->input('destination');
            $review->rating = $request->input('rating');
            $review->comment = $request->input('comment');
            $review->save();

            $review_sum = Review::where('driver_id', $driver_id)->sum('rating');
        }

        $driver = Driver::find($driver_id);
        $reviews = Review::where('driver_id', $driver_id)->orderBy('updated_at', 'desc')->get();

        if($reviews->count() > 0)
        {
            $user_ids = $reviews->pluck('user_id')->toArray();
            $persons = Person::whereIn('id', $user_ids)->get();
        }
        else $persons = NULL;

        if(!is_null($request->input('rating')) && !is_null($request->input('comment')))
        {
            $driver->rating_tot = round($review_sum / $reviews->count());
            $driver->save();
            return redirect()->route('result_submit', [
                'search_query' => $search_query,
                'driver_id' => $driver->id,
                'dashboard' => 0,
            ]);
        } 
        
        return view('search-info')->with('search_query', $search_query)->with(compact('driver', 'reviews', 'persons'));
    }

    public function result_submit($search_query, $driver_id, $dashboard)
    {
        $driver = Driver::find($driver_id);
        $reviews = Review::where('driver_id', $driver_id)->orderBy('updated_at', 'desc')->get();

        if($reviews->count() > 0)
        {
            $user_ids = $reviews->pluck('user_id')->toArray();
            $persons = Person::whereIn('id', $user_ids)->get();
        }
        else $persons = NULL;

        return view('search-info')->with('search_query', $search_query)->with('dashboard', $dashboard)->with(compact('driver', 'reviews', 'persons'));
    }

    public function delete_review(Request $request)
    {
        $search_query = $request->input('plate_no');
        $driver_id = $request->input('driver_id');

        $review_id = $request->input('review_id');
        $review = Review::find($review_id);

        if($review) $review->delete();

        $driver = Driver::find($driver_id);
        $reviews = Review::where('driver_id', $driver_id)->orderBy('updated_at', 'desc')->get();

        $review_sum = Review::where('driver_id', $driver_id)->sum('rating');
        if($review_sum === 0) $driver->rating_tot = 0;
        else $driver->rating_tot = round($review_sum / $reviews->count());
        $driver->save();
    
        return redirect()->route('result_submit', [
            'search_query' => $search_query,
            'driver_id' => $driver_id,
            'dashboard' => 0,
        ]);
    }
}
