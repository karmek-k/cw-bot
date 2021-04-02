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
        $fileContent = file_get_contents($this->joinPaths(
            constant('PROJECT_ROOT'), $path
        ));

        $this->commands = $this->yamlArrayToCommands(
            Yaml::parse($fileContent)
        );
    }

    /**
     * Courtesy of
     * https://stackoverflow.com/questions/1091107/how-to-join-filesystem-path-strings-in-php
     */
    private function joinPaths() {
        $paths = [];
    
        foreach (func_get_args() as $arg) {
            if ($arg !== '') { $paths[] = $arg; }
        }
    
        return preg_replace('#/+#','/',join('/', $paths));
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