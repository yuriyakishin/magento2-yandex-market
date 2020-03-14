<?php

namespace Yu\YandexMarket\Cron;

/**
 * Обновляем XML файлы маркета
 */
class FileUpdate
{

    /**
     * @var \Yu\YandexMarket\Service\CreateXMLFile
     */
    private $file;

    /**
     * @param \Yu\YandexMarket\Service\CreateXMLFile $file
     */
    public function __construct(
            \Yu\YandexMarket\Service\CreateXMLFile $file
    )
    {
        $this->file = $file;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        return $this->file->execute();
    }

}
