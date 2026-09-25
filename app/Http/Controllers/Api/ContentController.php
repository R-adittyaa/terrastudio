<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\Chapter;
use App\Models\Comment;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    // Fetch semua daftar karya (views & chapter count murni dari DB)
    public function getWorks()
    {
        $works = Work::withCount('chapters')->latest()->get();
        return response()->json(['status' => 'success', 'data' => $works]);
    }

    // Fetch detail karya + list bab-nya
    public function getWorkDetail($id)
    {
        $work = Work::with('chapters')->findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $work]);
    }

    // Fetch isi bab spesifik + Tambah views karya secara real-time
    public function getChapter($id)
    {
        $chapter = Chapter::with(['work', 'comments'])->findOrFail($id);
        
        // Auto Increment Views di parent Work secara akurat
        $chapter->work()->increment('views');

        return response()->json(['status' => 'success', 'data' => $chapter]);
    }

    // Like Bab (Validasi Backend)
    public function likeChapter($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->increment('likes');
        return response()->json([
            'status' => 'success', 
            'likes'  => $chapter->likes,
            'message' => 'Terima kasih atas apresiasimu!'
        ]);
    }

    // Kirim Komentar di Bab
    public function storeComment(Request $request, $chapterId)
    {
        $request->validate([
            'username' => 'required|string|max:30',
            'comment'  => 'required|string|max:300',
        ]);

        $comment = Comment::create([
            'chapter_id' => $chapterId,
            'username'   => strip_tags($request->username),
            'comment'    => strip_tags($request->comment),
        ]);

        return response()->json(['status' => 'success', 'data' => $comment], 201);
    }

    // Admin: Bikin Karya / Buku Baru
    // Admin: Bikin Karya / Buku Baru + Support Gambar
    public function storeWork(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:100',
            'synopsis'    => 'required|string',
            'genre'       => 'required|string',
            'type'        => 'required|in:novel,poetry,short_story,essay',
            'cover_image' => 'nullable|url',
        ]);

        $work = Work::create([
            'title'       => $request->title,
            'slug'        => \Illuminate\Support\Str::slug($request->title) . '-' . time(),
            'synopsis'    => $request->synopsis,
            'genre'       => $request->genre,
            'type'        => $request->type,
            'cover_image' => $request->cover_image,
            'status'      => 'ongoing',
            'views'       => 0,
        ]);

        return response()->json(['status' => 'success', 'data' => $work], 201);
    }

    // Admin: Bikin Bab / Chapter Baru
    public function storeChapter(Request $request)
    {
        $request->validate([
            'work_id'        => 'required|exists:works,id',
            'title'          => 'required|string|max:100',
            'chapter_number' => 'required|integer',
            'content'        => 'required|string',
        ]);

        $wordCount = str_word_count(strip_tags($request->content));
        $readingTime = max(1, ceil($wordCount / 200));

        $chapter = Chapter::create([
            'work_id'              => $request->work_id,
            'title'                => $request->title,
            'slug'                 => \Illuminate\Support\Str::slug($request->title) . '-' . time(),
            'chapter_number'       => $request->chapter_number,
            'content'              => $request->content,
            'reading_time_minutes' => $readingTime,
            'likes'                => 0, // Murni dari nol
        ]);

        return response()->json(['status' => 'success', 'data' => $chapter], 201);
    }
}