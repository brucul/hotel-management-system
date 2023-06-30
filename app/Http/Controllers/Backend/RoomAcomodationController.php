<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomAcomodation;
use Illuminate\Http\Request;
use App\Http\Requests\RoomAcomodationRequest;
use App\Models\SettingHotel;

class RoomAcomodationController extends Controller
{
    public function credentials($request)
    {
        return [
            'room_id'       => $request->room_id,
            'name'          => $request->name,
            'slug_name'     => str_slug($request->name),
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(RoomAcomodationRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        RoomAcomodation::create($this->credentials($request));
        notify()->success('Berhasil Menambah Room Acomodation.', 'Horayy !!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        $title = "Room Acomodations";
        $sub_title = "";
        $acomodations = RoomAcomodation::where('room_id', $id)->orderBy('name')->get();
        return view('backend.roomacomodation.main', compact('title', 'sub_title', 'acomodations', 'id', 'apk_name', 'hotel_name', 'pict'));
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
    public function update(RoomAcomodationRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $roomacomodation = RoomAcomodation::findOrFail($id);
        $roomacomodation->update($this->credentials($request));
        notify()->success('Berhasil Mengubah Room Acomodation.', 'Horayy !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoomAcomodation::destroy($id);
        notify()->success('Berhasil Menghapus Room Acomodation.', 'Horayy !!');
        return response()->json([
            'success' => 'Sukses Menghapus Data'
        ]);
    }
}
