<?php

namespace App\Http\Controllers;

use Log;
use App\Modelos\Comuna;

class ComunaController extends Controller {
    public function lista($idProvincia){
        try {
            $comunas = Comuna::where("idProvincia", $idProvincia)->select("idComuna", "nombre")->get();
            //return Response::json(['comunas' => $comunas], 200);
            return response()->json(['comunas' => $comunas], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return Response()->json(['comunas' => []], 500);
        }
    }
}