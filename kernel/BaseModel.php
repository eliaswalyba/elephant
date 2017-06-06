<?php namespace Kernel;
/*
 |-----------------------------------------------------
 | Class BaseModel
 | @package App\Kernel
 |-----------------------------------------------------
 */

use Config\Conf;

class BaseModel {

    /**
     * @var array the connections to the database
     */
    protected static $connections = [];

    /**
     * @var string the name of the database
     */
    protected $dbName = 'default';

    /**
     * @var \PDO the pdo object
     */
    protected $pdo;

    /**
     * @var null|string null if no table used and string the name of the current table
     */
    protected $table = null;

    /**
     * @var string the current table primary key
     */
    protected $primaryKey = 'id';


    /**
     * The constructor of the class. It allows to connect to the database
     */
    public function __construct() {
        // We initialize some variables
        if($this->table === null) {
            $table = strtolower(str_replace('Model\\','',get_class($this)) . 's');
            $this->table = $table;
        }
        // We establish a communication with the database
        $dbParams = Conf::$databases[$this->dbName];
        if(isset(BaseModel::$connections[$this->dbName])) {
            $this->pdo = BaseModel::$connections[$this->dbName];
            return true;
        } try {
            $pdo = new \PDO('mysql:host='.$dbParams['host'].';dbname='.$dbParams['name'], $dbParams['login'],
                $dbParams['password'], [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
            );
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            BaseModel::$connections[$this->dbName] = $pdo;
            $this->pdo = $pdo;
        } catch (\PDOException $e) {
            if(Conf::$debug >= 1) {
                die($e->getMessage());
            } else {
                die('Unable to establish a connection to the database');
            }
        }
    }

    /**
     * Allows to find all records
     * @param null $req the request attributes
     * @return array all records
     */
    public function findAll($req = null) {
        $statement = 'SELECT ';
        if(isset($req['fields'])) {
            if(is_array($req['fields'])) {
                $statement .= implode(', ', $req['fields']);
            } else {
                $statement .= $req['fields'];
            }
        } else {
            $statement .= '*';
        }
        $statement .= ' FROM '.$this->table.' AS '.str_replace('Model\\','',get_class($this));
        // Building the conditions
        if(isset($req['conditions'])) {
            $statement .= ' WHERE ';
            if(!is_array($req['conditions'])) {
                $statement .= $req['conditions'].' ';
            } else {
                $cond = [];
                foreach($req['conditions'] as $k => $v) {
                    if(!is_numeric($v)) {
                        $v = '"'.$v.'"';
                    }
                    $cond[] = "$k = $v ";
                }
                $statement .= implode(' AND ', $cond);
            }
        }
        if(isset($req['limit'])) {
            $statement .= ' LIMIT '.$req['limit'];
        }
        $results = $this->pdo->query($statement);
        return $results->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Allows to find the first record in the table
     * @param null $req the request attributes
     * @return mixed the first record
     */
    public function findFirst($req = null) {
        return current($this->findAll($req));
    }

    public function findLast($req = null) {
        return end($this->findAll($req));
    }

    public function findCount($conditions = null) {
        $result = $this->findFirst([
            'fields' => 'COUNT('.$this->primaryKey.') AS count',
            'conditions' => $conditions
        ]);
        return $result->count;
    }

}