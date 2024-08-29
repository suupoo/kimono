<?php

namespace App\Facades\Utility;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CustomFormService
{
    protected array $renders;

    protected $object;

    public function make($object = null): self
    {
        $this->renders = [];
        $this->object = $object;

        return $this;
    }

    /**
     * @return $this
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function input(array $attributes): self
    {
        // 初期値
        $id = null;
        $name = null;
        $type = null;
        $placeholder = null;
        $value = null;
        $fileAccept = null;

        // objectがあれば、objectの値を使う
        if ($this->object) {
            // set value from object
            $id = $this->object->id();
            $name = $this->object->id(); //現時点ではnameはidと同じ
            $type = $this->object->inputType();
            $placeholder = $this->object?->placeholder();
            if ($type === 'file') {
                $fileAccept = implode(',', $this->object?->fileExtensions(true));
            }
        }

        // attributeで指定した値があれば上書き
        if (array_key_exists('id', $attributes)) {
            $id = $attributes['id'];
        }
        if (array_key_exists('name', $attributes)) {
            $name = $attributes['name'];
        }
        if (array_key_exists('type', $attributes)) {
            $type = $attributes['type'];
        }
        if (array_key_exists('placeholder', $attributes)) {
            $placeholder = $attributes['placeholder'];
        }
        if (array_key_exists('value', $attributes)) {
            $value = $attributes['value'];
        }
        if (array_key_exists('fileAccept', $attributes)) {
            $fileAccept = $attributes['fileAccept'];
        }

        // 既存の値とマージ
        $attributes = array_merge($attributes, [
            'id' => $id,
            'name' => $name,
            'type' => $type,
            'placeholder' => $placeholder,
            'value' => old($name, request()->get($name, $value)),
            'fileAccept' => $fileAccept,
        ]);

        $this->renders[] = view('components.custom-form.input', compact('attributes'));

        return $this;
    }

    /**
     * @return $this
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function label(array $attributes): self
    {
        // 初期値
        $for = null;
        $label = null;

        // objectがあれば、objectの値を使う
        if ($this->object) {
            $for = $this->object->id();
            $label = $this->object->label();
        }

        // attributeで指定した値があれば上書き
        if (array_key_exists('for', $attributes)) {
            $for = $attributes['for'];
        }
        if (array_key_exists('label', $attributes)) {
            $label = $attributes['label'];
        }

        // 既存の値とマージ
        $attributes = array_merge($attributes, [
            'for' => $for,
            'label' => $label,
        ]);

        $this->renders[] = view('components.custom-form.label', compact('attributes'));

        return $this;
    }

    public function select(array $attributes, array $options = []): self
    {
        // 初期値
        $id = null;
        $name = null;

        // objectがあれば、objectの値を使う
        if ($this->object) {
            $id = $this->object->id();
            $name = $this->object->id(); //現時点ではnameはidと同じ
        }

        // attributeで指定した値があれば上書き
        if (array_key_exists('id', $attributes)) {
            $id = $attributes['id'];
        }
        if (array_key_exists('name', $attributes)) {
            $name = $attributes['name'];
        }

        // 既存の値とマージ
        $attributes = array_merge($attributes, [
            'id' => $id,
            'name' => $name,
        ]);

        $this->renders[] = view('components.custom-form.select', compact('attributes', 'options'));

        return $this;
    }

    public function editor(array $attributes): self
    {
        // 初期値
        $id = null;
        $name = null;

        // objectがあれば、objectの値を使う
        if ($this->object) {
            $id = $this->object->id();
            $name = $this->object->id(); //現時点ではnameはidと同じ
        }

        // attributeで指定した値があれば上書き
        if (array_key_exists('id', $attributes)) {
            $id = $attributes['id'];
        }
        if (array_key_exists('name', $attributes)) {
            $name = $attributes['name'];
        }

        // 既存の値とマージ
        $attributes = array_merge($attributes, [
            'id' => $id,
            'name' => $name,
        ]);

        $this->renders[] = view('components.custom-form.wysiwyg', compact('attributes'));

        return $this;
    }

    /**
     * HTML出力
     */
    public function render(): string
    {
        $views = [];
        foreach ($this->renders as $render) {
            $views[] = $render->render();
        }

        return implode('', $views);
    }
}
