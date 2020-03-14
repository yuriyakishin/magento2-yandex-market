<?php

namespace Yu\YandexMarket\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateXMLFileCommand extends \Symfony\Component\Console\Command\Command
{
    /**
     * @var \Yu\YandexMarket\Service\CreateXMLFile
     */
    private $file;
    
    /**
     * @var \Magento\Framework\App\State
     */
    protected $appState;
    
    /**
     * @param \Yu\YandexMarket\Service\CreateXMLFile $file
     * @param \Magento\Framework\App\State $appState
     * @param string $name
     */
    public function __construct(
            \Yu\YandexMarket\Service\CreateXMLFile $file,
            \Magento\Framework\App\State $appState,
            string $name = null
    )
    {
        $this->file = $file;
        $this->appState = $appState;
        parent::__construct($name);
    }
    
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('market:update');
        $this->setDescription('Update XML file for Yandex Market.');

        parent::configure();
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->appState->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
        $output->writeln('<info>Starting to create XML files.</info>');
        $this->file->execute();
        $output->writeln('<info>Ending to create XML files.</info>');
    }
}
