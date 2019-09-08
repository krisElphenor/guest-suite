# guest-suite
Projet de test pour Guest suite

#### Enoncé

- créer une API Symfony qui permet d'enregistrer et de récupérer des avis et des notes plateformes
  - un avis est composé de : une note, un auteur, un commentaire, une plateforme
  - Une plateforme est un site comme Google, Pages Jaunes, etc...
  - Une note plateforme est la note globale d'un établissement sur une plateforme donnée
- créer une interface en React qui permet de :
  - voir l'évolution de la moyenne de la note d'une plateforme par jour
  - voir le volume d'avis reçu par jour pour une plateforme donnée
  - comparer les établissements au niveau de la note d'une plateforme et du nombre d'avis
  
#### Getting Started

Le serveur de developpement de symfony est intégré au projet. Et, par souci de simplicité,
l'application react est dans le meme dossier. J'ai utilisé yarn au lieu de npm.
Donc, les étapes de test sont:

```
composer install
php bin/console server:start 127.0.0.1:8000
cd guest-suite
yarn install
yarn start
```

#### Possibles améliorations

- Il faudrait ajouter des test fonctionnels pour tester les custom actions des controller
- On pourrait également utiliser Faker pour créer des données de test et tester les repositories
- Le calcul des notes globales et moyennes est faites à chaque requetes, mais dans le cas où le volume des données
serait plus conséquent, il serait possible d'utiliser une entité historique qui conserverait les statistique journalières