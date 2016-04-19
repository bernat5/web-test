<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Tag;
use App\Rel_Task_Tag;
use Illuminate\Support\Facades\Auth;
use Request;

class TagController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
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
	 * @return Response
	 */
	public function store()
	{
		$input = Request::all();
		$title = $input['title'];

		if (Tag::where('title', '=', $title)->get()->first()) flash()->error('Already existing tag with this title!!!');
		else
		{
			$date = date('Y-m-d H:i:s', time());
			$user_id = Auth::user()->id;

			$input['owner_id'] = $user_id;
			$input['created_at'] = $date;
			$input['updated_at'] = $date;

			Tag::create($input);
			flash()->info('Tag successfully created!');
		}

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
		$rel = Rel_Task_Tag::where('tag_id', '=', $id)->get()->first();

		if ($rel) flash()->error('This tag cannot be deleted because is related to a task!!!');
		else
		{
			$tag = Tag::where('id', '=', $id)->get();
			$tag = $tag->first();
			$tag->delete();
			flash()->info('Tag successfully deleted!');
		}

		return redirect('home');
	}

}
