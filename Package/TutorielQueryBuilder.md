Tout au long de l'implémentation nous remarquons que chaque méthode, retourne l'instance actuelle de QueryBuilder.

Cela permet de chaîner d'autres méthodes par la suite.

Quelques exemples concrets d'utilisation de chaque méthode de la classe:


```php


// Méthode where()
$query = new QueryBuilder();
$query->select('id', 'name')->from('users')->where('age > 18')->where('gender = "male"');


// Méthode from()
$query = new QueryBuilder();
$query->select('id', 'name')->from('users')->where('age > 18');


// Méthode select()
$queryBuilder = new QueryBuilder();
$query = $queryBuilder->select('id', 'name')
    ->from('users')
    ->where('id > :id', ['id' => 10]);
echo $query;


// Méthode insert()
- Explications: 
    array_keys() récupère les clés du tableau associatif
    array_values() récupère les valeurs de chaque clé
    array_map (function ($value){ return "'. $value .'"}, array_values($this->insertData)) : Cette fonction détient une fonction de callback qui séra définie et qui récupère en paramètre, le deuxième argument qui est dans notre cas, arrays_values($this->insertData). Dans notre cas, cette fonction renverra chaque valeur, entourer de simple guillements ''.
    
- Exemple concret    
$queryBuilder = new QueryBuilder();
$queryBuilder->insert('users', ['username' => 'john_doe', 'email' => 'john@example.com']);
echo $queryBuilder;// INSERT INTO users (username,email) VALUES ('john_doe','john@example.com')


// Méthode Update
$queryBuilder = new QueryBuilder();
$query = $queryBuilder->update('users', ['name' => 'Jane', 'email' => 'jane@example.com'])
->where('id = :id', ['id' => 5]);
echo $query;


// Méthode Delete
$queryBuilder = new QueryBuilder();
$query = $queryBuilder->delete('users')
->where('id = :id', ['id' => 5]);
echo $query;


// Méthode createTable
$query = new QueryBuilder();
$query->createTable('users', [
'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
'username' => 'VARCHAR(255)',
'email' => 'VARCHAR(255)'
]);


// Méthode __toString()
$query = new QueryBuilder();
$query->select('id', 'name')->from('users')->where('age > 18');
echo $query; // Affiche: SELECT id,name FROM users WHERE age > 18
```

