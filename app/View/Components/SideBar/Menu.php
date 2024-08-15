<?php

namespace App\View\Components\SideBar;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Menu extends Component
{

    public array $menus;
    public array $cur_menu = [];


    public function __construct()
    {
        $this->menus = self::getMenu();


        $this->isCurrentUrlBelongsToPage();
    }


    /***
     *
     * @return
     */
    public static function getMenu()
    {
        return [
            [
                'name' => 'Dashboard',
                'icon' => 'ki-duotone ki-home fs-2x',

                'pages' => [
                    [
                        'name' => "Offices",
                        // 'icon' => 'ki-outline ki-shield-tick fs-2 ',
                        'route_name' => 'offices.index',
                    ],
                    [
                        'name' => "Factores",
                        'icon' => 'ki-outline ki-shield-tick fs-2 ',
                        // 'route_name' => 'payments.index',
                    ],
                ]
            ],
            [
                'name' => 'Office',
                'icon' => 'fa-solid fa-school fs-2x',

                'pages' => [
                    [
                        'name' => "staff",
                        // 'icon' => 'fa-solid fa-user fs-2x',
                        'route_name' => 'staffs.index',
                    ],
                    [
                        'name' => "candidats",
                        // 'icon' => 'fa-solid fa-user fs-2x',
                        'route_name' => 'profile.index',
                    ],
                    [
                        'name' => "Payment",
                        // 'icon' => 'fa-solid fa-book fs-2x',
                        'route_name' => 'payments.index',
                    ],
                    [
                        'name' => "Cars",
                        // 'icon' => 'fa-solid fa-book fs-2x',
                        'route_name' => 'cars.index',
                    ],
                ]
            ],

        ];
    }

    /***
     *
     * @return
     */
    public function isCurrentUrlBelongsToPage()
    {
        foreach ($this->menus as &$menu) {
            $menu['current'] = false;
            foreach ($menu['pages'] as &$page) {
                if (isset($page['pages'])) {
                    foreach ($page['pages'] as &$pageX) {
                        if (isset($pageX['route_name']) && url()->current() == route($pageX['route_name'])) {
                            $menu['current'] = true;
                            $page['current'] = true;
                            $pageX['current'] = true;
                            $this->cur_menu = $menu;
                            break 3;
                        } else {
                            $this->cur_menu = $menu;
                        }
                    }
                } else {
                    if (isset($page['route_name']) && Request::is($page['route_name'])) {
                        $menu['current'] = true;
                        $this->cur_menu = $menu;
                        break 2;
                    }
                }
            }
        }

        //        $this->menus[0]['current'] = true;


    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.side-bar.menu');
    }
}

class SmithWatermanGotoh
{
    private $gapValue;
    private $substitution;

    /**
     * Constructs a new Smith Waterman metric.
     *
     * @param gapValue
     *            a non-positive gap penalty
     * @param substitution
     *            a substitution function
     */
    public function __construct(
        $gapValue = -0.5,
        $substitution = null
    ) {
        if ($gapValue > 0.0) throw new Exception("gapValue must be <= 0");
        //if(empty($substitution)) throw new Exception("substitution is required");
        if (empty($substitution)) $this->substitution = new SmithWatermanMatchMismatch(1.0, -2.0);
        else $this->substitution = $substitution;
        $this->gapValue = $gapValue;
    }

    public function compare($a, $b)
    {
        if (empty($a) && empty($b)) {
            return 1.0;
        }

        if (empty($a) || empty($b)) {
            return 0.0;
        }

        $maxDistance = min(mb_strlen($a), mb_strlen($b))
            * max($this->substitution->max(), $this->gapValue);
        return $this->smithWatermanGotoh($a, $b) / $maxDistance;
    }

    private function smithWatermanGotoh($s, $t)
    {
        $v0 = [];
        $v1 = [];
        $t_len = mb_strlen($t);
        $max = $v0[0] = max(0, $this->gapValue, $this->substitution->compare($s, 0, $t, 0));

        for ($j = 1; $j < $t_len; $j++) {
            $v0[$j] = max(
                0,
                $v0[$j - 1] + $this->gapValue,
                $this->substitution->compare($s, 0, $t, $j)
            );

            $max = max($max, $v0[$j]);
        }

        // Find max
        for ($i = 1; $i < mb_strlen($s); $i++) {
            $v1[0] = max(0, $v0[0] + $this->gapValue, $this->substitution->compare($s, $i, $t, 0));

            $max = max($max, $v1[0]);

            for ($j = 1; $j < $t_len; $j++) {
                $v1[$j] = max(
                    0,
                    $v0[$j] + $this->gapValue,
                    $v1[$j - 1] + $this->gapValue,
                    $v0[$j - 1] + $this->substitution->compare($s, $i, $t, $j)
                );

                $max = max($max, $v1[$j]);
            }

            for ($j = 0; $j < $t_len; $j++) {
                $v0[$j] = $v1[$j];
            }
        }

        return $max;
    }
}

class SmithWatermanMatchMismatch
{
    private $matchValue;
    private $mismatchValue;

    /**
     * Constructs a new match-mismatch substitution function. When two
     * characters are equal a score of <code>matchValue</code> is assigned. In
     * case of a mismatch a score of <code>mismatchValue</code>. The
     * <code>matchValue</code> must be strictly greater then
     * <code>mismatchValue</code>
     *
     * @param matchValue
     *            value when characters are equal
     * @param mismatchValue
     *            value when characters are not equal
     */
    public function __construct($matchValue, $mismatchValue)
    {
        if ($matchValue <= $mismatchValue) throw new Exception("matchValue must be > matchValue");

        $this->matchValue = $matchValue;
        $this->mismatchValue = $mismatchValue;
    }

    public function compare($a, $aIndex, $b, $bIndex)
    {
        return ($a[$aIndex] === $b[$bIndex] ? $this->matchValue
            : $this->mismatchValue);
    }

    public function max()
    {
        return $this->matchValue;
    }

    public function min()
    {
        return $this->mismatchValue;
    }
}
