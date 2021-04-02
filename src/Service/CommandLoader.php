<?php

namespace CWBot\Service;

use Symfony\Component\Yaml\Yaml;

/**
 * Loads commands from a given YAML file.
 */
class CommandLoader
{
    /** @var BaseCommand[] */
    private $commands;

    public function __construct(string $path)
    {
        $fileContent = file_get_contents($path);
        $this->commands = $this->yamlArrayToCommands(
            Yaml::parse($fileContent)
        );
    }

    /**
     * Returns an array with command instances.
     * 
     * @return BaseCommand[]
     */
    private function yamlArrayToCommands(array $yaml): array
    {
        $result = [];

        foreach ($yaml['commands'] as $name => $config) {
            $result[$name] = new $config['class']($config['help']);
        }

        return $result;
    }

    /**
     * Returns the `commands` array.
     * 
     * @return BaseCommand[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }
}