<?php
namespace Php;
require_once __DIR__ . '/Helper.php'; //Include helper
class DbImport
{
    private $table_name = 'user';      //Login Table Name
    private $table_fields = array('email', 'password', 'status', 'is_admin'); // Table Field Names
    private $field_values = array('{input}', '{input}', 1, 1); // Table Field Values

    // Function to the database and tables and fill them with the default data
    function createDatabase($data = [])
    {
        // Connect to the database
        @$mysqli = new \mysqli($data['hostname'], $data['username'], $data['password'], '');

        // Check for errors
        if (mysqli_connect_errno()) {
            return false;
        }

        // Create the prepared statement
        $createDb = $mysqli->query("CREATE DATABASE IF NOT EXISTS " . $data['database']);

        // Close the connection
        $mysqli->close();

        if ($createDb) {
            return true;
        } else {
            return false;
        }
    }

    // Function to create the tables and fill them with the default data
    function createTables($data = [])
    {
        // Connect to the database
        @$mysqli = new \mysqli(
            $data['hostname'],
            $data['username'],
            $data['password'],
            $data['database']
        );

        // Check for errors
        if (mysqli_connect_errno())
            return false;

        // Open the default SQL file
        $query = file_get_contents('sql/install.sql');

        // Execute a multi query
        $multi_query = $mysqli->multi_query($query);

        // Close the connection
        $mysqli->close();

        // Store Database information into session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['hostname'] = $data['hostname'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['database'] = $data['database'];

        if ($multi_query) {
            return true;
        } else {
            return false;
        }
    }

    //filter all input data
    public function filterInput($data = null)
    {
        //if not empty posted data
        if (!empty($data)) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        return false;
    }

    // Insert Login info
    function insert_login($data = [])
    {

        $email = 'panda869@gmail.com';
        $password = 'panda869';

        // Connect to the database
        @$mysqli = new \mysqli(
            'localhost',
            'root',
            '',
            'hotel'
        );

        // Check for errors
        if (mysqli_connect_errno())
            return false;

        $password = md5($password);

        $fields_num = count($this->table_fields);
        $fields = '';
        $values = '';
        for ($i = 0; $i < $fields_num; $i++) {

            $fields .= "`" . $this->table_fields[$i] . "`,"; // set field values

            if ($i == 0) {

                $values .= "'" . $email . "',"; // Set Email values

            } else if ($i == 1) {

                $values .= "'" . $password . "',"; // Set Password Values

            } else {

                $values .= ((gettype($this->field_values[$i]) == 'integer') ? $this->field_values[$i] : "'" . $this->field_values[$i] . "'") . ",";

            }
        }

        // Make Query
        $query = "INSERT INTO `$this->table_name` (" . rtrim($fields, ',') . ") VALUES (" . rtrim($values, ',') . ")";

        // Run Query
        $insert_query = $mysqli->query($query);

        // Close the connection
        $mysqli->close();

        if ($insert_query) {
            return true;
        } else {
            return false;
        }
    }

}

