<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Person;
use App\Models\Review;
use App\Models\Driver;

class DashboardController extends Controller
{
    public function your_reviews()
    {
        $reviews = Review::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();

        if ($reviews->isEmpty()) {
            if (Auth::user()->access===1) return view('admin.home');
            else return view('dashboard');
        }

        $drivers = collect();
        foreach ($reviews as $review){
            $driver = Driver::find($review->driver_id);
            if ($driver) $drivers->push($driver);
        }
        
        if (Auth::user()->access===1) return view('admin.home')->with(compact('drivers', 'reviews'));
        else return view('dashboard')->with(compact('drivers', 'reviews'));
    }

    public function manage_users()
    {       
        $users = User::all();
        $persons = Person::all();
        return view('admin.users')->with(compact('users', 'persons'));
    }

    public function update_users(Request $request)
    {       
        $user_id = $request->input('id');
        $access = $request->input('access');
        $type = $request->input('type');
       
        User::where('id', $user_id)->update(['access' => $access]);
        Person::where('user_id', $user_id)->update(['type' => $type]);

        return redirect()->route('manage_users');
    }

    public function delete_users(Request $request)
    {       
        $user_id = $request->input('id');
       
        $user = User::find($user_id);
        if ($user) $user->delete();

        $drivers = Driver::all();
        foreach ($drivers as $driver){
            $reviews = Review::where('driver_id', $driver->id)->get();
            $review_sum = Review::where('driver_id', $driver->id)->sum('rating');
            if($review_sum === 0) $driver->rating_tot = 0;
            else $driver->rating_tot = round($review_sum / $reviews->count());
            $driver->save();
        }

        return redirect()->route('manage_users');
    }

    public function manage_drivers($city, $search_query)
    {      
        if($city == 'all' && $search_query == "ilocommute") 
            $drivers = Driver::orderBy('updated_at', 'desc')->get();
        else
        {
            if($city == 'all' || empty($city))
            {
                if($search_query != 'ilocommute') $drivers = Driver::where('plate_no', 'LIKE', "%$search_query%")->orderBy('updated_at', 'desc')->get();
                else $drivers = Driver::orderBy('updated_at', 'desc')->get();
            }
            else
            {
                if($search_query != 'ilocommute') $drivers = Driver::where('city', $city)->where('plate_no', 'LIKE', "%$search_query%")->orderBy('updated_at', 'desc')->get();
                else $drivers = Driver::where('city', $city)->orderBy('updated_at', 'desc')->get();
            }
        }
        return view('admin.drivers')->with('search_query', $search_query)->with('city', $city)->with(compact('drivers'));
    }

    public function delete_drivers(Request $request)
    {      
        if (empty($request->input('search_query'))) $search_query = 'ilocommute';
        else $search_query = $request->input('search_query');

        if ($request->input('city')!='all')  $city = $request->input('city');
        else $city = 'all';
        
        $driver_id = $request->input('id');
       
        $driver = Driver::find($driver_id);
        if ($driver) $driver->delete();

        return redirect()->route('manage_drivers', [
            'city' => $city,
            'search_query' => $search_query,
        ]);
    }

    public function create_driver(Request $request)
    {       
        $driver = new Driver();
        $driver->plate_no = $request->input('new_plate_no');
        $driver->city = $request->input('new_city');
        $driver->brgy = $request->input('new_brgy');

        $driver->save();

        $city = $request->input('city');
        if (empty($request->input('search_query'))) $search_query = 'ilocommute';
        else $search_query = $request->input('search_query');

        return redirect()->route('manage_drivers', [
            'city' => $city,
            'search_query' => $search_query,
        ]);
    }

    public function search_drivers(Request $request)
    {       
        $city = $request->input('city');
        if (empty($request->input('search_query'))) $search_query = 'ilocommute';
        else $search_query = $request->input('search_query');

        return redirect()->route('manage_drivers', [
            'city' => $city,
            'search_query' => $search_query,
        ]);
    }
    
}
