<?php

function escape($string)
{

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}

function insert_categories()
{

    global $connection;

    if (isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function find_all_categories()
{
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";
        echo "</tr>";
    }
}

function delete_categories()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function insert_menus()
{

    global $connection;

    if (isset($_POST['submit'])) {

        $menu = $_POST['menu'];
        $link = $_POST['link'];

        if ($menu == "" || empty($menu)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO footer_menu(menu, link) ";
            $query .= "VALUES('{$menu}', '{$link}') ";

            $create_menu_query = mysqli_query($connection, $query);

            if (!$create_menu_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function find_all_menus()
{
    global $connection;

    $query = "SELECT * FROM footer_menu ORDER BY footer_id ASC";
    $select_menus = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_menus)) {
        $footer_id = $row['footer_id'];
        $menu = $row['menu'];

        echo "<tr>";
        echo "<td>{$footer_id}</td>";
        echo "<td>{$menu}</td>";
        echo "<td><a href='footer_menu.php?delete={$footer_id}'>DELETE</a></td>";
        echo "<td><a href='footer_menu.php?edit={$footer_id}'>EDIT</a></td>";
        echo "</tr>";
    }
}

function delete_menus()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_footer_id = $_GET['delete'];
        $query = "DELETE FROM footer_menu WHERE footer_id = {$the_footer_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: footer_menu.php");
    }
}

function insert_menus_left()
{

    global $connection;

    if (isset($_POST['submit_2'])) {

        $menu = $_POST['menu'];
        $link = $_POST['link'];

        if ($menu == "" || empty($menu)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO footer_menu_left(menu, link) ";
            $query .= "VALUES('{$menu}', '{$link}') ";

            $create_menu_query = mysqli_query($connection, $query);

            if (!$create_menu_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function find_all_menus_left()
{
    global $connection;

    $query = "SELECT * FROM footer_menu_left ORDER BY footer_left_id ASC";
    $select_menus = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_menus)) {
        $footer_left_id = $row['footer_left_id'];
        $menu = $row['menu'];

        echo "<tr>";
        echo "<td>{$footer_left_id}</td>";
        echo "<td>{$menu}</td>";
        echo "<td><a href='footer_menu.php?delete={$footer_left_id}'>DELETE</a></td>";
        echo "<td><a href='footer_menu.php?edit_2={$footer_left_id}'>EDIT</a></td>";
        echo "</tr>";
    }
}

function delete_menus_left()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_footer_left_id = $_GET['delete'];
        $query = "DELETE FROM footer_menu_left WHERE footer_left_id = {$the_footer_left_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: footer_menu.php");
    }
}

function insert_main_menus()
{

    global $connection;

    if (isset($_POST['submit'])) {

        $menu = $_POST['menu'];
        $link = $_POST['link'];

        if ($menu == "" || empty($menu)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO main_menu(menu, link) ";
            $query .= "VALUES('{$menu}', '{$link}') ";

            $create_menu_query = mysqli_query($connection, $query);

            if (!$create_menu_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function find_all_main_menus()
{
    global $connection;

    $query = "SELECT * FROM main_menu ORDER BY menu_id ASC";
    $select_menus = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_menus)) {
        $menu_id = $row['menu_id'];
        $menu = $row['menu'];

        echo "<tr>";
        echo "<td>{$menu_id}</td>";
        echo "<td>{$menu}</td>";
        echo "<td><a href='main_menu.php?delete={$menu_id}'>DELETE</a></td>";
        echo "<td><a href='main_menu.php?edit={$menu_id}'>EDIT</a></td>";
        echo "</tr>";
    }
}

function delete_main_menus()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_menu_id = $_GET['delete'];
        $query = "DELETE FROM main_menu WHERE menu_id = {$the_menu_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: main_menu.php");
    }
}

function confirm($result)
{

    global $connection;

    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function slug($text)
{
    /* $spl_char = '/[^\-\s\pN\pL]+/u';
    $double_char = '/[\-\s]+/';

    $slug = preg_replace('/[^a-z0-9-]+/', '-', strtolower($string));

    $slug = trim($string, '-');

    return $slug; */
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    // trim
    $text = trim($text, '-');

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // lowercase
    $text = strtolower($text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}
function GetShortUrl($url)
{
    global $connection;
    $query = "SELECT * FROM url_shorten WHERE url = '" . $url . "' ";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['short_code'];
    } else {
        $short_code = generateUniqueID();
        $sql = "INSERT INTO url_shorten (url, short_code, hits)
   VALUES ('" . $url . "', '" . $short_code . "', '0')";
        if (mysqli_query($connection, $sql) === TRUE) {
            return $short_code;
        } else {
            die("Unknown Error Occured");
        }
    }
}
function generateUniqueID()
{
    global $connection;
    $token = substr(md5(uniqid(rand(), true)), 0, 6);
    $query = "SELECT * FROM url_shorten WHERE short_code = '" . $token . "' ";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        generateUniqueID();
    } else {
        return $token;
    }
}

