<?php

namespace App\GaelO\UseCases\CreateVisitType;

class CreateVisitTypeRequest {
    public int $currentUserId;
    public String $visitGroupId;
    public String $name;
    public int $visitOrder;
    public bool $localFormNeeded;
    public bool $qcNeeded;
    public bool $reviewNeeded;
    public bool $optional;
    public int $limitLowDays;
    public int $limitUpDays;
    public String $anonProfile;
}