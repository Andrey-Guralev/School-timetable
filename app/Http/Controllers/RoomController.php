<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

class RoomController extends Controller
{
    public function getAll()
    {
        return Room::all();
    }

    public function getById($id)
    {
        return Room::find($id);
    }

    public function index()
    {
        return view('admin.rooms.roomIndex');
    }


    public function store(StoreRoomRequest $request)
    {
        $room = new Room;

        $room->name = $request->name;
        $room->class_id = $request->class_id;

        $room->save();

        return response('Кабинет создан', 201);
    }

    public function update(UpdateRoomRequest $request, $id)
    {
        $room = Room::find($id);

        $room->name = $request->name;
        $room->class_id = $request->class_id;

        $room->save();

        return response('Кабинет обновлен', 200);
    }
    public function destroy($id)
    {
        //
    }
}
