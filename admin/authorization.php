<?php
$inputArea = $_POST['inputArea'];
$mailInfo = $_POST['mail'];
$level = $_POST['level'];

if ($level == "mail") {
    codeSending($inputArea);
}

if ($level == "code") {
    loggingInto($mailInfo, $inputArea);
}

function codeSending($mail)
{
    $code = rand(1000, 9999);
    if (!checkMail($mail)) {
        echo "666";
    } else {
        $con = mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
        $result = mysqli_query($con, "update admin set code = '$code' where mail = '$mail'");
        sendCodeToMail($mail, $code);
    }
};

function checkMail($mail)
{
    $con = mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
    $mailDb = mysqli_query($con, "select mail from admin where mail = '$mail'");
    $mailDb = $mailDb->fetch_assoc();
    $mailDb = $mailDb['mail'];
    if ($mail == $mailDb) {
        return true;
    } else {
        return false;
    }
}

function loggingInto($mail, $codeUser)
{

    $con = mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
    $code = mysqli_query($con, "select code from admin where mail = '$mail'");

    ($row = $code->fetch_assoc());

    if ($row['code'] == $codeUser) {
        echo 2;
    } else {
        echo 666;
    }
};

function sendCodeToMail($mail, $code)
{
    $to = $mail;
    $subject = 'CFI - code to log in';
    $from = 'CFI';

    $message = $code;
    $headers  = "From: $from\r\nContent-type: text/html; charset=utf-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo 1;
    } else {
        echo 666;
    }
}
