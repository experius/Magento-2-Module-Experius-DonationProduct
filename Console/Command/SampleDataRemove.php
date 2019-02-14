<?php


namespace Experius\DonationProduct\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SampleDataRemove extends Command
{

    const NAME_ARGUMENT = "name";
    const NAME_OPTION = "option";

    protected $donationSampleDataModel;

    protected $state;

    protected $registry;

    public function __construct(
        \Experius\DonationProduct\Model\SampleData $donationSampleDataModel,
        \Magento\Framework\App\State $state,
        \Magento\Framework\Registry $registry
    ) {
        $this->donationSampleDataModel = $donationSampleDataModel;
        $this->state = $state;
        $this->registry = $registry;
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
        $this->registry->register('isSecureArea', true);

        $output->writeln("Remove SampleData");

        $this->donationSampleDataModel->remove();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("experius_donationproduct:sampledata:remove");
        $this->setDescription("Deploy donation product sample data ");

        parent::configure();
    }
}
