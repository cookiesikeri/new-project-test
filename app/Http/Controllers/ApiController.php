<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //

    public function Articles()
    {
        try {

            $data = Post::orderBy('id','desc')->get();

            return response()->json([ 'status' => true, 'message' => 'Articles successfully fetched', 'response' => $data ], 200);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()],404);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }

    public function ArticleID($id)
    {
        try {
            $data = Post::on('mysql::write')->where('id', $id)->first();

            return response()->json([ 'status' => true, 'message' => 'Article successfully fetched', 'response' => $data ], 200);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()],404);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }

    public function ArticleView($id)
    {
        try {
            $data = Post::on('mysql::write')->where('id', $id)->sum('view_count');

            return response()->json([ 'status' => true, 'message' => 'Article successfully fetched', 'response' => $data ], 200);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()],404);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }

    public function ArticleLikes($id)
    {
        try {
            $data = Like::on('mysql::write')->where('post_id', $id)->sum('view_count');

            return response()->json([ 'status' => true, 'message' => 'Article successfully fetched', 'response' => $data ], 200);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()],404);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }

    public function ArticleComments($id)
    {
        try {
            $data = Comment::on('mysql::write')->where('post_id', $id)->get();

            return response()->json([ 'status' => true, 'message' => 'Article successfully fetched', 'response' => $data ], 200);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()],404);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }


    public function ArticleComment(Request $request)
    {
        // Validate data


        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|max:150',
            'email' => 'required|email',
            'content' => 'required|max:600'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }


        // Get Blog by slug
        $blog_slug = explode('/', url()->previous());
        $blog = Post::where('slug', end($blog_slug))->select('id')->firstOrFail();

        // If blog found
        if (!empty($blog)) {
            // Check status of validation
                // Save Comment
                $comment = new Comment();
                $comment->name = $request->name;
                $comment->email = $request->email;
                $comment->content = $request->content;
                $comment->post_id = $blog->id;
                $comment->save();

                // Redirect back with success

                return response()->json([ 'status' => true, 'message' => 'Article successfully sent', 'response' => $comment ], 201);

        }
    }
}
