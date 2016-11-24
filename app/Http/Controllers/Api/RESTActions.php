<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait RESTActions
{
    use ApiResponse;

    public function all()
    {
        $m = self::MODEL;

        return $this->response(Response::HTTP_OK, $m::all());
    }

    public function get($id)
    {
        $m = self::MODEL;

        $model = $m::find($id);

        if (is_null($model)) {
            return $this->response(Response::HTTP_NOT_FOUND);
        }

        return $this->response(Response::HTTP_OK, $model);
    }

    public function store(Request $request)
    {
        $m = self::MODEL;

        if (isset($m::$rules)) {
            $this->validate($request, $m::$rules);
        }

        return $this->response(Response::HTTP_CREATED, $m::create($request->all()));
    }

    public function update(Request $request, $id)
    {
        $m = self::MODEL;

        if (isset($m::$rules)) {
            $this->validate($request, $m::$rules);
        }

        $model = $m::find($id);

        if (is_null($model)) {
            return $this->response(Response::HTTP_NOT_FOUND);
        }

        $model->update($request->all());

        return $this->response(Response::HTTP_OK, $model);
    }

    public function destroy($id)
    {
        $m = self::MODEL;

        if (is_null($m::find($id))) {
            return $this->response(Response::HTTP_NOT_FOUND);
        }

        $m::destroy($id);

        return $this->response(Response::HTTP_NO_CONTENT);
    }
}
