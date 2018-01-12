<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class FileNotFoundException extends Exception {}

    class Debug {

        private $log;
        private $count = 0;

        function __construct() {
            
            
            
            $this->count = 0;
            $this->log = '                <div class="row"><div class="col-md-12">
                    <table class=\'debug_table\'>
                        <tr>
                            <th colspan=\'7\'>Error-Log</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Method</th>
                            <th>Line</th>
                            <th>Exception</th>
                            <th>Description</th>
                            <th>Time</th>
                        </tr>';
        }

        function addLog($class, $method, $line, $exception, $descr) {
            $this->count++;
            $this->log .= '<tr><td>'.$this->count.'</td><td>'.$class.'</td><td>'.$method.'</td><td>'.$line.'</td><td>'.$exception.'</td><td>'.$descr.'</td><td>'.time().'</td>';
        }

        function saveError($class, $method, $line, $exception, $descr) {
            global $database, $db;

            $stmt = $db->prepare('INSERT INTO ' . $database['prefix'] . 'errors (id, class, method, line, exception, description, time) VALUES (NULL, :class, :method, :line, :exception, :description, \''.date('Y-m-d H:i:s').'\')');

            $stmt->bindParam(':class', $class);
            $stmt->bindParam(':method', $method);
            $stmt->bindParam(':line', $line);
            $stmt->bindParam(':exception', $exception);
            $stmt->bindParam(':description', $descr);

            $stmt->execute();

            //echo 'An error has occurred (error #'.$db->lastInsertId().')';

        }

        function printDebugLog() {
            $this->log .= '
                    </table>
                </div>
            </div>';
            echo $this->log;
        }

    }
