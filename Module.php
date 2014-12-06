<?php
/**
 * @Author: Anders Blenstrup-Pedersen
 */
namespace KryuuLanguageSelector;

use KryuuLanguageSelector\Exception;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
	{	
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $translator
          ->setLocale($e->getApplication()->getServiceManager()->get('KryuuLanguageSelector')->Language()->getLanguage())
          ->setFallbackLocale('en_US');
    }
    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        $module = $this;
        return array(
            'factories' => array(
                'KryuuLanguageSelector' => function () use ($module) {
                    return $module;
                },
            ),
        );
    }

    /**
     * @param bool $true
     *
     * @return \Language
     * @throws Exception\RuntimeException
     */
    public function Language($true = true)
    {
        try
        {
            $Language = new \KryuuLanguageSelector($true);
        }
        catch (\Exception $e)
        {
            throw new Exception\RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
        return $Language;
    }
}
