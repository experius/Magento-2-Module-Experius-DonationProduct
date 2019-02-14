<?php


namespace Experius\DonationProduct\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SampleDataDeploy extends Command
{

    const NAME_ARGUMENT = "name";
    const NAME_OPTION = "option";

    protected $donationSampleDataModel;

    private $state;

    public function __construct(
        \Experius\DonationProduct\Model\SampleData $donationSampleDataModel,
        \Magento\Framework\App\State $state
    ) {
        $this->donationSampleDataModel = $donationSampleDataModel;
        $this->state = $state;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);

        $output->writeln("Deploy SampleData");

        $this->donationSampleDataModel->install();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("experius_donationproduct:sampledata:deploy");
        $this->setDescription("Deploy donation product sample data ");

        parent::configure();
    }
}
