<?php

namespace App\GaelO\Services;

use App\GaelO\Interfaces\MailInterface;
use App\GaelO\Adapters\SendEmailAdapter;
use App\GaelO\Repositories\UserRepository;
use App\GaelO\Constants\MailConstants;

Class MailServices extends SendEmailAdapter {

    public function __construct(MailInterface $mailInterface, UserRepository $userRepository) {
        $this->mailInterface = $mailInterface;
        $this->userRepository = $userRepository;
    }

    public function getAdminsEmails() : array {
        $adminsEmails = $this->userRepository->getAdministratorsEmails();
        return $adminsEmails;
    }

    public function getInvestigatorOfCenterInStudy(String $study, String $center, ?String $job=null) : array {
        $emails = $this->userRepository->getInvestigatorsStudyFromCenterEmails($study, $center, $job);
        return $emails;
    }

    /**
     * Parameters in associative array : name, email, center, request
     */
    public function sendRequestMessage(array $parameters) : void {
        $destinators = [$this->getAdminsEmails(), $parameters['email']];
        $this->mailInterface->setTo($destinators);
        $this->mailInterface->setReplyTo();
        $this->mailInterface->setParameters($parameters);
        $this->mailInterface->sendModel(MailConstants::EMAIL_REQUEST);

    }

    /**
     * Parameter in associative array : name, username, newPassword, email
     */
    public function sendResetPasswordMessage(string $name, string $username, string $newPassword, string $email) : void {
        $parameters = [
            'name'=> $name,
            'username'=> $username,
            'newPassword'=> $newPassword,
            'email'=> $email
        ];
        $this->mailInterface->setTo([$parameters['email']]);
        $this->mailInterface->setReplyTo();
        $this->mailInterface->setParameters($parameters);
        $this->mailInterface->sendModel(MailConstants::EMAIL_RESET_PASSWORD);

    }

    public function sendAccountBlockedMessage(String $username, String $email) : void {
        //Get all studies with role for the user
        $studies = $this->userRepository->getAllStudiesWithRoleForUser($username);
        $parameters = [
            'name'=>'user',
            'username'=>$username,
            'studies'=>$studies
        ];
        //Send to user and administrators
        $this->mailInterface->setTo( [$email, ...$this->getAdminsEmails()] );
        $this->mailInterface->setReplyTo();
        $this->mailInterface->setParameters($parameters);
        $this->mailInterface->sendModel(MailConstants::EMAIL_BLOCKED_ACCOUNT);

    }

    public function sendAdminConnectedMessage(String $username, String $remoteAddress) : void {
        $parameters = [
            'name'=> 'Administrator',
            'username'=>$username,
            'remoteAddress'=>$remoteAddress
        ];
        //Send to administrators
        $this->mailInterface->setTo( $this->getAdminsEmails() );
        $this->mailInterface->setReplyTo();
        $this->mailInterface->setParameters($parameters);
        $this->mailInterface->sendModel(MailConstants::EMAIL_ADMIN_LOGGED);

    }

    public function sendCreatedAccountMessage(string $userEmail, String $name, String $username, String $password) : void {

        $parameters = [
            'name'=> $name,
            'username'=>$username,
            'password'=>$password
        ];

        //Send to administrators
        $this->mailInterface->setTo( [$userEmail] );
        $this->mailInterface->setReplyTo();
        $this->mailInterface->setParameters($parameters);
        $this->mailInterface->sendModel(MailConstants::EMAIL_USER_CREATED);

    }

    public function sendForbiddenResetPasswordDueToDeactivatedAccount(String $userEmail, String $username, Array $studies){

        $parameters = [
            'name' => 'user',
            'username'=>$username,
            'studies'=>$studies
        ];

        //Send to administrators
        $this->mailInterface->setTo( [$userEmail] );
        $this->mailInterface->setReplyTo();
        $this->mailInterface->setParameters($parameters);
        $this->mailInterface->sendModel(MailConstants::EMAIL_CHANGE_PASSWORD_DEACTIVATED);

    }

}