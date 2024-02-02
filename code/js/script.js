
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


 function changerEtatBoutton(id_bouton) {
    console.log("hello")

    var boutton = document.getElementById(id_bouton)
   
    var id_boutton_cacher = "btn_cacher"+id_bouton;
   
    var btn_cacher = document.getElementById(id_boutton_cacher)
    console.log(boutton)
    
    if (btn_cacher.value == "off"){

        boutton.classList.add('boutton_affichage_selectionner')
        boutton.classList.remove('bg-blue-950')
        btn_cacher.value = "on"
        console.log(btn_cacher);

    }else{
        boutton.classList.remove('boutton_affichage_selectionner')
        boutton.classList.add('bg-blue-950')
        btn_cacher.value = "off"

    }
 }

 function changerEtatBoutton_ordre(id_bouton){
    console.log("hello")
    console.log(id_bouton)
     var bouton_cliker = document.getElementById(id_bouton);
    console.log(bouton_cliker)
    if (bouton_cliker.value == "off" ){
        bouton_cliker_cacher = document.getElementById("btn_cacher_"+id_bouton)
        if (id_bouton.includes("ASC")){
            id_autre_bouton = "ordre_DESC"
            autre_Bouton = document.getElementById(id_autre_bouton);
            autre_Bouton_cacher = document.getElementById("btn_cacher_"+id_autre_bouton);
        }else{
            id_autre_bouton = "ordre_ASC"
            autre_Bouton = document.getElementById(id_autre_bouton);
            autre_Bouton_cacher = document.getElementById("btn_cacher_"+id_autre_bouton)
        }
        bouton_cliker.value = "on"
        bouton_cliker.classList.add('boutton_affichage_selectionner')
        bouton_cliker.classList.remove('bg-blue-950')
        bouton_cliker_cacher.value = "on"
        autre_Bouton.value = "off"
        autre_Bouton.classList.remove('boutton_affichage_selectionner')
        autre_Bouton.classList.add('bg-blue-950')
        autre_Bouton_cacher.value = "off"

    }

 }


 function changercouleurtexteselect(){


    nom_domaine = document.getElementById("saisie_nom_domaine")


    if (nom_domaine.value != "" ){
        nom_domaine.classList.add("couleur-noir-custom")
        nom_domaine.classList.remove("text-[#9caabc]")
    }else{
        nom_domaine.classList.remove("couleur-noir-custom")
        nom_domaine.classList.add("text-[#9caabc]")
    }

 }

 function ChangerCouleurIcone(champ){

    console.log("hello")
    
    champ_selectionner = document.getElementById(champ)
    icone = document.getElementById(champ+"_icone")

    if(champ == "champ_libelle"){
        
        limite = 100
    }else{
        limite = 1000
    }
    console.log(limite)
    console.log(champ_selectionner.value.length)
    console.log(champ_selectionner.value )
    if (champ_selectionner.value != "" && champ_selectionner.value.length < limite){
        icone.classList.add("couleur_verte")
        icone.classList.remove("couleur_rouge")
         
    }else{
         icone.classList.remove("couleur_verte")
         icone.classList.add("couleur_rouge")

    }

 }

 function changercouleur_categorie(nomb_cat){
    icone = document.getElementById("categorie_icone")
    console.log(icone)
    uneSelection = false;
    for (index =1 ; index <= nomb_cat ; index++){
        var uneCategorie = document.getElementById("categorie"+index)
        console.log(uneCategorie)
        if (uneCategorie.checked == true){
            uneSelection = true;
        }

    }
    if (uneSelection == true){

        icone.classList.add("couleur_orange")
    
    }else{

        icone.classList.remove("couleur_orange")

    }



 }


 var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}