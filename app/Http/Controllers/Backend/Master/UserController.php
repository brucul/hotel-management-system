<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Helpers\ServicesHelpers;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Master\UserRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\SettingHotel;

class UserController extends Controller
{
    public function credentials_user($request, $password)
    {
        return [
            'email'          => $request->email,
            'password'       => $password,
        ];
    }

    public function credentials_profile($user_id, $request, $pict, $phone, $address)
    {
        return [
            'user_id'       => $user_id,
            'name'          => $request->name,
            'slug_name'     => str_slug($request->name),
            'phone'         => $phone,
            'address'       => $address,
            'pict'          => $pict
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

        $title = "Admin";
        $sub_title = "List Admin";
        $users = User::role('Admin')->get();
        return view('backend.master.user.main', compact('title', 'sub_title', 'users', 'apk_name', 'hotel_name', 'pict'));
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

        $title = "Admin";
        $sub_title = "Tambah Admin";
        $roles = Role::orderBy('name')->get();
        return view('backend.master.user.create', compact('title', 'sub_title', 'roles', 'apk_name', 'hotel_name', 'pict'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $user = User::create($this->credentials_user($request, bcrypt($request->password)));
        $pict = "default";
        $dir = public_path('storage/backend/user/');
        $slug = str_slug($request->name);

        ServicesHelpers::make_directory($dir);

        if($request->file('pict')) {
            $file = $request->file('pict');
            $pict = "pict-".$slug."-".time().".".$file->extension();
            ServicesHelpers::resize_image($file, 500, 500, $dir.$pict);
        }

        $user->assignRole($request->roles);
        $phone = "";
        $address = "";
        Profile::create($this->credentials_profile($user->id, $request, $pict, $phone, $address));
        notify()->success('Berhasil Menambah Admin.', 'Horayy !!');
        return redirect('/user');
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

        $title = "Pengaturan Akun";
        $sub_title = "Edit Akun";
        $staff = Profile::findOrFail($id);
        $roles = Role::orderBy('name')->get();
        $user = User::where('id', $staff->user_id)->first();
        return view('backend.staff.m_staff', compact('title', 'sub_title', 'staff', 'roles', 'user', 'apk_name', 'hotel_name', 'pict'));
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

        $title = "Admin";
        $sub_title = "Edit Admin";
        $roles = Role::orderBy('name')->get();
        $profile = Profile::findOrFail($id);
        $user = User::where('id', $profile->user_id)->first();
        return view('backend.master.user.edit', compact('title', 'sub_title', 'profile', 'roles', 'user', 'apk_name', 'hotel_name', 'pict'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $profile = Profile::findOrFail($id);
        $password = $profile->user->password;
        if($request->password) {
            $password = bcrypt($request->password);
        }
        $profile->user->update($this->credentials_user($request, $password));
        $profile->user->syncRoles($request->roles);

        $pict = $profile->pict;
        $dir = public_path('storage/backend/user/');
        $slug = str_slug($request->name);

        ServicesHelpers::make_directory($dir);

        if($request->file('pict')) {
            $file = $request->file('pict');
            $pict = "pict-".$slug."-".time().".".$file->extension();
            ServicesHelpers::resize_image($file, 500, 500, $dir.$pict);
        }

        $profile->update($this->credentials_profile($profile->user_id, $request, $pict, $request->phone, $request->address));
        notify()->success('Berhasil Mengubah Admin.', 'Horayy !!');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        notify()->success('Berhasil Menghapus Admin.', 'Horayy !!');
        return response()->json([
            'success' => 'Sukses Menghapus Data'
        ]);
    }


}
