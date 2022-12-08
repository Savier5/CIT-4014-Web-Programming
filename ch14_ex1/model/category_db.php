<?php

// Savier Osman
// 12/05/2022
// Modified program to adjuste for zero attribute constructor calls
// Modified class to use stadard methods rather than static methods.


class CategoryDB {
    // Changed from static to regular method definition.
    public function getCategories() {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories
                  ORDER BY categoryID';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $categories = array();
        foreach ($statement as $row) {
            $category = new Category();
            $category->setID($row['categoryID']);
            $category->setName($row['categoryName']);
            $categories[] = $category;
        }
        return $categories;
    }

    // Changed from static to regular method definition.
    public function getCategory($category_id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';    
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();    
        $row = $statement->fetch();
        $statement->closeCursor();    
        $category = new Category();
        $category->setID($row['categoryID']);
        $category->setName($row['categoryName']);
        return $category;
    }
}
?>