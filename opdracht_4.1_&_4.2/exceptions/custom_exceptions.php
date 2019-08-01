<?php

class DatabaseConnectionException extends Exception {
    /* JH: Mis hier nog de constructor die een $message accepteert en doorgeeft aan zijn parent constructor */
    public function __construct(string $message) {
      parent::__construct($message);
    }
};

class DatabaseQueryException extends Exception {
    private $sql;
    private $reportedError;

    public function __construct($message, $reportedError, $sql) {
      parent::__construct($message);
      $this->reportedError = $reportedError;
      $this->orgSql = $sql;
    }

    public function getSql() {
      return $this->orgSql;
    }
}

?>
