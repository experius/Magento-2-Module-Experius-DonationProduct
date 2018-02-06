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

namespace Experius\DonationProduct\Ui\Component\Listing\Column;

/**
 * Class ViewOrder
 * @package Experius\DonationProduct\Ui\Component\Listing\Column
 */
class ViewOrder extends \Magento\Ui\Component\Listing\Columns\Column
{

    protected $urlInterface;

    /**
     * ViewOrderAction constructor.
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\UrlInterface $urlInterface
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlInterface = $urlInterface;

        parent::__construct($context, $uiComponentFactory, $components, $data);
    }


    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $dataItem) {
                $indexFieldName = ($this->getData('config/indexField')) ?
                    $this->getData('config/indexField') : 'entity_id';
                if (isset($dataItem[$indexFieldName])) {
                    $viewUrlPath = $this->getData('config/urlPath') ?: '#';
                    $urlEntityParamName = $this->getData('config/urlParamName') ?
                        $this->getData('config/urlParamName') : $this->getData('config/indexField');
                    $dataItem[$this->getData('name')] = [
                        'view' => [
                            'label' => __('View order'),
                            'href' => $this->urlInterface->getUrl(
                                $viewUrlPath,
                                [
                                    $urlEntityParamName => $dataItem[$indexFieldName]
                                ]
                            )
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
