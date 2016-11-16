<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title><?php echo $this->fetch('title'); ?></title>
</head>
<body>
<?php echo $this->fetch('content'); ?>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $this->fetch('title'); ?></title>
</head>
<body>
<h3>Bonjour <?= $users->username ?>,</h3>
<p>
    Merci de votre inscription sur le blog. Votre compte est bien enregistré mais pas validé. Pour l'activer, veuillez <a href="http://florentm.simplon-epinal.tk/blog/compte/validation/<?= h($users->email) ?>">cliquer ici</a> ou suivre ce lien :
</p>
<p>
    <a href="http://florentm.simplon-epinal.tk/blog/compte/validation/<?= h($users->email) ?>">http://florentm.simplon-epinal.tk/blog/compte/validation/<?= h($users->email) ?></a>
</p>
<p>
    A bientôt !
    <h2>Blog de Mofla</h2>
</p>
</body>
</html>