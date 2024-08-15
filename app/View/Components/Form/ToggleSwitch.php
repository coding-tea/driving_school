<?php

namespace App\View\Components\Form;

use App\View\Component;


/***
 * Toggle Switch is components class exists to play the role off switch button
 * provide two option one and two each one has own text,color,val ...
 */
class ToggleSwitch extends Component
{


    public const TS_COLOR_PRIMARY = 'primary';
    public const TS_COLOR_SECONDARY = 'secondary';
    public const TS_COLOR_SUCCESS = 'success';
    public const TS_COLOR_DANGER = 'danger';
    public const TS_COLOR_WARNING = 'warning';
    public const TS_COLOR_INFO = 'info';
    public const TS_COLOR_LIGHT = 'light';
    public const TS_COLOR_DARK = 'dark';


    public const TS_COLOR_OUTLINE_PRIMARY = 'outline-primary';
    public const TS_COLOR_OUTLINE_SECONDARY = 'outline-secondary';
    public const TS_COLOR_OUTLINE_SUCCESS = 'outline-success';
    public const TS_COLOR_OUTLINE_DANGER = 'outline-danger';
    public const TS_COLOR_OUTLINE_WARNING = 'outline-warning';
    public const TS_COLOR_OUTLINE_INFO = 'outline-info';
    public const TS_COLOR_OUTLINE_LIGHT = 'outline-light';
    public const TS_COLOR_OUTLINE_DARK = 'outline-dark';

    public const TS_STYLE_SIMPLE = 'android';
    public const TS_STYLE_ROUNDED = 'ios';


    public const TS_SIZE_LG = 'lg';
    public const TS_SIZE_SM = 'sm';
    public const TS_SIZE_XS = 'xs';




    /***
     * the first option color
     * @var string
     */
    public string $firstOptionColor;

    /**
     * the second option color
     * @var string
     */
    public string $secondOptionColor;


    /**
     * the first option text
     * @var string
     */
    public string $firstOptionText;


    /**
     * the second option text
     * @var string
     */
    public string $secondOptionText;

    public string $firstOptionValue;
    public string $secondOptionValue;

    /**
     * the TS style (IOS, MOBILE)
     * @var string
     */
    public string $style;


    /**
     * Toggle Switch size as options lg,sm,xs
     * @var
     */
    public  $size;

    /***
     * three state toggle
     * @var
     */
    public bool $tristate;

    /***
     * Custom Sizes for the Toggle Switch
     * ifcustom size will overate @size
     * @var string
     */
    public  string $customSizewidth ;
    public  string $customSizeHeight ;
    /*********************************/

    /**
     * set the disable attribute
     * @var bool
     */
    public bool $disabled;


    /**
     * set the checked attribute
     * @var bool
     */
    public  $checked;




    public function __construct(
        String $name,
        String $label = '',
        string $firstOptionColor = '',
        string $secondOptionColor ='',
        string $firstOptionText = 'on',
        string $secondOptionText = 'off',
        string|null $firstOptionValue = null,
        string|null $secondOptionValue = null,
        string $style = self::TS_STYLE_SIMPLE,
        string|null $size = null,
        string $customSizeWidth = '',
        string $customSizeHeight = '',
        bool   $tristate = false,
        array  $custom_sizes = [],
        bool   $disabled = true,
        bool|null   $checked = null,
        bool   $required = false
    )
    {
        parent::__construct();


        $this->firstOptionColor = $firstOptionColor;
        $this->secondOptionColor = $secondOptionColor;



        $this->firstOptionText = $firstOptionText;
        $this->secondOptionText = $secondOptionText;

        $this->firstOptionValue = $firstOptionValue ?? $this->firstOptionText;
        $this->secondOptionValue = $secondOptionValue ?? $this->secondOptionText;

        $this->style = $style;
        $this->size = $size;
        $this->customSizewidth = $customSizeWidth;
        $this->customSizeHeight = $customSizeHeight;
        $this->tristate = $tristate;
        $this->custom_sizes = $custom_sizes;
        $this->disabled = $disabled;
        $this->checked = $checked;
        $this->required = $required;
        $this->name = $name;
        $this->label = $label;




        $this->getValue();





    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.toggle-switch');
    }
}
