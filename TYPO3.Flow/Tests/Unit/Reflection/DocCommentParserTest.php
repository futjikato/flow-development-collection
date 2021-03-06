<?php
namespace TYPO3\Flow\Tests\Unit\Reflection;

/*
 * This file is part of the TYPO3.Flow package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

/**
 * Testcase for DocCommentParser
 */
class DocCommentParserTest extends \TYPO3\Flow\Tests\UnitTestCase
{
    /**
     * @test
     */
    public function descriptionWithOneLineIsParsedCorrectly()
    {
        $parser = new \TYPO3\Flow\Reflection\DocCommentParser();
        $parser->parseDocComment('/**' . chr(10) . ' * Testcase for DocCommentParser' . chr(10) . ' */');
        $this->assertEquals('Testcase for DocCommentParser', $parser->getDescription());
    }

    /**
     * @test
     */
    public function eolCharacterCanBeNewlineOrCarriageReturn()
    {
        $parser = new \TYPO3\Flow\Reflection\DocCommentParser();
        $parser->parseDocComment('/**' . chr(10) . ' * @var $foo integer' . chr(13) . chr(10) . ' * @var $bar string' . chr(10) . ' */');
        $this->assertEquals(array('$foo integer', '$bar string'), $parser->getTagValues('var'));
    }
}
