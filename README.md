#Installation du projet : 

 ##Installer PHP8.0, composer et le binaire de symfony
 
 ##Cloner le projet depuis gitLab

 ##Installer les dépendances du projet (dans la racine du projet):
        
    composer install

#Configuration de la base de données : 

  ##Créer un fichier .env.local

  ##Copier le contenu du fichier .env dans le fichier .env.local

  ##Modifier la ligne DATABASE_URL pour y ajouter les informations de votre base de données

#Création de la base de données, exécution des migrations et chargement des fixtures
  
    composer run db    

#Lancement du serveur de développement : 
    
    symfony server:start