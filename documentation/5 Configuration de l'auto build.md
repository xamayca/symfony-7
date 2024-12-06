## 5. Configuration de l'AutoBuild CSS pour le serveur local (SymfonyCast Bundle / Symfony CLI)

Pour que vos assets soient automatiquement compilés à chaque lancement de votre serveur local, rendez-vous à la racine de votre projet et créez ou modifiez le fichier suivant :

```yaml
#.symfony.local.yaml

workers:
  tailwind:
    cmd: ['symfony', 'console', 'tailwind:build', '--watch']
```

Cette configuration permet de recompiler automatiquement les fichiers CSS de TailwindCSS à chaque modification, sans redémarrer le serveur ni exécuter la commande `php bin/console asset-map:compile.`.

---