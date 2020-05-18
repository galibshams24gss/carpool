<?php
include_once 'config/psl-config.php';
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE, PORT);
$mysqli->set_charset("utf8");

/**
 * start a session
 */
function sec_session_start() {
    $session_name = 'entepool_session';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
      $cookieParams["path"],
      $cookieParams["domain"],
      $secure,
      $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session
    session_regenerate_id(true);    // regenerated the session, delete the old one.
}

/**
 * @param $email
 * @param $password
 * @param $mysqli
 *
 * @return bool
 */
function login($email, $password, $mysqli) {
    if(empty($email) || empty($password)){
        return false;
    }
    if ($stmt = $mysqli->prepare("SELECT id, first_name, surname, email, password, salt, active, comment FROM entepool_users WHERE email = '".$email."' LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($user_id, $firstname, $surname, $email, $db_password, $salt, $active, $comment);
        $stmt->fetch();

        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts

            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $return['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    //$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                    $return['email'] = $email;
                    $return['firstname'] = $firstname;
                    $return['surname'] = $surname;
                    $return['permission'] = get_permission($active);
                    $return['login_string'] = hash('sha512', $password . $user_browser);
                    $return['roles'] = get_roles($email, $mysqli);
                    // Login successful.
                    $mysqli->query("delete from login_attempts where user_id = ".$user_id);
                    return $return;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = date('Y-m-d H:i:s');;
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}


/**
 * @param $email
 * @return bool
 */
function valid_email($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

/**
 * @param $user_id
 * @param $mysqli
 *
 * @return bool
 */
function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time
    $now = time();

    // All login attempts are counted from the past 2 hours.
    $valid_attempts = $now - (2 * 60 * 60);

    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);

        // Execute the prepared query.
        $stmt->execute();
        $stmt->store_result();

        // If there have been more than 5 failed logins
        if ($stmt->num_rows > 100) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * @param $active
 * @param $approval
 *
 * @return string
 */
function get_permission($active){
  if($active == 'N'){
    return 'inactive';
  }elseif($active == 'P'){
    return 'unapproved';
  }elseif($active == 'Y'){
    return 'approved';
  }else{
    return 'failed';
  }
}

/**
 * @param $email
 * @param $mysqli
 *
 * @return array
 */
function get_roles($email, $mysqli){
  $output = array();
  $query = "select r.role_name 
from entepool_users as u 
left join entepool_user_roles_user as uru on uru.uid = u.id 
left join roles as r on r.id = uru.rid 
where uru.active = 'Y' and u.email = '" . $email . "'";
  $result_unit = $mysqli->query($query);
  while ($row_unit = mysqli_fetch_assoc($result_unit)) {
    $output[] = $row_unit['role_name'];
  }
  return $output;
}