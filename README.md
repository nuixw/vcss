# Vcss

Vcss est un moyen facile d'utiliser des variables CSS, accessible sur tout navigateur.

### Installation

Importer vcss.php dans votre page.

```
require_once('vcss.php');
```

Initialisez ensuite Vcss avec le chemin relatif de votre css

```
$vcss = new Vcss('./css/style.css');
```

Appellez ensuite la balise link dans votre <head>

```
<link rel="stylesheet" href="<?php $vcss->Create();?>">
```

Vcss va créer un fichier compressé dans le dossier de votre css


## Utilisation des variables

Pour utiliser des variables, importer d'accord un fichier nommé var.json au haut de votre css, avec son chemin relatif

```
@import 'style/var.json';
```

Créez vos variables dans votre fichier var.json

```
{
    "$color": "#000",
    "$size": "15px",
    "$style": "background:#333;color:#fff;border-radius:5px;"
}
```

Et vous n'avez plus cas appeler vos variables qui seront retranscrites dans le css après la compression

```
body{background:$color;font-size:$size;}
button{$style}
```

## @import css

Avec Vcss vous ne pouvez utiliser la fonction @import que pour importer le fichier var.json et des css avec leurs chemins relatifs

```
@import 'style/var.json';
@import 'style/import.css';
```

