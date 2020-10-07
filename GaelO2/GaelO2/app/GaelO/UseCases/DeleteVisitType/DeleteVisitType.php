<?php

namespace App\GaelO\UseCases\DeleteVisitType;

use App\GaelO\Interfaces\PersistenceInterface;

class DeleteVisitType {

    public function __construct(PersistenceInterface $persistenceInterface){
        $this->persistenceInterface = $persistenceInterface;
    }

    public function execute(DeleteVisitTypeRequest $deleteVisitTypeRequest, DeleteVisitTypeResponse $deleteVisitTypeResponse){

        $hasVisits = $this->persistenceInterface->hasVisits($deleteVisitTypeRequest->visitTypeId);
        if($hasVisits){
            $deleteVisitTypeResponse->status = 403;
            $deleteVisitTypeResponse->statusText = 'Existing Child Visits';
        }else{
            $this->persistenceInterface->delete($deleteVisitTypeRequest->visitTypeId);
            $deleteVisitTypeResponse->status = 200;
            $deleteVisitTypeResponse->statusText = 'OK';
        }
    }

}