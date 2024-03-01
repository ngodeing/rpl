<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'username' => 'required|string', // Menambahkan validasi untuk username
        ]);

        // Cari pengguna berdasarkan username atau buat pengguna baru jika belum ada
        
            $user = User::firstOrCreate(['name' => $request->input('username')]);
        
        

        // Membuat komentar baru
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = $user->id; // Menggunakan id pengguna yang ditemukan atau baru dibuat

        // Menyimpan komentar
        $comment->save();

        // Redirect ke halaman post dengan pesan sukses
        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment added successfully.');
    }
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->content = $request->content;
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
