<?php

namespace App\ValueObjects\Column\Attendance;

use App\Facades\Utility\CustomForm;
use App\Models\Staff;
use App\ValueObjects\Column\Staff\Id as OriginalStaffId;
use Illuminate\Support\Facades\Route;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class StaffId extends OriginalStaffId
{
    public const NAME = 'staff_id';

    public const LABEL = 'スタッフ';

    protected bool $primaryKey = false;

    protected string $type = 'list';

    /**
     * IDを返す
     * @return string|null
     */
    public function id(): ?string
    {
        return self::NAME;
    }

    /**
     * 表示名を返す
     */
    public function label(): string
    {
        return self::LABEL;
    }

    /**
     * カラム名を返す
     */
    public function column(): ?string
    {
        return self::NAME;
    }

    /**
     * ルールを返す
     */
    public function rules(): array
    {
        return [
            'required',
            'integer',
            'exists:staffs,id',
        ];
    }

    /**
     * オプションを返す
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function options(): array
    {
        $query = Staff::query();
        if ( Route::is('attendances.create') ) {
            // 勤怠画面の新規登録画面
            // スタッフIDが指定されている場合はそのスタッフのみを返す
            if (request()->has('staff_id')) $query->where('id', request()->get('staff_id'));
        }

        return $query->get()
            ->map(function($staff){
                return [
                    'value' => $staff->id,
                    'label' => "{$staff->id}：{$staff->name}",
                ];
            })
            ->all();
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        return CustomForm::make($this)
            ->label($attributes)
            ->select($attributes, $this->options())
            ->render();
    }

}
