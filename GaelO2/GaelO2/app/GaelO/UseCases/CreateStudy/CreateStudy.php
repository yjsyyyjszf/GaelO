<?php

namespace App\GaelO\UseCases\CreateStudy;

use App\GaelO\Constants\Constants;
use App\GaelO\Interfaces\PersistenceInterface;
use App\GaelO\Services\TrackerService;

class CreateStudy {

    public function __construct(PersistenceInterface $persistenceInterface, TrackerService $trackerService){
        $this->persistenceInterface = $persistenceInterface;
        $this->trackerService = $trackerService;
    }

    public function execute(CreateStudyRequest $createStudyRequest, CreateStudyResponse $createStudyResponse){
        $studyName = $createStudyRequest->studyName;
        $patientCodePrefix = $createStudyRequest->patientCodePrefix;

       if( $this->persistenceInterface->isExistingStudy($studyName) ){
            $createStudyResponse->status = 409;
            $createStudyResponse->statusText = 'Conflict';
            return;
       }

        $this->persistenceInterface->addStudy($studyName, $patientCodePrefix);

        $currentUserId=$createStudyRequest->currentUserId;
        $actionDetails = [
            'studyName'=>$studyName,
            'patientCodePrefix'=> $patientCodePrefix
        ];

        $this->trackerService->writeAction($currentUserId, Constants::TRACKER_ROLE_ADMINISTRATOR, null, null, Constants::TRACKER_CREATE_STUDY, $actionDetails);

        $createStudyResponse->status = 201;
        $createStudyResponse->statusText = 'Created';

    }

}