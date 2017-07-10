<?php
/**
 * Tokenizer class
 */

namespace PhilWaters\Tokenizer;

require_once "Token.php";

/**
 * Class to handle PHP tokenizing
 */
class Tokenizer
{
    /**
     * Tokenizes a string containing PHP
     *
     * @param string $string PHP string
     *
     * @return \PhilWaters\Tokenizer\Token[]
     */
    public function tokenizeString($string)
    {
        $result = array();
        $tokens = token_get_all($string);
        $line = 1;

        foreach ($tokens as $token) {
            if (!is_array($token)) {
                $token = array(
                    null,
                    $token,
                    $line
                );
            }

            $line = $token[2];

            if (preg_match("`^[\r\n]+$`", trim($token[1], " 	"))) {
                $line++;
            }

            $result[] = new Token($token[0], $token[1], $token[2]);
        }

        return $result;
    }

    /**
     * Tokenizes a file
     *
     * @param string $path File path
     *
     * @throws \InvalidArgumentException
     *
     * @return \PhilWaters\Tokenizer\Token[]
     */
    public function tokenizePath($path)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException("$path does not exist");
        }

        return $this->tokenizeString(file_get_contents($path));
    }
}
