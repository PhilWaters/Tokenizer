<?php
/**
 * Token class
 */

namespace PhilWaters\Tokenizer;

/**
 * Stores PHP token details
 */
class Token
{
    /**
     * Stores token type
     *
     * @var integer
     */
    private $type;

    /**
     * Stores token text
     *
     * @var string
     */
    private $text;

    /**
     * Stores token line
     *
     * @var integer
     */
    private $line;

    /**
     * Token constructor
     *
     * @param integer $type Token type
     * @param string  $text Token text
     * @param integer $line Token line
     */
    public function __construct($type, $text, $line)
    {
        $this->type = $type;
        $this->text= $text;
        $this->line = $line;
    }

    /**
     * Getter method to get token type, text or line
     *
     * @param string $name Field name
     *
     * @return string|integer
     */
    public function __get($name)
    {
        return $this->$name;
    }
}
