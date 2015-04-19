<?php
namespace Mindweb\ResquePersist;

use Mindweb\Persist as Adapter;
use Mindweb\Persist\Event\PersistEvent;
use Resque;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Persist extends Adapter\Persist
{
    /**
     * @var array
     */
    private $configuration;

    /**
     * @param PersistEvent $persistEvent
     */
    public function persist(PersistEvent $persistEvent)
    {
        Resque::setBackend($this->configuration['host'] . ':' . $this->configuration['port']);

        Resque::enqueue(
            $this->configuration['queue'],
            $this->configuration['job'],
            $persistEvent->getAttributionEvent()->getAttribution()
        );
    }

    /**
     * @return null|ConfigurationInterface
     */
    public function getConfiguration()
    {
        return new Configuration();
    }

    /**
     * @param array $configuration
     */
    public function initialize(array $configuration = array())
    {
        $this->configuration = $configuration;
    }
}