<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use App\Http\Requests\UrlRequst;
use Illuminate\Support\Facades\Log;

class ShorUrlController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'verified'], ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $urls = ShortUrl::whereUserId($request->user()->id)->paginate(10);;
        return view('url.index', ['urls' => $urls]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('url.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrlRequst $request)
    {
        try{
            $data= $request->validated();
            $data['user_id'] = $request->user()->id;
            ShortUrl::create($data);
            return back()->with(['message' => "Url generate successfully"]);
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return back()->with(['error'=>$ex->getMessage() , 'message' => "something went wrong!!"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $url = ShortUrl::find($id);
        $url->increment('count');
        $url->save();
        return redirect()->away($url->url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $url = ShortUrl::find($id);
        return view('url.edit', ['url' => $url]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UrlRequst $request, string $id)
    {
        try{
            $data= $request->validated();
            ShortUrl::whereId($id)->update($data);
            return back()->with(['message' => "Url Update successfully"]);
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return back()->with(['error'=>$ex->getMessage() , 'message' => "something went wrong!!"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            if(ShortUrl::destroy($id)){
                return back()->with(['message' => "Url removed successfully!"]);
            }else{
                return back()->with(['error' => "Url Not found"]);
            }
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return back()->with(['error'=>$ex->getMessage() , 'message' => "something went wrong!!"]);
        }

    }
}
