<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Helpers\ServicesHelpers;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Category;
use App\Models\Discount;
use App\Http\Requests\RoomRequest;
use App\Models\SettingHotel;

class RoomController extends Controller
{
    public function credentials($request, $pict, $is_booked)
    {
        return [
            'name'          => $request->name,
            'slug_name'     => str_slug($request->name),
            'type_id'       => $request->type,
            'number'        => $request->number,
            'location'      => $request->location,
            'is_booked'     => $is_booked,
            'price'         => $request->price,
            // 'discount_id'   => $request->discount,
            'pict'          => $pict,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getsetting = SettingHotel::latest('id')->first();
        $apk_name = 'default';
        $hotel_name = 'default';
        $pict = 'default';
        if (!empty($getsetting)) {
            $apk_name = $getsetting->apk_name;
            $hotel_name = $getsetting->hotel_name;
            $pict = $getsetting->pict;
        }

        $title = "Kamar";
        $sub_title = "List Kamar";
        $rooms = Room::orderBy('number')->get();
        return view('backend.room.main', compact('title', 'sub_title', 'rooms', 'apk_name', 'hotel_name', 'pict'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getsetting = SettingHotel::latest('id')->first();
        $apk_name = 'default';
        $hotel_name = 'default';
        $pict = 'default';
        if (!empty($getsetting)) {
            $apk_name = $getsetting->apk_name;
            $hotel_name = $getsetting->hotel_name;
            $pict = $getsetting->pict;
        }

        $id = Category::where('slug_name', 'room')->first();
        $parent_id = -1;
        if (!empty($id)) {
            $parent_id = $id->id;
        }
        $categories = Category::where('parent_id', $parent_id)->orderBy('name')->get();
        $discounts = Discount::orderBy('value')->get();
        $title = "Kamar";
        $sub_title = "Tambah Kamar";
        return view('backend.room.create', compact('title', 'sub_title', 'categories', 'discounts', 'apk_name', 'hotel_name', 'pict'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $pict = 'default';
        $dir = public_path('storage/backend/room/');
        ServicesHelpers::make_directory($dir);

        if($request->file('pict')) {
            ServicesHelpers::make_directory($dir.'pict/');
            $file = $request->file('pict');
            $pict = "pict-".str_slug($request->name)."-".time().".".$file->extension();
            ServicesHelpers::resize_image($file, 1270, 720, $dir.'pict/'.$pict);
        }
        $is_booked = 0;
        Room::create($this->credentials($request, $pict, $is_booked));
        notify()->success('Berhasil Menambah Kamar.', 'Horayy !!');
        return redirect()->route('room.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getsetting = SettingHotel::latest('id')->first();
        $apk_name = 'default';
        $hotel_name = 'default';
        $pict = 'default';
        if (!empty($getsetting)) {
            $apk_name = $getsetting->apk_name;
            $hotel_name = $getsetting->hotel_name;
            $pict = $getsetting->pict;
        }

        $get_cat = Category::where('slug_name', 'room')->first();
        $parent_id = -1;
        if (!empty($get_cat)) {
            $parent_id = $get_cat->id;
        }
        $categories = Category::where('parent_id', $parent_id)->orderBy('name')->get();
        $discounts = Discount::orderBy('value')->get();
        $title = "Kamar";
        $sub_title = "Edit Kamar";
        $room = Room::findOrFail($id);

        return view('backend.room.edit', compact('title', 'sub_title', 'room', 'categories', 'discounts', 'apk_name', 'hotel_name', 'pict'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $room = Room::findOrFail($id);
        $is_booked = $room->is_booked;
        $pict = $room->pict;
        $dir = public_path('storage/backend/room/');

        if($request->file('pict')) {
            $file = $request->file('pict');
            $pict = "pict-".str_slug($request->name)."-".time().".".$file->extension();
            ServicesHelpers::resize_image($file, 1270, 720, $dir.'pict/'.$pict);
        }

        $room->update($this->credentials($request, $pict, $is_booked));
        notify()->success('Berhasil Mengubah Kamar.', 'Horayy !!');
        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Room::destroy($id);
        notify()->success('Berhasil Menghapus Kamar.', 'Horayy !!');
        return response()->json([
            'success' => 'Sukses Menghapus Data'
        ]);
    }
}
