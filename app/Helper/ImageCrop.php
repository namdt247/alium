<?php  

namespace App\Helper;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageCrop
{

	protected $cropUserSize = array(
    );
    
    protected $cropProductSize = array(
        "c1" => array(
            540,235
        ),
    );

    protected $cropProductMetaSize = array(
        "c1" => array(
            320,320
        ),
    );

    protected $cropArticleSize = array(
        // list article thumb
        "c1" => array(
            360,360
        ),
    );

    protected $cropOrderSize = array(
        "c1" => array(
            640,480
        ),
    );

    protected $cropSupplierSize = array(
        "c1" => array(
            360,360
        ),
        "c2" => array(
            640,480
        )
    );

    public function RemoveThumb($path){
        if (Storage::exists($path))
        {
            $imagesInfo = pathinfo($path);
            $directories = Storage::directories($imagesInfo['dirname']);
            foreach($directories as $dir){
                $arr = explode('/',$dir);
                $dirName = $arr[count($arr) - 1 ];
                if (Storage::exists($dir.'/'.$imagesInfo['basename']) && substr( $dirName, 0, 1 ) === "c")
                    Storage::delete($dir.'/'.$imagesInfo['basename']);
            }
            Storage::delete($path);
        }
    }

    public function MakeThumb($path,$w,$h,$dir){
        $imagesInfo = pathinfo($path);
        $image = Image::make(Storage::path($path));
        $height = $image->height();
        $width = $image->width();
        if (!Storage::exists($imagesInfo['dirname'].'/'.$dir))
            Storage::makeDirectory($imagesInfo['dirname'].'/'.$dir);
        if($height < $h || $width < $w) {
            $img = $image->crop($w, $h);
        }
        else {
            $img = $image->fit($w, $h);
        }
        $strName = Storage::path($imagesInfo['dirname'].'/'.$dir.'/'.$imagesInfo['basename']);
        $img->save($strName);
    }

    public function MakeProductThumb($FilePath)
    {
        if (Storage::exists($FilePath))
        {
            ini_set("memory_limit","1000M");
            set_time_limit(1000);

            foreach ($this->cropProductSize as $key => $value) {
                $this->MakeThumb($FilePath,$value[0],$value[1],$key);
            }
        }
    }

    public function MakeProductMetaThumb($FilePath)
    {
        if (Storage::exists($FilePath)){
            ini_set("memory_limit", "1000M");
            set_time_limit(1000);

            foreach ($this->cropProductMetaSize as $key => $value) {
                $this->MakeThumb($FilePath, $value[0], $value[1], $key);
            }
        }
    }

    public function MakeArticleThumb($FilePath)
    {
        if (Storage::exists($FilePath))
        {
            ini_set("memory_limit","1000M");
            set_time_limit(1000);

            foreach ($this->cropArticleSize as $key => $value) {
                $this->MakeThumb($FilePath,$value[0],$value[1],$key);
            }
        }
    }

    public function MakeUserThumb($FilePath)
    {
        if (Storage::exists($FilePath))
        {
            ini_set("memory_limit","1000M");
            set_time_limit(1000);

            foreach ($this->cropUserSize as $key => $value) {
                $this->MakeThumb($FilePath,$value[0],$value[1],$key);
            }
        }
    }

    public function MakeOrderThumb($FilePath)
    {
        if (Storage::exists($FilePath))
        {
            ini_set("memory_limit","1000M");
            set_time_limit(1000);

            foreach ($this->cropOrderSize as $key => $value) {
                $this->MakeThumb($FilePath,$value[0],$value[1],$key);
            }
        }
    }

    public function MakeSupplierThumb($FilePath)
    {
        if (Storage::exists($FilePath))
        {
            ini_set("memory_limit","1000M");
            set_time_limit(1000);

            foreach ($this->cropSupplierSize as $key => $value) {
                $this->MakeThumb($FilePath,$value[0],$value[1],$key);
            }
        }
    }
}

