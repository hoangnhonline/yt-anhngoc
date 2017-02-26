<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\LinkVideo;
use App\Models\ChuDe;
use App\Models\MailUpload;
use App\Models\ThuocTinhChuDe;
use Helper, File, Session, Auth, DB;

class LinkVideoController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */    
    public function index(Request $request)
    {    
        $chudeList = ChuDe::all();
        foreach($chudeList as $tmp){
            $chudeNameArr[$tmp->id] = $tmp->ten;
        }

        $mailList = MailUpload::all();
        foreach($mailList as $tmp){
            $mailNameArr[$tmp->id] = $tmp->email;
        }
        $userList = Account::where('role', 1)->get();
        foreach($userList as $tmp){
            $userNameArr[$tmp->id] = $tmp->full_name;
        }
        $stt_fm = $search['stt_fm'] = $request->stt_fm ? $request->stt_fm : '';
        $stt_to = $search['stt_to'] = $request->stt_to ? $request->stt_to : '';
        $id_chude = $search['id_chude'] = $request->id_chude ? $request->id_chude : '';
        $id_mail = $search['id_mail'] =  $request->id_mail ? $request->id_mail : '';
        $items = (object) [];
        
        $query = LinkVideo::whereRaw('1');
        if($id_mail > 0){
            $query->where('id_mail', $id_mail);
        }        
        if($id_chude > 0){
            $query->where('id_chude', $id_chude);
        }
        if($stt_fm > 0){
            $query->where('stt','>=', $stt_fm);
        }
        if($stt_to > 0){
            $query->where('stt','<=', $stt_to);
        }
        if(Auth::user()->role != 3){
            $query->where('created_user', Auth::user()->id );   
        }else{
            $user_id = $search['user_id'] = $request->user_id ? $request->user_id : 0;

            if($user_id > 0){
                $query->where('created_user', $user_id);
            }
        }
        $items = $query->paginate(100);
        
        //$parentCate = Category::where('parent_id', 0)->where('type', 1)->orderBy('display_order')->get();
        
        return view('link-video.index', compact('items', 'chudeList', 'mailList', 'userList', 'search', 'mailNameArr', 'userNameArr', 'chudeNameArr'));
    }
    public function create(Request $request)
    {         
        $stt_fm = $request->stt_fm ? $request->stt_fm : '';
        $stt_to = $request->stt_to ? $request->stt_to : '';
        $id_chude = $request->id_chude ? $request->id_chude : '';
        $id_mail = $request->id_mail ? $request->id_mail : '';
        $buoc = $request->buoc ? $request->buoc : 1;
        $dataList = (object) [];
        $query = LinkVideo::where('stt', '>=', $stt_fm)->where('stt', '<=', $stt_to);
        if(Auth::user()->role !=3){
            $query->where('created_user', Auth::user()->id);
        }
        $dataList = $query->get();
        $dataArr = [];
        $check = true;
        if($stt_fm > 0 && $stt_to > 0 && Auth::user()->role != 3){
            for($i = $stt_fm; $i<=$stt_to; $i++){
                $arr[] = $i;
            }
            
            $count = LinkVideo::whereIn('stt', $arr)->where('created_user', '<>', Auth::user()->id)->count();

            if($count > 0){
                $check = false;
            }
        }
        if($dataList->count() > 0){
            foreach($dataList as $tmp){
                $dataArr[$tmp->stt] = $tmp;
            }
        }        
        $str_id_thuoctinh = '';
        if($id_chude > 0){
            $thuocTinhList = ThuocTinhChuDe::where('id_chude', $id_chude)->get();
            foreach($thuocTinhList as $thuocTinh){
                $str_id_thuoctinh .= $thuocTinh->id.",";
            }
            $str_id_thuoctinh = rtrim($str_id_thuoctinh, ',');
        }else{
            $thuocTinhList = (object) [];
        }        
        $chudeList = ChuDe::all();
        $mailList = MailUpload::all();
        $userList = Account::where('role', 1)->get();
        return view('link-video.create', compact('chudeList', 'userList', 'stt_fm', 'stt_to', 'id_chude', 'thuocTinhList', 'dataList','str_id_thuoctinh', 'dataArr', 'buoc', 'mailList', 'id_mail', 'check'));
    }

    public function store(Request $request)
    {
        $dataArr = $request->all();
        foreach($dataArr['stt'] as $key => $stt){
            $data['stt'] = $stt;
            $data['name'] = $dataArr['ten'][$key]!='' ? $dataArr['ten'][$key] : $stt ;

            if(isset($dataArr['notes'])){
                $data['notes'] = $dataArr['notes'][$key] != '' ? $dataArr['notes'][$key] : $stt.".mp4" ;
            }            
            $data['id_chude'] = $dataArr['id_chude'];
            $data['created_user'] = Auth::user()->id;
            $data['updated_user'] = Auth::user()->id;
            if(isset($dataArr['thuoctinh']) && isset($dataArr['str_id_thuoctinh'])){
                // xu ly thuoc tinh
                $thuocTinhChuDe = explode(',', $dataArr['str_id_thuoctinh']);
                
                $str_id_thuoctinh = '';
                foreach($thuocTinhChuDe as $thuoc_tinh_id){                
                    if($dataArr['thuoctinh'][$thuoc_tinh_id][$key] == 1){
                        $str_id_thuoctinh .= $thuoc_tinh_id.",";
                    }
                }
                $str_id_thuoctinh = rtrim($str_id_thuoctinh, ',');
                
                $data['str_id_thuoctinh'] = $str_id_thuoctinh;
            }
            if(isset($dataArr['link'])){
                $data['link'] = $dataArr['link'][$key];
            }
            if(isset($dataArr['id_mail'])){
                $data['id_mail'] = $dataArr['id_mail'][$key];
            }
            if(isset($dataArr['duration'])){
                $data['duration'] = $dataArr['duration'][$key];
            }
            if($dataArr['id'][$key] > 0){
                LinkVideo::find($dataArr['id'][$key])->update($data);
            }else{
                LinkVideo::create($data);
            }         
        }

        Session::flash('message', 'Lưu thông tin thành công');
        $id_mail_select = isset($dataArr['id_mail_select']) ? $dataArr['id_mail_select'] : "";
        return redirect()->route('link-video.create', ['buoc' => $dataArr['buoc'], 'stt_fm' => $dataArr['stt_fm'], 'stt_to' => $dataArr['stt_to'], 'id_chude' => $dataArr['id_chude'], 'id_mail' => $id_mail_select]);
    }
    public function checkStt(Request $request){
        $stt_fm = $request->stt_fm;
        $stt_to = $request->stt_to;
        $stt_max = DB::table('link_video')->max('stt');
        if($stt_max && ( $stt_fm <= $stt_max || $stt_to <= $stt_max ) ){
            return $stt_max + 1;
        }else{
            return 'OK';
        }
    }
    public function destroy($id)
    {
        if(Auth::user()->role != 3){
            return redirect()->route('link-video.index');
        }
        // delete
        $model = Account::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa quốc gia thành công');
        return redirect()->route('link-video.index');
    }
    public function edit($id)
    {
        if(Auth::user()->role != 3){
            return redirect()->route('link-video.index');
        }
        $detail = Account::find($id);
        $departmentList = Department::all();
        $areaList = Area::all();
        return view('link-video.edit', compact( 'detail', 'departmentList', 'areaList'));
    }
    public function update(Request $request)
    {
        if(Auth::user()->role != 3){
            return redirect()->route('link-video.index');
        }
        $dataArr = $request->all();
        
        $this->validate($request,[
            'name' => 'required'            
        ],
        [
            'name.required' => 'Bạn chưa nhập họ tên'           
        ]);      

        $model = Account::find($dataArr['id']);        

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật tài khoản thành công');

        return redirect()->route('link-video.index');
    }
    
}
