<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Game;

class GameController extends Controller
{
    //Listar todos los juegos
    public function allGames(){
        try {

            $games = Game::all();
            return $games;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

    // Buscar juego por id
    public function gameById(Request $request){

        $id = $request->input('id');

        try {
            $game = Game::all()->where('id', "=", $id);
            return $game;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }
        }
    }

    //C
    public function newGame (Request $request){

        $title = $request->input('title');
        $thumbnail_url = $request->input('thumbnail_url');
        $url = $request->input('url');

        try {

            return Game::create(
                [
                    'title' => $title,
                    'thumbnail_url' => $thumbnail_url,
                    'url' => $url
                ]
            );

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }
            
        }
    }

    //
    public function updateGame (Request $request){

        $id = $request->input('id');
        $title = $request->input('title');
        $thumbnail_url = $request->input('thumbnail_url');
        $url = $request->input('url');

        try {

            $game = Game::where('id', '=', $id)
            ->update(
                [
                    'title' => $title,
                    'thumbnail_url' => $thumbnail_url,
                    'url' => $url
                ]
            );
            return Game::all()
            ->where('id', "=", $id);

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

    //Borrar juego 
    public function deleteGame(Request $request){

        $id = $request->input('id');

        try {
            $findGame = Game::all()->where('id', '=', $id);

            $game = Game::where('id', '=', $id);
            
            if (count($findGame) == 0) {
                return response()->json([
                    "msg" => "Juego no encontrado"
                ]);
            }else{
                $game->delete();
                return response()->json([
                    "data" => $findGame,
                    "mdg" => "Juego borrado"
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