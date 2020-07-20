<?php

class HashProvider
{
    public function findMatch($data)
    {
        $match = [];
        foreach ($data as $key => $value) {
            foreach ($data as $k => $item) {
                if ($value != $item) {
                    $first = md5_file($value);
                    $second = md5_file($item);
                    if ($first == $second) {
                        if (!in_array($data[$k], $match)) {
                            $match[] = $data[$k];
                        }
                    }
                } else {
                    continue;
                }
            }
        }

        if (empty($match)) {
            throw new \Error('No match');
        } else {
            return $match;
        }
    }
}