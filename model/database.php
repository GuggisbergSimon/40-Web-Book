<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : Database class interacting with data on MySQL server
 */

/**
 * Class Database
 */
class Database
{
    private $connector;
    private $serverName = 'localhost';
    private $username = 'root';
    private $password = 'root';

    /**
     * Database constructor.
     */
    public function __construct()
    {
        try {
            $this->connector = new PDO('mysql:host=' . $this->serverName . ';dbname=book;charset=utf8', $this->username, $this->password);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * @param $query
     * @return false|PDOStatement
     */
    private function querySimpleExecute($query)
    {
        $req = $this->connector->query($query);
        return $req;
    }

    /**
     * @param $req
     * @return mixed
     */
    private function formatData($req)
    {
        return $req->fetchALL(PDO::FETCH_ASSOC);
    }

    /**
     * @param $req
     */
    private function unsetData($req)
    {
        $req->closeCursor();
    }

    /**
     * Merges an array as string as the following : (..., ..., ...) with a char (or a string) being added before and after each element
     * @param string[] $strings
     * @param string $char
     * @return string merged
     */
    function mergeStrings($strings, $char): string
    {
        $stringsAsString = "";
        foreach ($strings as $string) {
            $stringsAsString = $stringsAsString . $char . ', ' . $char . addslashes($string);
        }
        $stringsAsString = substr_replace($stringsAsString, '(', 0, 2);
        return $stringsAsString . $char .')';
    }

    /**
     * Read a table and return an array with the table's informations
     * @param string $tableName
     * @return array
     */
    function readTable(string $tableName): array
    {
        $results = $this->querySimpleExecute('select * from ' . $tableName);
        $results = $this->formatData($results);
        return $results;
    }

    /**
     * returns the username based on the id
     * @param $id
     * @return string
     */
    function getUsernameByUserId($id): string {
        $result = $this->querySimpleExecute("select usePseudo from t_user where idUser = $id");
        return $this->formatData($result)[0]['usePseudo'];
    }

    /**
     * returns all books added by a user based on the id
     * @param $id
     * @return array
     */
    function getBooksByUserId($id): array {
        $result = $this->querySimpleExecute("select * from t_book where idUser = $id");
        return $this->formatData($result);
    }
    
    /**
     * Read a table and return an array with the first n table's informations
     * @param string $tableName
     * @param int 
     * @return array
     */
    function readTableFirstLines(string $tableName, int $limit): array
    {
        $results = $this->querySimpleExecute('select * from ' . $tableName . ' order by idBook desc limit ' . $limit);
        $results = $this->formatData($results);
        return $results;
    }

    /**
     * Read informations of a book given an id
     * @param int $bookId
     * @return array
     */
    function getBookById(int $bookId): array
    {
        $results = $this->querySimpleExecute('select * from t_book WHERE idBook=' . $bookId);
        $results = $this->formatData($results);
        return $results[0];
    }

    /**
     * Read informations of a book given an id
     * @param int $bookId
     * @return array
     */
    function getEvaluationsFromBook(int $bookId): array
    {
        $results = $this->querySimpleExecute('select * from t_evaluate LEFT OUTER JOIN t_book ON t_evaluate.idBook = t_book.idBook WHERE t_book.idBook=' . $bookId);
        $results = $this->formatData($results);
        return $results;
    }

    /**
     * Read informations of a book given an id
     * @param int $bookId
     * @return array
     */
    function getUserById(int $userId): array
    {
        $results = $this->querySimpleExecute('select * from t_user WHERE idUser=' . $userId);
        $results = $this->formatData($results);
        return $results[0];
    }

#region ExistsAt functions

    /**
     * Checks wether the specified data exists, returns a negative value if the data does not exist, the id otherwise
     * @param mixed $value
     * @param string $table
     * @param string $column
     * @return int
     */
    function dataExistsAt($value, $table, $column): int
    {
        $results = $this->querySimpleExecute('select * from ' . $table);
        $results = $this->formatData($results);

        foreach ($results as $result) {
            if ($result[$column] == $value) {
                return (int)$result["id" . ucfirst(substr($table, 2, strlen($table)))];
            }
        }
        return -1;
    }

    /**
     * Checks wether the specified user exists
     * @param string $username
     * @return int
     */
    function userExistsAt($username): int
    {
        return $this->dataExistsAt($username, 't_user', 'usePseudo');
    }

    /**
     * Checks wether the specified author exists, returns a negative value if the author does not exist, the id otherwise
     * @param string $name
     * @param string $surname
     * @return int
     */
    function authorExistsAt($name, $surname): int
    {
        $results = $this->querySimpleExecute('select * from t_author');
        $results = $this->formatData($results);

        foreach ($results as $result) {
            if (($result['autName'] == $name) && ($result['autSurname'] == $surname)) {
                return (int)$result["idAuthor"];
            }
        }
        return -1;
    }

    /**
     * Checks wether the specified editor exists
     * @param string $name
     * @return int
     */
    function editorExistsAt($name): int
    {
        return $this->dataExistsAt($name, 't_editor', 'ediName');
    }

    /**
     * Checks wether the specified category exists
     * @param string $name
     * @return int
     */
    function categoryExistsAt($name): int
    {
        return $this->dataExistsAt($name, 't_category', 'catName');
    }

#endregion

#region Add functions

    /**
     * Adds some data to the database
     * @param string $table
     * @param string[] $columns
     * @param string[] $values
     * @return int id
     */
    function addData($table, $columns, $values): int
    {
        echo "added new entry to $table " . var_dump($columns) . " " . var_dump($values);

        $id = 'id' . ucfirst(substr($table, 2, strlen($table)));
        $this->querySimpleExecute('insert into ' . $table . ' ' . $this->mergeStrings($columns,'') . ' values ' . $this->mergeStrings($values, '\''));
        $results = $this->querySimpleExecute("select max($id) from " . $table);
        $results = $this->formatData($results);
        return (int)($results[0]["max($id)"]);
    }

    function addDataBis($table, $columns, $values)
    {
        echo "added new entry to $table " . var_dump($columns) . " " . var_dump($values);
        $query = 'insert into ' . $table . ' ' . $this->mergeStrings($columns,'') . ' values ' . $this->mergeStrings($values, '\'');
        echo $query;
        $this->querySimpleExecute('insert into ' . $table . ' ' . $this->mergeStrings($columns,'') . ' values ' . $this->mergeStrings($values, '\''));
    }

    /**
     * modifie une évaluation de la base de données
     * @param $idUser
     * @param $idBook
     * @param $rating         
     * @param $remark          
     */
    public function updateRating($idBook, $idUser, $rating, $remark){
        $query = 'UPDATE t_evaluate SET evaNote="' . $rating . '", evaRemark="' . $remark . '" WHERE idBook =' . $idBook . ' AND idUserEvaluer=' . $idUser;
        $req = $this->querySimpleExecute($query);
        $this->unsetData($req);
    }

    public function modifyBookAverageNote($averageNote, $id)
    {
        $query = 'UPDATE t_book SET booAverageNotes="' . $averageNote . '" WHERE idBook =' . $id;
        $req = $this->querySimpleExecute($query);
        $this->unsetData($req);
    }

    /**
     * Adds an user to the database
     * @param string $username
     * @param string $password
     */
    function addUser($username, $password)
    {
        $this->addData("t_user", ["usePseudo", "usePassword"], [$username, $password]);
    }

    /**
     * Adds a rating to a book associated with a user
     * @param int $idBook
     * @param int $idUser
     * @param int $rating
     * @param string $summary
     */
    function addRating($idbook, $idUser, $rating, $summary)
    {
        $this->addDataBis("t_evaluate", ["idBook", "idUserEvaluer", "evaNote", "evaRemark"], [$idbook, $idUser, $rating, $summary]);
    }


    /**
     * Adds an author to the database
     * @param string $name
     * @param string $surname
     * @return int
     */
    function addAuthor($name, $surname): int
    {
        return $this->addData("t_author", ["autName", "autSurname"], [$name, $surname]);
    }

    /**
     * Adds an editor to the database
     * @param string $name
     * @return int
     */
    function addEditor($name): int
    {
        return $this->addData("t_editor", ["ediName"], [$name]);
    }

    /**
     * Adds a category to the database
     * @param string $name
     * @return int
     */
    function addCategory($name): int
    {
        return $this->addData("t_category", ["catName"], [$name]);
    }

    /**
     * Adds a book to the database with its foreign keys
     * @param string $title
     * @param int $numberPages
     * @param string $excerptLink
     * @param string $summary
     * @param int $year
     * @param string $coverLink
     * @param int $idAuthor
     * @param int $idUser
     * @param int $idEditor
     * @param int $idCategory
     */
    function addBook($title, $numberPages, $excerptLink, $summary, $year, $coverLink, $idAuthor, $idUser, $idEditor, $idCategory)
    {
        $this->addData("t_book",
            ["booTitle", "booNbrPages", "booExcerptLink", "booSummary", "booYearEdited", "booAverageNotes", "booCoverLink", "idAuthor", "idUser", "idEditor", "idCategory"],
            [$title, $numberPages, $excerptLink, $summary, $year, -1.0, $coverLink, $idAuthor, $idUser, $idEditor, $idCategory]);
    }

#endregion

}