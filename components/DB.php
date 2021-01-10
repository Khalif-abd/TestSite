<?
class DB
{
    private $pdo;
    private $sql = null;
    private $placeholders = null;

    //Подключение к базе данных
    public function mysql_connect()
    {
        $path = ROOT . '/config/db.config.php';
        $param = include $path;

        $host = $param['host'];
        $dbname = $param['dbname'];
        $user = $param['user'];
        $pass = $param['pass'];

        $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
        $connopt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        $this->pdo = new PDO($dsn, $user, $pass, $connopt);
        $this
            ->pdo
            ->exec('SET NAMES utf8');
    }

    // Выборка
    public function select($what)
    {
        $this->placeholders = null;
        $this->sql = "SELECT $what ";
        return $this;

    }

    public function from($table)
    {
        $this->sql .= " FROM  $table";
        return $this;

    }

    public function where($args, $placeholders = null)
    {
        $this->placeholders = $placeholders;
        $this->sql .= " WHERE  $args ";
        return $this;

    }

    public function sort($arg, $arg2 = null)
    {
        $this->sql .= " ORDER BY  $arg  $arg2 ";
        return $this;

    }

    public function limit($arg, $arg2 = null)
    {
        $a = null;
        $arg2 != null ? $a = ' , ' : $a = null;
        $this->sql .= " LIMIT  $arg   $a  $arg2  ";
        return $this;

    }

    //Добавлеине в данных в таблицу
    public function insert($table)
    {
        $this->placeholders = null;
        $this->sql = "INSERT INTO $table";
        return $this;

    }

    public function value($args)
    {
        $this->placeholders = $args;
        $str = '';
        $str2 = '';

        foreach ($args as $key => $value)
        {
            $a = null;
            $last_key = array_key_last($args);
            $last_key === $key ? $a = null : $a = ',';
            $str .= $key . $a;
            $str2 .= ':' . $key . $a;
        }

        $this->sql .= "( $str ) VALUES ( $str2 ) ";
        return $this;
    }

    // Обновление данных в таблице
    public function update($table)
    {
        $this->placeholders = null;
        $this->sql = "UPDATE $table  SET ";
        return $this;

    }

    public function set($args, $placeholders = null)
    {
        $this->placeholders = $placeholders;
        $this->sql .= $args;
        return $this;

    }

    // Удалениен данных из таблицы
    public function delete($table)
    {
        $this->placeholders = null;
        $this->sql = " DELETE from  $table";
        return $this;
    }

    //-------------------------------------------------- Создание таблиц
    

    public function table($table)
    {
        $this->sql = "CREATE TABLE $table ( ";
        return $this;
    }

    public function increments($id)
    {
        $this->sql .= "$id INT PRIMARY KEY AUTO_INCREMENT";
        return $this;
    }

    public function int($int, $length = 11, $notNull = null, $index = null)
    {
        $this->sql .= ", $int INT($length) $notNull  $index";

        return $this;
    }

    public function string($string, $length = 255)
    {

        $this->sql .= ", $string VARCHAR($length)";

        return $this;
    }

    public function text($text)
    {

        $this->sql .= ", $text  TEXT";
        return $this;
    }

    public function forEignKey($table, $id1, $id2)
    {

        $this->sql .= ", FOREIGN KEY ($id1) REFERENCES $table ($id2)";
        return $this;
    }

    public function create()
    {
        $this->sql .= " )";
         return  $this->pdo->exec($this->sql);
        // return $this;
    }

    
    // Удаление таблицы
    public function deleteTable($table)
    {
        $this->sql = 'DROP TABLE ' . $table;
        $this
            ->pdo
            ->exec($this->sql);
    }

    
    // Запуск сформированного запроса
    public function go($select = false)
    {

        $sth = $this
            ->pdo
            ->prepare($this->sql);

        if (!is_null($this->placeholders))
        {
            $sth->execute($this->placeholders);
        }
        else
        {
            $sth->execute();
        }

        if ($select == true)
        {
            $arr = $sth->fetchAll();
            return $arr;
        }

        else return false;

    }

    public function mysql_destroy()
    {
        $this->pdo = null;
    }
}
?>
