<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();
        return response([
            'success' => true,
            'message' => "List semua post",
            'data' => $posts,
            'code' => 200,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'content' => 'required',
            ],
            [
                'title.required' => 'Masukan Title Post!',
                'content.required' => 'Masukan Content Post!',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan Isi Bidang Yang Kosong',
                'data' => $validator->errors(),
                'code' => 401
            ], 401);
        } else {
            $post = Post::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                    'code' => 200,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Disimpan!',
                    'code' => 401,
                ], 401);
            }
        }
    }

    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data' => $post,
                'code' => 200
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post tidak ditemukan!',
                'data' => '',
                'code' => 401
            ], 401);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Masukan Title Post!',
                'content.required' => 'Masukan Content Post!'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan isi bidang yang kosong',
                'data' => $validator->errors(),
                'code' => 401
            ], 401);
        } else {
            $post = Post::whereId($request->input('id'))->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil diupdate',
                    'code' => 200
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal diupdate',
                    'code' => 401
                ], 401);
            }
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post berhasil dihapus',
                'code' => 200,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post gagal dihapus',
                'code' => 401,
            ], 401);
        }
    }
}
