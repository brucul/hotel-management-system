<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Http\Requests\Master\DiscountRequest;
use App\Models\SettingHotel;

class DiscountController extends Controller
{
    public function credentials($request)
    {
        return [
            'name'      => $request->name,
            'slug_name' => str_slug($request->name),
            'value'     => $request->value,
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

        $title = "Discount";
        $sub_title = "List Discount";
        $discounts = Discount::orderBy('name')->get();
        return view('backend.master.discount.main', compact('title', 'sub_title', 'discounts','apk_name', 'hotel_name','pict'));
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
    public function store(DiscountRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        Discount::create($this->credentials($request));
        notify()->success('Berhasil Menambah Discount.', 'Horayy !!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $discount = Discount::findOrFail($id);
        $discount->update($this->credentials($request));
        notify()->success('Berhasil Mengubah Discount.', 'Horayy !!');
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
        Discount::destroy($id);
        notify()->success('Berhasil Menghapus Discount.', 'Horayy !!');
        return response()->json([
            'success' => 'Sukses Menghapus Data'
        ]);
    }
}
