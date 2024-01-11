<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id):View
    {
        $user = User::findOrFail($id);
        $data = [
            'pageTitle' => 'User Detail',
            'user' => $user,
        ];
        return view('admin.profile.userProfile',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id):View
    {
        $user = User::findOrFail($id);

        $data = [
            'pageTitle' => 'User Edit',
            'user' => $user,
        ];

        return view('admin.profile.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id):RedirectResponse
    {
        $user = User::findOrFail($id);
        $userImageFileName = $user->image;
        if ($request->hasFile('image')){
            $userImage = $request->file('image');
            $userImageFileName = 'user'.time() . '.' . $userImage->getClientOriginalExtension();
            if (!file_exists('assets/uploads/users')){
                mkdir('assets/uploads/users', 0777, true);
            }

            //delete old image if exist
            if (file_exists('assets/uploads/users/'.$user->image) and $user->image != 'default.png'){
                unlink('assets/uploads/users/'.$user->image);
            }
            $userImage->move('assets/uploads/users', $userImageFileName);
        }

        $profile =  $user->update([
            'name' => $request->name ,
            'email' => $request->email ,
            'image' => $userImageFileName,
        ]);

        if ($profile) {
            $request->session()->flash('success', setMessage('update', 'Profile'));
            return redirect()->route('admin.dashboard');
        } else {
            $request->session()->flash('error', setMessage('update.error', 'Profile'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(Request $request):RedirectResponse
    {
        $this->validate($request, [
            'password_confirmation' => 'required',
            'password' => 'required|confirmed',
        ]);

        $userPassword = $this->updatePassword($request);
        if ($userPassword) {
            $request->session()->flash('success', setMessage('update', 'User Password'));
            return redirect()->route('admin.dashboard');
        } else {
            $request->session()->flash('error', setMessage('update.error', 'User Password'));
            return redirect()->back();
        }
    }

    public function updatePassword($request){
        return User::where('id', $request->user_id)
            ->update(['password' => Hash::make($request->password)]);

    }
}
