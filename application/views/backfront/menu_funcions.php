<?php
$backArrayAllRole = array(MODERATOR, STUDENT, TRAINER, MEMBER);

$backArrayNotMemberRole      = array(MODERATOR, STUDENT, TRAINER);
$backArrayNotTrainerRole     = array(MODERATOR, STUDENT, MEMBER);
$backArrayNotStudentRole     = array(MODERATOR, TRAINER, MEMBER);
$backArrayNotModeratorRole   = array(STUDENT, TRAINER, MEMBER);

$backArrayStudAndMenRole     = array(STUDENT, MEMBER);
$backArrayStudAndModRole     = array(STUDENT, MODERATOR);
$backArrayStudAndTrainRole    = array(STUDENT, TRAINER);
$backArrayModAndTrainRole    = array(MODERATOR, TRAINER);
$backArrayModAndMenRole      = array(MODERATOR, MEMBER);
$backArrayMemAndTrainRole    = array(MEMBER, TRAINER);

$backArrayMemberRole      = array(MEMBER);
$backArrayTrainerRole     = array(TRAINER);
$backArrayStudentRole     = array(STUDENT);
$backArrayModeratorRole   = array(MODERATOR);

function role_in_array(array $data = array()){
    return (is_connect())? in_array(session_data('role'), $data): false;
}

function is_connect() {
    return (bool) session_data('connect');
}