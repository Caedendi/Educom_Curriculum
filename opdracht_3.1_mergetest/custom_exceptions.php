<?php
class PageNotFoundException extends Exception {

};

class DatabaseConnectionException extends Exception {
    /* JH: Mis hier nog de constructor die een $message accepteert en doorgeeft aan zijn parent constructor */
};

class DatabaseQueryException extends Exception {

}

?>
