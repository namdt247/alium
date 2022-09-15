<?php
/**
 * Created by PhpStorm.
 * Project: Alium_main
 * User: quanvu
 * Date: 13/07/2019
 */


namespace App\Http\Business\API;



use App\Helper\_ApiCode;
use App\Http\DAL\DAL_Config;
use App\Models\Config;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class BzArticle extends BzApi
{
    public function getStaticPage($alias){
        $config = Config::where('cfg_alias',$alias)->first();
        if (!$config) $config = Config::find(100);
        if ($alias == "footer") {
            return[
                'alias' => $alias,
                'config' => array_values(DAL_Config::getConfigByLocale($config->cfg_id))
            ];
        }
        return[
            'alias' => $alias,
            'config' => array_values(DAL_Config::getConfigByLocale($config->cfg_id))[0]
        ];
    }

    public function postAddQNA($request){
        try {
            $dataFb = [
                'fb_email' => $request->email,
                'fb_phone' => $request->phone,
                'fb_name' => $request->name,
                'fb_order' => $request->order,
                'fb_cate' => $request->cate,
                'fb_content' => $request->content,
            ];
            if (Auth::check()) $dataFb['fb_user'] = Auth::user()->user_id;
            if (Feedback::create($dataFb)) {
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Feedback::getModel())
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }
}
