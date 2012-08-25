<?php
namespace Avro\RatingBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
use Avro\RatingBundle\Document\Rating;
use FOS\UserBundle\Document\UserInterface;

class RatingExtension extends \Twig_Extension
{
    protected $router;
    protected $context;
    protected $maxRating;

    public function __construct($router, $context, $ratingManager, $maxRating)
    {
        $this->router = $router;
        $this->context = $context;
        $this->maxRating = $maxRating;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'avro_rating' => new \Twig_Function_Method($this, 'render', array(
                'is_safe' => array('html')
            ))
        );
    }

    /**
     *
     * @param string $string
     * @return int
     */
    public function render(Rating $rating)
    {
        $readOnly = true;

        $user = $this->context->getToken()->getUser();
        if (is_object($user)) {
            $readOnly = false;
        }

        $id = $rating->getId();
        $score = $rating->getScore();
        $html = '';
        $starCount = 0;
        if ($score > 0) {
            while ($starCount < $score) {
                if ($readOnly) {
                    $html = sprintf('%s<span class="avro-star avro-star-on" title="'.($starCount + 1).' stars"></span>', $html);
                } else {
                    $uri = $this->router->generate('avro_rating_rating_addRating', array('id' => $id, 'score' => ($starCount + 1)));
                    $html = sprintf('%s<a href="%s" class="avro-star avro-star-on" data-original="avro-star-on" title="'.($starCount + 1).' stars"></a>', $html, $uri);
                }

                $starCount++;
            }
        }

        while ($starCount < $this->maxRating) {
            if ($readOnly) {
                $rating = sprintf('%s<span class="avro-star avro-star-off" title="'.($starCount + 1).' stars"></span>', $html);
            } else {
                $uri = $this->router->generate('avro_rating_rating_addRating', array('id' => $id, 'score' => ($starCount + 1)));
                $html = sprintf('%s<a href="%s" class="avro-star avro-star-off" data-original="avro-star-off" title="'.($starCount + 1).' stars"></a>', $html, $uri);
            }

            $starCount++;
        }

        $html = sprintf('<span id="avroStarContainer">%s</span>', $html);

        return $html;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'rating_bundle';
    }
}
