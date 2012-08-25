<?php

/*
 * This file is part of the AvroRatingBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Avro\RatingBundle\Model;

use FOS\UserBundle\Model\UserInterface;

/**
 * Interface to be implemented by rating managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * All changes to ratings should happen through this interface.
 *
 * @author Joris de Wit <joris.w.dewit@gmail.com>
 */
interface RatingManagerInterface
{
    /**
     * Returns the rating's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Updates a rating.
     *
     * @param RatingInterface $rating
     */
    public function updateRating(RatingInterface $rating);

    /**
     * Add a vote
     *
     * @param RatingInterface Rating
     * @param UserInterface User
     * @param int $score
     */
    public function process(RatingInterface $rating, UserInterface $user, $score);
}
