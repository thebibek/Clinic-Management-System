<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class InstallController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view("Install/InstallView");
    }

    /*
     * @requirements 
     *
     */

    public function firstStep() {
        $config_path = APPPATH . 'config/config.php';
        $data['error'] = false;

        if (phpversion() < "5.6") {
            $data['error'] = true;
            $data['phpversion'] = '<span class="tra-amount text-danger">Current version is ' . phpversion() . '</span>';
        } else {
            $data['phpversion'] = '<span class="tra-amount text-success">' . phpversion() . '</span>';
        }

        if (!extension_loaded("mysqli")) {
            $data['error'] = true;
            $data['mysqli'] = '<span class="tra-amount text-danger">Not Enabled</span>';
        } else {
            $data['mysqli'] = '<span class="tra-amount text-success">Enabled</span>';
        }

        if (!extension_loaded('gd')) {
            $data['error'] = true;
            $data['gd'] = '<span class="tra-amount text-danger">Not Enabled</span>';
        } else {
            $data['gd'] = '<span class="tra-amount text-success">Enabled</span>';
        }

        if (!extension_loaded('curl')) {
            $data['error'] = true;
            $data['curl'] = '<span class="tra-amount text-danger">Not Enabled</span>';
        } else {
            $data['curl'] = '<span class="tra-amount text-success">Enabled</span>';
        }

        if (!extension_loaded('mbstring')) {
            $data['error'] = true;
            $data['mbstring'] = '<span class="tra-amount text-danger">Not Enabled</span>';
        } else {
            $data['mbstring'] = '<span class="tra-amount text-success">Enabled</span>';
        }

        if (!extension_loaded('zip')) {
            $data['error'] = true;
            $data['zip'] = '<span class="tra-amount text-danger">Not Enabled</span>';
        } else {
            $data['zip'] = '<span class="tra-amount text-success">Enabled</span>';
        }

        if (!is_really_writable(APPPATH . 'config/config.php')) {
            $data['error'] = true;
            $data['config'] = '<span class="tra-amount text-danger">Not Writable</span>';
        } else {
            $data['config'] = '<span class="tra-amount text-success">Writable</span>';
        }

        if (!is_really_writable(APPPATH . 'config/database.php')) {
            $data['error'] = true;
            $data['database'] = '<span class="tra-amount text-danger">Not Writable</span>';
        } else {
            $data['database'] = '<span class="tra-amount text-success">Writable</span>';
        }



        if ($data['error']) {
            $data['status'] = 0;
            $data['errormsg'] = '<span class="text-danger">Please fix the requirements to proceed.</span>';
        }


        $this->load->view("Install/FirstStepView", $data);
    }

    public function secondStep() {
        $this->load->view("Install/SecondStepView");
    }

    public function validateDatabase() {
        $this->form_validation->set_rules('Host', 'host', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('Database', 'database', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('UserName', 'user name', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('Password', 'password', 'trim');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url('install/database'));
            exit();
        } else {
            $host = $this->input->post('Host');
            $db = $this->input->post('Database');
            $user = $this->input->post('UserName');
            $pwd = $this->input->post('Password');

            $conn = new mysqli($host, $user, $pwd);

            if ($conn->connect_error) {
                $error = "Connection failed: " . $conn->connect_error;
                $this->session->set_flashdata('error', $error);
                $conn->close();
                redirect(base_url('install/database'));
                exit();
            }

            $sql = "CREATE DATABASE  IF NOT EXISTS " . $db . " CHARACTER SET utf8 COLLATE utf8_general_ci";
            if (!$conn->query($sql)) {
                $error = "Connection failed: " . $conn->error;
                $this->session->set_flashdata('error', $error);
                $conn->close();
                redirect(base_url('install/database'));
                exit();
            } else {
                if ($this->dbConfig($host, $db, $user, $pwd)) {

                    $query = file_get_contents(APPPATH . 'controllers/database/database.sql');

                    //close previous database connection if any
                    $conn->close();

                    //import database file 
                    if ($this->import($host, $user, $pwd, $db, $query)) {
                        $this->session->set_flashdata('success', 'Database connection is successful');

                        redirect(base_url('install/setup'));
                        exit();
                    } else {
                        $error = "Could not import the database file";
                        $this->session->set_flashdata('error', $error);
                        redirect(base_url('install/database'));
                    }
                } else {
                    $error = "Could not configure the database file";
                    $this->session->set_flashdata('error', $error);
                    redirect(base_url('install/database'));
                }
            }
        }
    }

    public function setup() {
        $this->load->view("Install/SetupView");
    }

    public function setupValidate() {
        $this->form_validation->set_rules('EmailId', 'email', 'trim|required|valid_email|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('Password', 'password', 'trim|required|min_length[6]|max_length[8]');
        $this->form_validation->set_rules('ConfirmPassword', 'confirm password', 'trim|required|min_length[6]|max_length[8]|matches[Password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url("install/setup"));
            exit();
        } else {
            $this->load->library("Aauth");

            $email = $this->input->post('EmailId');
            $password = $this->input->post('Password');

            if ($this->aauth->user_exist_by_id(1)) {
                $this->aauth->update_user(1, $email, $password);
            } else {
                $this->aauth->create_user($email, $password, "Admin");
            }

            redirect(base_url("install/finish"));
            exit();
        }
    }

    public function finishSetup() {
        $file1 = APPPATH . 'config/routes.php';
        $find1 = '$route["default_controller"] = "InstallController"';
        $replace1 = '$route["default_controller"] = "ApplicationController"';


        $this->findReplace($find1, $replace1, $file1, false);

        $file2 = APPPATH . 'config/autoload.php';
        $find2 = "array('email','session','form_validation')";
        $replace2 = "array('database','email','session','form_validation','Aauth')";

        $this->findReplace($find2, $replace2, $file2, false);

        $this->load->view("Install/FinalView");
    }

    function findReplace($find, $replace, $file, $case_insensitive = true) {
        if (!file_exists($file)) {
            return false;
        } else {
            $contents = file_get_contents($file);
            if ($case_insensitive) {
                $output = str_ireplace($find, $replace, $contents);
            } else {
                $output = str_replace($find, $replace, $contents);
            }

            $fopen = fopen($file, 'w');
            if (!$fopen) {
                return false;
            } else {
                $fwrite = fwrite($fopen, $output);
                if (!$fwrite) {
                    return false;
                } else {
                    return true;
                }
            }
            fclose($open);
        }
    }

    public function import($host, $user, $pwd, $db, $query) {
        set_time_limit(300);
        $cn = new mysqli($host, $user, $pwd, $db);
        $count = 0;
        if ($cn->multi_query($query)) {
            do {
                if ($result = $cn->store_result()) {
                    $count = 1;
                }
                if ($result instanceof mysqli_result) {
                    $result->free();
                }

                if ($cn->more_results()) {
                    $count += 1;
                }
            } while ($cn->next_result());

            if ($count >= 1) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    private function dbConfig($host, $db, $user, $pwd) {
        $hostname = $host;
        $database = $db;
        $username = $user;
        $password = $pwd;
        $configDatabaseFile = '<?php defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the \'Database Connection\'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	[\'dsn\']      The full DSN string describe a connection to the database.
|	[\'hostname\'] The hostname of your database server.
|	[\'username\'] The username used to connect to the database
|	[\'password\'] The password used to connect to the database
|	[\'database\'] The name of the database you want to connect to
|	[\'dbdriver\'] The database driver. e.g.: mysqli.
|			Currently supported:
|				 cubrid, ibase, mssql, mysql, mysqli, oci8,
|				 odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
|	[\'dbprefix\'] You can add an optional prefix, which will be added
				|				 to the table name when using the  Query Builder class
|	[\'pconnect\'] TRUE/FALSE - Whether to use a persistent connection
|	[\'db_debug\'] TRUE/FALSE - Whether database errors should be displayed.
|	[\'cache_on\'] TRUE/FALSE - Enables/disables query caching
|	[\'cachedir\'] The path to the folder where cache files should be stored
|	[\'char_set\'] The character set used in communicating with the database
|	[\'dbcollat\'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	[\'swap_pre\'] A default table prefix that should be swapped with the dbprefix
|	[\'encrypt\']  Whether or not to use an encrypted connection.
|
|			\'mysql\' (deprecated), \'sqlsrv\' and \'pdo/sqlsrv\' drivers accept TRUE/FALSE
|			\'mysqli\' and \'pdo/mysql\' drivers accept an array with the following options:
|
|				\'ssl_key\'    - Path to the private key file
|				\'ssl_cert\'   - Path to the public key certificate file
|				\'ssl_ca\'     - Path to the certificate authority file
|				\'ssl_capath\' - Path to a directory containing trusted CA certificats in PEM format
|				\'ssl_cipher\' - List of *allowed* ciphers to be used for the encryption, separated by colons (\':\')
|				\'ssl_verify\' - TRUE/FALSE; Whether verify the server certificate or not (\'mysqli\' only)
|
|	[\'compress\'] Whether or not to use client compression (MySQL only)
|	[\'stricton\'] TRUE/FALSE - forces \'Strict Mode\' connections
|							- good for ensuring strict SQL while developing
|	[\'ssl_options\']	Used to set various SSL options that can be used when making SSL connections.
|	[\'failover\'] array - A array with 0 or more data for connections if the main should fail.
|	[\'save_queries\'] TRUE/FALSE - Whether to "save" all executed queries.
| 				NOTE: Disabling this will also effectively disable both
| 				$this->db->last_query() and profiling of DB queries.
| 				When you run a query, with this setting set to TRUE (default),
| 				CodeIgniter will store the SQL statement for debugging purposes.
| 				However, this may cause high memory usage, especially if you run
| 				a lot of SQL queries ... disable this to avoid that problem.
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the \'default\' group).
				|
| The $query_builder variables lets you determine whether or not to load
| the query builder class.
						*/
$active_group = \'default\';
$query_builder = TRUE;

$db[\'default\'] = array(
	\'dsn\'	=> \'\',
	\'hostname\' => \'' . $hostname . '\',
	\'username\' => \'' . $username . '\',
	\'password\' => \'' . $password . '\',
	\'database\' => \'' . $database . '\',
	\'dbdriver\' => \'mysqli\',
	\'dbprefix\' => \'\',
	\'pconnect\' => FALSE,
	\'db_debug\' => (ENVIRONMENT !== \'production\'),
	\'cache_on\' => FALSE,
	\'cachedir\' => \'\',
	\'char_set\' => \'utf8\',
	\'dbcollat\' => \'utf8_general_ci\',
	\'swap_pre\' => \'\',
	\'encrypt\' => FALSE,
	\'compress\' => FALSE,
	\'stricton\' => FALSE,
	\'failover\' => array(),
	\'save_queries\' => TRUE
);';

        $fp = fopen(APPPATH . 'config/database.php', 'w+');
        if ($fp) {
            if (fwrite($fp, $configDatabaseFile)) {
                return true;
            }
            fclose($fp);
        }
        return false;
    }

}
