<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Party;

class PartyController extends Controller
{
    //Listar todas las partidas
    public function allParties(){
        try {

            $parties = Party::all();
            return $parties;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

    // Buscar partida por id
    public function partyById(Request $request){

        $id = $request->input('id');

        try {

            $party = Party::all()->where('id', "=", $id);
            return $party;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }
        }
    }


    //Crear partida
    public function newParty (Request $request){

        $name = $request->input('name');
        $userId = $request->input('userId');
        $gameId = $request->input('gameId');

        try {

            return Party::create(
                [
                    'name' => $name,
                    'gameId' => $gameId,
                    'userId' => $userId
                    
                ]
            );

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }
            
        }
    }

    // Modificar partida
    public function updateParty (Request $request){

        $id = $request->input('id');
        $name = $request->input('name');
        $userId = $request->input('userId');
        $gameId = $request->input('gameId');

        try {

            $party = Party::where('id', '=', $id)
            ->update(
                [
                    'name' => $name,
                    'userId' => $userId,
                    'gameId' => $gameId
                ]
            );
            return Party::all()
            ->where('id', "=", $id);

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

    // Borrar partida
    public function deleteParty(Request $request){

        $id = $request->input('id');

        try {
            $findParty = Party::all()
            ->where('id', '=', $id);

            $party = Party::where('id', '=', $id);
            
            if (count($findParty) == 0) {
                return response()->json([
                    "msg" => "Partida no escontrada"
                ]);
            }else{
                $party->delete();
                return response()->json([
                    "data" => $findParty,
                    "msg" => "Partida borrada"
                ]);
            }

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }
}