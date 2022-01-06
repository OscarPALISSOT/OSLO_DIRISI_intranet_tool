<?php

namespace Symfony\Config\Framework\Validation;


use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;


/**
 * This class is automatically generated to help creating config.
 */
class MappingConfig 
{
    private $paths;
    
    /**
     * @param ParamConfigurator|list<ParamConfigurator|mixed> $value
     *
     * @return $this
     */
    public function paths(ParamConfigurator|array $value): static
    {
        $this->paths = $value;
    
        return $this;
    }
    
    public function __construct(array $value = [])
    {
    
        if (isset($value['paths'])) {
            $this->paths = $value['paths'];
            unset($value['paths']);
        }
    
        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }
    
    public function toArray(): array
    {
        $output = [];
        if (null !== $this->paths) {
            $output['paths'] = $this->paths;
        }
    
        return $output;
    }

}
