<?php

namespace App\Http\Controllers;

use DB;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = DB::table('rooms')->get();
        return view('roomList', ['headTitle' => 'Rooms', 'bodyClass' => 'room', 'rooms' => Room::all(), 'roomCode' => '', 'langUrl' => '/danh-sach-phong']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $code = $request->input('room-code');
        $fen = $request->input('FEN');
        $pass = $request->input('pass');
        DB::table('rooms')
            ->updateOrInsert(
            ['code' => $code],
            ['fen' => $fen, 'pass' => $pass, 'modified_at' => time()]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = $request->input('room-code');
        $fen = $request->input('FEN');
        DB::table('rooms')
            ->updateOrInsert(
            ['code' => $code],
            ['fen' => $fen, 'modified_at' => time()]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setWhiteName(Request $request)
    {
        $code = $request->input('room-code');
        $whiteName = $request->input('white-name');
        DB::table('rooms')
            ->updateOrInsert(
            ['code' => $code],
            ['white_name' => $whiteName]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setBlackName(Request $request)
    {
        $code = $request->input('room-code');
        $blackName = $request->input('black-name');
        DB::table('rooms')
            ->updateOrInsert(
            ['code' => $code],
            ['black_name' => $blackName]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room, $code)
    {
        $fenJson = DB::table('rooms')
                ->select('fen')
                ->where('code', '=', $code)
                ->get();
        $fen = json_decode($fenJson, true);
        return $fen[0]['fen'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function getPass(Room $room, $code)
    {
        $passJson = DB::table('rooms')
                ->select('pass')
                ->where('code', '=', $code)
                ->get();
        $pass = json_decode($passJson, true);
        return $pass[0]['pass'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function changePass(Request $request, Room $room)
    {
        $code = $request->input('room-code');
        $pass = $request->input('pass');
        if (!$request->input('pass') || $pass === '') {
            echo json_encode(array('message' => 'Password cannot be empty', 'code' => 0));
            exit();
        } else {
            DB::update('update rooms set pass = ? where code = ?', [$pass, $code]);
            echo json_encode(array('message' => 'Changed password successfully!', 'code' => 1));
            exit();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
