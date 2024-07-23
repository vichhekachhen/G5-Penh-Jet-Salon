<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Reply;
use App\Models\Service;
use App\Models\Slideshow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//     public function index()
//     {
//         $userAuth = Auth::user();
//         $services = Service::where('store_id', $userAuth->store_id)->paginate(10);

//         return view('service.index', compact('services'));
//     }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('service.new', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        $data = $request->validate([
            'text' => 'required|string',
            'comment_id' => 'required|integer',
        ]);
        $reply = Reply::create([
            'text' => $data['text'],
            'comment_id' => $data['comment_id'],
            'owner_id' => $user->id,
        ]);

        return redirect('/admin/services/'.$request->service_id)->with('success', 'Reply created successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        $comments = Comment::where('service_id', $id)->get();
        foreach ($comments as $key => $comment) {
            $user = User::findOrFail($comment->user_id);
            $comments[$key]->user = $user;
        }
        return view('service.show', ['service' => $service, 'comments' => $comments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        
        $reply = Reply::findOrFail($id);
        $reply->update([
            'text' => $request->text,
        ]);
        $reply->save();
        return redirect('/admin/services/'.$request->service_id)->with('success', 'Reply edit successfully !!!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $reply->delete();
        return redirect()->back()->withSuccess('Reply deleted !!!');
    }
}
