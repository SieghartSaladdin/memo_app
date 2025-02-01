<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MemoResource;

class MemoController extends Controller
{
    public function index()
    {
        try {
            $memos = DB::table('memo')->get();
            return response()->json(['success' => true, 'data' => $memos]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) 
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required'
            ]);

            DB::table('memo')->insert([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['success' => true, 'message' => 'Data Berhasil Dibuat']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $memo = DB::table('memo')->where('id', $id);

            if ($memo->exists()) {
                $memo->delete();
                return response()->json(['success' => true, 'message' => 'Data Berhasil Dihapus']);
            }
            return response()->json(['success' => false, 'message' => 'Data Tidak Ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function toggleArsip($id)
    {
        try {
            $memo = DB::table('memo')->where('id', $id)->first();

            if ($memo) {
                $arsipStatus = !$memo->arsip;
                DB::table('memo')->where('id', $id)->update(['arsip' => $arsipStatus]);
                return response()->json(['success' => true, 'message' => 'Status arsip berhasil diubah', 'arsip' => $arsipStatus]);
            }
            return response()->json(['success' => false, 'message' => 'Data Tidak Ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
