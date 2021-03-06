<?php
use Encore\Admin\Form;
use App\Admin\Extensions\BoxImage;
use App\Admin\Extensions\Form\WangEditor;
use Encore\Admin\Grid\Column;
use App\Admin\Extensions\Column\FloatBar;

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);

config(['admin.logo'=>'<b>'.getConfig('site_name').'</b>']);

config(['admin.logo-mini'=>'<b>'.mb_substr(getConfig('site_name'),0,1).'</b>']);

Form::extend('boxImage', BoxImage::class);
Form::extend('editor', WangEditor::class);
Column::extend('floatBar', FloatBar::class);

