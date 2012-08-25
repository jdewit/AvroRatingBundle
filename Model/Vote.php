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
 * @author Joris de Wit <joris.w.dewit@gmail.com>
 */
abstract class Vote implements VoteInterface
{
    protected $id;
    protected $score;
    protected $createdBy;

    public function getId()
    {
        return $this->id;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
