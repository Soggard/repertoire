<?php

namespace Controller;

class Controller {
    private $db;

    public function __construct()
    {
        $this->db = new \model\EntityRepository;
    }


    // Gère les requêtes provenant de affichage_annuaire.php
    public function handlerRequest() {
        $op = isset($_GET['op']) ? $_GET['op'] : null;
        try {
            if ($op == 'confirmDelete') $this->confirmDelete();
            elseif ($op == 'delete') $this->delete();
            else $this->selectAll();
        } catch (\Exception $e) {
            Throw new \Exception($e->getMessage());
        }
    }

    // Gère les requêtes provenant de repertoire.php
    public function manageRepertoire() {
        $op = isset($_GET['op']) ? $_GET['op'] : null;
        $this->save($op);
    }

    // Gestion de la vue
    public function render($layout, $template, $parameters = []) {
        extract($parameters);
        ob_start();
        require "view/$template";
        $content = ob_get_clean();
        ob_start();
        require "view/$layout";
        return ob_end_flush();
    }

    // Récupère et affiche l'ensemble des entrées du répertoire
    public function selectAll() {

        $result = $this->db->selectAll();
        $donnees = $result[0];

        // Récupère le nombre d'hommes et de femmes
        $count = $this->countByGender($result[1]);

        $this->render('layout.php', 'donnees.php', array(
            'title' => 'Toutes les données',
            'donnees' =>$donnees,
            'fields' => $this->db->getFields(),
            'id' => 'id_'.$this->db->table,
            'count' => $count
        ));
    }

    // Permet d'isoler dans un tableau le nombre d'hommes et de femmes
    public function countByGender($result) {
        $count = ['m' => 0, 'f' => 0];
        foreach ($result as $sexe) {
            $count[$sexe['sexe']] = $sexe['c'];
        }
        return $count;
    }

    // Gestion de l'ajout et de l'édition de contacts
    public function save($op) {
        $title = "Ajouter un contact";
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $entry = false;

        // Traitement si formulaire s'il a été soumis
        if ($_POST) {
            $r = $this->db->save();
        }

        // Récupération des données à éditer si nécessaire
        if ($id != null) {
            $title = "Modifier un contact";
            $entry = $this->db->selectById($id);
        }

        $this->render('layout.php', 'entry-form.php', [
            'title' => $title,
            'op' => $op,
            'entry' => $entry
        ]);

    }

    // Page de confirmation pour la suppression
    public function confirmDelete() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $title = "Suppression";

        $this->render('layout.php', 'suppression.php', [
            'title' => $title,
            'id' => $id
        ]);
    }

    // Suppression d'une entrée
    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $result = $this->db->delete($id);

        $this->selectAll();
    }
}