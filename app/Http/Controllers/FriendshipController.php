<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Friendship;

class FriendshipController extends Controller
{
    // Listar todos los friendships
     public function allFriendships(){
        try {

            $friendships = Friendship::all();
            return $friendships;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

   //Buscar friendship por id 
    public function friendshipById(Request $request){

        $id = $request->input('id');

        try {

            $friendship = Friendship::all()->where('id', "=", $id);
            return $friendship;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }
        }
    }

    

    // Crear friendship
     public function newFriendship (Request $request){

        $Player1_ID = $request->input('player1Id');
        $Player2_ID = $request->input('player2Id');

        try {

            return Friendship::create(
                [
                    'player1Id' => $Player1_ID,
                    'player2Id' => $Player2_ID
                ]
            );

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }
            
        }
    }

    //Mofidicar friendship
    public function UpdateFriendship (Request $request){

        $id = $request->input('id');
        $player1Id = $request->input('player1Id');
        $player2Id = $request->input('player2Id');

        try {

            $friendship = Friendship::where('id', '=', $id)
            ->update(
                [
                    'player1Id' => $player1Id,
                    'player2Id' => $player2Id
                ]
            );
            return Friendship::all()
            ->where('id', "=", $id);

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

    // Borrar friendship
    public function friendshipDelete(Request $request){

        $id = $request->input('id');

        try {
            
            $arrayFriendship = Friendship::all()->where('id', '=', $id);

            $frienship = Friendship::where('id', '=', $id);
            
            if (count($arrayFriendship) == 0) {
                return response()->json([
                    "msg" => "friendship no encontrado"
                ]);
            }else{
                $frienship->delete();
                return response()->json([
                    "data" => $arrayFriendship,
                    "msg" => "Friendship borrado"
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