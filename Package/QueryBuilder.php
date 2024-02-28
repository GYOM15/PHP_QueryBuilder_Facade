<?php

namespace Core\Database;

/**
 * La classe QueryBuilder est implémentée pour la notion de fluent.
 * Elle permet de construire dynamiquement des requêtes SQL.
 */
class QueryBuilder {
    
    private $fields = [];             // Les colonnes à sélectionner dans la requête SELECT
    private $conditions = [];         // Les conditions à ajouter à la clause WHERE de la requête
    private $from = [];               // La table source dans la requête FROM
    private $createTableQuery = null; // La requête de création de table
    private $insertTable;             // La table dans laquelle insérer des données dans une requête INSERT
    private $insertData = [];         // Les données à insérer dans une requête INSERT
    private $updateTable;             // La table à mettre à jour dans une requête UPDATE
    private $updateData = [];         // Les données à mettre à jour dans une requête UPDATE
    private $updateConditions = [];   // Les conditions à ajouter à la clause WHERE de la requête UPDATE
    private $deleteTable;             // La table à partir de laquelle supprimer des enregistrements dans une requête DELETE
    private $deleteConditions = [];   // Les conditions à ajouter à la clause WHERE de la requête DELETE



    /**
     * Spécifie les colonnes à sélectionner dans la requête.
     * func_get_args permet de récupérer tous les arguments passés à la fonction sous forme d'un tableau
     * @return $this
     */
    public function select() {
        $this->fields = func_get_args();
        return $this;
    }

    /**
     * Ajoute des conditions à la clause WHERE de la requête.
     * Dans cette methode, Nous implémentons le cas où nous pouvoir avoir plusieurs clauses where, donc nous recuperons chaque condition de façon distinct pour ensuite la traiter 
     * @return $this
     */
    public function where() {
        foreach (func_get_args() as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }

    /**
     * Spécifie la table source dans la requête.
     * @param string $table Le nom de la table.
     * @param string|null $alias L'alias éventuel de la table.
     * @return $this
     */
    public function from($table, $alias = null) {
        if (is_null($alias)) {
            $this->from[] = $table;
        } else {
            $this->from[] = "$table AS $alias";
        }       
        return $this;
    }

       /**
     * Spécifie la table et les données à insérer dans une requête INSERT.
     * @param string $table Le nom de la table dans laquelle insérer les données.
     * @param array $data Un tableau associatif des données à insérer, où les clés représentent les noms de colonnes et les valeurs les valeurs à insérer.
     * @return $this
     */
    public function insert($table, $data) {
        $this->insertTable = $table;
        $this->insertData = $data;
        return $this;
    }

    /**
     * Spécifie la table et les données à mettre à jour dans une requête UPDATE.
     * @param string $table Le nom de la table à mettre à jour.
     * @param array $data Un tableau associatif des données à mettre à jour, où les clés représentent les noms de colonnes et les valeurs les nouvelles valeurs.
     * @return $this
     */
    public function update($table, $data) {
        $this->updateTable = $table;
        $this->updateData = $data;
        return $this;
    }

    /**
     * Ajoute une paire clé-valeur à la liste des données à mettre à jour dans une requête UPDATE.
     * @param string $key Le nom de la colonne à mettre à jour.
     * @param mixed $value La nouvelle valeur de la colonne.
     * @return $this
     */
    public function set($key, $value) {
        $this->updateData[$key] = $value;
        return $this;
    }

    /**
     * Spécifie la table à partir de laquelle supprimer des enregistrements dans une requête DELETE.
     * @param string $table Le nom de la table dans laquelle supprimer les enregistrements.
     * @return $this
     */
    public function delete($table) {
        $this->deleteTable = $table;
        return $this;
    }

    /**
     * Crée une nouvelle table avec les colonnes spécifiées.
     * @param string $tableName Le nom de la table à créer.
     * @param array $columns Les colonnes de la table avec leurs types de données.
     * @return $this
     */
    public function createTable($tableName, $columns){
        $columnDefinition = [];
        foreach($columns as $columnName => $columnType){
            $columnDefinition[] = "$columnName $columnType";
        }
        $this -> createTableQuery = "Create Table $tableName (" . implode(',' , $columnDefinition) . ")";
        return $this;
    }

    /**
     * Retourne la représentation sous forme de chaîne de la requête SQL.
     * La méthode __toString est automatiquement appelée lorsque nous essayons de convertir une instance d'objet en chaîne de caractères.
     * Cela se produit implicitement dans plusieurs contextes, par exemple, lorsque nous essayons d'afficher l'objet avec echo ou lorsque nous incluons l'objet dans une chaîne.
     * @return string
     */
    public function __toString() {
        if (!empty($this->fields) && !empty($this->from) && !empty($this->conditions)) {
            return 'SELECT ' . implode(',', $this->fields) . ' FROM ' . implode(',', $this->from) . ' WHERE ' . implode(' AND ', $this->conditions);
        } elseif (!empty($this->insertData) && !empty($this->insertTable)) 
        {
            return 'INSERT INTO ' . $this->insertTable . ' (' . implode(',', array_keys($this->insertData)) . ') 
            VALUES (' . implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, array_values($this->insertData))) . ')';
        } 
        elseif (!empty($this->updateData) && !empty($this->updateTable)) 
        {
            $updateClause = implode(',', array_map(function ($key, $value) {
                return "$key = '$value'";
            }, array_keys($this->updateData), array_values($this->updateData)));
            $whereClause = !empty($this->updateConditions) ? ' WHERE ' . implode(' AND ', $this->updateConditions) : '';
            return 'UPDATE ' . $this->updateTable . ' SET ' . $updateClause . $whereClause;
        } 
        elseif (!empty($this->deleteTable)) 
        {
            $whereClause = !empty($this->deleteConditions) ? ' WHERE ' . implode(' AND ', $this->deleteConditions) : '';
            return 'DELETE FROM ' . $this->deleteTable . $whereClause;
        } 
        else {
            return '';
        }
    }
}
