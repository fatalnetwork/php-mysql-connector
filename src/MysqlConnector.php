<?php

# MySQL Connector
# Version 4.1
# GitHub: 
# Under the MIT License

class MysqlConnector {

  private $connection;
  private $debug;

  public function __construct() {
    $this->set_debug(false);
  }

  public function connect($host, $user, $pass, $database, $port = 3306, $charset = 'utf8') {
    $this->connection = new mysqli($host, $user, $pass, $database, $port);
    $this->set_charset($charset);

    return mysqli_connect_errno() ? false : true;
  }

  public function close() {
    $this->connection->close();
  }

  public function query($query) {
    $query_results = $this->connection->query($query);

    $results = new stdClass();
    $results->data = array();

    if ($query_results->num_rows != false) {
      while ($row = $query_results->fetch_array(MYSQLI_ASSOC)) {
        $results->data[] = $row;
      }

      $query_results->free();
    }

    $results->num_rows = $query_results->num_rows;
    $results->last_insert_id = (int) $this->connection->insert_id;
    $results->affected_rows = (int) $this->connection->affected_rows;

    if ($this->debug === true) {
      $results->debug[] = array(
        'errno' => $this->connection->errno,
        'error' => $this->connection->error
      );
    }

    return $results;
  }

  public function get_escaped_string($string) {
    return $this->connection->real_escape_string($string);
  }

  public function set_charset($charset) {
    $this->connection->set_charset($charset);
  }

  public function set_debug($debug = true) {
    $this->debug = is_bool($debug) ? $debug : false;
  }

}

?>
