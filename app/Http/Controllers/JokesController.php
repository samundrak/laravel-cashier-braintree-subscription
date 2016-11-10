<?php

namespace App\Http\Controllers;

use App\Jokes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JokesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();


        return view('jokes.index', compact('user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        return view('jokes.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $plan = $user->plan;

        if ( $user->jokes->count() >= $plan->limit->limit) {
            return redirect()->back()->with('error', 'You have exceeded your joke limit.');
        }

        $joke = \App\Jokes::create($request->all());
        $joke->user()->attach([$user->id]);

        return redirect()->back()->with('success', 'Joke has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $jokes = $user->jokes->pluck('id')->reject(function ($item) use ($id) {
            return $id == $item;
        });
        $user->jokes()->sync($jokes->toArray());

        if (!Jokes::destroy($id)) {
            return redirect()->back()->with('error', 'Unable to delete.');
        }


        return redirect()->back()->with('success', 'Provided Joke has been deleted.');

    }
}
