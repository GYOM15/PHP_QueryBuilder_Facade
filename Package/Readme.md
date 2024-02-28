**Facade QueryBuilder**

---

**Description :**

La Facade QueryBuilder est un package PHP qui fournit une interface simplifiée et fluide pour construire des requêtes SQL de manière dynamique. Elle abstrait les complexités de la construction manuelle de requêtes SQL, offrant une manière plus intuitive et efficace d'interagir avec les bases de données.

---

**Fonctionnalités :**

- **Interface fluide :** La Facade QueryBuilder utilise un modèle de conception d'interface fluide, permettant un enchaînement transparent et intuitif des méthodes pour construire des requêtes SQL.

- **Requêtes SELECT :** Sélectionnez facilement des colonnes spécifiques dans une ou plusieurs tables avec la méthode `select()`.

- **Clauses WHERE :** Ajoutez des conditions à la clause `WHERE` de vos requêtes SQL en utilisant la méthode `where()`. Prend en charge plusieurs conditions pour une flexibilité accrue.

- **Requêtes INSERT :** Insérez des données dans des tables sans effort avec la méthode `insert()`. Fournissez simplement le nom de la table et un tableau associatif des paires colonne-valeur.

- **Requêtes UPDATE :** Mettez à jour des enregistrements existants dans les tables en utilisant la méthode `update()`. Spécifiez le nom de la table et fournissez un tableau associatif des paires colonne-valeur pour la mise à jour.

- **Requêtes DELETE :** Supprimez des enregistrements de tables avec la méthode `delete()`. Spécifiez simplement le nom de la table, et éventuellement ajoutez des conditions en utilisant la méthode `where()`.

- **Requêtes CREATE TABLE :** Créez de nouvelles tables dans votre base de données facilement avec la méthode `createTable()`. Fournissez le nom de la table et un tableau définissant les colonnes et leurs types de données.

---

**Utilisation :**

1. **Installation :**
   - Clonez ou téléchargez le package Facade QueryBuilder depuis le dépôt.
   - Incluez les fichiers nécessaires dans votre projet PHP.

2. **Construction de requêtes de base :**
   - Commencez par importer la classe `Query` dans votre script PHP.
   - Utilisez les méthodes fournies par la classe `Query` pour construire vos requêtes de manière fluide.

   Exemple :
   ```php
   use Core\Database\Query;

   $query = Query::select('colonne1', 'colonne2')->from('table')->where('condition')->__toString();
   ```

3. **Exécution des requêtes :**
   - Une fois que vous avez construit votre requête à l'aide de l'interface fluide, vous pouvez l'exécuter en utilisant votre méthode d'interaction avec la base de données préférée (par exemple, PDO, MySQLi).

4. **Utilisation avancée :**
   - Explorez des fonctionnalités supplémentaires telles que l'insertion, la mise à jour, la suppression d'enregistrements et la création de tables à l'aide des méthodes respectives fournies par la Facade QueryBuilder.

---

**Contributions :**

Les contributions à la Facade QueryBuilder sont les bienvenues ! N'hésitez pas à soumettre des rapports de bogues, des demandes de fonctionnalités ou des demandes de tirage via le dépôt GitHub.

---

**Licence :**

## Licence

Ce projet est fourni sans licence et est destiné à être utilisé tel quel, sans aucune garantie d'aucune sorte. Vous êtes libre de l'utiliser, de le modifier et de le distribuer, mais à vos propres risques. Veuillez noter qu'aucune assistance ne sera fournie pour ce projet.

---

**Crédits :**

La Facade QueryBuilder a été développée par psr0. Un grand merci à la communauté open-source pour ses contributions et ses retours.

---

**Contact :**

Pour toute question ou demande de support, veuillez contacter kahlan.10.3.lara@gmail.com. Vous pouvez également nous trouver sur GitHub.

---

**Remerciements :**

Nous tenons à exprimer notre gratitude aux créateurs de PHP et aux nombreux développeurs qui contribuent à l'écosystème PHP. De plus, nous remercions les auteurs des bibliothèques et des frameworks qui ont inspiré ce projet.

---

**Historique des versions :**

- **v1.0.0 (Version initiale) :** Fonctionnalités de base pour la construction de requêtes SELECT, INSERT, UPDATE, DELETE et CREATE TABLE.

