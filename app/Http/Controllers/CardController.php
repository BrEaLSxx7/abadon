<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Authentication;
use App\DocumentType;
use App\Gender;
use Illuminate\Support\Facades\Hash;

class CardController extends Controller {

    private $excel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(Card::all(), 200);
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
            if ($request->hasFile('formato')) {
                $ficha = new Card();
                $ficha->nombre = $request->nombre_ficha;
                $ficha->numero = $request->numero_ficha;
                $ficha->descripcion = $request->descripcion;
                $ficha->saveOrFail();
                $path = $request->file('formato')->store('aprendices');
                $name = './../storage/app/' . $path;
                $this->leer($name);
                foreach ($this->excel as $row) {
                    $user = $this->addUser($row, $ficha->id);
                    $this->addAuth($user->numero_documento, $user->id);
                }
                return response()->json(['message' => 'Agregado correctamente'], 200);
            } else {
                return response()->json(['message' => 'Falta el formato'], 404);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    private function leer(string $name) {
        Excel::load($name, function ($reader) {
            $excel = $reader->get();
            $this->setExcel($excel);
        });
    }

    private function addUser($row, $id) {
        $user = new User();
        $user->nombre = $row->nombre_completo;
        $user->correo = $row->correo;
        $user->numero_documento = $row->numero_documento;
        $user->telefono = $row->telefono;
        $user->id_ficha = $id;
        $tpd = DocumentType::where('nombre', $row->tipo_documento)->firstOrFail();
        $user->tipo_documento = $tpd->id;
        $gen = Gender::where('nombre', $row->genero)->firstOrFail();
        $user->genero = $gen->id;
        $user->save();
        return $user;
    }

    private function addAuth($numero, $id) {
        $auth = new Authentication();
        $auth->usuario = $numero;
        $auth->contrasena = Hash::make($numero);
        $auth->id_rol = 2;
        $auth->id_usuario = $id;
        $auth->save();
    }

    private function setExcel($excel) {
        $this->excel = $excel;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card) {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card) {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card) {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card) {
//
    }

}
