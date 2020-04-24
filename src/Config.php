<?php


class Config
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function get(string $paramPath)
    {
        $levels = explode('/', $paramPath);
        $data = $this->config;

        foreach ($levels as $level) {
            if (!array_key_exists($level, $data)) {
                return null;
            }

            $data = $data[$level];
        }

        return $data;
    }
}