//===== AUTHENTICATION HELPERS =====//

function is_student()
{
    if (isLoggedIn()) {
        $result = query("SELECT user_role FROM users WHERE user_id=" . $_SESSION['user_id'] . "");
        $row = fetchRecords($result);
        if ($row['user_role'] == 'student') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function is_teacher()
{
    if (isLoggedIn()) {
        $result = query("SELECT user_role FROM users WHERE user_id=" . $_SESSION['user_id'] . "");
        $row = fetchRecords($result);
        if ($row['user_role'] == 'teacher') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function is_parent()
{
    if (isLoggedIn()) {
        $result = query("SELECT user_role FROM users WHERE user_id=" . $_SESSION['user_id'] . "");
        $row = fetchRecords($result);
        if ($row['user_role'] == 'parent') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function is_affiliate()
{
    if (isLoggedIn()) {
        $result = query("SELECT is_affiliate FROM users WHERE user_id=" . $_SESSION['user_id'] . "");
        $row = fetchRecords($result);
        if ($row['is_affiliate'] == 1) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function getAffiliate()
{
    if (isLoggedIn()) {
        $result = query("SELECT * FROM affiliates WHERE user_id=" . $_SESSION['user_id'] . "");
        $row = fetchRecords($result);
        return $row;
    }
    return false;
}

if (!function_exists('getServerName')) {
    function getServerName()
    {
        $base_url = (isset($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
            . "://" . $_SERVER['HTTP_HOST'];


        $host = $base_url . ($_SERVER['HTTP_HOST'] == 'localhost' ? '/xogos' : '');
        return $host;
    }
}

function newRecruits()
{
    if (isLoggedIn()) {
        $result = query("SELECT SUM(kids_count) AS total_kids FROM users WHERE affiliated_by = " . $_SESSION['user_id'] . " AND DATEDIFF(NOW(), timestamp_lr) <= 7");
        $row = fetchRecords($result);

        return $row[0];
    }
    return false;
}

function allRecruits()
{
    if (isLoggedIn()) {
        $result = query("SELECT SUM(kids_count) AS total_kids FROM users WHERE affiliated_by = " . $_SESSION['user_id']);
        $row = fetchRecords($result);
        return $row[0];
    }
    return false;
}

function newRecruitsByMonth()
{
    if (isLoggedIn()) {
        $currentYear = date('Y');
        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $startDate = "$currentYear-" . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
            $endMonth = $month + 1;
            if ($endMonth == 13) {
                $endMonth = 1;
                $currentYear++;
            }
            $endDate = "$currentYear-" . str_pad($endMonth, 2, '0', STR_PAD_LEFT) . '-01';

            $result = query("SELECT SUM(kids_count) FROM users WHERE affiliated_by = " . $_SESSION['user_id'] . " AND timestamp_lr >= '$startDate' AND timestamp_lr < '$endDate'");

            if ($result) {
                $row = fetchRecords($result);
                $months[] = $row[0];
            } else {
                return false;
            }
        }

        return $months;
    }
    return false;
}

function is_admin()
{
    if (isLoggedIn()) {
        $result = query("SELECT user_role FROM users WHERE user_id=" . $_SESSION['user_id'] . "");
        $row = fetchRecords($result);
        if ($row['user_role'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function is_contractor()
{
    if (isLoggedIn()) {
        $result = query("SELECT user_role FROM users WHERE user_id=" . $_SESSION['user_id'] . "");
        $row = fetchRecords($result);
        if ($row['user_role'] == 'contractor') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

//===== END AUTHENTICATION HELPERS =====//

function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }
    return false;
}

function query($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function fetchRecords($result)
{
    return mysqli_fetch_array($result);
}

function confirmQuery($result)
{

    global $connection;

    if (!$result) {

        die("QUERY FAILED ." . mysqli_error($connection));
    }
}

function loggedInUserIdParent()
{
    if (isLoggedIn()) {
        $result = query("SELECT * FROM users WHERE user_id='" . $_SESSION['user_id'] . "'");
        confirmQuery($result);
        $parent = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) >= 1) {
            return $parent['parent_id'];
        }
    }
    return false;
}

function loggedInUserIdStudent()
{
    if (isLoggedIn()) {
        $result = query("SELECT * FROM users WHERE user_id='" . $_SESSION['user_id'] . "'");
        confirmQuery($result);
        $parent = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) >= 1) {
            return $parent['student_id'];
        }
    }
    return false;
}

function loggedInUserIdTeacher()
{
    if (isLoggedIn()) {
        $result = query("SELECT * FROM users WHERE user_id='" . $_SESSION['user_id'] . "'");
        confirmQuery($result);
        $teacher = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) >= 1) {
            return $teacher['teacher_id'];
        }
    }
    return false;
}

function get_all_user_kids()
{
    return query("SELECT * FROM users WHERE student_id =" . loggedInUserIdParent() . "");
}

function get_all_user_leads()
{
    return query("SELECT * FROM leads WHERE lead_user=" . loggedInUserId() . "");
}

function get_all_user_proposals()
{
    return query("SELECT * FROM proposal WHERE proposal_user=" . loggedInUserId() . "");
}

function get_all_user_meetings()
{
    return query("SELECT * FROM meetings WHERE meeting_user=" . loggedInUserId() . "");
}

function count_records($result)
{
    return mysqli_num_rows($result);
}

function users_online()
{
    global $connection;

    $session                 = session_id();
    $time                    = time();
    $online_id               = $_SESSION['user_id'];
    $online_parent_id        = $_SESSION['parent_id'];
    $online_student_id       = $_SESSION['student_id'];
    $online_teacher_id       = $_SESSION['teacher_id'];
    $online_t_student_id     = $_SESSION['t_student_id'];
    $online_firstname        = $_SESSION['firstname'];
    $online_img              = $_SESSION['img'];
    $online_user_role        = $_SESSION['user_role'];
    $time_out_in_seconds     = 60;
    $time_out                = $time - $time_out_in_seconds;

    $query = "DELETE FROM users_online WHERE users_online.online_id = '" . $online_id . "'";
    mysqli_query($connection, $query);
    // $count = mysqli_num_rows($send_query);

    // if ($count == NULL) {
    if ($online_student_id !== NULL && $online_parent_id !== NULL) {
        mysqli_query($connection, "INSERT INTO users_online(session, time, online_id, online_parent_id, online_student_id, online_teacher_id, online_t_student_id, online_firstname, online_img, online_user_role) VALUES('{$session}', '{$time}', '{$online_id}', '{$online_parent_id}', '{$online_student_id}', NULLIF('{$online_teacher_id}', ''), NULLIF('{$online_t_student_id}', ''), '{$online_firstname}', '{$online_img}', '{$online_user_role}')");
    } elseif ($online_student_id !== NULL) {
        mysqli_query($connection, "INSERT INTO users_online(session, time, online_id, online_student_id, online_teacher_id, online_t_student_id, online_firstname, online_img, online_user_role) VALUES('{$session}', '{$time}', '{$online_id}', '{$online_student_id}', NULLIF('{$online_teacher_id}', ''), NULLIF('{$online_t_student_id}', ''), '{$online_firstname}', '{$online_img}', '{$online_user_role}')");
    } elseif ($online_parent_id !== NULL) {
        mysqli_query($connection, "INSERT INTO users_online(session, time, online_id, online_parent_id, online_teacher_id, online_t_student_id, online_firstname, online_img, online_user_role) VALUES('{$session}', '{$time}', '{$online_id}', '{$online_parent_id}', NULLIF('{$online_teacher_id}', ''), NULLIF('{$online_t_student_id}', ''), '{$online_firstname}', '{$online_img}', '{$online_user_role}')");
    } else {
        mysqli_query($connection, "INSERT INTO users_online(session, time, online_id, online_teacher_id, online_t_student_id, online_firstname, online_img, online_user_role) VALUES('{$session}', '{$time}', '{$online_id}', NULLIF('{$online_teacher_id}', ''), NULLIF('{$online_t_student_id}', ''), '{$online_firstname}', '{$online_img}', '{$online_user_role}')");
    }
    // } 
    // else {
    //     mysqli_query($connection, "UPDATE users_online SET time = '$time', online_teacher_id = NULLIF('{$online_teacher_id}', ''), online_t_student_id = NULLIF('{$online_t_student_id}', '') WHERE online_id = '$online_id'");
    // }

    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' AND (online_id != $online_id)");
    return $count_user = mysqli_num_rows($users_online_query);
}







function print_users_online()
{
    global $connection;

    $session = session_id();
    $time = time();
    $online_parent_firstname = $_SESSION['parent_firstname'];
    $time_out_in_secound = 60 * 2;
    $time_out = $time - $time_out_in_secound;

    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");

    while ($row = mysqli_fetch_array($users_online_query)) {
        $online_parent_firstname = $row['parent_firstname'];
        $query = "SELECT * FROM users_online WHERE online_parent_id = '{$online_parent_id}' ";
        $select_parent_query = mysqli_query($connection, $query);
        $user_row = mysqli_fetch_array($select_parent_query);
        echo $user_row['parent_firstname'] . " ";
    }
}

function update_kids_count()
{
    global $connection;
    if (isLoggedIn()) {
        $result = query("SELECT * FROM users WHERE parent_id !=''");
        if (mysqli_num_rows($result) > 0) {
            while ($parent_data = mysqli_fetch_assoc($result)) {
                $student_row = query("SELECT * FROM users WHERE student_id ='" . $parent_data['parent_id'] . "'");
                $student_count = mysqli_num_rows($student_row);
                $query = "UPDATE users SET kids_count=" . $student_count . " WHERE parent_id=" . $parent_data['parent_id'];
                $update = mysqli_query($connection, $query);
                if ($update) {
                } else {
                    echo $query;
                    die("QUERY FAILED" . mysqli_error($connection) . '' . mysqli_errno($connection));
                }
            }
        }
    }
    return false;
}

function loginTimeQuestApi($data)
{
    $url = "https://timequest.rocks/api/login";
    $ch = curl_init($url);

    $data_string = json_encode($data);

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        )
    ));

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        // Check if the response is valid JSON
        $decoded_response = json_decode($response, true);

        if ($decoded_response === null && json_last_error() !== JSON_ERROR_NONE) {
            echo 'SUPERADMIN LOGIN ERROR: ' . $response;
        } else {
            return $decoded_response;
        }
    }

    curl_close($ch);
}

function registerTimeQuest($data, $token)
{
    $url = "https://timequest.rocks/api/student";
    $ch = curl_init($url);

    
    if(strlen(trim($data['img_url'])) == 0) {
        $data['img_url'] = 'image';
    }
    
    $data_string = json_encode($data);
    
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'token: ' . $token  
        )
    ));

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        // Check if the response is valid JSON
        $decoded_response = json_decode($response, true);

        if ($decoded_response === null && json_last_error() !== JSON_ERROR_NONE) {
            echo 'REGISTER ERROR: ' . $response;
        } else {
            return $decoded_response;
        }
    }

    curl_close($ch);
}

