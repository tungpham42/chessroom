<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');
        $subject = $request->input('subject');
        if (!$request->input('name') || $name === '') {
            echo json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
            exit();
        }
        if (!$request->input('email') || $email === '') {
            echo json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array('message' => 'Email format invalid', 'code' => 0));
            exit();
        }
        if (!$request->input('subject') || $subject === '') {
            echo json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
            exit();
        }
        if (!$request->input('message') || $message === '') {
            echo json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
            exit();
        }
        $content="From: $name \nEmail: $email \nMessage: $message";
        $recipient = "admin@chessroom.top";
        $mailheader = "From: $email \r\n";
        $mailheader = "Content-Type: text/html; charset=UTF-8 \r\n";
        mail($recipient, $subject, $content, $mailheader) or die("Error!");
        echo json_encode(array('message' => 'Email successfully sent!', 'code' => 1));
        exit();
    }
}
