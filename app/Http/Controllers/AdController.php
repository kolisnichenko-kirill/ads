<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use DB;
use Auth;

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
    
    public function create(Request $request)
    {
        $ad = new Ad;

        $ad->title = $request->title;
        $ad->description = $request->description;
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
    
    public function edit($id, Request $request)
    {
        $ad = Ad::findOrFail($id);

        if (Auth::user()->username !== $ad->author_name) {
            return abort(403);
        }

        $ad->title = $request->title;
        $ad->description = $request->description;

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
