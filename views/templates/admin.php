<?php 
    /** 
     * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun. 
     * Et un formulaire pour ajouter un article. 
     */
?>

<div class="adminArticles adminContent">
    <div class="adminContent__header">
        <h2 class="adminContent__header--aside">Edition des articles</h2>
        <h2 class="adminContent__header--aside"><a href="index.php?action=monitorArticles">Monitoring des articles</a></h2>
    </div>
    <div class="adminArticles__list commentPaleTable">
        <?php foreach ($articles as $article) { ?>
            <div class="articleLine tableLine">
                <div class="title"><?= Utils::format($article->getTitle()) ?></div>
                <div class="content"><?= Utils::format($article->getContent(200)) ?></div>
                <div><a class="submit" href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">Modifier</a></div>
                <div><a class="submit" href="index.php?action=deleteArticle&id=<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?> >Supprimer</a></div>
            </div>
        <?php } ?>
    </div>
</div>
<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>