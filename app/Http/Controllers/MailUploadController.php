<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\MailUpload;
use Helper, File, Session, Auth;

class MailUploadController extends Controller
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
        $email = $request->email ? $request->email : "";
        $status = $request->status ? $request->status : 0;
        $query = MailUpload::whereRaw(1);
        if($email != ''){
            $query->where('email', 'LIKE', '%'.$email.'%');
        }
        if($status > 0){
            $query->where('status', $status);   
        }
        $items = $query->paginate(100);
      
        return view('mail-upload.index', compact( 'items', 'email', 'status' ));
    }
    public function updateStatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        $model = MailUpload::find($id);
        $model->status = $status;
        $model->save();
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
        return view('mail-upload.create');
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
            'email' => 'required',
            'password' => 'required'                 
        ],
        [            
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập password',            
        ]);
   
        $rs = MailUpload::create($dataArr);

        Session::flash('message', 'Tạo mail upload thành công');

        return redirect()->route('mail-upload.index');
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
        $detail = MailUpload::find($id);        
        return view('mail-upload.edit', compact('detail'));
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
            'email' => 'required',
            'password' => 'required'                 
        ],
        [            
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập password',            
        ]);

        $model = MailUpload::find($dataArr['id']);

        $model->update($dataArr);
       
        Session::flash('message', 'Cập nhật thành công');        

        return redirect()->route('mail-upload.edit', $dataArr['id']);
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
            return redirect()->route('mail-upload.index');
        }
        // delete
        $model = MailUpload::find($id);
        $model->delete();
        // redirect
        Session::flash('message', 'Xóa thông tin thành công');
        return redirect()->route('mail-upload.index');
    }
}