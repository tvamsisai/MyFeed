<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Article' => $baseDir . '/app/models/Article.php',
    'ArticleController' => $baseDir . '/app/controllers/ArticleController.php',
    'BaseController' => $baseDir . '/app/controllers/BaseController.php',
    'CreateArticlesTable' => $baseDir . '/app/database/migrations/2013_12_22_020134_create_articles_table.php',
    'CreateFeedsTable' => $baseDir . '/app/database/migrations/2013_12_22_015536_create_feeds_table.php',
    'CreateKeywordsInArtibleTable' => $baseDir . '/app/database/migrations/2013_12_22_020952_create_keywords_in_artible_table.php',
    'CreateKeywordsTable' => $baseDir . '/app/database/migrations/2013_12_22_020706_create_keywords_table.php',
    'DatabaseSeeder' => $baseDir . '/app/database/seeds/DatabaseSeeder.php',
    'Feed' => $baseDir . '/app/models/Feed.php',
    'FeedController' => $baseDir . '/app/controllers/FeedController.php',
    'IlluminateQueueClosure' => $vendorDir . '/laravel/framework/src/Illuminate/Queue/IlluminateQueueClosure.php',
    'Keyword' => $baseDir . '/app/models/Keyword.php',
    'MakeSeeder' => $baseDir . '/app/database/seeds/MakeSeeder.php',
    'SessionHandlerInterface' => $vendorDir . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs/SessionHandlerInterface.php',
    'TestCase' => $baseDir . '/app/tests/TestCase.php',
    'User' => $baseDir . '/app/models/User.php',
    'Word' => $baseDir . '/app/models/Word.php',
);
