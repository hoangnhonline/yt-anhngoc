<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ChuDe;
use App\Models\ThuocTinhChuDe;
use Helper, File, Session, Auth;

class ThuocTinhChuDeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        if(Auth::user()->role != 3){
            return redirect()->route('link-video.index');
        }
        $id_chude = 0;
        if(ChuDe::first()){

            $id_chude = $request->id_chude ? $request->id_chude : ChuDe::first()->id;
            
        }
        if($id_chude > 0){
            $items = ThuocTinhChuDe::where('id_chude', $id_chude)->paginate(20);    
        }else{
            $items = ThuocTinhChuDe::paginate(20);    
        }       
        $chudeList = ChuDe::all();
        return view('thuoc-tinh-chu-de.index', compact( 'items', 'chudeList', 'id_chude'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {          
        if(Auth::user()->role != 3){
            return redirect()->route('link-video.index');
        } 
        $chudeList = ChuDe::all();

        return view('thuoc-tinh-chu-de.create', compact('chudeList'));
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
            'ten' => 'required',
            'id_chude' => 'required'
        ],
        [            
            'ten.required' => 'Bạn chưa nhập tên thuộc tính',
            'id_chude.required' => 'Bạn chưa chọn chủ đề'
        ]);
   
        $rs = ThuocTinhChuDe::create($dataArr);

        Session::flash('message', 'Tạo chủ đề thành công');

        return redirect()->route('thuoc-tinh-chu-de.index');
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
        if(Auth::user()->role != 3){
            return redirect()->route('link-video.index');
        }
        $chudeList = ChuDe::all();
        $detail = ThuocTinhChuDe::find($id);        
        return view('thuoc-tinh-chu-de.edit', compact('detail', 'chudeList'));
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
            'ten' => 'required',
            'id_chude' => 'required'
        ],
        [            
            'ten.required' => 'Bạn chưa nhập tên thuộc tính',
            'id_chude.required' => 'Bạn chưa chọn chủ đề'
        ]);

        $model = ThuocTinhChuDe::find($dataArr['id']);

        $model->update($dataArr);
       
        Session::flash('message', 'Cập nhật thành công');        

        return redirect()->route('thuoc-tinh-chu-de.edit', $dataArr['id']);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        
        // delete
        $model = ThuocTinhChuDe::find($id);
        $model->delete();
        // redirect
        Session::flash('message', 'Xóa thông tin thành công');
        return redirect()->route('thuoc-tinh-chu-de.index');
    }
}