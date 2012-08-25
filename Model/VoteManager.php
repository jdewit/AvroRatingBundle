<?php

/*
* This file is part of the AvroRatingBundle package.
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Avro\RatingBundle\Model;

/**
* Abstract Rating Manager implementation which can be used as base class for your
* concrete manager.
*
* @author Joris de Wit <joris.w.dewit@gmail.com>
*/
abstract class VoteManager implements VoteManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function createVote()
    {
        $class = $this->getClass();

        return new $class();
    }
}
