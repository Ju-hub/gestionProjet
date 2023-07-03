Bonjour, voici mon travail concernant le test "GestionProjet".
Quelques instructions afin de bien voir le projet.
    
    1.➡️ Récupérer l'ensemble des fichiers

            ⌨ Git clone https://github.com/Ju-hub/gestionProjet.git
             

    2.➡️ Dans le dossier créé installer les dépendances :

            ⌨ composer install


    3.➡️ Installer la base de données MySQL. Pour paramétrer la création de votre base de données, rdv dans le fichier .env du projet, et modifier la variable d'environnement selon vos paramètres :

            DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
    
    4.➡️ Créer la base de données :

            ⌨ symfony console doctrine:database:create
    
    5.➡️  Exécuter la migration en base de données :

            ⌨ php bin/console doctrine:migration:migrate

    6.➡️ Lancer le serveur en local

            ⌨ symfony server:start 

J'ai utilisé le bundle easyadmin afin d'obtenir plus rapidement un back stylisé et la gestion des cruds sur les entités.

- Vous pouvez accéder au back via le bouton Admin de la navBar
- Vous pourrez créer des projets et des taches via l'interface 
- Attribuer des taches a des projets ainsi qu'affecter des Users aux taches 
- Les projets sont visibles sur la home page "/"
- Vous pourrez afficher le détail des projets en cliquant dessus
- Vous pouvez créer une tache directement dans le projet




