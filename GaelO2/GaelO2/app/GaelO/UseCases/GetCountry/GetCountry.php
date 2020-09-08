<?php

namespace App\GaelO\UseCases\GetCountry;

use App\GaelO\Interfaces\PersistenceInterface;

use App\GaelO\UseCases\GetCountry\GetCountryRequest;
use App\GaelO\UseCases\GetCountry\GetCountryResponse;


class GetCountry {

    public function __construct(PersistenceInterface $persistenceInterface){
        $this->persistenceInterface = $persistenceInterface;
     }

    public function execute(GetCountryRequest $countryRequest, GetCountryResponse $countryResponse) : void
    {
        $code = $countryRequest->code;
        if ($code == '') $countryResponse->body = $this->persistenceInterface->getAll();
        else $countryResponse->body = $this->persistenceInterface->find($code);
        $countryResponse->status = 200;
        $countryResponse->statusText = 'OK';
    }

}

?>
