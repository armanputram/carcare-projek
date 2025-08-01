<?php

namespace App\Http\Controllers;

use App\Models\CarService;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\CarStore;

class FrontController extends Controller
{
    //
    public function index()
    {
        $cities = City::all();
        $services = CarService::withCount(['storeServices'])->get();
        return view('front.index', compact('cities', 'services' ));
    }

    public function search(Request $request)
    {
        $cityId = $request->input('city_id');
        $serviceTypeId = $request->input('service_type');

        $carService = CarService::where('id', $serviceTypeId)->first();
        if(!$carService){
            return redirect()->back()->with('error', 'Service not found.');
        }
        $stores = CarStore::whereHas('storeServices', function ($query) use ($carService) {
            $query->where('car_service_id', $carService->id);
        })->where('city_id', $cityId)->get();

        $city = City::find($cityId);

        session()->put('serviceTypeId', $request->input('service_type'));

        return view('front.stores',[
        'stores' => $stores,
        'carService' => $carService,
        'cityName' => $city ? $city->name : 'Unknown City',
        ]);
    }
}

