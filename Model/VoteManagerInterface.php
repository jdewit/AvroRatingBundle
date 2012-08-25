<?php

/*
 * This file is part of the AvroRatingBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Avro\RatingBundle\Model;

/**
 * Interface to be implemented by rating managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * All changes to ratings should happen through this interface.
 *
 * @author Joris de Wit <joris.w.dewit@gmail.com>
 */
interface VoteManagerInterface
{
    /**
     * Returns the votes fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Updates a vote.
     *
     * @param VoteInterface $vote
     */
    public function updateVote(VoteInterface $vote);

    /**
     * Creates a vote.
     *
     * @return VoteInterface Vote
     */
    public function createVote();

}
