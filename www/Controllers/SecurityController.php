<?php

namespace App\Controllers;

session_start();

use App\Core\View;
use App\Forms\AddUser;
use App\Models\User;
use App\Models\Token;
use App\Core\Verificator;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SecurityController
{

    function login()
    {
        $view = new View("User/login", "login");
    }

    function register()
    {
        $view = new View("User/register", "register");
    }

    function generateToken()
    {
        $token = bin2hex(random_bytes(16));
        return $token;
    }

    function processlogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $model = new User();
        $model->setEmail($email);

        $check_email = $model->checkEmail();
        if (count($check_email) == 0) {
            echo 'Email or Password is incorrect or Account not activated';
            return false;
        }

        if (password_verify($password, trim($check_email[0]['password']))) {

            // Create Token
            $token = $this->generateToken();
            $expirationTime = time() + (30 * 60);

            $modelToken = new Token();

            $userid = $check_email[0]['id'];

            // update all user status = false
            $modelToken->setId($userid);
            $modelToken->setStatus('false');
            $modelToken->save('userid');

            // insert new
            $modelToken->setId(0);
            $modelToken->setToken($token);
            $modelToken->setExpirationTime($expirationTime);
            $modelToken->setUserid($userid);
            $modelToken->setStatus('true');
            $modelToken->save();

            // get id just add new
            $row = $modelToken->getLast();

            $_SESSION["user"] = [
                'id' => $check_email[0]['id'],
                'firstname' => $check_email[0]['firstname'],
                'lastname' => $check_email[0]['lastname'],
                'email' => $check_email[0]['email'],
                'role' => $check_email[0]['role'],
                'tokenid' => $row[0]['id']
            ];
            echo 'Logged in successfully';
            return true;
        } else {
            echo 'Password is not correct for this email';
            return false;
        }
    }

    function processregister()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $model = new User();
        $model->setEmail(trim($email));

        $check_email = $model->checkEmailExist();
        if (count($check_email) != 0) {
            echo 'Account had exist!';
            return false;
        }
        $model->setFirstname($firstname);
        $model->setLastname($lastname);
        $model->setPassword(trim($password));
        $model->setRole('blogger');

        $model->save();

        // send mail
        $newData = $model->getList('', 'id', 'DESC', 1); // Get data just add
        $idUser = $newData[0]['id'];
        $this->send_email($idUser, $email);

        echo 'Register in successfully';
    }

    function active()
    {
        $idUser = $_GET['id'];
        $model = new User();
        $model->setId($idUser);
        $result = (count($model->getDetail()) == 0) ? 'Data does not exist.' : '';
        $model->setStatus('true');
        $model->status();
    }

    function logout()
    {
        session_destroy();
        header('Location: ' . (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]" . '/login');
        exit();
    }

    function send_email($idUser = '', $email = '')
    {
        include 'mail/Exception.php';
        include 'mail/PHPMailer.php';
        include 'mail/SMTP.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;// Enable verbose debug output
            $mail->isSMTP(); // send SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'quangminh1575@gmail.com'; // SMTP username
            $mail->Password = 'mfeihkmmspcumjbg'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587; // TCP port to connect to
            //Recipients
            $mail->setFrom('quangminh1575@gmail.com', 'Quang Minh');
            $mail->addAddress($email, 'Quang Minh'); // Add a recipient
            // $mail->addAddress('ellen@example.com'); // Name is optional
            $mail->addReplyTo('quangminh1575@gmail.com', 'Reply');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
            // Content
            $mail->isHTML(true);   // Set email format to HTML
            $mail->Subject = 'Account activation email';
            $mail->Body = 'Please click on this link <a href="' . URL . '/admin/user/active?id=' . $idUser . '" target="_blank">Active Account</a> to active account.';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function response($code = 200, $field = '', $data = [])
    {
        $alert = '';
        $message = 'Error';
        switch ($code) {
            case 200:
                $alert = 'Register successfully!';
                $message = 'Success';
                break;
            case 600:
                $alert = $field . ' cannot be empty!';
                break;
            case 601:
                $alert = $field . ' invalidate!';
                break;
            case 602:
                $alert = $field . ' is at least 5 characters!';
                break;
            case 603:
                $alert = $field . ' is at most 30 characters!';
                break;
            case 604:
                $alert = $field . ' had exist!';
                break;
            case 610:
                $alert = $field . ' cannot be empty!';
                break;

            default:
                $alert = 'No code';
                break;
        }

        $result = [
            'code' => $code,
            'message' => $message,
            'response' => ["alert" => $alert, "data" => $data]
        ];
        return print_r(json_encode($result));
    }

    function api_register()
    {
        if (count($_POST) == 0) {
            $this->response(610, 'Field');
            return false;
        }

        if (empty(trim($_POST['firstname']))) {
            $this->response(600, 'Firstname');
            return false;
        }

        if (empty(trim($_POST['lastname']))) {
            $this->response(600, 'Lastname');
            return false;
        }

        if (empty(trim($_POST['email']))) {
            $this->response(600, 'Email');
            return false;
        }

        if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $this->response(601, 'Email');
            return false;
        }

        if (empty(trim($_POST['password']))) {
            $this->response(600, 'Password');
            return false;
        }

        if (strlen(trim($_POST['password'])) <= 5) {
            $this->response(602, 'Password');
            return false;
        }

        if (strlen(trim($_POST['password'])) > 30) {
            $this->response(603, 'Password');
            return false;
        }

        $model = new User();
        $model->setEmail(trim($_POST['email']));

        $check_email = $model->checkEmailExist();
        if (count($check_email) != 0) {
            $this->response(604, 'Email');
            return false;
        }

        $model->setFirstname(trim($_POST['firstname']));
        $model->setLastname(trim($_POST['lastname']));
        $model->setPassword(trim($_POST['password']));
        $model->setRole('user');
        $model->save();

        $newData = $model->getList('', 'id', 'DESC', 1);
        $idUser = $newData[0]['id'];

        $this->send_email($idUser, trim($_POST['email']));

        $this->response(200, '', [
            "id" => $idUser,
            "firstname" => trim($newData[0]['firstname']),
            "lastname" => trim($newData[0]['lastname']),
            "email" => trim($newData[0]['email']),
            "status" => trim($newData[0]['status']),
            "role" => trim($newData[0]['role']),
            "date_inserted" => trim($newData[0]['date_inserted']),
        ]);
    }
}
