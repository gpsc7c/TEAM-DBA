<?php
    //define variables and set to empty values
    $nameErr = $passErr = $mailErr = $repPassErr = $phoneErr = $zipErr = $firstErr = $lastErr = "";
    $birthErr = $marrErr = $genErr = $stateErr = $cityErr = $addressErr = "";
    $username = $password = $repPass = $mail = $phone = $zip = $first = $last = "";
    $birth = $marid = $genid = $state = $city = $address = $address2 = "";
    $isValid = false;




    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $isValid = true;

        $username = clean_input($_POST['username']);
        if (empty($username)) {
            $nameErr = "Name is required";
            $isValid = false;
        } else {
            if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
                $nameErr = "Only letters and numbers allowed.";
                $isValid = false;
            }
        }
        //var_dump($isValid);
        $mail = clean_input($_POST['mail']);
        if (empty($mail)) {
            $mailErr = "email is required";
            $isValid = false;
        } else {
            if (!preg_match("/^([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9_\-.]+)\.([a-zA-Z]{2,5})$/", $mail)) {
                $mailErr = "Please input a valid email address formatted correctly.";
                $isValid = false;
            }
        }
        //var_dump($isValid);
        $password = clean_input($_POST['password']);
        if (empty($password)) {
            $passErr = "password is required";
            $isValid = false;
        } else {
            if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}:;<>,?~_+-=|]).{8,50}$/", $password)) {
                $passErr = "Please input a password with at least one lowercase, uppercase, number, and symbol.";
                $isValid = false;
            }
        }
        //var_dump($isValid);
        $repPass = clean_input($_POST['repPass']);
        if (empty($repPass)) {
            $repPassErr = "password verification is required";
            $isValid = false;
        } else {
            if ($repPass != $password) {
                $repPassErr = "Passwords do not match, please re-input both passwords";
                $isValid = false;
            }
        }
        //var_dump($isValid);
        $phone = clean_input($_POST['phone']);
        if (empty($phone)) {
            $phoneErr = "phone number is required";
            $isValid = false;
        } else {
            if (!preg_match("/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/", $phone)) {
                $phoneErr = "Phone number is not in correct format";
                $isValid = false;
            }
        }
        $city = clean_input($_POST['city']);
        if (empty($city)) {
            $cityErr = "city is required";
            $isValid = false;
        } else {
            if (!preg_match("/^[a-zA-Z0-9_']+$/", $city)) {
                $cityErr = "This is not a valid city";
                $isValid = false;
            }
        }
        //var_dump($isValid);
        $address = clean_input($_POST['address']);
        if (empty($address)) {
            $addressErr = "address line one is required";
            $isValid = false;
        } else {
            if (!preg_match("/^[a-zA-Z0-9_,]+( [a-zA-Z0-9_,]+)*$/", $address)) {
                $addressErr = "This is not a valid address";
                $isValid = false;
            }
        }
        $address2 = clean_input($_POST['address2']);
        //var_dump($isValid);
        $first = clean_input($_POST['first']);
        if (empty($first)) {
            $firstErr = "first name is required";
            $isValid = false;
        } else {
            if (!preg_match("/^[a-zA-Z0-9_'-]+$/", $first)) {
                $firstErr = "This is not a name that can be accepted";
                $isValid = false;
            }
        }
        //var_dump($isValid);
        $last = clean_input($_POST['last']);
        if (empty($last)) {
            $lastErr = "last name is required";
            $isValid = false;
        } else {
            if (!preg_match("/^[a-zA-Z0-9_']+$/", $last)) {
                $lastErr = "This is not a name that can be accepted";
                $isValid = false;
            }
        }
        //var_dump($isValid);
        $zip = clean_input($_POST['zip']);
        if (empty($zip)) {
            $zipErr = "zip code is required";
            $isValid = false;
        } else {
            if (!preg_match("/^[0-9]{5}(?:-[0-9]{4})?$/", $zip)) {
                $zipErr = "This does not match ####-##### or ##### format for a zip code";
                $isValid = false;
            }
        }
        //var_dump($isValid);
        if (isset($_POST["genid"])) {
            $genid = clean_input($_POST["genid"]);
            if (empty($_POST["genid"])) {
                $genErr = "Gender is required";
                $isValid = false;
            }
        } else {
            $genErr = "Gender is required";
            $isValid = false;
        }
        //var_dump($isValid);
        if (isset($_POST["marid"])) {
            $marid = clean_input($_POST["marid"]);
            if (empty($_POST["marid"])) {
                $marrErr = "Marital Status is required";
                $isValid = false;
            }
        } else {
            $marrErr = "Marital Status is required";
            $isValid = false;
        }
        //var_dump($isValid);
        $state = clean_input($_POST['state']);
        if (empty($_POST["state"])) {
            $stateErr = "State is required";
            $isValid = false;
        }
        //var_dump($isValid);
        $birth = clean_input($_POST['birth']);
        if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $birth)) {
            $birthErr = "Birthday is required";
            $isValid = false;
        }


}
    //var_dump($isValid);
    function clean_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
    }
?>