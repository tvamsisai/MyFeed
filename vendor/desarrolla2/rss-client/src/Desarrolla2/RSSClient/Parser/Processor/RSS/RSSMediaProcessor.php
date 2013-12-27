<?php
/**
 * This file is part of the RSSClient project.
 *
 * Copyright (c)
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */

namespace Desarrolla2\RSSClient\Parser\Processor\RSS;

use Desarrolla2\RSSClient\Parser\Processor\AbstractProcessor;
use Desarrolla2\RSSClient\Node\NodeInterface;

/**
 * Class RSSMediaProcessor
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 * @see    http://www.rssboard.org/media-rss
 */
class RSSMediaProcessor extends AbstractProcessor
{
    /**
     * @var array
     */
    protected $mediaTypes = array(
        'content',
        'keywords',
        'thumbnail',
        'category',
        'comments',
    );

    /**
     * @param NodeInterface $node
     * @param \DOMElement   $item
     *
     * @return mixed|void
     */
    public function execute(NodeInterface $node, \DOMElement $item)
    {
        foreach ($this->mediaTypes as $mediaType) {
            $value = $this->getNodeValueByTagName($item, $mediaType);
            if ($value) {
                $node->setExtended(
                    $mediaType,
                    $this->doClean($value)
                );

            }
        }
    }
}