<?PHP
require_once 'includes/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createUnsafeImmutable('includes/');
$dotenv->load();
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');  
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');


$servername = getenv('SERVERNAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_RESUME');
$resendAPIKey = getenv('RESEND_KEY');


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Handle the file upload
    $uploadDir = "uploads/";  // Change this to your desired upload directory
    $uploadFilePath = $uploadDir . basename(bin2hex(random_bytes(8)).$_FILES["resume"]["name"]);
    $file = $_FILES["resume"]["name"];

    $fileContent = file_get_contents($_FILES["resume"]["tmp_name"]);
    $base64EncodedContent = base64_encode($fileContent);

    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $uploadFilePath)) {
        // File uploaded successfully
        
    } else {
        $message['rsp'] = array(
            'status'=> "error while uploading file, try again later",
            'response'=> "Unsuccessful attempt",
            
        );
    }

/* 

    // Uncomment this code if you want to store in db table

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $file_location = $uploadFilePath;

    $stmt = $mysqli->prepare("INSERT INTO resumes (first_name, last_name, email, phone, file_location) VALUES (?, ?, ?, ?, ?)");

 
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $phone, $file_location );


    $stmt->execute();

    $stmt->close();
    $mysqli->close();
   
*/
    $resend = Resend::client($resendAPIKey);
   

    try {
        $result = $resend->emails->send([
            'from' => 'Tyler Treadwell <noreply@tylertreadwell.dev>',
            'to' => ['tyltreadwell@gmail.com'],
            'subject' => 'User Submitted a New Resume',
            'html' => '<!DOCTYPE html
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
        <html lang="en">
        
        <head></head>
        
        
        <body style="background-color:#f6f9fc;padding:10px 0">
            <table align="center" role="presentation" cellSpacing="0" cellPadding="0" border="0" width="100%"
                style="max-width:37.5em;background-color:#ffffff;border:1px solid #f0f0f0;padding:45px">
                <tr style="width:100%">
                    <td>
                        <table align="center" border="0" cellPadding="0" cellSpacing="0" role="presentation" width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <p
                                            style="font-size:16px;line-height:26px;margin:16px 0;font-family:&#x27;Open Sans&#x27;, &#x27;HelveticaNeue-Light&#x27;, &#x27;Helvetica Neue Light&#x27;, &#x27;Helvetica Neue&#x27;, Helvetica, Arial, &#x27;Lucida Grande&#x27;, sans-serif;font-weight:300;color:#404040">
                                            Hi Admin,</p>
                                        <p
                                            style="font-size:16px;line-height:26px;margin:16px 0;font-family:&#x27;Open Sans&#x27;, &#x27;HelveticaNeue-Light&#x27;, &#x27;Helvetica Neue Light&#x27;, &#x27;Helvetica Neue&#x27;, Helvetica, Arial, &#x27;Lucida Grande&#x27;, sans-serif;font-weight:300;color:#404040">
                                            '.$firstName.' just sent you their resume and contact information. Ready
                                            for review below.</p>

                                            <p
                                            style="font-size:16px;line-height:26px;margin:16px 0;font-family:&#x27;Open Sans&#x27;, &#x27;HelveticaNeue-Light&#x27;, &#x27;Helvetica Neue Light&#x27;, &#x27;Helvetica Neue&#x27;, Helvetica, Arial, &#x27;Lucida Grande&#x27;, sans-serif;font-weight:700;color:#404040">
                                            First Name: '.$firstName.' <br>
                                            Last Name: '.$lastName.' <br>
                                            Email: '.$email.' <br>
                                            Phone: '.$phone.' <br>
                                            
                                            </p>
        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        
        </html>',
            'attachments' => [
                [
                    'filename' => $uploadFilePath,
                    'content' => base64_encode(file_get_contents($uploadFilePath)),
                ]
              ],
        ]);
    } catch (\Exception $e) {
        exit('Error: ' . $e->getMessage());
    }

    // Show the response of the sent email to be saved in a log...
    echo $message['rsp'] = array(
        'status'=> "active",
        'response'=> "Successful Submission",
    );
    
} else {
    // Handle the case where the form is not submitted
    $message['rsp'] = array(
        'status'=> "error",
        'response'=> "Invaild Request",
        
    );
}





echo json_encode($message);

?>