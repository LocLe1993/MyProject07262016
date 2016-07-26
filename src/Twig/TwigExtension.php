<?php

namespace MyProject\Twig;

use MyProject\Core\Helper;

class TwigExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('testHelper', array($this, 'testHelperFilter')),
        );
    }

    public function testHelperFilter($str_input)
    {
        return Helper::testHelper($str_input);
    }

    public function getName()
    {
        return 'myproject';
    }
}