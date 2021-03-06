<?php

/*
 * This file is part of the Behat.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Behat\Snippet;

use Behat\Gherkin\Node\StepNode;

/**
 * Aggregate snippet.
 * Aggregates multiple similar snippets with different targets and steps.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class AggregateSnippet
{
    /**
     * @var Snippet[]
     */
    private $snippets;

    /**
     * Initializes snippet.
     *
     * @param Snippet[] $snippets
     */
    public function __construct(array $snippets)
    {
        $this->snippets = $snippets;
    }

    /**
     * Returns snippet type.
     *
     * @return string
     */
    public function getType()
    {
        return current($this->snippets)->getType();
    }

    /**
     * Returns snippet unique ID (step type independent).
     *
     * @return string
     */
    public function getHash()
    {
        return current($this->snippets)->getHash();
    }

    /**
     * Returns definition snippet text.
     *
     * @return string
     */
    public function getSnippet()
    {
        return current($this->snippets)->getSnippet();
    }

    /**
     * Returns all steps interested in this snippet.
     *
     * @return StepNode[]
     */
    public function getSteps()
    {
        return array_unique(
            array_map(
                function (Snippet $snippet) {
                    return $snippet->getStep();
                },
                $this->snippets
            )
        );
    }

    /**
     * Returns all snippet targets.
     *
     * @return string[]
     */
    public function getTargets()
    {
        return array_unique(
            array_map(
                function (Snippet $snippet) {
                    return $snippet->getTarget();
                },
                $this->snippets
            )
        );
    }
}
