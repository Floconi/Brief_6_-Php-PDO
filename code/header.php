<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    
    <link href="css/output.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/0a3766d4f1.js" crossorigin="anonymous"></script>
    <script src="js/script.js" defer></script>
    <title> ^^--favoriti--^^ </title>
</head>
<body class="bg-neutral-500">
    <header class="flex justify-around items-center p-3">
        <h1 class="flex justify-center  text-amber-500 font-PE_nunito text-5xl">Mes favoris</h1>
        <form method="GET" action="AjoutFavori.php">
            <button type="submit" class="bg-blue-950  text-white p-6 font-PE_nunito rounded flex justify-center flex-col " >
            <div>
                <div class=" text-center">
                    <i class="fa-solid fa-plus flex text-center"></i> 
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
                <p>Ajouter un favori<p>
            </div>
            </button> 
        </form>
        <form method="GET" action="lecture_dom_cat.php">
            <button type="submit" class="bg-blue-950  text-white p-6 font-PE_nunito rounded flex justify-center flex-col " >
            <div>
                <div class=" text-center">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <p>Gérer les domaines/catégorie<p>
            </div>
            </button> 
        </form>
    </header>