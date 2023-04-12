<?php
    class Account {

        private $errorArray;
        private $con;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if (empty($this->errorArray) == true) {
                // Insert into db
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            }
            else {
                return false;
            }
        }

        public function getError($error) {
            if (!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
            $encryptedPw = md5($pw); // Password is encrypted using md5
            $profilePic = "assets/images/profile-pics/head_emerald.png";// Default profile pic. path is relative to index.php and is not real. place pic at this path and change this when done.
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");//gotta be in order of ur db table
            return $result;
        }
        
        private function validateUsername($un) {
            if (strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }
        /*
            if (usernameExists($un)) {
                array_push($this->errorArray, "Username already exists");
            }
        */

        }
        
        private function validateFirstName($fn) {
            if (strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
            }
        }
        
        private function validateLastName($ln) {
            if (strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
            }
        }
        
        private function validateEmails($em, $em2) {
            if ($em != $em2) {
                array_push($this->errorArray, Constants::$emailsDoNotMatch);
                return;
            }
        
            if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }
        
        /*
            if (emailExists($em)) {
                array_push($this->errorArray, "Email already in use");
                return;
            }
        */

        }
        
        private function validatePasswords($pw, $pw2) {
            if ($pw != $pw2) {
                array_push($this->errorArray , Constants::$passwordsDoNotMatch);
                return;
            }

            if (strlen($pw) > 30 || strlen($pw) < 5) {
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }

            if (preg_match('/[^A-Za-z0-9]/', $pw)) {
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
                return;
            }

        }

    }
?>