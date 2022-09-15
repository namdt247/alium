<?php

namespace App\Http\Middleware;

use App\Helper\_ApiCode;
use App\Helper\_ApiMessage;
use App\Helper\Common;
use App\Models\Supplier;
use Closure;

class SupplierMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        $supplier = Supplier::where('sp_manager', $user->user_id)->first();

        if ($supplier) {
            if ($supplier->sp_status == 1) {
                return $next($request);
            }
            return response()->json(
                Common::buildApiResponse($supplier, _ApiCode::SUPPLIER_PENDING, _ApiMessage::SUPPLIER_PENDING)
            );
        }
        return response()->json(
            Common::buildApiResponse([], _ApiCode::SUPPLIER_NOT_EXIST, _ApiMessage::SUPPLIER_NOT_EXIST)
        );
    }
}
