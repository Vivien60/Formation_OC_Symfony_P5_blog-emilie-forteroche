<?php
    /** 
     * Affichage de la partie admin : liste des articles avec un monitoring :
     * nombre de vues, nombre de commentaires, date de publication.
     */
    /** @var Article $article */
    $urlPage = "?action=monitorComments&id={$article->getId()}";
?>
<div class="monitoring-comments adminContent">
    <div class="adminContent__header">
        <h2 class="adminContent__header--main"><?= $article->getTitle() ?></h2>
        <h2 class="adminContent__header--aside">Commentaires</h2>
        <h2 class="adminContent__header--aside"><a href="?action=monitorArticles">Monitoring des articles</a></h2>
    </div>
    <div class="monitoring-comments__list commentPaleTable gridList">
        <div class="gridList--header content"><h3>Auteur</h3><div class="gridList--order"><a href="<?= $urlPage ?>&order=author&dir=1">&#9207;</a>&nbsp;<a href="<?= $urlPage ?>&order=author&dir=0">&#9206;</a></div></div>
        <div class="gridList--header content"><h3>Commentaire</h3></div>
        <div class="gridList--header content"><h3>Date de publication</h3><div class="gridList--order"><a href="<?= $urlPage ?>&order=date-pub&dir=1">&#9207;</a>&nbsp;<a href="<?= $urlPage ?>&order=date-pub&dir=0">&#9206;</a></div></div>
        <div>&nbsp;</div>
        <?php foreach ($comments as $comment) {
            /** @var Comment $comment */
            ?>
            <div class="content"><?= $comment->getPseudo() ?></div>
            <div class="content"><?= $comment->getContent() ?></div>
            <div class="content"><?= $comment->getDateCreation()->format('Y-m-d') ?></div>
            <div><a class="submit gridList__cell--button" href="?action=deleteComment&id=<?= $comment->getId() ?>">Supprimer</a></div>
        <?php } ?>
    </div>
</div>