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
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->modelNotFound();
        }

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
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'confirmed|min:6',
        ]);

        $user = User::find($id);

        if (is_null($user)) {
            return $this->modelNotFound();
        }

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
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->modelNotFound();
        }

        $user->delete();

        return $this->modelDeleted();
    }
}
