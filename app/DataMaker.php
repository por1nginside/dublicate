<?php

class DataMaker
{
    private $folder;
    private $provider;

    public function __construct($path = null)
    {
        if (!$path) {
            $path = getcwd();
        } else if (!file_exists($path)) {
            throw new \Error('Wrong path');
        }

        $this->folder[] = $path;
    }

    public function getAllFiles()
    {
        $duplicates = [];
        while (!empty($this->folder)) {
            $currentDir = array_pop($this->folder);
            foreach (scandir($currentDir) as $name) {
                if (strcasecmp($name, '.') != 0 && strcasecmp($name, '..') != 0) {
                    $currentName = $currentDir . DIRECTORY_SEPARATOR . $name;
                    if (is_dir($currentName)) {
                        array_push($this->folder, $currentName);
                    } else {
                        $duplicates[] = $currentDir . DIRECTORY_SEPARATOR . $name;
                    }
                }
            }
        }

        return $duplicates;
    }

    public function selectProvider(Provider $provider)
    {
        $this->provider = $provider;
    }

}