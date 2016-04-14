<?php namespace App\Http\Controllers;

use App\Tag;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tags = Tag::where('owner_id', '=', Auth::user()->id)->get();

		$tasks = Task::where('owner_id', '=', Auth::user()->id)->where('state', '!=', 'Completed')->orderBy('deadline', 'asc')->get();

		return view('home', compact('tags', 'tasks'));
	}

}
