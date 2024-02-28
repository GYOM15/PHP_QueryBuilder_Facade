**Documentation de la Facade QueryBuilder**

---

La Facade QueryBuilder est une bibliothèque PHP conçue pour simplifier la construction de requêtes SQL de manière dynamique. Cette documentation fournit une explication détaillée de chaque méthode disponible dans la Facade QueryBuilder, ainsi que des exemples concrets d'utilisation.

---

**Utilisation de base :**

1. **Installation :**
   - Clonez ou téléchargez le package Facade QueryBuilder depuis le dépôt.
   - Incluez les fichiers nécessaires dans votre projet PHP.

2. **Importation de la classe :**
   ```php
   use Core\Database\Query;
   ```

3. **Création d'une requête :**
   - Commencez par utiliser la méthode statique `select()` pour spécifier les colonnes à sélectionner dans la requête.
   - Enchaînez ensuite les méthodes `from()` et éventuellement `where()` pour définir la source de la table et les conditions de la requête.
   - Utilisez la méthode `__toString()` pour obtenir la représentation sous forme de chaîne de caractères de la requête.

   Exemple :
   ```php
   $query = Query::select('colonne1', 'colonne2')->from('table')->where('condition')->__toString();
   echo $query;
   ```

---

**Méthodes disponibles :**

1. **select(...$fields) :** Spécifie les colonnes à sélectionner dans la requête SELECT.

   Exemple :
   ```php
   $query = Query::select('nom', 'email')->from('utilisateurs')->__toString();
   ```

2. **where(...$conditions) :** Ajoute des conditions à la clause WHERE de la requête.

   Exemple :
   ```php
   $query = Query::select('nom')->from('utilisateurs')->where('age > 18', 'sexe = "Femme"')->__toString();
   ```

3. **from($table, $alias = null) :** Spécifie la table source dans la requête.

   Exemple :
   ```php
   $query = Query::select('nom')->from('utilisateurs', 'u')->where('age > 18')->__toString();
   ```

4. **insert($table, $data) :** Spécifie la table et les données à insérer dans une requête INSERT.

   Exemple :
   ```php
   $query = Query::insert('utilisateurs', ['nom' => 'John', 'email' => 'john@example.com']).__toString();
   ```

5. **update($table, $data) :** Spécifie la table et les données à mettre à jour dans une requête UPDATE.

   Exemple :
   ```php
   $query = Query::update('utilisateurs', ['age' => 30])->where('id = 1')->__toString();
   ```

6. **set($key, $value) :** Ajoute une paire clé-valeur à la liste des données à mettre à jour dans une requête UPDATE.

   Exemple :
   ```php
   $query = Query::update('utilisateurs')->set('age', 30)->where('id = 1')->__toString();
   ```

7. **delete($table) :** Spécifie la table à partir de laquelle supprimer des enregistrements dans une requête DELETE.

   Exemple :
   ```php
   $query = Query::delete('utilisateurs')->where('id = 1')->__toString();
   ```

8. **createTable($tableName, $columns) :** Crée une nouvelle table avec les colonnes spécifiées.

   Exemple :
   ```php
   $query = Query::createTable('utilisateurs', ['id' => 'INT PRIMARY KEY', 'nom' => 'VARCHAR(255)', 'email' => 'VARCHAR(255)'])->__toString();
   ```

NB:Lors de l'appel des méthodes, il n'est pas obligatoire de chainer __toString; elle est conçue pour gérer automatiquement chaque cas spécifique.
---
 