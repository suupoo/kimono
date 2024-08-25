<?php

namespace App\View\Components\Carousel;

use App\Models\MSystemBanner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Adsense extends Component
{
    protected Collection $banners;
    protected bool $autoPlay = false;
    protected array $classes = [
        'relative',
    ];
    protected array $options = [
        'loadingClasses' => 'opacity-0',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(
        bool $autoPlay = false,
        string $class = null,
    )
    {
        // クラス
        if ($class) {
            $this->classes = array_merge($this->classes, explode(' ', $class));
        }

        // オプション
        $this->autoPlay = $autoPlay;
        if ($this->autoPlay) {
            $this->options['isAutoPlay'] = true;
        }
        // データ取得
        $this->banners = MSystemBanner::query()
            ->orderBy('priority')
            ->limit(3)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.carousel.adsense',[
            'banners' => $this->banners,
            'autoPlay' => $this->autoPlay,
            'classes' => $this->classes,
            'options' => $this->options,
        ]);
    }
}
