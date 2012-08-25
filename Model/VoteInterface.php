<?php

/*
 * This file is part of the AvroRatingBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Avro\RatingBundle\Model;


/**
 * @author Joris de Wit <joris.w.dewit@gmail.com>
 */
interface VoteInterface
{
    public function getId();

    public function getScore();

    public function setScore($score);

    public function getCreatedBy();

    public function setCreatedBy($user);
}
