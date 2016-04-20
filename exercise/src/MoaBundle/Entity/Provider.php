<?php

namespace MoaBundle\Entity;

/**
 * Provider
 */
class Provider
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $providerName;

    /**
     * @var string
     */
    private $providerUrl;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set providerName
     *
     * @param string $providerName
     *
     * @return Provider
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;

        return $this;
    }

    /**
     * Get providerName
     *
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * Set providerUrl
     *
     * @param string $providerUrl
     *
     * @return Provider
     */
    public function setProviderUrl($providerUrl)
    {
        $this->providerUrl = $providerUrl;

        return $this;
    }

    /**
     * Get providerUrl
     *
     * @return string
     */
    public function getProviderUrl()
    {
        return $this->providerUrl;
    }
}

