<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Request;

class TaskController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = Task::where('owner_id', '=', Auth::user()->id)->where('state', '!=', 'Completed')->orderBy('deadline', 'asc')->get();

		return view('home', compact('tasks'));
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

		$deadline = date_create_from_format('d/m/Y H:i', $input['deadline']);
		$input['deadline'] = date_format($deadline, 'Y-m-d H:i:s');

		if ($input['deadline'] < $date) flash()->error('Please, insert a valid deadline!');

		else {
			$user_id = Auth::user()->id;

			$input['owner_id'] = $user_id;
			$input['created_at'] = $date;
			$input['updated_at'] = $date;

			$task = Task::create($input);
			flash()->info('Task successfully created!');
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
		$task = Task::where('id', '=', $id)->get();
		$task = $task->first();
		$task->delete();
		flash()->info('Task successfully deleted!');
		return redirect('home');
	}

}
