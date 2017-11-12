<?php


namespace Experius\DonationProduct\Api\Data;

interface DonationOptionsInterface
{

    const AMOUNT = 'amount';

    /**
     * Get amount
     * @return string|null
     */
    public function getAmount();

    /**
     * Set amount
     * @param string $amount
     * @return \Experius\DonationProduct\Api\Data\DonationOptionsInterface
     */
    public function setAmount($amount);

}