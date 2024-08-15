<?php

namespace App\View\Components\Form;


use App\View\Component;

class File extends Component
{

    public $filePath;
    public $file_name;
    public $file_ext;
    public $file_type;

    public $horizontal;
    public $orgValue;
    public $col;

    public const IMG = 0;
    public const PDF = 1;
    public const WORD = 2;
    public const EXEL = 3;
    public const DOCS = 4;
    public const ALL = 5;
    public const VIDEO = 6;
    public const AUDIO = 7;
    public const TEXT = 7;


    /**
     * @param string $label
     * @param $name
     * @param bool $required
     * @param bool $fileType
     * @param bool $readonly
     * @param string $imgPath
     * @param string $col '
     */
    public function __construct(
        string $name,
        string $label = '',
        bool   $required = false,
        int    $fileType = self::IMG,
        bool   $horizontal = true,
        bool   $readonly = false,
        string $col = 'col-12',
        string $src = null,
        bool   $showLabele = true
    ) {
        parent::__construct();
        $this->name = $name;
        if (empty($label)) {
            $this->label = ucwords($name);
        } else {
            $this->label = ucwords($label);
        }
        $this->required = $required;
        $this->readonly = $readonly;
        $this->horizontal = $horizontal;
        $this->col = $col;
        $this->file_type = $fileType;

        $this->showLabele = $showLabele;

        $this->getValue();
        $this->getFileInfo();

        $this->orgValue = $this->value;


        //        if(isset($src)){
        //            if ($this->isModel() && !empty($name) && !str_contains($this->model[$name], 'http')) {
        //                if (isset($this->model[$name]) && $this->model[$name] != '') {
        //
        //                    $this->value = route('show',$this->value);
        //
        //                } else {
        //                    $this->value = null;
        //                }
        //            } elseif ($this->isModel()) {
        //                $this->value = $this->model[$name];
        //            }
        //        }else{
        //            $this->value = route('show',$src);
        //        }
        if (isset($src))
            $this->value = stream_image_from_uploads($src);
    }


    /*
     * get name for input witch contain the path of file chosen
     * after submitting form with chosen file , server will get the file + textbook contain path
     */
    public function generateNameForInputFileTextbook(): string
    {
        return $this->name . '-path';
    }

    public function generateNameForInputFileImgPreview(): string
    {
        return $this->name . '-preview';
    }


    public function getFileInfo()
    {
        if ($this->isModel() && !empty($this->value)) {
            $filePath = $this->value;


            if (file_exists($filePath)) {
                $pathInfo = pathinfo($filePath);
                $this->file_name = $pathInfo['basename'] ?? "";
                $this->file_ext = $pathInfo['extension'] ?? "";
            }
        }
    }


    public function isImage()
    {
        if (isset($this->file_ext)) {
            return in_array($this->file_ext, ['png', 'jpeg', 'jpg']);
        }
        return null;
    }


    public function getType()
    {
        if (substr_count($this->file_type, '|') > 0) {
            return implode(',', array_map(function ($val) {
                return '.' . $val;
            }, explode('|', $this->file_type)));
        }
        return match ($this->file_type) {
            self::IMG => 'image/*',
            self::AUDIO => 'audio/*',
            self::TEXT => 'plain',
            self::VIDEO => 'video/*',
            self::PDF => 'application/pdf',
            self::WORD => 'application/msword',
            self::DOCS => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            self::EXEL => 'application/vnd.ms-excel',
            self::ALL => null,
            default => '.' . $this->file_type
        };
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.file');
    }
}
