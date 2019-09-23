<?php
session_start();
$logged_in = 0;

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      $logged_in = 1;
  }

  require_once "config.php";

  // Define variables and initialize with empty values
  $username = $password = "";
  $username_err = $password_err = "";

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $validate_user = 0;


        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                    $validate_user = 1;
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();

      // Check if username is empty
      if(empty(trim($_POST["username"]))){
          $username_err = "Please enter username.";
      } else{
          $username = trim($_POST["username"]);
      }

      // Check if password is empty
      if(empty(trim($_POST["password"]))){
          $password_err = "Please enter your password.";
      } else{
          $password = trim($_POST["password"]);
      }

      if($validate_user == 1){ // Login user

        $username_err = "";

        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT id, username, password FROM users WHERE username = ?";

            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_username);

                // Set parameters
                $param_username = $username;

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Store result
                    $stmt->store_result();

                    // Check if username exists, if yes then verify password
                    if($stmt->num_rows == 1){
                        // Bind result variables
                        $stmt->bind_result($id, $username, $hashed_password);
                        if($stmt->fetch()){
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                // Redirect user to welcome page
                                // header("location: welcome.php");
                                $logged_in = 1;
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $username_err = "No account found with that username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            // Close statement
            $stmt->close();
        }

      }else{ // Register User

        // Validate username
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";

            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_username);

                // Set parameters
                $param_username = trim($_POST["username"]);

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // store result
                    $stmt->store_result();

                    if($stmt->num_rows == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            // Close statement
            $stmt->close();
        }

        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }


        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err)){

            // Prepare an insert statement
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("ss", $param_username, $param_password);

                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                  $_SESSION["loggedin"] = true;
                  $_SESSION["id"] = $id;
                  $_SESSION["username"] = $username;
                  $logged_in = 1;
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }

            // Close statement
            $stmt->close();
        }

      }



      // Close connection
      $mysqli->close();
  }