function loginStudentTimeQuest($data)
{
 
    $url = "https://timequest.rocks/colyseuss/login";
    $ch = curl_init($url);
    $data_string = json_encode($data);
    
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            )
        ));
        
    $response = curl_exec($ch);

    $no_data_found = ($response == "username or password is incorrect");
    if($no_data_found) {
        return "no_data";
    }

    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        $decoded_response = json_decode($response, true);

        if ($decoded_response === null && json_last_error() !== JSON_ERROR_NONE) {
            echo 'STUDENT LOGIN ERROR: ' . $response;
        } else {
            return $decoded_response;
        }
    }
    
    curl_close($ch);
}

function registerHistoricalStudent($data_array, $token)
{
    // Data to be sent in the request body
    $data = array(
        "std_name" => $data_array['name'],
        "std_pass" => $data_array['password'],
        "std_email" => $data_array['email'],
        "img_url" => $data_array['img'],
        "state_id" => "1",
        "city_id" => "1",
        "school_id" => "1",
        "class_id" => 1,
        "teacherId" => $data_array['teached_id']
    );

    // Convert data to JSON format
    $jsonData = json_encode($data);

    // API endpoint URL
    $url = 'https://timequest.rocks/api/student';


    // Prepare the request
    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "Authorization: $token",
            'Content-Length: ' . strlen($jsonData)
        )
    ));

    // Execute the request and get the response
    $response = curl_exec($ch);

    // Check for errors in the request
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    }

    // Close the connection
    curl_close($ch);

    // Display the API response
    return json_decode($response);
}

