<?php


namespace Grav\Plugin;

use Grav\Common\Grav;
use RocketTheme\Toolbox\ResourceLocator\UniformResourceLocator;
use Grav\Common\Page\Medium\MediumFactory;


class MediumTwigExtension extends \Twig_Extension
{
    protected $grav;
    protected $debugger;
    protected $config;

    /**
     * TwigExtension constructor.
     */
    public function __construct()
    {
        $this->grav     = Grav::instance();
        $this->debugger = isset($this->grav['debugger']) ? $this->grav['debugger'] : null;
        $this->config   = $this->grav['config'];
    }

    /**
     * Returns extension name.
     *
     * @return string
     */
    public function getName()
    {
        return 'MediumTwigExtension';
    }

    /**
     * Return a list of all functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('medium', [$this, 'getMedium']),
        ];
    }

    public function getMedium($location)
    {
        /** @var UniformResourceLocator $locator */
        $locator = $this->grav['locator'];

        // Get relative path to the resource (or false if not found).
        $path = $locator->findResource((string)$location, false);
        $medium = MediumFactory::fromFile($path);

        return $medium;
    }
}