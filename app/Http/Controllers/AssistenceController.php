<?php

namespace App\Http\Controllers;

use App\Assistence;
use Illuminate\Http\Request;

class AssistenceController extends Controller {

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
        try {
            $assit = new Assistence();
            $assit->id_usuario = $request->id_usuario;
            $assit->id_ficha = $request->id_ficha;
            if ($request->asistio) {
                $assit->asistio = false;
            } else {
                $assit->asistio = $request->asistio;
            }
            $assit->codigo = str_random(5);
            $assit->saveOrFail();
            return response()->json(['codigo' => $assit->codigo], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assistence  $assistence
     * @return \Illuminate\Http\Response
     */
    public function show(Assistence $assistence) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assistence  $assistence
     * @return \Illuminate\Http\Response
     */
    public function edit(Assistence $assistence) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assistence  $assistence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assistence $assistence) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assistence  $assistence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assistence $assistence) {
        //
    }

    public function config(Request $request) {
        $ass = Assistence::where('id_usuario', $request->id)->first();
        if ($ass->codigo == $request->codigo) {
            $ass->asistio = true;
            $ass->save();
            return response()->json(['message' => 'Confirmacion correcta'], 200);
        } else {
            return response()->json(['message' => 'Codigo incorrecto'], 500);
        }
    }

    public function inasistencia(Request $request) {
        $meses = [];
        for ($i = 1; $i <= 12; $i++) {
            $app = Assistence::whereMonth('created_at', $i)->where('id_ficha', $request->id)->get()->count();
            array_push($meses, $app);
        }
        return response()->json($meses, 200);
    }

}
