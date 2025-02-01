<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MemoResource;

class MemoController extends Controller
{
    public function index()
    {
        $memos = DB::table('memo')->get();
        return MemoResource::collection($memos);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'title',
            'description'
        ]);

        DB::table('memo')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json('Data Berhasil Di Buat');
    }

    public function destroy($id)
    {
        $memo = DB::table('memo')->where('id', $id);

        if ($memo->exists()) {
            $memo->delete();
            return response()->json('Data Berhasil Dihapus');
        }

        return response()->json('Data Tidak Ditemukan', 404);
    }

    public function toggleArsip($id)
    {
        $memo = DB::table('memo')->where('id', $id)->first();

        if ($memo) {
            $arsipStatus = !$memo->arsip;
            DB::table('memo')->where('id', $id)->update(['arsip' => $arsipStatus]);
        }
    }

}
