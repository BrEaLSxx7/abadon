<?php

namespace App\Http\Controllers;

use App\Authentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthenticationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Authentication  $authentication
     * @return \Illuminate\Http\Response
     */
    public function show(Authentication $authentication) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Authentication  $authentication
     * @return \Illuminate\Http\Response
     */
    public function edit(Authentication $authentication) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Authentication  $authentication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Authentication $authentication) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Authentication  $authentication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Authentication $authentication) {
        //
    }

    public function auth(Request $request) {
        try {
            $auth = Authentication::where('usuario', $request->usuario)->firstOrFail();
            if (Hash::check($request->contrasena, $auth->contrasena)) {
                $data = User::where('id', $auth->id_usuario)->firstOrFail();
                return response()->json(['message' => 'Sesión iniciada', 'datos' => $data, 'id_rol' => $auth->id_rol], 200);
            } else {
                return response()->json(['message' => 'Datos incorrectos'], 401);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['laravel' => $ex->getMessage(), 'message' => 'Datos incorrectos'], 500);
        }
    }

}
