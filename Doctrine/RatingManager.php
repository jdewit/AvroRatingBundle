<?php

/*
* This file is part of the AvroRatingBundle package.
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Avro\RatingBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserInterface;
use Avro\RatingBundle\Document\Vote;
use Avro\RatingBundle\Model\RatingInterface;
use Avro\RatingBundle\Model\VoteManager;
use Avro\RatingBundle\Model\RatingManager as BaseRatingManager;

/**
* @author Joris de Wit <joris.w.dewit@gmail.com>
*/
class RatingManager extends BaseRatingManager
{
    protected $om;
    protected $class;
    protected $repository;
    protected $voteManager;

    public function __construct(ObjectManager $om, $class, VoteManager $voteManager)
    {
        $this->om = $om;
        $this->repository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
        $this->voteManager = $voteManager;
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Updates a rating
     *
     * @param RatingInterface $rating
     * @param Boolean $andFlush Whether to flush the changes (default true)
     */
    public function updateRating(RatingInterface $rating, $andFlush = true)
    {
        $this->om->persist($rating);
        if ($andFlush) {
            $this->om->flush();
        }
    }

}
