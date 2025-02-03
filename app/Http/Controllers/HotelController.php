<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\HotelModel;
use App\Services\HotelServices;
use Exception;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    protected HotelServices $service;

    function __construct(HotelServices $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $hotels = HotelModel::paginate(1000);
        return view('hotel.hotels', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotel.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        try{
            $this->service->add($request->validated());
            return redirect()->route('hotel.index')->with('Message', 'Hotel Added');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
