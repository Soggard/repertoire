<?php

namespace model;

class  EntityRepository {

    private $db;
    public $table;

    public function getDb() {
        if (!$this->db) {
            try {
                $xml = simplexml_load_file('app/config.xml');
                $this->table = $xml->table;
                try {
                    // Connexion à la BDD
                    $this->db = new \PDO("mysql:dbname=".$xml->db.";host=".$xml->host,$xml->user,$xml->password, array(
                        \PDO::ERRMODE_EXCEPTION,
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                    ));
                } catch (\PDOException $exception) {
                    echo "Impossible de se connecter à la base de données";
                }
            } catch (\Exception $exception) {
                echo "Impossible d'accéder aux données de connexion";
            }
        }

        return $this->db;
    }

    public function getFields() {
        $q = $this->getDb()->query("DESC ". $this->table);
        $r = $q->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }

    public function selectAll() {
        $q = $this->getDb()->query("SELECT * FROM " . $this->table);
        $r = $q->fetchAll(\PDO::FETCH_ASSOC);
        $q2 = $this->getDb()->query("SELECT COUNT(id_annuaire) as c, sexe FROM annuaire GROUP BY sexe");
        echo "SELECT COUNT(id_annuaire), sexe FROM annuaire GROUP BY sexe" . $this->table;
        $r2 = $q2->fetchAll(\PDO::FETCH_ASSOC);
        return [$r, $r2];
    }

    public function selectById($id) {
        $q = $this->getDb()->query("SELECT * FROM " . $this->table ." WHERE id_annuaire = ".$id);
        $r = $q->fetch(\PDO::FETCH_ASSOC);
        return $r;
    }

    public function save() {
        $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';
        $q = $this->getDb()->query(
            'REPLACE INTO ' . $this->table . ' (id' . ucfirst($this->table) .
            ',' . implode(',', array_keys($_POST)).' ) VALUES (' .
            $id . ','. "'" . implode("','", $_POST)."'".')'
        );
        //$r = $q->fetchAll(\PDO::FETCH_ASSOC);

        return $this->getDb()->lastInsertId();
    }

    public function saveRep() {
        $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';
        $req = 'REPLACE INTO annuaire (id_annuaire,' . implode(',', array_keys($_POST)).' ) VALUES (' . $id . ','. "'" . implode("','", $_POST)."'".')';
        echo $req;
        $q = $this->getDb()->exec($req);


        return $this->getDb()->lastInsertId();
    }

    public function delete($id) {
        $q = $this->getDb()->exec("DELETE FROM " . $this->table ." WHERE id_annuaire = ".$id);
        return $q;
    }


}