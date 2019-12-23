<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function index()
    {
        $users = User::with(['profile.country', 'roles'])->get();
        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $countries = Country::all();

        return  view('admin.pages.user.create', compact('roles', 'countries'));
    }



    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'country_id' => 'required',
            'avatar' => 'nullable',
            'role_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $user = User::create($user);

        if ($request->hasFile('avatar')){
            $setname = sprintf('avatar_%s.png', random_int(1,1000));
            $path = $request->file('avatar')->storeAs('profiles', $setname, 'public');
        }else{
            $path = 'profiles/default.png';
        }

        if ($user){
             UserProfile::create([
                'user_id' => $user->id,
                'country_id' => $request->country_id,
                'phone' => $request->phone,
                'address' => $request->address,
                'avatar' => $path,
            ]);
            $user->roles()->attach($request->role_id);

            return redirect()->route('users.index');
        }
    }



    public function show($id)
    {
        echo "Comming soon....";
    }



    public function edit($id)
    {
        $roles = Role::all();
        $countries = Country::all();
        $user = User::with(['profile', 'roles'])->findOrFail($id);
        return  view('admin.pages.user.edit', compact('roles', 'countries', 'user'));
    }



    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'email'  => 'required|unique:users,email,'.$id,
            'country_id' => 'required',
            'avatar' => 'nullable',
            'role_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;

        $user->email = $request->email;

        $userSave = $user->save();

        if ($request->hasFile('avatar')){

            if (Storage::disk('public')->exists($user->profile->avatar)){

                Storage::disk('public')->delete($user->profile->avatar);
            }

            $setname = sprintf('avatar_%s.png', random_int(1,1000));

            $path = $request->file('avatar')->storeAs('profiles', $setname, 'public');

        }else{

            $path = $user->profile->avatar;
        }

        if ($userSave){

           $profile = [
                'country_id' => $request->country_id,
                'phone' => $request->phone,
                'address' => $request->address,
                'avatar' => $path,
            ];

           $user->profile()->update($profile);

           $user->roles()->sync($request->role_id);

            return redirect()->route('users.index')->with('success', 'User updated success ! ');
        }


    }



    public function destroy($id)
    {
        $user = User::find($id);
        if (Storage::disk('public')->exists($user->profile->avatar)){

            Storage::disk('public')->delete($user->profile->avatar);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted success !');
    }
}
