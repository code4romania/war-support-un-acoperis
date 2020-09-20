<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use A17\Twill\Repositories\SettingRepository;
use App\Repositories\PageRepository;
use Illuminate\Support\Facades\View;

class PageController extends ModuleController
{
    protected $moduleName = 'pages';
}
