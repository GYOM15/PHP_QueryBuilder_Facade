<?php

use Core\Database\QueryBuilder;



/**
 * La classe Query est une façade statique pour la classe QueryBuilder.
 * Elle permet d'utiliser la classe QueryBuilder de manière simplifiée et fournit une interface fluide.
 * 
 * __callStatic est une méthode magique de PHP qui est appelée lorsque des méthodes inaccessibles sont appelées de manière statique.
 * Dans ce cas, lorsque vous appelez une méthode statique sur la classe Query, comme Query::select(...), la méthode __callStatic est déclenchée.
 * Elle crée une nouvelle instance de la classe QueryBuilder appelée $query.
 * Ensuite, elle utilise call_user_func_array pour appeler dynamiquement la méthode demandée (par exemple, select) sur l'instance nouvellement créée de QueryBuilder avec les arguments fournis.
 * Enfin, elle retourne l'instance de QueryBuilder, permettant ainsi une construction fluide de la requête.
 * 
 * Explication de la méthode call_user_func_array :
 * - Premier argument : La fonction ou la méthode à appeler
    *   Il peut s'agir d'une fonction ordinaire (définie par l'utilisateur) ou d'une méthode d'une classe.
    *   Si c'est une méthode d'une classe, le premier élément du tableau doit être une instance de cette classe.
 * - Deuxième argument : Les arguments à passer à la fonction ou méthode
    *   Il s'agit d'un tableau contenant les arguments que vous souhaitez passer à la fonction ou à la méthode.
    *   Chaque élément du tableau correspond à un argument.
 * - Retour
    *   La fonction call_user_func_array renverra dynamiquement la valeur retournée par la fonction ou méthode appelée de façon statique.
 */

class Query {

    /**
     * Méthode magique __callStatic permettant d'appeler dynamiquement des méthodes de QueryBuilder.
     * @param string $method Le nom de la méthode appelée.
     * @param array $args Les arguments passés à la méthode.
     * @return QueryBuilder
     */
    public static function __callStatic($method, $args) {
        $query = new QueryBuilder();
        // Appel dynamique de la méthode sur l'instance de QueryBuilder nouvellement créée.
        return call_user_func_array([$query, $method], $args);
    }
}
