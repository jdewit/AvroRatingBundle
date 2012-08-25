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
use Avro\RatingBundle\Model\VoteInterface;
use Avro\RatingBundle\Model\VoteManager as BaseVoteManager;

/**
* @author Joris de Wit <joris.w.dewit@gmail.com>
*/
class VoteManager extends BaseVoteManager
{
    protected $objectManager;
    protected $class;
    protected $repository;

    public function __construct(ObjectManager $om, $class)
    {
        $this->om = $om;
        $this->repository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
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
     * Updates a vote
     *
     * @param VoteInterface $vote
     * @param Boolean $andFlush Whether to flush the changes (default true)
     */
    public function updateVote(VoteInterface $vote, $andFlush = true)
    {
        $this->om->persist($vote);
        if ($andFlush) {
            $this->om->flush();
        }
    }

}
