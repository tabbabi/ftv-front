<?php

namespace AppBundle\Manager;

/**
 * @author marouane
 */
interface ArticleManagerInterface
{
    /**
     * Get a list of Articles from the api.
     *
     * @return array
     */
    public function getAll();

    /**
     * Get single Article from the api.
     *
     * @param string $uri
     *
     * @return array
     */
    public function get($uri);

    /**
     * Remove single Article.
     *
     * @var string
     */
    public function delete($uri);

    /**
     * Create new Article.
     *
     * @param array $data
     */
    public function post(array $data);
}
