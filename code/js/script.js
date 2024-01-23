
function AppliquerFiltre(){

    console.log("hey")

    var ab = document.getElementById("categorie_filtre")

    var Tab_categorie = new Array();  

    var nomb_cat = document.getElementById("categorie_filtre").appendChild.length

    var index_cat = 1; 
    var index_Tab_categorie = 0
    console.log(document.getElementById("categorie_n°"+index_cat))
    while (document.getElementById("categorie_n°"+index_cat) != null){
        if(document.getElementById("categorie_n°"+index_cat).checked == true){
            
           Tab_categorie[index_Tab_categorie] = document.getElementById("Label_categorie_n°"+index_cat).innerHTML
            index_Tab_categorie = index_Tab_categorie +1
        }
        index_cat = index_cat + 1

    }
    console.log(Tab_categorie)
    console.log(Tab_categorie.length)

    var nom_domaine = "aucun"
    var index_dom = 1; 
    
    while (document.getElementById("domaine_n°"+index_dom) != null){
        console.log(document.getElementById("domaine_n°"+index_dom))
        if(document.getElementById("domaine_n°"+index_dom).checked == true){
            
            nom_domaine = document.getElementById("Label_domaine_n°"+index_dom).innerHTML
            console.log(nom_domaine)
            
        }
        index_dom = index_dom + 1

    }
    










    var Requete_SQL = "SELECT * FROM favori "
    console.log(Requete_SQL)
    var filtre_sur_categorie = false

    var Conditioncategorie = "OR"
    var ConditionEntreDomaineEtCategorie = "OR"






    if (document.getElementById("ou_categorie").checked == false){
        Conditioncategorie = "AND"
    }
    if (document.getElementById("ou_categorie_dom").checked == false){
        ConditionEntreDomaineEtCategorie = "AND"
    }

    if(nom_domaine != "aucun"){
            Requete_SQL += "INNER JOIN domaine ON domaine.id_domaine = favori.id_dom  "
    }
    
    if (Tab_categorie.length == 0){
        

       
    }else{
        filtre_sur_categorie = true
        Requete_SQL += "INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie WHERE "
        if (Tab_categorie.length >= 2 ){
        Requete_SQL +="( "
        }


        
       
        
       
        for (index_Tab_categorie = 0 ; index_Tab_categorie < Tab_categorie.length ; index_Tab_categorie++){
            Requete_SQL += "categorie.nom_categorie='"+Tab_categorie[index_Tab_categorie]+"'"
            if(index_Tab_categorie + 1 == Tab_categorie.length){
                if(Tab_categorie.length >= 2 ){
                    Requete_SQL += ") "
                }
                
            }else{
                Requete_SQL +=" "+Conditioncategorie+" "
            }

        }
      
    } 


    if(nom_domaine != "aucun" && filtre_sur_categorie == false){
            Requete_SQL += "WHERE domaine.nom_domaine='"+nom_domaine+"'"
            
        }else{
            if(nom_domaine != 'aucun'){
               Requete_SQL += " "+ConditionEntreDomaineEtCategorie+" domaine.nom_domaine='"+nom_domaine+"'" 
            }
           
        }

    Requete_SQL += ";"
    console.log(Requete_SQL) 
    


    
    


}