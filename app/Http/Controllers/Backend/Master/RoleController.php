<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Master\RoleRequest;
use App\Models\SettingHotel;

class RoleController extends Controller
{
    public function credentials($request)
    {
        return [
            'name'      => $request->name,
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

        $title = "Roles";
        $sub_title = "List Roles";
        $roles = Role::all();
        return view('backend.master.roles.main', compact('title', 'sub_title', 'roles', 'apk_name', 'hotel_name', 'pict'));
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
    public function store(RoleRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        Role::create($this->credentials($request));
        notify()->success('Berhasil Menambah Role.', 'Horayy !!');
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

        $title = "Permission";
        $sub_title = "List Permission";
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('backend.master.roles.give_permission', compact('title', 'sub_title', 'permissions', 'role', 'apk_name', 'hotel_name', 'pict'));
    }

    public function give_permission(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->name);
        notify()->success('Berhasil Mengubah Permission.', 'Horayy !!');
        return redirect()->route('role.index');
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
    public function update(RoleRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $role = Role::findOrFail($id);
        $role->update($this->credentials($request));
        notify()->success('Berhasil Mengubah Role.', 'Horayy !!');
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
        Role::destroy($id);
        notify()->success('Berhasil Menghapus Role.', 'Horayy !!');
        return response()->json([
            "success" => "Sukses Delete Data!"
        ]);
    }
}
