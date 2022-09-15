<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Admin;


use App\Helper\_ApiCode;
use App\Http\Business\Admin\BzRate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RateController extends Controller
{
    protected $bzRate;
    public function __construct()
    {
        parent::__construct();
        $this->bzRate = new BzRate();
    }

    public function getListRate(){
        return view('admin.rate.list_rate');
    }

    public function getListRateData(){
        return $this->bzRate->getListRateData();
    }

    public function getAddRate(){
        return view('admin.rate.add_rate');
    }

    public function postAddRate(Request $request){
        $errorCode = $this->bzRate->postAddRate($request);
        if($errorCode == _ApiCode::SUCCESS){
            return redirect()->back()->with(['success_message' => 'Thêm mới đánh giá thành công']);
        } else{
            return redirect()->back()->with(['error_message' => 'Thêm mới đánh giá không thành công']);
        }
    }

    public function getEditRate($rateId){
        $rate = $this->bzRate->getDetailRate($rateId);
        return view('admin.rate.edit_rate',compact('rate'));
    }

    public function postEditRate(Request $request){
        $errorCode = $this->bzRate->postEditRate($request);
        if($errorCode == _ApiCode::SUCCESS){
            return redirect()->back()->with(['success_message' => 'Chỉnh sửa đánh giá thành công']);
        } else{
            return redirect()->back()->with(['error_message' => 'Chỉnh sửa đánh giá không thành công']);
        }
    }
}