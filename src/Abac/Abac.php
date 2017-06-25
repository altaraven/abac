<?php

namespace Abac;

use Abac\Example\Example;

class Abac
{
    public function __construct()
    {
        (new Example())->test();
    }
}