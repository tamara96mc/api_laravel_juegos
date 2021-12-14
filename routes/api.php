<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//IMPORTO CONTROLLERS
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FriendshipController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//EndPoints de autentificador

Route::post('register', [AuthController::class, "register"]);
Route::post('login', [AuthController::class, "Login"]);

Route::middleware('auth:api')->group(function () {
  
    //EndPoints de usuarios
  
    Route::get('allPlayers', [PlayerController::class, "allPlayers"]); //Listar todos los usuarios
    Route::post('playerById', [PlayerController::class, "playerById"]); //Buscar usuario por id
    Route::post('newPlayer', [PlayerController::class, "newPlayer"]); //Crear usuario
    Route::put('updatePlayer', [PlayerController::class, "updatePlayer"]); //Modificar usuario
    Route::delete('deletePlayer', [PlayerController::class, "deletePlayer"]); //Borrar usuario

    //EndPoints de game
  
    Route::get('allGames', [GameController::class, "allGames"]); //listar todos los juegos
    Route::post('gameById', [GameController::class, "gameById"]); //Buscar juego por id
    Route::post('newGame', [GameController::class, "newGame"]); //Crear juego
    Route::put('updateGame', [GameController::class, "updateGame"]); //Modificar juego
    Route::delete('deleteGame', [GameController::class, "deleteGame"]); //Borrar juego

    //EndPoints de party

    Route::get('allParties', [PartyController::class, "allParties"]); //Listar todas las partidas
    Route::post('partyById', [PartyController::class, "partyById"]); //Buscar partida por id
    Route::post('newParty', [PartyController::class, "newParty"]); // Crear partida
    Route::put('updateParty', [PartyController::class, "partyUpdate"]); //Modificar partida
    Route::delete('deleteParty', [PartyController::class, "partyDelete"]); //Borrar partida

     //EndPoints de message

    Route::get('allMessages', [MessageController::class, "allMessages"]); //Listar todos los mensajes
    Route::post('messageById', [MessageController::class, "messageById"]); //Buscar todos los msg por id
    Route::post('newMessage', [MessageController::class, "newMessage"]); //Crear mensaje
    Route::put('updateMessage', [MessageController::class, "updateMessage"]); //Mofificar mensaje
    Route::delete('deleteMessage', [MessageController::class, "deleteMessage"]); //Borrar mensaje


    //ENDPOINTS de friendship
  

    Route::get('allFriendships', [FriendshipController::class, "allFriendships"]);
    Route::post('friendshipById', [FriendshipController::class, "friendshipById"]);
    Route::post('newFriendship', [FriendshipController::class, "newFriendship"]);
    Route::put('updateFriendship', [FriendshipController::class, "updateFriendship"]);
    Route::delete('deleteFriendship', [FriendshipController::class, "deleteFriendship"]);

   
    //ENDPOINTS de menber

    Route::get('allMembers', [MemberController::class, "allMembers"]);
    Route::post('memberById', [MemberController::class, "memberById"]);
    Route::post('newMember', [MemberController::class, "newMember"]);
    Route::put('updateMember', [MemberController::class, "updateMember"]);
    Route::delete('deleteMember', [MemberController::class, "deleteMember"]);

    
});