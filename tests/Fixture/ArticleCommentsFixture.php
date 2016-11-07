<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArticleCommentsFixture
 *
 */
class ArticleCommentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'article_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'comment_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_article_id' => ['type' => 'index', 'columns' => ['article_id'], 'length' => []],
            'fk_comment_id' => ['type' => 'index', 'columns' => ['comment_id'], 'length' => []],
        ],
        '_constraints' => [
            'fk_comment_id' => ['type' => 'foreign', 'columns' => ['comment_id'], 'references' => ['comments', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_article_id' => ['type' => 'foreign', 'columns' => ['article_id'], 'references' => ['articles', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'article_id' => 1,
            'comment_id' => 1
        ],
    ];
}
