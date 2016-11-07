<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArticleComment Entity
 *
 * @property int $article_id
 * @property int $comment_id
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Comment $comment
 */
class ArticleComment extends Entity
{

}
