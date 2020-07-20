<?php

class DuplicateSearch
{
    private $data;
    private $result;
    private $providers = [];

    public function __construct($files)
    {
        if (is_array($files)) {
            $this->data = $files;
        } else {
            throw new Exception('No files.');
        }
    }

    public function search()
    {
        foreach ($this->providers as $provider) {
            $this->result = $provider->findMatch($this->data);
        }

        return $this->result;
    }

    public function selectProvider(Provider $provider)
    {
        $this->providers[] = $provider;
    }
}