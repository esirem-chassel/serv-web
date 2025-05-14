<?php
class Installer
{
    use tSingleton;

    const PATH = '/APIKEY.txt';

    protected function getFile()
    {
        return __DIR__ . '/..' . static::PATH;
    }

    public function isInstalled()
    {
        return file_exists($this->getFile());
    }

    public function getApiKey(): ?string
    {
        return $this->isInstalled() ? file_get_contents($this->getFile()) : null;
    }

    public function install(string $apiKey) {
        $fh = @fopen($this->getFile(), 'w+');
        if(false !== $fh) {
            fwrite($fh, $apiKey);
            fclose($fh);
        }
    }
}
