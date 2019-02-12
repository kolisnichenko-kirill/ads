<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use DB;
use Auth;
use App\Http\Requests\AdPost;

class AdController extends Controller
{
    public function index()
    {
        $ads = DB::table('ads')->paginate(5);

        return view('index', ['ads' => $ads]);
    }

    public function show($id)
    {
        $item = Ad::findOrFail($id);
        return view('item', ['item' => $item]);
    }
    
    public function showCreateForm()
    {
        return view('create');
    }
    
    public function create(AdPost $request)
    {
        $ad = new Ad;

        $validated = $request->validated();

        $ad->title = $validated['title'];
        $ad->description = $validated['description'];
        $ad->author_name = Auth::user()->username;

        $ad->save();

        return redirect()->action('AdController@show', ['id' => $ad->id]);
    }
    
    public function showEditForm($id)
    {
        $ad = Ad::findOrFail($id);

        if (Auth::user()->username !== $ad->author_name) {
            return abort(403);
        }

        return view('edit', ['ad' => $ad]);
    }
    
    public function edit($id, AdPost $request)
    {
        $ad = Ad::findOrFail($id);

        if (Auth::user()->username !== $ad->author_name) {
            return abort(403);
        }

        $validated = $request->validated();

        $ad->title = $validated['title'];
        $ad->description = $validated['description'];

        $ad->save();

        return redirect()->action('AdController@show', ['id' => $ad->id]);
    }
    
    public function delete($id)
    {
        $ad = Ad::findOrFail($id);
        if (Auth::user()->username == $ad->author_name) {
            $ad->delete();
        }

        return redirect()->action('AdController@index');
    }
}
