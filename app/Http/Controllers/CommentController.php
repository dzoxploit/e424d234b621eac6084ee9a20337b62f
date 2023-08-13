<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\News;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request, $newsId) {
        $news = News::findOrFail($newsId);

        $comment = new Comments();
        $comment->user_id = Auth::user()->id;
        $comment->news_id = $news->id;
        $comment->content = $request->input('content');
        $comment->save();

        return response()->json(['message' => 'Comment posted successfully']);
    }
}
