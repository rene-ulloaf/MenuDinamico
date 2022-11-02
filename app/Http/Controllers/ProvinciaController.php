<?php

namespace App\Http\Controllers;

use Log;
use App\Modelos\Provincia;

class ProvinciaController extends Controller {
    public function lista($idRegion){
        try {
            $provincias = Provincia::where("idRegion", $idRegion)->select("idProvincia", "nombre")->get();

            return response()->json(['provincias' => $provincias], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return Response()->json(['provincias' => []], 500);
        }
    }
}