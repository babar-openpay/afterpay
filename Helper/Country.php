<?php
/**
 * Custom payment method in Magento 2
 * @category    AfterPay
 * @package     Apexx_Afterpay
 */
namespace Apexx\Afterpay\Helper;

use Magento\Directory\Model\ResourceModel\Country\CollectionFactory;
use Apexx\Afterpay\Model\Adminhtml\System\Config\Country as CountryConfig;

/**
 * Class Country
 */
class Country
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CountryConfig
     */
    private $countryConfig;

    /**
     * @var array
     */
    private $countries;

    /**
     * @param CollectionFactory $factory
     * @param CountryConfig $countryConfig
     */
    public function __construct(CollectionFactory $factory, CountryConfig $countryConfig)
    {
        $this->collectionFactory = $factory;
        $this->countryConfig = $countryConfig;
    }

    /**
     * Returns countries array
     *
     * @return array
     */
    public function getCountries()
    {
        if (!$this->countries) {
            $this->countries = $this->collectionFactory->create()
                ->addFieldToFilter('country_id', ['nin' => $this->countryConfig->getExcludedCountries()])
                ->loadData()
                ->toOptionArray(false);
        }
        return $this->countries;
    }
}
