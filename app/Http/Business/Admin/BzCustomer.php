<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 26/10/2016
 * Time: 21:49 CH
 */

namespace App\Http\Business\Admin;


use App\Helper\_ApiCode;
use App\Models\Feedback;

class BzCustomer extends BzAdmin
{
    #region *** FEEDBACK ***
    public function getListFeedbackData(){
        return Feedback::paginate(30);
    }

    public function getDetailFeedback($fbId){
        return Feedback::find($fbId);
    }

    public function postEditFeedback($request){
        try {
            $fbId = $request->lbId;
            $feedback = Feedback::find($fbId);
            if ($feedback && $feedback->fb_id) {
                $feedback->fb_status = $request->sltStatus;
                $feedback->fb_note = $request->txtNote;
                $feedback->save();
            }
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Feedback::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postEditFeedback'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }
    #endregion

}