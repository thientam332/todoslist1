<?php

namespace App\Http\Controllers;

use App\Models\TodosList;
use App\Providers\HelperProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TodosListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mess=NULL)
    {
        $temp = TodosList::orderBy('id', 'desc')->get();
        return view('HomePage')->with(['todo' => $temp,'mess' => $mess]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|max:300'
        ]);
        $todo_name = HelperProvider::mb_trim($request->name);
        if (strlen($todo_name) == 0) {
            return Redirect::back()->with("failed",'Failed create todos: Input Empty');
        }
        $todo = new TodosList();
        $todo->name = $todo_name;
        $todo->save();

        return Redirect::back()->with("success","Success created todos name: $todo->name");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo=TodosList::find($id);
        $todo->completed=!$todo->completed;
        $todo->save();
        if($todo->completed==True)
        {
            return Redirect::back()->with("success","Completed Todos: $todo->name");
        }
        return Redirect::back()->with("success","Status change successful: $todo->name");
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo=TodosList::find($id);
        $todo->delete();
        return Redirect::back()->with("success","Deleted todos: $todo->name");
    }
}
