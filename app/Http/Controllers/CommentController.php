<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post)
    {
        $this->validate($request, ['message' => 'required|max:1000']); //change comment field to message
        $comment = new Comment();
        $comment->post_id = $post;
        $comment->user_id = Auth::id();
        $comment->subject = $request->subject;
        $comment->message = $request->message; //change comment field to message
        $comment->save();

        // Success message
        Toastr::success('success', 'The comment added successfully ;)');

        return redirect()->back();
    }
}
