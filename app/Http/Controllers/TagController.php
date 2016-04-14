<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Request;

class TagController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tags = Tag::all();

		return view('home', compact('tags'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$input = Request::all();
		$date = date('Y-m-d H:i:s', time());

		$user_id = Auth::user()->id;

		$input['owner_id'] = $user_id;
		$input['created_at'] = $date;
		$input['updated_at'] = $date;

		$tag = Tag::create($input);
		flash()->info('Tag successfully created!');


		return redirect('home');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tag = Tag::where('id', '=', $id)->get();
		$tag = $tag->first();
		$tag->delete();
		flash()->info('Tag successfully deleted!');
		return redirect('home');
	}

}
