<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 08/12/2016
 * Time: 11:20 SA
 */

namespace App\Http\Controllers\Admin;


use App\Helper\_ApiCode;
use App\Http\Business\Admin\BzCustomer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $bzCustomer;
    public function __construct()
    {
        parent::__construct();
        $this->bzCustomer = new BzCustomer();
    }

    public function getListFeedback(){
        return view('admin.customer.list_feedback');
    }

    public function getListFeedbackData(){
        return $this->bzCustomer->getListFeedbackData();
    }

    public function getEditFeedback($fbId){
        $feedback = $this->bzCustomer->getDetailFeedback($fbId);
        if ($feedback && $feedback->fb_id)
            return view('admin.customer.edit_feedback',compact('feedback'));
        return redirect()->route('admin.dashboard');
    }

    public function postEditFeedback(Request $request){
        $errorCode = $this->bzCustomer->postEditFeedback($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Cập nhật phản hồi thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Cập nhật phản hồi không thành công']);
    }

}