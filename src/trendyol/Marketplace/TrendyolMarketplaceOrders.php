<?php

    namespace Hasokeyk\Trendyol\Marketplace;

    use Hasokeyk\Trendyol\TrendyolRequest;

    class TrendyolMarketplaceOrders{

        public $supplierId;
        public $username;
        public $password;

	    function __construct($trendyol){
		    $this->supplierId = $trendyol->supplierId;
		    $this->username   = $trendyol->username;
		    $this->password   = $trendyol->password;
		    $this->trendyol   = $trendyol;
	    }

        public function get_my_orders($filter = []){
            $url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/orders';

            $required_query_data = [
                'startDate'          => null,
                'endDate'            => null,
                'page'               => null,
                'size'               => null,
                'supplierId'         => $this->supplierId,
                'orderNumber'        => null,
                'status'             => null,
                'orderByField'       => null,
                'orderByDirection'   => 'DESC',
                'shipmentPackageIds' => null,
            ];
            $required_query_data = array_merge($required_query_data, $filter);
            $new_url             = http_build_query($required_query_data);

            $result = $this->trendyol->request->get($url.'?'.$new_url);
            return $result;
        }

    }