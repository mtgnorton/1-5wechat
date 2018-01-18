<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;


use Mtg\ShowImage\ShowImagesService;

class BoxImage extends Field
{

    public function render(){

        return ShowImagesService::getView($this->value);

    }

}