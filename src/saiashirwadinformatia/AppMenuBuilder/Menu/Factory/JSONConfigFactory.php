<?php
/**
 *  JSON Config Factory
 *
 *  @author Rohan Sakhale <rs@saiashirwad.com>
 */
namespace saiashirwadinformatia\AppMenuBuilder\Menu\Factory;

class JSONConfigFactory extends MenuFactory implements MenuFactoryInterface
{

    public function build($config)
    {
        if (!file_exists($config)) {
            throw new \InvalidArgumentException('Config file (' . $config . ') not found');
        }
        if (!is_readable($config)) {
            throw new \InvalidArgumentException('Config file (' . $config . ') not readable');
        }
        $jsonFileContents = file_get_contents($config);

        $phpArr = json_decode($jsonFileContents, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $PHPConfigFactory = new PHPConfigFactory();
            return $PHPConfigFactory->build($phpArr);
        }
        throw new \Exception('JSON File Error: ' . json_last_error_msg());
    }
}
