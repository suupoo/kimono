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
    protected string $height   = 'h-[200px]';
    protected string $width    = 'w-[300px]';
    protected array $options = [
        'loadingClasses' => 'opacity-0',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(
        bool $autoPlay = false,
        string $height = 'h-96',
        string $width = 'w-full'
    )
    {
        $this->autoPlay = $autoPlay;
        if ($this->autoPlay) {
            $this->options['isAutoPlay'] = true;
        }
        $this->height   = $height;
        $this->width    = $width;
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
            'height' => $this->height,
            'width' => $this->width,
            'options' => $this->options,
        ]);
    }
}