// function editHistoricalStudent($data_array, $accessToken)
// {
//     // Convert data to JSON format
//     $jsonData = json_encode($data_array);

//     // API endpoint URL
//     $url = 'https://timequest.rocks/api/student';

//     // Prepare the request
//     $ch = curl_init();

//     curl_setopt_array($ch, array(
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_CUSTOMREQUEST => "PUT",
//         CURLOPT_POSTFIELDS => $jsonData,
//         CURLOPT_HTTPHEADER => array(
//             'Content-Type: application/json',
//             'token: ' . $accessToken,
//             'Content-Length: ' . strlen($jsonData)
//         )
//     ));

//     // Execute the request and get the response
//     $response = curl_exec($ch);

//     // Check for errors in the request
//     if (curl_errno($ch)) {
//         echo 'Error: ' . curl_error($ch);
//     }

//     // Close the connection
//     curl_close($ch);

//     // Return the API response
//     return json_decode($response);
// }

function register_lighting_round($data_array)
{
    $url = 'https://lightninground.rocks/api/register';

    $data = http_build_query($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    if ($e = curl_error($ch)) {
        echo $e;
    } else {
        return json_decode($resp)->content->token;
    }
}
function deleteUserFromLightningRound($data_array)
{
    $url = 'https://lightninground.rocks/api/removeAccount';

    $data = http_build_query($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    if ($e = curl_error($ch)) {
        echo $e;
    } else {

        return json_decode($resp)->content->token;
    }
}

function loginLightingRound($data_array)
{
    $url = 'https://lightninground.rocks/api/login';

    $data = http_build_query($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    if ($e = curl_error($ch)) {
        echo $e;
    } else {
        return json_decode($resp)->content->token;
    }
}
function editInfoLightingRound($data_array)
{
    $url = 'https://lightninground.rocks/api/updateInfoKids';

    $data = http_build_query($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    if ($e = curl_error($ch)) {
        echo $e;
    } else {
        json_decode($resp);
    }
}

function update_kids_count_byteacher()
{
    global $connection;
    if (isLoggedIn()) {
        $result = query("SELECT * FROM users WHERE teacher_id !=''");

        if (mysqli_num_rows($result) > 0) {
            while ($parent_data = mysqli_fetch_assoc($result)) {
                $student_row = query("SELECT * FROM users WHERE t_student_id ='" . $parent_data['teacher_id'] . "'");
                //  echo $parent_data['teacher_id'];
                $student_count = mysqli_num_rows($student_row);
                // echo $student_count.'<br>';

                if ($student_count > 0) {
                    $query = "UPDATE users SET kids_count=" . $student_count . " WHERE teacher_id=" . $parent_data['teacher_id'];
                    $update = mysqli_query($connection, $query);
                    if ($update) {
                    } else {
                        echo $query;
                        die("QUERY FAILED" . mysqli_error($connection) . '' . mysqli_errno($connection));
                    }
                }
            }
        }
    }
    return false;
}

function check_password_strength($password)
{
    // check if password is at least 8 characters long
    if (strlen($password) < 8) {
        return false;
    }

    // check if password contains uppercase and lowercase letters
    if (!preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // check if password contains numbers and special characters
    if (!preg_match('/[0-9]/', $password) || !preg_match('/[\W]/', $password)) {
        return false;
    }

    // check if password contains common words or phrases
    $common_passwords = array('password', '123456', 'qwerty', 'admin', 'letmein', 'monkey', 'abc123', 'football');
    if (in_array(strtolower($password), $common_passwords)) {
        return false;
    }

    // check if password is a commonly used password
    $commonly_used_passwords = array('password1', '12345678', '123456789', '1234567890', 'qwertyuiop', 'asdfghjkl', 'zxcvbnm', 'letmein1', 'welcome1', 'monkey1', 'iloveyou1', 'admin123', 'football1', 'baseball1', 'superman1');
    if (in_array(strtolower($password), $commonly_used_passwords)) {
        return false;
    }

    // password meets all criteria
    return true;
}

function ifItIsMethod($method = null)
{

    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {

        return true;
    }

    return false;
}

function redirect($location)
{
    header("Location:" . $location);
    exit;
}

function email_exists($email)
{

    global $connection;


    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {

        return true;
    } else {

        return false;
    }
}

function generatePassword($length = 8)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $randomChar = $chars[rand(0, strlen($chars) - 1)];
        $password .= $randomChar;
    }

    return $password;
}

//Automatic logout after inactivity

function checkInactivity($timeoutMinutes, $redirectUrl)
{
    $lastActivity = isset($_SESSION['last_activity']) ? $_SESSION['last_activity'] : 0;
    $inactiveTime = time() - $lastActivity;

    if ($inactiveTime >= ($timeoutMinutes * 60)) {
        // Redirect to the specified URL
        header("Location: $redirectUrl");
        exit();
    }

    $_SESSION['last_activity'] = time();
}
