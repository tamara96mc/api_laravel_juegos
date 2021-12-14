<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Player;

class PlayerController extends Controller
{
    //Listar todos los usuarios
    
    public function allPlayers(){
        try {

            $players = Player::all();
            return $players;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];

            if($codError){
                return "Error $codError";
            }

        }
    }

    // Buscar usuario por id
    public function playerById(Request $request){

        $id = $request->input('id');

        try {
            $player = Player::all()->where('id', "=", $id);
            return $player;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];

            if($codError){
                return "Error $codError";
            }
        }
    }

    //Crear nuevo usuario
    public function newPlayer (Request $request){

        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');
        $steamUsername = $request->input('steamUsername');

        try {

            return Player::create(
                [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'role' => $role,
                    'steamUsername' => $steamUsername
                ]
            );

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];

            if($codError){
                return "Error $codError";
            }
            
        }
    }

    //Actualizar usuario
    public function playerUpdate (Request $request){

        $id = $request->input('id');
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');
        $steamUsername = $request->input('steamUsername');
    

        try {

            $player = Player::where('id', '=', $id)
            ->update(
                [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'role' => $role,
                    'steamUsername' => $steamUsername
                ]
            );
            return Player::all()->where('id', "=", $id);

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];

            if($codError){
                return "Error $codError";
            }

        }
    }

    // Borrar un usuario
    public function playerDelete(Request $request){

        $id = $request->input('id');

        try {
            
            $findPlayer = Player::all()->where('id', '=', $id);

            $player = Player::where('id', '=', $id);
            
            if (count($findPlayer) == 0) {
                return response()->json([
                    "msg" => "Usuario no encontrado"
                ]);
            }else{
                $player->delete();
                return response()->json([
                    "data" => $findPlayer,
                    "msg" => "Usuario borrado"
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