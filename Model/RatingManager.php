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
* Abstract Rating Manager implementation which can be used as base class for your
* concrete manager.
*
* @author Joris de Wit <joris.w.dewit@gmail.com>
*/
abstract class RatingManager implements RatingManagerInterface
{
    public function process(RatingInterface $rating, UserInterface $user, $score)
    {
        $userId = $user->getId();

        $voteExists = $this->repository->createQueryBuilder($this->class)
            ->field('id')->equals($rating->getId())
            ->field('votes.createdBy')->equals($userId)
            ->getQuery()
            ->getSingleResult();

        if (is_object($voteExists)) {
            $response = 'updated';

            $votes = $rating->getVotes()->toArray();

            $i = 0;
            foreach ($votes as $vote) {
                if ($vote->getCreatedBy() == $userId) {
                    $originalScore = $vote->getScore();
                    $vote->setScore($score);
                    $votes[$i] = $vote;
                    break;
                }
                $i++;
            }

            $rating->setVotes($votes);

            $exactScore = $rating->getExactScore();
            $voteCount = $rating->getVoteCount();

            $exactScoreTotal = ($exactScore * $voteCount) - $originalScore;
            $newExactScoreTotal = $exactScoreTotal + $score;

            $newExactScore = round(($newExactScoreTotal / $voteCount), 4);

            $rating->setExactScore($newExactScore);
            $rating->setScore(round($newExactScore));
        } else {
            $response = 'new';

            $vote = $this->voteManager->createVote();
            $vote->setScore($score);
            $vote->setCreatedBy($user->getId());
            $rating->addVote($vote);

            $exactScore = $rating->getExactScore();
            $voteCount = $rating->getVoteCount();
            $newVoteCount = $voteCount + 1;

            $newExactScoreTotal = ($exactScore * $voteCount) + $score;
            $newExactScore = round(($newExactScoreTotal / $newVoteCount), 4);

            $rating->setExactScore($newExactScore);
            $rating->setScore(round($newExactScore));
            $rating->setVoteCount($newVoteCount);
        }

        $this->updateRating($rating);

        return $response;
    }
}
