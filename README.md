# pweb_pj

Comment utiliser ?

1. Lancer un serveur mysql et s'y connecter
2. Exécuter le fichier SQL `db-export.sql`
3. Créer un ficher `.env.local` dans le même dossier que ce fichier
4. Y mettre le contenu suivant en remplaçant <user> et <password>:
   ```
   DATABASE_URL=mysql://<user>:<password>@127.0.0.1:3306/pwebpj_dev?serverVersion=5.7
   ```
5. Lancer symfony CLI v4.30.0 et s'assure d'avoir symfony v5.1.7 en environnement `dev`
6. S'assurer que toutes les dépendances sont installées avec composer
7. Faire `symfony server:start` et aller à `http://localhost:8000/`