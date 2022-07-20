<?php 
// Fonction qui verifie si un utilisateur est connecté
function internauteEstConnecte(){
    if(!isset($_SESSION['membre']))
    {
        return false;
    }
    else
    {
        return true;
    }
}

// Fonction qui verifie si un utilisateur est admin

function internauteEstConnecteEtEstAdmin(){
   if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1 ){
         return true;
    }
    else{
         return false;
   }
    
}
