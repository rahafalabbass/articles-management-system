<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    use GeneralTrait;


    public function getArticles(){
        try{
            $userId = Auth::user()->id;

            $articles = Article::with('images')->where('user_id', $userId)->paginate(5);
            
            $data = ArticleResource::collection($articles);

            $meta = [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
            ];

            $response = [
                'data' => $data,
                'meta' => $meta,
            ];

            return $this->buildResponse($response,'Success','These are your articles',200);
        }catch(\Exception $ex){
            return $this->buildResponse($ex,'Error','Faild to get data!',400);
        }
    }


    


    public function addArticle(ArticleRequest $request){
        DB::beginTransaction();
        try {
            $userId = Auth::id();

            $article = Article::create([
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
                'user_id' => $userId,
            ]);

            $images = $request->file('images');
            if ($request->hasFile('images') && is_array($images)) {
                foreach ($images as $image) {

                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('articles'), $fileName);

                    $article->images()->create([
                        'url' => 'articles/' . $fileName
                    ]);
                }
            }
            DB::commit();
            return $this->buildResponse($article, 'Success', 'Article has been added successfully', 200);

        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->buildResponse(null, 'Error', 'Failed to add article: ' . $ex->getMessage(), 500);
        }
    }

}
