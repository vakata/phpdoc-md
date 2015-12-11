<?php namespace Clean\PhpDocMd\Markdown\GitHub;

use Clean\View\Phtml;
use Clean\PhpDocMd\ClassParser;
use ReflectionClass;

class ClassInfo extends Phtml
{
    private $reflectionClass;
    private $classes;

    public function __construct(ReflectionClass $class, array $classes)
    {
        $this->setTemplate(__DIR__.'/../../../tpl/github.class.phtml');
        $this->reflectionClass = $class;
        $this->classes = $classes;
    }

    public function render()
    {
        $parser = new ClassParser($this->reflectionClass);
        $this->setData(
            [
                'className' => $this->reflectionClass->getName(),
                'classShortName' => $this->reflectionClass->getShortName(),
                'methods' => $parser->getMethodsDetails(),
                'classDescription' => $parser->getClassDescription(),
                'classes' => $this->classes
            ]
        );
        return parent::render();
    }
}
