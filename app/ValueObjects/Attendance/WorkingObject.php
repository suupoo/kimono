<?php

namespace App\ValueObjects\Attendance;

use App\ValueObjects\ValueObject;
use Carbon\CarbonImmutable;

/**
 * 勤務時間オブジェクト
 */
class WorkingObject extends ValueObject
{
    protected string $startDate;
    protected string $startTime;
    protected CarbonImmutable $start;
    protected string $endDate;
    protected string $endTime;
    protected CarbonImmutable $end;
    protected int $hourlyWage;

    /**
     * コンストラクタ
     * @param array $attributes
     * @throws \Exception
     */
    public function __construct(array $attributes = [])
    {
        // 必須のパラメータがない場合は例外を投げる
        if(!(array_key_exists('start_date', $attributes) && array_key_exists('start_time', $attributes) && array_key_exists('end_date', $attributes) && array_key_exists('end_time', $attributes))){
           throw new \Exception('Invalid attributes');
        }
        $this->startDate = $attributes['start_date'];
        $this->startTime = $attributes['start_time'];
        $this->endDate = $attributes['end_date'];
        $this->endTime = $attributes['end_time'];
        $this->start = CarbonImmutable::createFromFormat('Y-m-d H:i:s', $this->startDate . ' ' . $this->startTime);
        $this->end = CarbonImmutable::createFromFormat('Y-m-d H:i:s', $this->endDate . ' ' . $this->endTime);
        $this->hourlyWage = 3600;// todo:時給の設定を動的にする
    }

    /**
     * 分給を算出する
     * @return int
     */
    private function minutelyWage(): int
    {
        return round($this->hourlyWage / 60);
    }

    /**
     * 日給を計算する
     * @return int
     */
    private function dailyWage():int
    {
        return floor($this->minutelyWage() * $this->calculateWorkingTime());
    }

    /**
     * 勤務時間（分）を計算する
     * @return float
     */
    private function calculateWorkingTime(): float
    {
        return $this->start->diffInMinutes($this->end);
    }

    /**
     * 起算日を返す
     * @return string
     */
    public function getDate(): string
    {
        return $this->start->format('Y-m-d');
    }

    /**
     * 勤務時間をテキストにして返す
     * @return string
     */
    private function workingTimeText(): string
    {
        $hours = floor($this->calculateWorkingTime() / 60);
        $minutes = $this->calculateWorkingTime() % 60;

        return ($hours == 0)
            ? $minutes. '分'
            : $hours. '時間'. $minutes. '分';
    }

    /**
     * 勤務状況をテキストにして返す
     * @return string
     */
    public function text(): string
    {
        $text  = ''.$this->getDate(). ''. PHP_EOL;
        $text .= ($this->start->format('Y-m-d') === $this->end->format('Y-m-d'))
            ? $this->start->format('H:i') .' 〜 '. $this->end->format('H:i'). PHP_EOL
            : $this->start->format('H:i') .' 〜 '. $this->end->format('Y-m-d H:i'). PHP_EOL;
        $text .= '日給概算：'. $this->dailyWage(). '円（'.$this->workingTimeText().'）';
        return
            $text;
    }
}
