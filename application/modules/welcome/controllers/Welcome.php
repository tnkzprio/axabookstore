<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {

        $q = $this->db->query("select AUTO_INCREMENT from information_schema.tables where table_schema = 'axabook' and table_name = 'inventory'");
        $keluarin = $q->result();
        foreach ($keluarin as $data) {
            $no_inc = $data->AUTO_INCREMENT;
        }
        $book = $_GET["book"];
        $author = $_GET["author"];
        $genre = $_GET["genre"];
        $price = $_GET["price"];
        $qty = $_GET["qty"];
        $r = array();
        $data = $this->db->query("insert into inventory(booktitle,authorname,genre,price,qty) values('$book','$author','$genre','$price','$qty')");
        if (!$data) {
            $r['result'] = "failures";
        } else {
            $query = $this->db->query("select * from inventory where idbook = '$no_inc'");
            $r['result'] = $query->result();
        }
        echo json_encode($r, JSON_PRETTY_PRINT);
        
    }
    
    public function update() {

        $idbook = $_GET["idbook"];
        $book = $_GET["book"];
        $author = $_GET["author"];
        $genre = $_GET["genre"];
        $price = $_GET["price"];
        $qty = $_GET["qty"];
        $r = array();
        $data = $this->db->query("update inventory set price='$price', qty='$qty',booktitle='$book',authorname='$author',genre='$genre' where idbook = '$idbook'");
        if (!$data) {
            $r['result'] = "tidak tersimpan";
        } else {
            $query = $this->db->query("select * from inventory where idbook = '$idbook'");
            $r['updated'] = $query->result();
        }
        echo json_encode($r, JSON_PRETTY_PRINT);
    }
    public function delete() {

        $idbook = $_GET["idbook"];
        
        $r = array();
        $data = $this->db->query("delete from inventory where idbook = '$idbook'");
        if (!$data) {
            $r['result'] = "tidak tersimpan";
        } else {
            $query = $this->db->query("select * from inventory where idbook = '$idbook'");
            $r['deleted'] = "deleted";
        }
        echo json_encode($r, JSON_PRETTY_PRINT);
    }
    
    public function searchbook() {

        $book = $_GET["book"];
        $r = array();
       
            $query = $this->db->query("select * from inventory where booktitle = '$book'");
            $r['result'] = $query->result();
        
        echo json_encode($r, JSON_PRETTY_PRINT);
        
    }
    public function searchauthor() {

        $author = $_GET["author"];
        $r = array();
       
            $query = $this->db->query("select * from inventory where authorname = '$author'");
            $r['result'] = $query->result();
        
        echo json_encode($r, JSON_PRETTY_PRINT);
        
    }
    
    public function searchgenre() {

        $genre = $_GET["genre"];
        $r = array();
       
            $query = $this->db->query("select * from inventory where genre = '$genre'");
            $r['result'] = $query->result();
        
        echo json_encode($r, JSON_PRETTY_PRINT);
        
    }
    
    public function searchprice() {

        $pricemin = $_GET["pricemin"];
        $pricemax = $_GET["pricemax"];
        $r = array();
       
            $query = $this->db->query("select * from inventory where price between '$pricemin' and '$pricemax'");
            $r['result'] = $query->result();
        
        echo json_encode($r, JSON_PRETTY_PRINT);
        
    }

}
