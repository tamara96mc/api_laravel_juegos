<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Message;

class MessageController extends Controller
{
    // Listar todos los mensajes
    public function allMessages(){
        try {

            $messages = Message::all();
            return $messages;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

    //Buscar mensaje por id
    public function messageById(Request $request){

        $id = $request->input('id');

        try {

            $message = Message::all()->where('id', "=", $id);
            return $message;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }
        }
    }

    // Crear mensaje
    public function newMessage (Request $request){

        $message = $request->input('message');
        $date = $request->input('date');
        $fromPlayer = $request->input('fromPlayer');
        $partyId = $request->input('partyId');

        try {

            return Message::create(
                [
                    'message' => $message,
                    'date' => $date,
                    'fromPlayer' => $fromPlayer,
                    'partyId' => $partyId
                ]
            );

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }
            
        }
    }

    //Modificar mensaje
    
    public function updateMessage (Request $request){

        $id = $request->input('id');
        $message = $request->input('message');
        $date = $request->input('date');
        $fromPlayer = $request->input('fromPlayer');
        $partyId = $request->input('partyId');

        try {

            $message = Message::where('id', '=', $id)
            ->update(
                [
                    'message' => $message,
                    'date' => $date,
                    'fromPlayer' => $fromPlayer,
                    'partyId' => $partyId
                ]
            );
            return Message::all()->where('id', "=", $id);

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

    // Borrar mensaje
    public function deleteMessage(Request $request){

        $id = $request->input('id');

        try {

            $findMessage = Message::all()->where('id', '=', $id);

            $message = Message::where('id', '=', $id);
            
            if (count($findMessage) == 0) {
                return response()->json([
                    "msg" => "Mensaje no encontado"
                ]);
            }else{
                $message->delete();
                return response()->json([
                    "data" => $findMessage,
                    "msg" => "Mensaje borrado"
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