<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Task;
use App\Rel_Task_Tag;
use Illuminate\Support\Facades\Auth;
use Request;

class TaskController extends Controller {

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
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Request::all();
		$title = $input['title'];

		if (Task::where('title', '=', $title)->get()->first()) flash()->error('Already existing task with this title!!!');
		else
		{
			$tags = ($input['tags']);
			$date = date('Y-m-d H:i:s', time());
			$user_id = Auth::user()->id;

			if ($input['deadline'] == null)
			{
				$input['owner_id'] = $user_id;
				$input['created_at'] = $date;
				$input['updated_at'] = $date;

				$task = Task::create($input);

				foreach ($tags as $tag)
				{
					$data['task_id'] = $task->id;
					$data['tag_id'] = $tag;
					$data['created_at'] = $date;
					$data['updated_at'] = $date;

					Rel_Task_Tag::create($data);
				}

				flash()->info('Task successfully created!');
			}
			else
			{
				$deadline = date_create_from_format('d/m/Y H:i', $input['deadline']);
				$input['deadline'] = date_format($deadline, 'Y-m-d H:i:s');

				if ($input['deadline'] < $date) flash()->error('Please, insert a valid deadline!');

				else
				{
					$input['owner_id'] = $user_id;
					$input['created_at'] = $date;
					$input['updated_at'] = $date;

					$task = Task::create($input);

					foreach ($tags as $tag)
					{
						$data['task_id'] = $task->id;
						$data['tag_id'] = $tag;
						$data['created_at'] = $date;
						$data['updated_at'] = $date;

						Rel_Task_Tag::create($data);
					}
					flash()->info('Task successfully created!');
				}
			}
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
		$task = Task::where('id', '=', $id)->get()->first();
		$rel_tasks_tags = Rel_Task_Tag::where('task_id', '=', $task->id)->get();
		return view('task', compact('task', 'rel_tasks_tags'));
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
		$state = Request::all();
		$state = $state['state'];

		$task = Task::find($id);
		$task->state = $state;
		$task->save();

		flash()->info('Task state successfully updated!');
		return redirect()->action('TaskController@show', ['id' => $task->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Task::where('id', '=', $id)->get()->first()->delete();
		Rel_Task_Tag::where('task_id', '=', $id)->delete();
		flash()->info('Task successfully deleted!');
		return redirect('home');
	}

}
