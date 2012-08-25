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
abstract class Rating implements RatingInterface
{
    protected $id;
    protected $score;
    protected $exactScore;
    protected $votes = array();
    protected $voteCount;

    public function __construct()
    {
        $this->score = 0;
        $this->exactScore = 0;
        $this->votes = array();
        $this->voteCount = 0;
    }

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

    public function getExactScore()
    {
        return $this->exactScore;
    }

    public function setExactScore($exactScore)
    {
        $this->exactScore = $exactScore;

        return $this;
    }

    public function getVotes()
    {
        return $this->votes;
    }

    public function addVote(\Avro\RatingBundle\Model\VoteInterface $vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    public function setVotes(array $votes)
    {
        $this->votes = $votes;

        return $this;
    }

    public function getVoteCount()
    {
        return $this->voteCount;
    }

    public function setVoteCount($voteCount)
    {
        $this->voteCount = $voteCount;

        return $this;
    }

}
