<?php

namespace Controller;

class Controller {
    private $db;

    public function __construct()
    {
        $this->db = new \model\EntityRepository;
    }

    public function handlerRequest() {
        $op = isset($_GET['op']) ? $_GET['op'] : null;
        try {
            if ($op == 'add' || $op == 'update') $this->save($op);
            elseif ($op == 'select') $this->select();
            elseif ($op == 'confirmDelete') $this->confirmDelete();
            elseif ($op == 'delete') $this->delete();
            else $this->selectAll();
        } catch (\Exception $e) {
            Throw new \Exception($e->getMessage());
        }
    }

    public function manageRepertoire() {
        $op = isset($_GET['op']) ? $_GET['op'] : null;
        $this->saveRep($op);
    }

    public function render($layout, $template, $parameters = []) {
        extract($parameters);
        ob_start();
        require "view/$template";
        $content = ob_get_clean();
        ob_start();
        require "view/$layout";
        return ob_end_flush();
    }

    public function selectAll() {
        /*echo "On affiche tout";*/
        $result = $this->db->selectAll();
        $r = $result[0];
        $r2 = $result[1];


        $count = $this->countByGender($r2);

        $this->render('layout.php', 'donnees.php', array(
            'title' => 'Toutes les données',
            'donnees' =>$r,
            'fields' => $this->db->getFields(),
            'id' => 'id_'.$this->db->table,
            'count' => $count
        ));
    }

    public function countByGender($result) {
        $count = ['m' => 0, 'f' => 0];
        foreach ($result as $sexe) {
            $count[$sexe['sexe']] = $sexe['c'];
        }
        return $count;
    }

    public function save($op) {
        $title = $op;
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($_POST) {
            $r = $this->db->save();
        }
        $this->render('layout.php', 'donnees-form.php', [
            'title' => "Données : $title",
            'op' => $op,
            'fields' => $this->db->getFields()
        ]);
    }

    public function saveRep($op) {
        $title = "Ajouter un contact";
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $entry = false;

        if ($_POST) {
            $r = $this->db->saveRep();
        }

        if ($id != null) {
            $title = "Modifier un contact";
            $entry = $this->db->selectById($id);
        }


        $this->render('layout.php', 'saveRep.php', [
            'title' => "Ajouter un contact",
            'op' => $op,
            'entry' => $entry
        //'fields' => $this->db->getFields()
        ]);

    }

    public function select() {
        echo "select";
    }

    public function confirmDelete() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $title = "Suppression";

        $this->render('layout.php', 'suppression.php', [
            'title' => $title,
            'id' => $id
        ]);
    }

    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $result = $this->db->delete($id);

        $this->selectAll();
    }
}