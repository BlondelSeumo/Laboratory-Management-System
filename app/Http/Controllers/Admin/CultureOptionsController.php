<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CultureOption;
use DataTables;
class CultureOptionsController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_culture_option',     ['only' => ['index', 'show','ajax']]);
        $this->middleware('can:create_culture_option',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_culture_option',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_culture_option',   ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $culture_options=CultureOption::where('parent_id',0)->get();

        return view('admin.culture_options.index',compact('culture_options'));
    }

     /**
    * get culture options datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=CultureOption::where('parent_id',0);

        return DataTables::eloquent($model)
        ->addColumn('action',function($culture_option){
            return view('admin.culture_options._action',compact('culture_option'));
        })
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.culture_options.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $culture_option=CultureOption::create([
          'value'=>$request['name'],
          'parent_id'=>0
      ]);

      //save new options
      if($request->has('option'))
      {
        $culture_option->childs()->createMany($request['option']);
      }

      session()->flash('success',__('Culture option created successfully'));

      return redirect()->route('admin.culture_options.index');
       
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
        $option=CultureOption::with('childs')->where('id',$id)->where('parent_id',0)->firstOrFail();

        return view('admin.culture_options.edit',compact('option'));
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
        $culture_option=CultureOption::where([
            ['id',$id],
            ['parent_id',0]
        ])->firstOrFail();
        
        $culture_option->update([
            'value'=>$request['name']
        ]);

        //old options
        $old_options=[];
        
        if($request->has('old_option'))
        {
            foreach($request['old_option'] as $key=>$value)
            {
                array_push($old_options,$key);

                CultureOption::where('id',$key)->update([
                    'value'=>$value
                ]);
            }
        }

        //delete old options not submited
        CultureOption::where('parent_id',$id)->whereNotIn('id',$old_options)->delete();

        //save new options
        if($request->has('option'))
        {
            $culture_option->childs()->createMany($request['option']);

        }
        
        session()->flash('success',__('Culture option updated successfully'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $culture_option=CultureOption::where('id',$id)->orWhere('parent_id',$id)->firstOrFail();
        $culture_option->delete();

        session()->flash('success',__('Culture option deleted successfully'));

        return redirect()->back();

    }
}
