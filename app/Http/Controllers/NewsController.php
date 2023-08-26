<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepository;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Auth;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsRepo;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepo = $newsRepo;
    }

    public function indexUser(Request $request) {
        
        if($request->get('category') != null){
            $news = News::with('penulis','comments','kategori','artis')->where('kategori_id',$request->get('category'))->paginate(10); 
        }

        if($request->get('artis') != null){
            $news = News::with('penulis','comments','kategori','artis')->where('kategori_id',$request->get('artis'))->paginate(10); 
        }

        $news = News::with('penulis','comments','kategori','artis')->paginate(10); // You can adjust the number of news per page

        return response()->json($news);
    }

    public function detailNews($newsId) {
        $news = News::with('penulis','comments','kategori','artis')->where('id',$newsId)->firstOrFail(); // You can adjust the number of news per page
        return response()->json($news);
    }

    public function indexPenulis() {
        $news = News::paginate(10); // You can adjust the number of news per page

        return response()->json($news);
    }

    public function createPenulis(NewsRequest $request) {
        
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
            $validatedData['image'] = $imagePath;
        }
        
        $validatedData['penulis_id'] = Auth::user()->id;

        $this->newsRepo->createNews($validatedData);
        return response()->json
        (['message' => 'News created successfully']);
    }

    public function update(NewsRequest $request, $id) {
        $news = News::findOrFail($id);

        $validatedData = $request->validated();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['penulis_id'] = Auth::user()->id;
        
        $this->newsRepo->updateNews($validatedData, $id);
        
        return response()->json(['message' => 'News updated successfully']);
    }

    public function delete($id) {
        $this->newsRepo->deleteNews($id);
        return response()->json(['message' => 'News deleted successfully']);
    }

    public function show($filename)
    {
        $path = $filename; // Update the path based on your storage configuration

        if (Storage::exists($path)) {
            $file = Storage::get($path);
            $type = Storage::mimeType($path);

            return response($file, 200)->header('Content-Type', $type);
        } else {
            abort(404);
        }
    }
}
