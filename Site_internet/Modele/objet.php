<?php
  /**
  * Classe des objets. C'est la classe mère.
  * @author Estelle BOISSERIE
  */
  class objet {
    //-------------------------
    // ACCESSEURS
    //-------------------------
    public function get($attribut){
      if($attribut == NULL){
        return " ";
      }
      else {
        return $this->$attribut;
      }
    }
    public function set($attribut, $valeur){
      $this->$attribut = $valeur;
    }
  }
?>