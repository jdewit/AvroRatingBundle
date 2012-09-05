<?php
namespace Avro\RatingBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
use Avro\RatingBundle\Document\Rating;
use FOS\UserBundle\Document\UserInterface;

class RatingExtension extends \Twig_Extension
{
    protected $environment;
    protected $starCount;
    protected $minRole;

    /**
     * @param \Twig_Environment $environment
     * @param int $starCount
     * @param string $minRole
     */
    public function __construct(\Twig_Environment $environment, $starCount, $minRole)
    {
        $this->environment = $environment;
        $this->starCount = $starCount;
        $this->minRole = $minRole;
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
    public function render(Rating $rating, array $options = array())
    {
        $template = 'AvroRatingBundle:Rating:rating.html.twig';

        if (!$template instanceof \Twig_Template) {
            $template = $this->environment->loadTemplate($template);
        }

        $options['star_count'] = $this->starCount;
        $options['min_role']= $this->minRole;

        return $template->renderBlock('rating', array('rating' => $rating, 'options' => $options));
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
