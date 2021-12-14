<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Member;

class MemberController extends Controller
{
    //Listar todos los miembros
    public function Allmembers(){
        try {

            $members = Member::all();
            return $members;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

    // Buscar miembro por id 
    public function memberById(Request $request){

        $id = $request->input('id');

        try {

            $member = Member::all()->where('id', "=", $id);
            return $member;

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }
        }
    }


    //Crear miembro
    public function newMember (Request $request){

        $partyId = $request->input('partyId');
        $playerId = $request->input('playerId');

        try {

            return Member::create(
                [
                    'partyId' => $partyId,
                    'playerId' => $playerId
                ]
            );

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            } 
        }
    }

    //Modificar miembro
    public function updateMember (Request $request){

        $id = $request->input('id');
        $partyId = $request->input('partyId');
        $playerId = $request->input('playerId');

        try {

            $member = Member::where('id', '=', $id)
            ->update(
                [
                    'partyId' => $partyId,
                    'playerId' => $playerId
                ]
            );
            return Member::all()->where('id', "=", $id);

        } catch (QueryException $error) {

            $codError = $error->errorInfo[1];
            if($codError){
                return "Error $codError";
            }

        }
    }

    //Borrar miembro
    public function deleteMember(Request $request){

        $id = $request->input('id');

        try {
            
            $findMember = Member::all()->where('id', '=', $id);

            $member = Member::where('id', '=', $id);
            
            if (count($findMember) == 0) {
                return response()->json([
                    "msg" => "Miembro no entrado"
                ]);
            }else{
                $member->delete();
                return response()->json([
                    "data" => $findMember,
                    "msg" => "Miembro borrado"
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