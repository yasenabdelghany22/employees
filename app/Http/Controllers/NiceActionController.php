<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\NiceAction; 

use App\NiceActionLog;

// use DB;

class NiceActionController extends Controller
{

    public function getHome() {
        $actions = NiceAction::all();
        $loggedActions = NiceActionLog::paginate(1);
        return view('home',['actions' => $actions, 'loggedActions' => $loggedActions]);
    }

    public function getNiceAction($action, $name = null){
        if($name === null){
            $name = 'you';
        }
        $nice_action = NiceAction::where('name',$action)->first();
        $nice_action_log = new NiceActionLog();
        $nice_action->logged_actions()->save($nice_action_log);
    	return view('actions.nice',['name' => $name, 'action' => $action]);
    }

    public function postInsertNiceAction(Request $request){
    	$this->validate($request , [
    			'name' => 'required|alpha|unique:nice_actions',
                'niceness' => 'required|numeric'
    		]);

        $action = new NiceAction();
        $action->name = $request['name'];
        $action->niceness = $request['niceness'];
        $action->save();
        $actions = NiceAction::all();
        if($request->ajax()){
            return $response()->json();
        }
        return redirect()->route('home');
		// return view('actions.nice',['name'=>$this->transformName($request['name']),'action'=>$request['action']]);
    }

    private function transformName($name){
    	$perfix = 'KING ';
    	return $perfix . strtoupper($name);
    }
}
