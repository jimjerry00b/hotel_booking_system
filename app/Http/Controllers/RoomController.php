<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\HotelModel;
use App\Models\RoomModel;
use App\Services\RoomServices;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class RoomController extends Controller
{


    protected RoomServices $service;

    function __construct(RoomServices $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $rooms = RoomModel::all();
        return view('room.view', compact('rooms'));
    }

    public function create()
    {
        $hotels = HotelModel::all();
        $rooms = RoomModel::all();

        if(count($hotels)<= 0){
            return redirect()->route('hotel.index')->with('error', 'No hotel in the list, please add Hotel first');
        }

        return view('room.add', compact('hotels', 'rooms'));
    }

    public function store(RoomRequest $request)
    {
        try{
            $this->service->add($request->validated());
            return redirect()->route('room.index')->with('message', 'Added');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $room = RoomModel::find($id);
        $hotels = HotelModel::all();
        return view('room.edit', compact('hotels', 'room'));
    }




    public function update(RoomRequest $request, RoomModel $room)
    {
        try {
            $this->service->update($request->validated(), $room);
            return redirect()->route('room.index')->with('success', 'Modified');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something was wrong.');
        }

    }

    public function destroy(RoomModel $room)
    {
        try{
           $this->service->delete($room);
           return redirect()->route('room.index')->with('message', 'Delete');
        }catch(Exception $e){
            return redirect()->route('room.index')->with('error', $e->getMessage());
        }

    }
}
