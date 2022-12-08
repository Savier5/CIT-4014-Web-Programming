<?php

// Savier Osman
// 12/05/2022
// Modified program to adjuste for zero attribute constructor calls
// Modified class to use stadard methods rather than static methods.

class ProductDB {
        // Changed from static to regular method definition.
        public function getProductsByCategory($category_id) {
        $db = Database::getDB();

        // Added code to create CategoryDB object and get category.
        $categoryDB = new CategoryDB();
        $category = $categoryDB->getCategory($category_id);

        $query = 'SELECT * FROM products
                  WHERE products.categoryID = :category_id
                  ORDER BY productID';
        $statement = $db->prepare($query);
        $statement->bindValue(":category_id", $category_id);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
    
        // Modified code to call constructor will zero arguments and set attributes individually
        foreach ($rows as $row) {
            $product = new Product();
            $product->setCategory($category);
            $product->setId($row['productID']);
            $product->setCode($row['productCode']);
            $product->setName($row['productName']);
            $product->setPrice($row['listPrice']);
            $products[] = $product;
        }
        return $products;
    }

    // Changed from static to regular method definition.
    public function getProduct($product_id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM products
                  WHERE productID = :product_id';
        $statement = $db->prepare($query);
        $statement->bindValue(":product_id", $product_id);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
    
        // Added code to create CategoryDB object and get category.
        $categoryDB = new CategoryDB();
        $category = $categoryDB->getCategory($row['categoryID']);

        // Modified code to call constructor will zero arguments and set attributes individually
        $product = new Product();
        $product->setCategory($category);
        $product->setId($row['productID']);
        $product->setCode($row['productCode']);
        $product->setName($row['productName']);
        $product->setPrice($row['listPrice']);
        return $product;
    }

    // Changed from static to regular method definition.
    public function deleteProduct($product_id) {
        $db = Database::getDB();
        $query = 'DELETE FROM products
                  WHERE productID = :product_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
    }

    // Changed from static to regular method definition.
    public function addProduct($product) {
        $db = Database::getDB();

        $category_id = $product->getCategory()->getID();
        $code = $product->getCode();
        $name = $product->getName();
        $price = $product->getPrice();

        $query = 'INSERT INTO products
                     (categoryID, productCode, productName, listPrice)
                  VALUES
                     (:category_id, :code, :name, :price)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':price', $price);
        $statement->execute();
        $statement->closeCursor();
    }
}
?>