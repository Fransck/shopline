<?php

class ProduitBD extends Produit
{
    private $_db;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_db = $cnx;
    }

    public function editProduit($champ, $id, $valeur)
    {
        try {
            $query = "UPDATE produits SET $champ = '$valeur' WHERE id_produit = '$id'";
            $res = $this->_db->prepare($query);
            $res->execute();
            return true;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
            return false;
        }
    }

    public function addProduit($libelle, $prix, $illustration, $qstock, $id_categorie)
{
    try {
        $query = "INSERT INTO produits (libelle, prix, illustration, qstock, id_categorie) VALUES (:libelle, :prix, :illustration, :qstock, :id_categorie)";
        $res = $this->_db->prepare($query);
        $res->bindValue(':libelle', $libelle);
        $res->bindValue(':prix', $prix);
        $res->bindValue(':illustration', $illustration);
        $res->bindValue(':qstock', $qstock);
        $res->bindValue(':id_categorie', $id_categorie);
        $res->execute();
        return true;
    } catch (PDOException $e) {
        print "Echec " . $e->getMessage();
        return false;
    }
}
    public function deleteProduit($id)
    {
        try {
            $query = "DELETE FROM produits WHERE id_produit = :id";
            $res = $this->_db->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();

            return true;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();

            return false;
        }
    }

    public function getProduitById($id)
    {
        try {
            $query = "SELECT * FROM produits WHERE id_produit = :id";
            $res = $this->_db->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
            $data = $res->fetch();
            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }

    public function getVueAllProduits()
    {
        try {
            $query = "SELECT * FROM vue_produits ORDER BY id_produit";
            $res = $this->_db->prepare($query);
            $res->execute();

            while ($data = $res->fetch()) {
                $_array[] = new Produit($data);
            }
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }

    public function getAllCategories()
    {
        try {
            $query = "SELECT * FROM categorie ORDER BY nom_cat";
            $res = $this->_db->prepare($query);
            $res->execute();

            while ($data = $res->fetch()) {
                $_array[] = new Categorie($data);
            }
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }
}
