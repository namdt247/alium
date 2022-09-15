<?php

namespace App\Models;

use App\Helper\_ObjectType;
use App\Helper\Common;
use App\Http\Business\Helper;
use App\Http\DAL\DAL_Config;
use App\Jobs\OrderChangeAlium;
use App\Jobs\OrderChangeFactory;
use App\Jobs\OrderChangeSale;
use App\Jobs\OrderChangeSupplier;
use App\Notifications\OrderChange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Order
 */
class Order extends Model
{
    use LogsActivity;

//    protected static $logFillable = true;
    protected static $submitEmptyLogs = false;
    protected $table = 'order';
    protected $primaryKey = 'od_id';
    protected $guarded = [];
    protected $with = ['status', 'supplier', 'image'];
    protected $appends = ['orderType', 'quality', 'requiredType', 'demander', 'product', 'city', 'stage', 'supply_employee', 'sale'];
    public $timestamps = true;
    protected $hidden = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'od_product', 'prd_id');
    }

    public function demander()
    {
        return $this->belongsTo('App\Models\User', 'od_createdBy', 'user_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'od_city', 'city_id');
    }

    public function listSPChoose(){
        return $this->hasMany('App\Models\Order_supplier','order_id','od_id');
    }

    public function getStatusSPChoose($spId){
        return $this->listSPChoose()->where('sp_id',$spId)->pluck('status')->first();
    }

    public function getOrderTotalSupplier($spId)
    {
        return $this->hasMany('App\Models\Order_detail', 'od_order', 'od_id')
            ->where('order_detail.od_assigneeTo', $spId)
            ->where('order_detail.od_type', 8)
            ->where('order_detail.od_status', 1)
            ->pluck('od_price')
            ->first();
    }

    public function getCityAttribute()
    {
        return $this->city()->first() ? $this->city()->first('city_name') :
            ['city_name' => 'Không xác định'];
    }

    public function getDemanderAttribute()
    {
        return $this->demander()->first(['user_showName', 'user_id']);
    }

    public function getProductAttribute()
    {
        return $this->product()->first() ? $this->product()->first(['prd_id', 'prd_name', 'prd_cate'])
            : ['prd_name' => 'Không xác định'];
    }

    public function getStageAttribute()
    {
        try {
            if ($this->od_status == 34) {
                $lastChangeStt = Order_detail::where('od_type', 4)
                    ->where('od_order', $this->od_id)
                    ->orderBy('created_at', 'desc')->first();
                $lastStt = ((object)unserialize($lastChangeStt->od_detail))->from;
                return Order_status::find($lastStt)->parent_status->stt_valueA;
            } else if ($this->status->stt_parent == 0) {
                return $this->status->stt_valueA;
            } else return $this->status->parent_status->stt_valueA;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return 'Không xác định';
        }
    }

    public function getContentDetailAttribute()
    {
        $contentArray = unserialize($this->getAttribute('od_content'));
        if (!is_array($contentArray)) return [];
        return [
            'total_price' => array_key_exists('total_price', $contentArray) ? $contentArray['total_price'] : 0,
            'price_order' => array_key_exists('price_order', $contentArray) ? $contentArray['price_order'] : 0,
            'price_vat' => array_key_exists('price_vat', $contentArray) ? $contentArray['price_vat'] : 0,
            'price_template' => array_key_exists('price_template', $contentArray) ? $contentArray['price_template'] : 0,
            'time_finish' => array_key_exists('time_finish', $contentArray) ? $contentArray['time_finish'] : 0,
            'time_template' => array_key_exists('time_template', $contentArray) ? $contentArray['time_template'] : 0,
            'material' => array_key_exists('material', $contentArray) ? $contentArray['material'] : 0,
            'payment_expected1' => array_key_exists('payment_expected1', $contentArray) ? $contentArray['payment_expected1'] : 0,
            'payment_expected2' => array_key_exists('payment_expected2', $contentArray) ? $contentArray['payment_expected2'] : 0,
            'payment_expected3' => array_key_exists('payment_expected3', $contentArray) ? $contentArray['payment_expected3'] : 0,
        ];
    }

    public function getOrderTypeAttribute()
    {
        // example of order type : 1010
        // order of status 0 => have resource or not
        // order of status 1 => require bill or not
        // order of status 2 => require template or not
        // order of status 3 => print or embroider
        $result = array();
        $result['resource'] = $this->od_type % 10;
        $result['bill'] = floor(($this->od_type) / 10) % 10;
        $result['template'] = floor(($this->od_type) / 100) % 10;
        $result['otherRequire'] = floor(($this->od_type) / 1000) % 10;
        $result['liveTemplate'] = floor(($this->od_type) / 10000) % 10;
        return $result;
    }

    public static function setType($array)
    {
        $resource = intval($array['resource']);
        $bill = intval($array['bill']);
        $template = intval($array['template']);

        $totalOtherReruire = 0;
        if (isset($array['otherRequire'])) {
            if (is_array($array['otherRequire'])) {
                foreach ($array['otherRequire'] as $requireItem) {
                    $totalOtherReruire += intval($requireItem);
                }
            } else {
                $totalOtherReruire = $array['otherRequire'];
            }
        }
        $otherRequire = $totalOtherReruire;

        $liveTemplate = intval($array['liveTemplate']);
        return intval($liveTemplate . $otherRequire . $template . $bill . $resource);
    }

    public function getRequiredTypeAttribute()
    {
        return Common::buildTagArray($this->getAttribute('od_requiredType'));
    }

    public function getQualityAttribute()
    {
        try {
            return DAL_Config::getConfigValueById(7, $this->getAttribute('od_quality'));
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return 'Không xác định';
        }
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Order_status', 'od_status', 'stt_id');
    }


    public function suggest()
    {
        return $this->hasMany('App\Models\Order_detail', 'od_order', 'od_id')
            ->where('order_detail.od_status', 1)
            ->where('order_detail.od_type', 1);
    }

    public function suggest_uMake()
    {
        return $this->hasMany('App\Models\Order_detail', 'od_order', 'od_id')
            ->where('order_detail.od_status', 1)
            ->where('order_detail.od_type', 8);
    }

    public function order_detail()
    {
        return $this->hasMany('App\Models\Order_detail', 'od_order', 'od_id');
    }

    public function size()
    {
        return $this->hasMany('App\Models\Order_detail', 'od_order', 'od_id')
            ->where('order_detail.od_status', 1)
            ->where('order_detail.od_type', 2);
    }

    public function latestNote()
    {
        return $this->hasOne('App\Models\Order_detail', 'od_order', 'od_id')
            ->where('order_detail.od_status', 1)
            ->where('order_detail.od_type', 3)
            ->orderBy('order_detail.created_at', 'desc')->latest();
    }

    public function image()
    {
        return $this->hasMany('App\Models\Order_image', 'img_order', 'od_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'od_assigneeTo', 'sp_id');
    }

    public function sale()
    {
        return $this->belongsTo('App\Models\User', 'od_sale', 'user_id');
    }

    public function getSaleAttribute()
    {
        return $this->sale()->first();
    }

    public function supplyEmployee()
    {
        return $this->belongsTo('App\Models\User', 'od_supplier', 'user_id');
    }

    public function getSupplyEmployeeAttribute()
    {
        return $this->supplyEmployee()->first();
    }

    static function ChangeStatus(Order $order, $newSttId, $image = '', $note = '')
    {
        $newStatus = Order_status::find($newSttId);
        if ($newStatus && $newStatus->stt_id) {
            $count = count(Order_detail::where('od_order', $order->od_id)->get());
            Order_detail::create([
                'od_id' => $order->od_id . 'DT' . ($count + 1),
                'od_image' => $image,
                'od_type' => 4,
                'od_order' => $order->od_id,
                'od_name' => 'Change status',
                'od_assigneeTo' => $newStatus->stt_id,
                'od_detail' => serialize([
                    'from' => $order->od_status,
                    'to' => $newStatus->stt_id,
                    'note' => $note
                ])
            ]);
            $sttNotify = unserialize($newStatus->stt_notify);
            if ($sttNotify['frontend'] && is_array($sttNotify['frontend']) && count($sttNotify['frontend']) > 0) {
                $notify = $sttNotify['frontend'];
                $image = '/img/order-template.png';
                if (count($order->image) > 0) {
                    $image = Common::GetThumb($order->image[0]->img_src);
                }
                $contentNotify = [
                    'cate' => 1,
                    'code' => $order->od_code,
                    'user' => $order->od_createdBy,
                    'url' => '/orders/' . $order->od_code,
                    'type' => $newStatus->stt_id,
                    'title' => sprintf($notify['msTitle'], $order->od_code, $order->product->prd_name, $order->demander->user_showName),
                    'message' => sprintf($notify['msMessage'], $order->od_code, $order->product->prd_name, $order->demander->user_showName),
                    'name' => $order->od_code . ' (' . $order->product->prd_name . ' - ' . $order->od_quantity . ' chiếc)',
                    'action' => 'Xử lí đơn hàng',
                    'image' => $image
                ];
                $userOrder = User::find($order->od_createdBy);
                Notification::send($userOrder, new OrderChange($contentNotify));
                Helper::sendFCMMessage($contentNotify);
            }
            if ($sttNotify['sale'] && is_array($sttNotify['sale']) && count($sttNotify['sale']) > 0) {
                $notify = $sttNotify['sale'];
                $contentNotify = [
                    'msTitle' => sprintf($notify['msTitle'], $order->od_code, $order->product->prd_name, $order->demander->user_showName),
                    'msMessage' => sprintf($notify['msMessage'], $order->od_code, $order->product->prd_name, $order->demander->user_showName),
                    'msUrl' => route('admin.sale.getChangeOrder', $order->od_id),
                    'msSale' => $order->od_sale ? $order->sale->user_showName : '',
                    'saleId' => $order->od_sale ? $order->od_sale : 0,
                ];
                $user_sale = User::find($order->od_sale);
                if ($user_sale && $user_sale->user_email &&
                    filter_var($user_sale->user_email, FILTER_VALIDATE_EMAIL)) {
                    dispatch(new OrderChangeSale($contentNotify, $order->od_sale));
                }
            }

            if ($sttNotify['sale manager'] && is_array($sttNotify['sale manager']) && count($sttNotify['sale manager']) > 0) {
                $notify = $sttNotify['sale manager'];
                $contentNotify = [
                    'msTitle' => sprintf($notify['msTitle'], $order->od_code, $order->product->prd_name, $order->demander->user_showName),
                    'msMessage' => sprintf($notify['msMessage'], $order->od_code, $order->product->prd_name, $order->demander->user_showName),
                    'msUrl' => route('admin.order.changeStatus', $order->od_id),
                    'msSale' => $order->sale ? $order->sale->user_showName : ''
                ];
                dispatch(new OrderChangeAlium($contentNotify));
            }

            if ($sttNotify['supplier'] && is_array($sttNotify['supplier']) && count($sttNotify['supplier']) > 0) {
                $notify = $sttNotify['supplier'];
                $contentNotify = [
                    'msTitle' => sprintf($notify['msTitle'], $order->od_code, $order->product->prd_name),
                    'msMessage' => sprintf($notify['msMessage'], $order->od_code, $order->product->prd_name),
                    'msUrl' => route('admin.supplier.getChangeOrder', $order->od_id),
                    'msSale' => '',
                    'msSupplier' => $order->od_supplier
                ];
                $user_supplier = User::find($order->od_supplier);
                if ($user_supplier && $user_supplier->user_email &&
                    filter_var($user_supplier->user_email, FILTER_VALIDATE_EMAIL)) {
                    dispatch(new OrderChangeSupplier($contentNotify));
                }
            }

            if ($sttNotify['factory'] && is_array($sttNotify['factory']) && count($sttNotify['factory']) > 0) {
                $notify = $sttNotify['factory'];
                $image = '';
                if (count($order->image) > 0) {
                    $image = Common::GetThumb($order->image[0]->img_src);
                }
                $contentNotify = [
                    'cate' => 2,
                    'code' => $order->od_code,
                    'user' => $order->od_createdBy,
                    'url' => $order->od_code,
                    'type' => $newStatus->stt_id,
                    'title' => sprintf($notify['msTitle'], $order->od_code, $order->product->prd_name),
                    'message' => sprintf($notify['msMessage'], $order->od_code, $order->product->prd_name),
                    'name' => $order->od_code . ' (' . $order->product->prd_name . ' - ' . $order->od_quantity . ' chiếc)',
                    'action' => 'Xử lí đơn hàng',
                    'image' => $image
                ];
                $contentMail = [
                    'msTitle' => sprintf($notify['msTitle'], $order->od_code, $order->product->prd_name),
                    'msMessage' => sprintf($notify['msMessage'], $order->od_code, $order->product->prd_name),
                    'msUrl' => _ObjectType::URL_WEB_SUPPLIER . _ObjectType::PATH_MANAGER_ORDER,
                    'msSale' => '',
                ];
                $spOrder = Supplier::find($order->od_assigneeTo);
                if ($spOrder && $spOrder->sp_id) {
                    $userSPOrder = User::find((int)$spOrder->sp_manager);
                    if($userSPOrder && $userSPOrder->user_id) {
                        Notification::send($userSPOrder, new OrderChange($contentNotify));
                        Helper::sendFCMSupplier($contentNotify);
                    }
                    if (filter_var($spOrder->sp_email, FILTER_VALIDATE_EMAIL)) {
                        dispatch(new OrderChangeFactory($contentMail, $order->od_assigneeTo));
                    }
                }
            }

            $order->od_status = $newStatus->stt_id;
            $order->save();
        }
    }

    public function getReasonCancel() {
        return $this->hasOne('App\Models\Order_detail', 'od_order', 'od_id')
            ->where('od_type', 4)
            ->where('od_name', 'Change status')
            ->where('od_assigneeTo', 34)
            ->first();
    }
}
