<?php

namespace Avro\RatingBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Avro\RatingBundle\Document\Rating;

/**
 * Rating controller.
 *
 * @author Joris de Wit <joris.w.dewit@gmail.com>
 */
class RatingController extends ContainerAware
{

    public function addRatingAction($id, $score)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user)) {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        $request = $this->container->get('request');
        $ratingManager = $this->container->get('avro_rating.rating_manager');
        $rating = $ratingManager->find($id);

        $process = $ratingManager->process($rating, $user, $score);
        if ($process == 'updated') {
            $this->container->get('session')->getFlashBag()->set('success', 'Your rating has been updated.');
        } else {
            $this->container->get('session')->getFlashBag()->set('success', 'Your rating has been added.');
        }


        return new RedirectResponse($this->container->get('request')->headers->get('referer'));
    }
}

