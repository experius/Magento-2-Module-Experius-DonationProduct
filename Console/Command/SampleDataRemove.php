<?php
/**
 * A Magento 2 module named Experius/DonationProduct
 * Copyright (C) 2017 Derrick Heesbeen
 *
 * This file is part of Experius/DonationProduct.
 *
 * Experius/DonationProduct is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

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
