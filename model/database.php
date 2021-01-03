<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : Database class interacting with data on MySQL server
 */

include_once '../controller/config.ini.php';

/**
 * Class Database
 */
class Database
{
    private $connector;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        try {
            $host = $GLOBALS['database']['host'];
            $port = $GLOBALS['database']['port'];
            $dbname = $GLOBALS['database']['dbname'];
            $charset = $GLOBALS['database']['charset'];
            $username = $GLOBALS['database']['username'];
            $password = $GLOBALS['database']['password'];
            $this->connector = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=' . $charset . '', $username, $password);
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
        return $stringsAsString . $char . ')';
    }

#region Get functions

    /**
     * Read a table and return an array with the table's informations
     * @param string $tableName
     * @return array
     */
    function getTable(string $tableName): array
    {
        $req = $this->querySimpleExecute('select * from ' . $tableName);
        $results = $this->formatData($req);
        $this->unsetData($req);
        return $results;
    }

    /**
     * Read a table and return an array with the first n table's informations
     * @param string $tableName
     * @param int $limit
     * @return array
     */
    function getTableFirstLines(string $tableName, int $limit): array
    {
        $req = $this->querySimpleExecute('select * from ' . $tableName . ' order by idBook desc limit ' . $limit);
        $results = $this->formatData($req);
        $this->unsetData($req);
        return $results;
    }

    /**
     * returns the username based on its id
     * @param $userId
     * @return string
     */
    function getUsernameByUserId($userId): string
    {
        $req = $this->querySimpleExecute("select usePseudo from t_user where idUser = $userId");
        $result = $this->formatData($req)[0]['usePseudo'];
        $this->unsetData($req);
        return $result;
    }

    /**
     * Get informations of a user given its id
     * @param int $userId
     * @return array
     */
    function getUserById(int $userId): array
    {
        $req = $this->querySimpleExecute('select * from t_user WHERE idUser=' . $userId);
        $results = $this->formatData($req);
        $this->unsetData($req);
        return $results[0];
    }

    /**
     * Get informations of an author given its id
     * @param int $authorId
     * @return array
     */
    function getAuthorById(int $authorId): array
    {
        $req = $this->querySimpleExecute('select * from t_author WHERE idAuthor=' . $authorId);
        $results = $this->formatData($req);
        $this->unsetData($req);
        return $results[0];
    }

    /**
     * Get informations of an editor given its id
     * @param int $editorId
     * @return array
     */
    function getEditorById(int $editorId): array
    {
        $req = $this->querySimpleExecute('select * from t_editor WHERE idEditor=' . $editorId);
        $results = $this->formatData($req);
        $this->unsetData($req);
        return $results[0];
    }

    /**
     * Get informations of a category given its id
     * @param int $categoryId
     * @return array
     */
    function getCategoryById(int $categoryId): array
    {
        $req = $this->querySimpleExecute('select * from t_category WHERE idCategory=' . $categoryId);
        $results = $this->formatData($req);
        $this->unsetData($req);
        return $results[0];
    }

    /**
     * Get Books based on the id of the user
     * @param $userId
     * @return array
     */
    function getBooksByUserId(int $userId): array
    {
        $req = $this->querySimpleExecute("select * from t_book where idUser = $userId");
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    /**
     * Get Books based on the id of the category
     * @param $catId
     * @return array
     */
    function getBooksByCategoryId(int $catId): array
    {
        $req = $this->querySimpleExecute("select * from t_book where idCategory = $catId");
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    /**
     * Get informations of a book given its id
     * @param int $bookId
     * @return array
     */
    function getBookById(int $bookId): array
    {
        $req = $this->querySimpleExecute('select * from t_book WHERE idBook=' . $bookId);
        $results = $this->formatData($req);
        $this->unsetData($req);
        return $results[0];
    }

    /**
     * Get evaluations of a book given its id
     * @param int $bookId
     * @return array
     */
    function getAllEvaluationsFromBook(int $bookId): array
    {
        $req = $this->querySimpleExecute('select * from t_evaluate LEFT OUTER JOIN t_book ON t_evaluate.idBook = t_book.idBook WHERE t_book.idBook=' . $bookId);
        $results = $this->formatData($req);
        $this->unsetData($req);
        return $results;
    }

    /**
     * Get 3 evaluations of a book given its id
     * @param int $bookId
     * @return array
     */
    function getSomeEvaluationsFromBook(int $bookId): array
    {
        $req = $this->querySimpleExecute('select * from t_evaluate LEFT OUTER JOIN t_book ON t_evaluate.idBook = t_book.idBook WHERE t_book.idBook=' . $bookId . ' LIMIT 3');
        $results = $this->formatData($req);
        $this->unsetData($req);
        return $results;
    }

#endregion

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
        $req = $this->querySimpleExecute('select * from ' . $table);
        $results = $this->formatData($req);
        $this->unsetData($req);

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
        $req = $this->querySimpleExecute('select * from t_author');
        $results = $this->formatData($req);
        $this->unsetData($req);

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
        $this->querySimpleExecute('insert into ' . $table . ' ' . $this->mergeStrings($columns, '') . ' values ' . $this->mergeStrings($values, '\''));
        $req = $this->querySimpleExecute("select max($id) from " . $table);
        $results = $this->formatData($req);
        $this->unsetData($req);
        return (int)($results[0]["max($id)"]);
    }

    /**
     * Adds some data to the database (without returning ID)
     * @param string $table
     * @param string[] $columns
     * @param string[] $values
     */
    function addDataBis($table, $columns, $values)
    {
        $query = 'insert into ' . $table . ' ' . $this->mergeStrings($columns, '') . ' values ' . $this->mergeStrings($values, '\'');
        $req = $this->querySimpleExecute('insert into ' . $table . ' ' . $this->mergeStrings($columns, '') . ' values ' . $this->mergeStrings($values, '\''));
        $this->unsetData($req);
    }

    /**
     * modify an evaluation in the database
     * @param $idUser
     * @param $idBook
     * @param $rating
     * @param $remark
     */
    public function updateRating($idBook, $idUser, $rating, $remark)
    {
        $query = 'UPDATE t_evaluate SET evaNote="' . $rating . '", evaRemark="' . $remark . '" WHERE idBook =' . $idBook . ' AND idUserEvaluer=' . $idUser;
        $req = $this->querySimpleExecute($query);
        $this->unsetData($req);
    }

    /**
     * modify a book average note by its ID
     * @param $averageNote
     * @param $id
     */
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