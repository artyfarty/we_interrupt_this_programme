<?php

function html5date($dateish) {
    return date_create($dateish)->format("Y-m-d\TH:i");
}
