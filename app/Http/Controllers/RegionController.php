<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Support\Facades\Response;
use App\Modelos\Region;

class RegionController extends Controller {
    public function lista($idPais){
        try {
            $regiones = Region::where("idPais", $idPais)->select("idRegion", "nombre")->get();

            return Response::json(['regiones' => $regiones], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return Response()->json(['regiones' => []], 500);
        }
    }
}