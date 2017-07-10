<?php
namespace PhilWaters\Tokenizer;

require_once __DIR__ . "/../src/Tokenizer.php";

class TokenizerTest extends \PHPUnit_Framework_TestCase
{
    public function testTokenizeString()
    {
        $tokenizer = new Tokenizer();
        $php = <<<EOPHP
<?php
namespace Test\Name\Space;

class TestClass extends DateTime
{
    public function __construct(\$dateTime)
    {
        parent::__construct(\$dateTime);
    }
}
EOPHP;

        $tokens = $tokenizer->tokenizeString($php);

        $this->assertEquals(42, count($tokens));
        $this->assertEquals(T_NAMESPACE, $tokens[1]->type);
        $this->assertEquals(T_CLASS, $tokens[10]->type);
        $this->assertEquals("class", $tokens[10]->text);
        $this->assertEquals(T_VARIABLE, $tokens[26]->type);
        $this->assertEquals("\$dateTime", $tokens[26]->text);
    }

    public function testTokenizePath()
    {
        $tokenizer = new Tokenizer();

        $tokens = $tokenizer->tokenizePath(__DIR__ . "/data/TestFnc.php");

        $this->assertEquals(31, count($tokens));
        $this->assertEquals(T_FUNCTION, $tokens[1]->type);
        $this->assertEquals(T_WHITESPACE, $tokens[10]->type);
        $this->assertEquals(" ", $tokens[10]->text);
        $this->assertEquals(T_VARIABLE, $tokens[26]->type);
        $this->assertEquals("\$c", $tokens[26]->text);
    }

    /**
     * @expectedException \Exception
     */
    public function testTokenizePath_doesNotExist()
    {
        $tokenizer = new Tokenizer();

        $tokenizer->tokenizePath(__DIR__ . "/data/does_not_exist.php");
    }
}
