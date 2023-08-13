<?php 

namespace App\Repositories;

use App\Models\News;
use App\Events\NewsCreated;
use App\Events\NewsUpdated;
use App\Events\NewsDeleted;

class NewsRepository
{
    public function createNews($request) {
        $news = News::create($request);
        event(new NewsCreated($news));
    }

    public function updateNews($request, $id) {
        $news = News::findOrFail($id);
        $news->update($request);
        event(new NewsUpdated($news));
    }

    public function deleteNews($id) {
        $news = News::findOrFail($id);
        $news->delete();
        event(new NewsDeleted($news));
    }
}