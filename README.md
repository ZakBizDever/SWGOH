**Guide de déploiement d'applications**
**_Ce guide explique comment déployer l'application de liste de joueurs SWGOH_GG à l'aide de Docker et Docker Compose._**

**Étapes de déploiement**

1. **_Obtenez le code source_**

   Assurez-vous d'avoir le code source du projet SWGOH_GG, Symfony (API) et ReactJS (front), prêt à être déployé sur votre machine.

2. **_Configurer les variables d'environnement_**

   Editez les fichiers .env des projets "API" et "FRONT" pour configurer les variables d'environnement spécifiques à votre environnement, notamment les paramètres de la base de données.

3. **_Créer des images Docker_**

   Accédez au répertoire racine de chaque projet (API et FRONT) et exécutez la commande suivante pour créer des images Docker :

   docker-compose build

4. **_Démarrez les conteneurs Docker_**

   Pour lancer l'application, exécutez la commande suivante dans le répertoire racine de votre projet :

   docker-compose up -d

5. **_Accédez à l'application_**

   Après avoir démarré les conteneurs, vous pouvez accéder à l'application à l'aide des URL suivantes :

   (Symfony) API: http://localhost:8000

   (ReactJS) FRONT http://localhost:3000

6. **_Entretien_**

   Pour arrêter l'application, utilisez la commande suivante :

   docker-compose down

**_N.B: _**
Developed and tested under MacOS Sonoma 14.0 Apple M2 Chip.
