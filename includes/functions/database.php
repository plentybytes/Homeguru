<?php
function dbConnect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = "db_link")
{
    global $$link;

    if (USE_PCONNECT == "true") {
        $$link = mysqli_pconnect($server, $username, $password);
    } else {
        $$link = mysqli_connect($server, $username, $password, $database);
    }

  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

    if ($$link) {
      mysqli_select_db($$link, $database);
    }

    return $$link;
}

function dbClose($link = "db_link")
{
    global $$link;

    return mysqli_close($$link);
}

function dbError($query, $errno, $error)
{
    die('<font color="#000000"><strong>' . $errno . ' - ' . $error . '<br /><br />' . $query . '<br /><br /><small><font color="#ff0000">[TEP STOP]</font></small><br /><br /></strong></font>');
}

function dbQuery($query, $link = "db_link")
{
    global $$link;

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == "true")) {
        error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    $result = mysqli_query($$link, $query) or dbError($query, mysqli_errno($$link), mysqli_error($$link));

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == "true")) {
        $result_error = mysqli_error();
        error_log('RESULT ' . $result . ' ' . $result_error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    return $result;
}

function dbPerform($table, $data, $action = "insert", $parameters = "", $link = "db_link")
{
    reset($data);
    if ($action == "insert") {
        $query = "INSERT INTO " . $table . " (";
        while (list($columns,) = each($data)) {
            $query .= $columns . ", ";
        }
        $query = substr($query, 0, -2) . ") VALUES (";
        reset($data);
        while (list(, $value) = each($data)) {
            switch ((string)$value) {
                case "NOW()":
                    $query .= "NOW(), ";
                    break;
                case "NULL":
                    $query .= "NULL, ";
                    break;
                default:
                    $query .= "'" . dbInput($value) . "', ";
                    break;
            }
        }
        $query = substr($query, 0, -2) . ")";
    } elseif ($action == "update") {
        $query = "UPDATE " . $table . " SET ";
        while (list($columns, $value) = each($data)) {
            switch ((string)$value) {
                case "NOW()":
                    $query .= $columns . "=NOW(), ";
                    break;
                case "NULL":
                    $query .= $columns .= "=NULL, ";
                    break;
                default:
                    $query .= $columns . "='" . dbInput($value) . "', ";
                    break;
            }
        }
        $query = substr($query, 0, -2) . " WHERE " . $parameters;

    }

    return dbQuery($query, $link);
}

function dbFetchArray($dbQuery)
{
    return mysqli_fetch_array($dbQuery, MYSQLI_ASSOC);
}

function dbNumRows($dbQuery)
{
    return mysqli_num_rows($dbQuery);
}

function dbDataSeek($dbQuery, $rowNumber)
{
    return mysqli_data_seek($dbQuery, $rowNumber);
}

function dbInsertId($link = "db_link")
{
    global $$link;
    return mysqli_insert_id($$link);
}

function dbFreeResult($dbQuery)
{
    return mysqli_free_result($dbQuery);
}

function dbFetchFields($dbQuery)
{
    return mysqli_fetch_field($dbQuery);
}

function dbOutput($string)
{
    return htmlspecialchars($string);
}

function dbInput($string, $link = "db_link")
{
    global $$link;

    if (function_exists('mysql_real_escape_string')) {
        return mysqli_real_escape_string($string, $$link);
    } elseif (function_exists('mysql_escape_string')) {
        return mysqli_escape_string($string);
    }

    return addslashes($string);
}

function dbPrepareInput($string)
{
    if (is_string($string)) {
        return trim(sanitizeString(stripslashes($string)));
    } elseif (is_array($string)) {
        reset($string);
        while (list($key, $value) = each($string)) {
            $string[$key] = dbPrepareInput($value);
        }
        return $string;
    } else {
        return $string;
    }
}

?>
