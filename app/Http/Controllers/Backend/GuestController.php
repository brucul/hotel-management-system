<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Category;
use App\Http\Requests\GuestRequest;
use App\Models\SettingHotel;
use App\Models\Reservation;

class GuestController extends Controller
{
    public function credentials($request)
    {
        return [
            'name'              => $request->name,
            'slug_name'         => str_slug($request->name),
            'type_id'           => $request->type,
            'nik'               => $request->nik,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'address'           => $request->address,
            'city'              => $request->city,
            'country'           => $request->country,
            'additional_info'   => $request->additional_info,
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

        $title = "Tamu";
        $sub_title = "List Tamu";
        $guests = Guest::orderBy('name')->get();
        return view('backend.guest.main', compact('title', 'sub_title', 'guests', 'apk_name', 'hotel_name', 'pict'));
    }

    public function guest_in_house()
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

        $title = "Tamu";
        $sub_title = "Guest In House";
        $guests = Reservation::where('check_out', null)->orderBy('check_in')->get();
        return view('backend.guest.in-house', compact('title', 'sub_title', 'guests', 'apk_name', 'hotel_name', 'pict'));
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

        $id = Category::where('slug_name', 'guest')->first();
        $parent_id = -1;
        if (!empty($id)) {
            $parent_id = $id->id;
        }
        $categories = Category::where('parent_id',  $parent_id)->orderBy('name')->get();
        $title = "Tamu";
        $sub_title = "Tambah Tamu";
        return view('backend.guest.create', compact('title', 'sub_title', 'categories','apk_name', 'hotel_name', 'pict'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        Guest::create($this->credentials($request));
        notify()->success('Berhasil Menambah Tamu.', 'Horayy !!');
        return redirect()->route('guest.index');
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

        $get_cat = Category::where('slug_name', 'guest')->first();
        $parent_id = -1;
        if (!empty($get_cat)) {
            $parent_id = $get_cat->id;
        }
        $categories = Category::where('parent_id',  $parent_id)->orderBy('name')->get();
        $title = "Tamu";
        $sub_title = "Edit Tamu";
        $guest = Guest::findOrFail($id);
        return view('backend.guest.edit', compact('title', 'sub_title', 'guest', 'categories', 'apk_name', 'hotel_name', 'pict'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuestRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $guest = Guest::findOrFail($id);

        $guest->update($this->credentials($request));
        notify()->success('Berhasil Mengubah Tamu.', 'Horayy !!');
        return redirect()->route('guest.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Guest::destroy($id);
        notify()->success('Berhasil Menghapus Tamu.', 'Horayy !!');
        return response()->json([
            'success' => 'Sukses Menghapus Data'
        ]);
    }
}
