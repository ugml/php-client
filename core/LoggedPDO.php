<?php
/**
* Extends PDO and logs all queries that are executed and how long
* they take, including queries issued via prepared statements
*/
class LoggedPDO extends PDO
{
    public static $log = array();
    
    public function __construct($dsn, $username = null, $password = null) {
        parent::__construct($dsn, $username, $password);
    }
    
    /**
     * Print out the log when we're destructed. I'm assuming this will
     * be at the end of the page. If not you might want to remove this
     * destructor and manually call LoggedPDO::printLog();
     */
    public function __destruct() {
        //self::printLog();
    }
    
    public function query($query) {
        $start = microtime(true);
        $result = parent::query($query);
        $time = microtime(true) - $start;
        LoggedPDO::$log[] = array('query' => $query,
                                  'time' => round($time * 1000, 3));
        return $result;
    }

    /**
     * @return LoggedPDOStatement
     */
    public function prepare($query, $options = null) {
        return new LoggedPDOStatement(parent::prepare($query));
    }
    
    public static function printLog() {
        $totalTime = 0;
        echo '<div class="row"><div class="col-md-12"><table class=\'sql_debug_table\'><tr><th>#</th><th>Query</th><th>Time (ms)</th></tr>';
        $i = 1;
        foreach(self::$log as $entry) {
            $totalTime += $entry['time'];
            echo '<tr><td>'.$i++.'</td><td>' . $entry['query'] . '</td><td>' . $entry['time'] . '</td></tr>';
        }
        echo '<tr><th colspan=\'2\'>' . count(self::$log) . ' queries</th><th>' . $totalTime . '</th></tr>';
        echo '</table></div></div>';
    }
}

/**
* PDOStatement decorator that logs when a PDOStatement is
* executed, and the time it took to run
* @see LoggedPDO
*/
class LoggedPDOStatement {
    /**
     * The PDOStatement we decorate
     */
    private $statement;

    public function __construct(PDOStatement $statement) {
        $this->statement = $statement;
    }

    /**
    * When execute is called record the time it takes and
    * then log the query
    * @return PDO result set
    */
    public function execute() {
        $start = microtime(true);
        $result = $this->statement->execute();
        $time = microtime(true) - $start;
        LoggedPDO::$log[] = array('query' => '[PS] ' . $this->statement->queryString,
                                  'time' => round($time * 1000, 3));
        return $result;
    }
    
    /**    
    * Makes the parameters from $this->__call() referenced, or else php complains    
    */    
    private function makeValuesReferenced($arr){    
        $refs = array();    
        foreach($arr as $key => $value)    {
            $refs[$key] = &$arr[$key];    
        }
        return $refs;    
        
    }
    
    /**
    * Other than execute pass all other calls to the PDOStatement object
    * @param string $function_name
    * @param array $parameters arguments
    */
    public function __call($function_name, $parameters) {    
        return call_user_func_array(array($this->statement, $function_name), $this->makeValuesReferenced($parameters));    
    }
    
}
