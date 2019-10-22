<?php
namespace Logic\Device;

use Logic\BasicLogic;
use Model\MachineCupboardModel;

class DeviceDriver extends BasicLogic
{
    protected  $model;
    
    public function __construct()
    {
        if (! $this->model) {
            $this->model = new MachineCupboardModel();
        }
    }
}