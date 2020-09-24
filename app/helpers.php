<?php

use App\Repositories\ConfigRepository;

function html5date($dateish) {
    return date_create($dateish)->format("Y-m-d\TH:i");
}

function veryshortdatetime($dateish) {
    return date_create($dateish)->format("j M H:i");
}

function config_get($key) {
    return resolve(ConfigRepository::class)->get($key);
}
