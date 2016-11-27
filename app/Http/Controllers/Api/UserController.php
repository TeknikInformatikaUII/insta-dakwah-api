<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $this->authorize('users.view');

        return $this->ok(User::all());
    }

    /**
     * Display specific user in storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function get(User $user)
    {
        $this->authorize('view', $user);

        return $this->ok($user);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('users.create');

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
        ]);

        $request->merge([
            'password' => bcrypt($request->password),
        ]);

        $user = User::create($request->all());

        return $this->ok($user);
    }

    /**
     * Update specific user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'confirmed|min:6',
        ]);

        if ($request->has('password')) {
            $request->merge([
                'password' => bcrypt($request->password),
            ]);
        }

        $user->update($request->all());

        return $this->ok($user);
    }

    /**
     * Destroy specific user in storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return $this->modelDeleted();
    }
}
