<?php

use Illuminate\Support\Facades\Route;

use App\Room;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/play-with-friend', function () {
  return view('human', ['headTitle' => 'Play with friend', 'bodyClass' => 'home', 'roomCode' => '']);
});
Route::get('/', function () {
    return view('ai', ['headTitle' => 'Play', 'bodyClass' => 'home', 'roomCode' => '', 'level' => '3', 'levelTxt' => 'Normal']);
});
Route::get('/easiest', function () {
    return view('ai', ['headTitle' => 'Play - Easiest', 'bodyClass' => 'home', 'roomCode' => '', 'level' => '1', 'levelTxt' => 'Easiest']);
});
Route::get('/newbie', function () {
    return view('ai', ['headTitle' => 'Play - Newbie', 'bodyClass' => 'home', 'roomCode' => '', 'level' => '1', 'levelTxt' => 'Newbie']);
});
Route::get('/easy', function () {
    return view('ai', ['headTitle' => 'Play - Easy', 'bodyClass' => 'home', 'roomCode' => '', 'level' => '2', 'levelTxt' => 'Easy']);
});
Route::get('/normal', function () {
    return view('ai', ['headTitle' => 'Play - Normal', 'bodyClass' => 'home', 'roomCode' => '', 'level' => '3', 'levelTxt' => 'Normal']);
});
Route::get('/hard', function () {
    return view('ai', ['headTitle' => 'Play - Hard', 'bodyClass' => 'home', 'roomCode' => '', 'level' => '4', 'levelTxt' => 'Hard']);
});
Route::get('/hardest', function () {
    return view('ai', ['headTitle' => 'Play - Hardest', 'bodyClass' => 'home', 'roomCode' => '', 'level' => '5', 'levelTxt' => 'Hardest']);
});
Route::get('/about-us', function () {
    return view('about', ['headTitle' => 'About Us', 'bodyClass' => 'about', 'roomCode' => '']);
});
Route::get('/contact-us', function () {
    return view('contact', ['headTitle' => 'Contact Us', 'bodyClass' => 'contact', 'roomCode' => '']);
});
Route::get('/rooms', [
    "uses" => 'RoomController@index',
    "as" => 'index'
]);
Route::get('/room/{code}', function($code) {
  return view('roomHost', ['headTitle' => 'White - Room: '.$code, 'bodyClass' => 'room', 'roomCode' => $code, 'room' => App\Room::firstWhere('code', $code)]);
});
Route::get('/room/{code}/invited', function($code) {
  return view('roomGuest', ['headTitle' => 'Black - Room: '.$code, 'bodyClass' => 'room', 'roomCode' => $code, 'room' => App\Room::firstWhere('code', $code)]);
});
Route::get('/room/{code}/white', function($code) {
  return view('roomWhite', ['headTitle' => 'White - Room: '.$code, 'bodyClass' => 'room', 'roomCode' => $code, 'room' => App\Room::firstWhere('code', $code)]);
});
Route::get('/room/{code}/black', function($code) {
  return view('roomBlack', ['headTitle' => 'Black - Room: '.$code, 'bodyClass' => 'room', 'roomCode' => $code, 'room' => App\Room::firstWhere('code', $code)]);
});
Route::post('/createRoom', [
  "uses" => 'RoomController@create',
  "as" => 'create'
]);
Route::get('/getPass/{code}', [
  "uses" => 'RoomController@getPass',
  "as" => 'getPass'
]);
Route::post('/changePass', [
  "uses" => 'RoomController@changePass',
  "as" => 'changePass'
]);
Route::post('/updateFEN', [
  "uses" => 'RoomController@store',
  "as" => 'store'
]);
Route::post('/setWhiteName', [
  "uses" => 'RoomController@setWhiteName',
  "as" => 'setWhiteName'
]);
Route::post('/setBlackName', [
  "uses" => 'RoomController@setBlackName',
  "as" => 'setBlackName'
]);
Route::get('/readFEN/{code}', [
  "uses" => 'RoomController@show',
  "as" => 'show'
]);
Route::post('/processMail', [
  "uses" => 'MailController@send',
  "as" => 'send'
]);