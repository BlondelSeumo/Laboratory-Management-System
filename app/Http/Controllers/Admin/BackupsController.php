<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Artisan;
class BackupsController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_backup',     ['only' => ['index', 'show']]);
        $this->middleware('can:create_backup',   ['only' => ['create', 'store']]);
        $this->middleware('can:delete_backup',   ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $backups = File::allFiles(storage_path('app/public/'.config('app.name')));
        
        return view('admin.backups.index',compact('backups'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $result=Artisan::call('backup:run',[
                '--only-db'=>true
            ]);
            session()->flash('success',__('Database backup created successfully'));
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('success',__('Something went wrong'));
            return redirect()->back();
        }
        return redirect()->route('admin.backups.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        ob_end_clean(); // this
        ob_start(); // and this
        return response()->download(storage_path('app/public/'.config('app.name').'/'.$id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
       File::delete(storage_path('app/public/'.config('app.name').'/'.$id));

       session()->flash('success',__('Backup deleted successfully'));

       return redirect()->route('admin.backups.index');
    }
}
