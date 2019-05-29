<?php

function ppr($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function ppre($var)
{
    ppr($var);
    exit;
}
