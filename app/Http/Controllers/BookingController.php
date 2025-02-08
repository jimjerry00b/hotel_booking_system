<?php

namespace App\Http\Controllers;

use App\Models\BookingModel;
use App\Services\BookingServices;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    protected BookingServices $service;

    function __construct(BookingServices $service)
    {
        $this->service =  $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = BookingModel::with('room', 'user')->get();
        // dd($bookings);
        return view('booking.view', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }


    public function bookingsBeforeConfirm(Request $request)
    {
        try{
            $this->service->add($request);
            return redirect()->route('home')->with('message', 'booking added');
        }catch(Exception $e){
            dd($e->getMessage());
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
