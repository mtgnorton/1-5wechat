<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'wang-editor';

    protected static $css = [
        '/vendor/wangEditor-3.0.10/release/wangEditor.css',
        '/vendor/wangEditor-3.0.10/release/wangEditor-fullscreen-plugin.css',
    ];

    protected static $js = [
        '/vendor/wangEditor-3.0.10/release/wangEditor.js',
        '/vendor/wangEditor-3.0.10/release/wangEditor-fullscreen-plugin.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);

        $this->script = <<<EOT

        var E = window.wangEditor
        var editor = new E('#{$this->id}');
        editor.customConfig.zIndex = 0
        editor.customConfig.uploadImgShowBase64 = true
         editor.customConfig.uploadImgServer = '/admin/wangeditor/upload'
        editor.customConfig.onchange = function (html) {
            $('input[name=$name]').val(html);
        }
        editor.create()
         E.fullscreen.init('#{$this->id}');
EOT;
        return parent::render();
    }
}
