<?php
session_start();
$array_error=[];
function est_vide(string $val):bool {
    return empty($val);
}

function is_mail(string $mail):bool{
    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return true;
      } else {
          return false;
      }
  
}

function valide_champ(string $val, array &$array_error,string $key, string $message="champ obligatoire"):void{
    if(empty($val)){
       $array_error[$key] = $message;
   }else{
       if(!is_mail($val)){
           $array_error[$key] = "Vous devez saisir une adresse mail";
       }
   }
}

function password_confirm():bool{
    if ($_POST["password"]==$_POST["passwordo"]){
        return true;
    }else{
        return false;
    }
}

function form_valide(array $array_error):bool {
    return count($array_error)===0;
}

function registering():void{

    
    
    if(key_exists("btn_submit",$_POST)){

        if (!key_exists($_POST["login"],$_SESSION)){

            if (password_confirm()){

                $_SESSION[$_POST["login"]]=["nom"=>$_POST["nom"],
                "prenom"=>$_POST["prenom"],
                "password"=>$_POST["password"],
                "role"=>$_POST["role"]];
                echo "compte créé";   

                
            }else{
                echo "Veuillez confirmer le mot de passe";
            } 
        }else{
            echo "Ce login existe deja";
        }
    }
}

function login():void{
    if (key_exists("bt_submit",$_POST)){
        if (key_exists($_POST["log"],$_SESSION)){
            if ($_POST["pass"]==$_SESSION[$_POST["log"]]["password"]){
                if ($_SESSION[$_POST["log"]]["role"]=="Admin"){
                    header('Location:accueil.admin.html.php');
                }else{
                    header('Location:accueil.visiteur.html.php');
                }
                echo "pute";
            }
        }
    }
}



?>