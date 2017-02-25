<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ChuDe;
use Helper, File, Session, Auth;

class ChuDeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $items = ChuDe::paginate(100);
      
        return view('chu-de.index', compact( 'items' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {   
        return view('chu-de.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        
        $dataArr = $request->all();
        
        $this->validate($request,[            
            'ten' => 'required'                   
        ],
        [            
            'ten.required' => 'Bạn chưa nhập tên chủ đề'            
        ]);
   
        $rs = ChuDe::create($dataArr);

        Session::flash('message', 'Tạo chủ đề thành công');

        return redirect()->route('chu-de.index');
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
        $detail = ChuDe::find($id);        
        return view('chu-de.edit', compact('detail'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'ten' => 'required'            
        ],
        [            
            'ten.required' => 'Bạn chưa nhập tên chủ đề'
        ]);

        $model = ChuDe::find($dataArr['id']);

        $model->update($dataArr);
       
        Session::flash('message', 'Cập nhật thành công');        

        return redirect()->route('chu-de.edit', $dataArr['id']);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        if(Auth::user()->role != 3){
            return redirect()->route('chu-de.index');
        }
        // delete
        $model = ChuDe::find($id);
        $model->delete();
        // redirect
        Session::flash('message', 'Xóa thông tin thành công');
        return redirect()->route('chu-de.index');
    }
}