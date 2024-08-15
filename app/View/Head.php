<?php

namespace App\View;

class Head
{

    public const TYPE_TEXT = 'TEXT';

    public const TYPE_IMG = 'IMG';
    public const TYPE_OPTIONS = 'OPTIONS';
    public const TYPE_FILE = 'FILE';
    public const TYPE_DATE = 'DATE';
    public const TYPE_EMPTY = 'EMPTY';
    public const TYPE_CUSTOM = 'CUSTOM';
    public const TYPE_COLOR = 'HTML';

    private string $name;
    private string $type;
    private string $showAs;
    private array $options;



    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getShowAs(): string
    {
        return empty($this->showAs) ? strtoupper($this->name) :  strtoupper($this->showAs);
    }

    /**
     * @param string $showAs
     */
    public function setShowAs(string $showAs): void
    {
        $this->showAs = $showAs;
    }


    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }


    /**
     * @param string $name
     * @param string $type
     * @param string $showAs
     * @param array $options
     */
    public function __construct(string $name = '', string $type = Head::TYPE_TEXT, string $showAs = '' , array $options = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->showAs = $showAs;
        $this->options = $options;


    }




}
