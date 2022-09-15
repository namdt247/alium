<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $tran_id
 * @property string|null $tran_number
 * @property int $tran_type
 * @property int $tran_port
 * @property int|null $tran_order
 * @property int $tran_target
 * @property float $tran_amount
 * @property string|null $tran_message
 * @property string|null $tran_content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTranAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTranContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTranId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTranMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTranNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTranOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTranPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTranTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTranType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Cate_product
 *
 * @package App\Models
 * @property int $cate_id
 * @property string|null $cate_name
 * @property string|null $cate_value
 * @property int $cate_parent
 * @property string|null $cate_alias
 * @property string|null $cate_featureImg
 * @property int $cate_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cate_product $parent_cate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cate_product[] $sub_cate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCateAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCateFeatureImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCateParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCateStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCateValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereUpdatedAt($value)
 * @property string|null $cate_code
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCateCode($value)
 * @mixin \Eloquent
 * @property string|null $cate_size
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product whereCateSize($value)
 */
	class Cate_product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cate_article_tran
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article_tran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article_tran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article_tran query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $cate_article_cate_id
 * @property string|null $cate_value
 * @property string|null $cate_alias
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article_tran whereCateAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article_tran whereCateArticleCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article_tran whereCateValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article_tran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article_tran whereLocale($value)
 */
	class Cate_article_tran extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $prd_id
 * @property string|null $prd_name
 * @property string|null $prd_alias
 * @property string|null $prd_sapo
 * @property string|null $prd_SKU
 * @property string|null $prd_des
 * @property string|null $prd_spec
 * @property float $prd_price
 * @property float $prd_priceNow
 * @property int $prd_quantity
 * @property string|null $prd_code
 * @property int $prd_sold
 * @property int $prd_view
 * @property int $prd_cate
 * @property string|null $prd_tag
 * @property int $prd_status
 * @property int $prd_promote
 * @property string|null $prd_featureImg
 * @property int $prd_createdBy
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Cate_product $cate_product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product_image[] $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product_meta[] $meta
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdCate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdFeatureImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdPriceNow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdPromote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdSKU($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdSapo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdSpec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $prd_type
 * @property int $prd_order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrdType($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product_tran[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product withTranslation()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $od_id
 * @property string|null $od_code
 * @property string|null $od_name
 * @property string|null $od_address
 * @property string|null $od_phone
 * @property string|null $od_mail
 * @property int $od_quantity
 * @property int $od_product
 * @property int $od_createdBy
 * @property int $od_demander
 * @property int $od_assigneeTo
 * @property int $od_status
 * @property float $od_total
 * @property float $od_paid
 * @property string|null $od_paymentMethod
 * @property string|null $od_coupon
 * @property int $od_type
 * @property string|null $od_message
 * @property string|null $requiredDate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order_meta[] $metas
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdAssigneeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdDemander($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdPaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRequiredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $od_locationId
 * @property int $od_quanlity
 * @property int $order_template
 * @property int $od_haveResource
 * @property int $od_requiredSample
 * @property string|null $od_content
 * @property string|null $od_requiredDate
 * @property string|null $od_deliveredTime
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdDeliveredTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdHaveResource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdQuanlity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdRequiredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdRequiredSample($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderTemplate($value)
 * @property int $od_parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdParent($value)
 * @property string|null $od_email
 * @property int $od_country
 * @property int $od_city
 * @property int $od_district
 * @property int $od_postalCode
 * @property int $od_quality
 * @property float $od_templatePrice
 * @property float|null $od_priceUnit
 * @property string|null $od_requiredType
 * @property float $od_wantedPrice
 * @property-read \App\Models\City $city
 * @property-read \App\Models\User $demander
 * @property-read mixed $order_type
 * @property-read mixed $quality
 * @property-read mixed $required_type
 * @property-read mixed $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order_image[] $image
 * @property-read \App\Models\Order_detail $latestNote
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order_detail[] $size
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order_detail[] $suggest
 * @property-read \App\Models\Supplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdPriceUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdQuality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdRequiredType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdTemplatePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOdWantedPrice($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product_tran
 *
 * @property int $tran_id
 * @property string|null $tran_name
 * @property string|null $tran_alias
 * @property string|null $tran_sapo
 * @property string|null $tran_des
 * @property string|null $tran_spec
 * @property int $tran_lang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereTranAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereTranDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereTranId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereTranLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereTranName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereTranSapo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereTranSpec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $id
 * @property int $product_prd_id
 * @property string|null $prd_name
 * @property string|null $prd_alias
 * @property string|null $prd_sapo
 * @property string|null $prd_des
 * @property string|null $prd_spec
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran wherePrdAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran wherePrdDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran wherePrdName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran wherePrdSapo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran wherePrdSpec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_tran whereProductPrdId($value)
 */
	class Product_tran extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role_user
 *
 * @property int $role_id
 * @property string|null $role_name
 * @property string|null $role_des
 * @property int $role_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user whereRoleDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user whereRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user whereRoleStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $role_value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role_user whereRoleValue($value)
 */
	class Role_user extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country query()
 * @mixin \Eloquent
 * @property int $cty_id
 * @property string|null $cty_code
 * @property string|null $cty_language
 * @property string|null $cty_name
 * @property string|null $cty_alias
 * @property string|null $cty_phoneCode
 * @property string|null $cty_numbericCode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyNumbericCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyPhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereUpdatedAt($value)
 * @property string|null $cty_languageCode
 * @property string|null $cty_langName
 * @property int $cty_order
 * @property int $cty_status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyLangName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyLanguageCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCtyStatus($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\City
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City query()
 * @mixin \Eloquent
 * @property int $city_id
 * @property string $city_code
 * @property string $city_name
 * @property string $city_alias
 * @property int $city_country
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCityAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCityCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereUpdatedAt($value)
 * @property int $city_order
 * @property int $city_status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCityOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCityStatus($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product_image
 *
 * @property int $img_id
 * @property int $img_product
 * @property string|null $img_src
 * @property string|null $img_name
 * @property string|null $img_alias
 * @property int $img_status
 * @property int $img_shape
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image whereImgAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image whereImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image whereImgName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image whereImgProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image whereImgShape($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image whereImgSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image whereImgStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product_image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Product_image extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Tag
 *
 * @package App\Models
 * @property int $tag_id
 * @property string|null $tag_name
 * @property string|null $tag_alias
 * @property string|null $tag_normalized
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $tga
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereTagAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereTagNormalized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Device_token
 *
 * @property int $token_user
 * @property string|null $token_device
 * @property string|null $token_value
 * @property string|null $token_push
 * @property string|null $token_expire
 * @property string|null $token_lastLogin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token whereTokenDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token whereTokenExpire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token whereTokenLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token whereTokenPush($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token whereTokenUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token whereTokenValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device_token whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Device_token extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $user_id
 * @property string|null $user_name
 * @property string|null $user_showName
 * @property string|null $user_alias
 * @property string|null $password
 * @property string|null $user_des
 * @property string|null $user_email
 * @property string|null $user_phone
 * @property string|null $user_avatar
 * @property int $user_country
 * @property int $user_city
 * @property int $user_district
 * @property string|null $user_address
 * @property string|null $user_birthday
 * @property int $user_type
 * @property int $user_role
 * @property int $user_verify
 * @property string|null $user_verifyCode
 * @property int $user_status
 * @property string|null $stripe_id
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $trial_ends_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\Role_user $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserShowName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserVerifyCode($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles, $guard = null)
 * @property string|null $user_gender
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $supply
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserGender($value)
 * @property-read \App\Models\City $city
 * @property string|null $user_postalCode
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserPostalCode($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Config
 *
 * @property int $cfg_id
 * @property string|null $cfg_name
 * @property string|null $cfg_value
 * @property string|null $cfg_alias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereCfgAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereCfgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereCfgName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereCfgValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $cfg_valueEn
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereCfgValueEn($value)
 */
	class Config extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment query()
 * @mixin \Eloquent
 * @property int $pay_id
 * @property string|null $pay_name
 * @property string|null $pay_alias
 * @property string|null $pay_config
 * @property int $pay_status
 * @property int $pay_type
 * @property string|null $pay_source
 * @property string|null $pay_content
 * @property string|null $pay_gate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePayAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePayConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePayContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePayGate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaySource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereUpdatedAt($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order_detail
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail query()
 * @mixin \Eloquent
 * @property int $od_id
 * @property int $od_order
 * @property int $od_type
 * @property float $od_price
 * @property float $od_priceNow
 * @property string $od_coupon
 * @property int $od_priority
 * @property int $od_status
 * @property string|null $od_message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdPriceNow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdPriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereUpdatedAt($value)
 * @property string|null $od_name
 * @property int $od_quantity
 * @property int $od_assigneeTo
 * @property int $od_parent
 * @property string|null $od_detail
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdAssigneeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdQuantity($value)
 * @property string|null $od_unit
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdUnit($value)
 * @property float|null $od_priceUnit
 * @property-read \App\Models\Supplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_detail whereOdPriceUnit($value)
 */
	class Order_detail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supplier
 *
 * @property int $sp_id
 * @property int $sp_user
 * @property string|null $sp_manager
 * @property string|null $sp_banner
 * @property string|null $sp_avatar
 * @property string|null $sp_showName
 * @property string|null $sp_location
 * @property string|null $sp_locationId
 * @property string|null $sp_businessType
 * @property int $sp_numEmployee
 * @property string|null $sp_archive
 * @property int $sp_quanlity
 * @property float $sp_point
 * @property float $sp_rate
 * @property int $sp_numRate
 * @property string|null $sp_init
 * @property string|null $sp_product
 * @property string|null $sp_service
 * @property int $sp_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpBusinessType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpInit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpNumEmployee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpNumRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpPoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpQuanlity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpShowName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $sp_name
 * @property string|null $sp_alias
 * @property string|null $sp_email
 * @property string|null $sp_phone
 * @property int $sp_city
 * @property int $sp_minQuantity
 * @property int $sp_maxQuantity
 * @property int $sp_quanlityOrder
 * @property string|null $sp_businessLicense
 * @property int $sp_status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpBusinessLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpMaxQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpMinQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpQuanlityOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpStatus($value)
 * @property string|null $sp_code
 * @property int|null $sp_qualityOrder
 * @property int|null $sp_licenseId
 * @property-read \App\Models\City|null $city
 * @property-read mixed $quality_order
 * @property-read mixed $type_supplier
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpLicenseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSpQualityOrder($value)
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Article_tran
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $article_atc_id
 * @property string|null $atc_title
 * @property string|null $atc_alias
 * @property string|null $atc_sapo
 * @property string|null $atc_content
 * @property string|null $atc_source
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran whereArticleAtcId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran whereAtcAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran whereAtcContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran whereAtcSapo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran whereAtcSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran whereAtcTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article_tran whereLocale($value)
 */
	class Article_tran extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supply
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply query()
 * @mixin \Eloquent
 * @property int $sp_user
 * @property int $sp_product
 * @property int $sp_quantity
 * @property int $sp_status
 * @property float $sp_price
 * @property float $sp_priceNow
 * @property string|null $sp_coupon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereSpCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereSpPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereSpPriceNow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereSpProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereSpQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereSpStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereSpUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereUpdatedAt($value)
 * @property int $sp_supply
 * @property int $sp_cate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereSpCate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supply whereSpSupply($value)
 */
	class Supply extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cate_product_tran
 *
 * @property int $tran_id
 * @property string|null $tran_value
 * @property string|null $tran_alias
 * @property string|null $tran_size
 * @property int $tran_lang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereTranAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereTranId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereTranLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereTranSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereTranValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $id
 * @property int $cate_product_cate_id
 * @property string|null $cate_value
 * @property string|null $cate_alias
 * @property string|null $cate_size
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereCateAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereCateProductCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereCateSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereCateValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_product_tran whereLocale($value)
 */
	class Cate_product_tran extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subscriber
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber query()
 * @mixin \Eloquent
 */
	class Subscriber extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Social_account
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social_account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social_account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social_account query()
 * @mixin \Eloquent
 */
	class Social_account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Article
 *
 * @property int $atc_id
 * @property string|null $atc_title
 * @property string|null $atc_alias
 * @property string|null $atc_sapo
 * @property string|null $atc_content
 * @property int $atc_cate
 * @property int $atc_type
 * @property int $atc_createdBy
 * @property int $atc_updatedBy
 * @property int $atc_approvedBy
 * @property string|null $atc_featureImg
 * @property string|null $atc_tag
 * @property int $atc_promote
 * @property int $atc_view
 * @property int $atc_status
 * @property string|null $atc_source
 * @property string|null $atc_publicDate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Cate_article $cate_article
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcCate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcFeatureImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcPromote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcPublicDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcSapo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAtcView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article_tran[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article withTranslation()
 */
	class Article extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Feedback
 *
 * @property int $fb_id
 * @property int $fb_cate
 * @property int $fb_user
 * @property string|null $fb_info
 * @property string|null $fb_content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbCate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $fb_code
 * @property string|null $fb_email
 * @property string|null $fb_phone
 * @property string|null $fb_name
 * @property int|null $fb_order
 * @property int|null $fb_assignee
 * @property int|null $fb_status
 * @property string|null $fb_note
 * @property-read mixed $cate
 * @property-read \App\Models\Order|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbAssignee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFbStatus($value)
 */
	class Feedback extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rating
 *
 * @property int $rate_id
 * @property float|null $rate_star
 * @property string|null $rate_title
 * @property string|null $rate_content
 * @property string|null $rate_targetType
 * @property int|null $rate_targetId
 * @property string|null $rate_authorType
 * @property int|null $rate_authorId
 * @property int $rate_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $supplier
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRateAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRateAuthorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRateContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRateStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRateStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRateTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRateTargetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRateTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereUpdatedAt($value)
 */
	class Rating extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cate_article
 *
 * @property int $cate_id
 * @property string|null $cate_name
 * @property string|null $cate_value
 * @property string|null $cate_imgFeature
 * @property int $cate_parent
 * @property string|null $cate_alias
 * @property string|null $cate_tag
 * @property int $cate_order
 * @property int $cate_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cate_article $parent_cate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cate_article[] $sub_cate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCateAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCateImgFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCateOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCateParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCateStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCateTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCateValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cate_article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Cate_article extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Taggable
 *
 * @property int $tga_id
 * @property int $tga_tag
 * @property string|null $tga_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taggable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taggable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taggable query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taggable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taggable whereTgaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taggable whereTgaTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taggable whereTgaType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taggable whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Taggable extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District query()
 * @mixin \Eloquent
 * @property int $dt_id
 * @property string|null $dt_code
 * @property string|null $dt_name
 * @property string|null $dt_alias
 * @property int $dt_city
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereDtAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereDtCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereDtCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereDtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereDtName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereUpdatedAt($value)
 * @property int $dt_order
 * @property int $dt_status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereDtOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereDtStatus($value)
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order_image
 *
 * @property int $img_id
 * @property int $img_order
 * @property string|null $img_src
 * @property string|null $img_name
 * @property string|null $img_alias
 * @property int $img_status
 * @property int $img_shape
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image whereImgAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image whereImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image whereImgName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image whereImgOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image whereImgShape($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image whereImgSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image whereImgStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order_image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Order_image extends \Eloquent {}
}

