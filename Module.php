<?php
/**
 * @Author: Anders Blenstrup-Pedersen
 */
namespace LanguageSelector;

use LanguageSelector\Exception;

class Module
{
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
                'LanguageSelector' => function () use ($module) {
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
            $Language = new \LanguageSelector($true);
        }
        catch (\Exception $e)
        {
            throw new Exception\RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
        return $Language;
    }
}
