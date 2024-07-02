<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// ホーム
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('ホーム', route('home'));
});
// ログイン
Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->push(__('Login'), route('login'));
});
// マイページ
Breadcrumbs::for('mypage.index', function (BreadcrumbTrail $trail) {
    $trail->push(__('MyPage'), route('mypage.index'));
});

$resourceModels = [
    // リソースのモデルを追加
    new \App\Models\Customer,
    new \App\Models\User,
    new \App\Models\Store,
];

foreach ($resourceModels as $model) {
    $name = $model::NAME;
    $resource = $model->getTable();

    // ホーム > リソースモデル > 一覧
    Breadcrumbs::for("$resource.index", function (BreadcrumbTrail $trail) use ($resource, $name) {
        $trail->parent('home');
        $trail->push($name, route("$resource.index"));
    });

    // ホーム > リソースモデル > 新規登録
    Breadcrumbs::for("$resource.create", function (BreadcrumbTrail $trail) use ($resource) {
        $trail->parent("$resource.index");
        $trail->push(__('resource.create'), route("$resource.create"));
    });

    // ホーム > リソースモデル > 詳細
    Breadcrumbs::for("$resource.show", function (BreadcrumbTrail $trail) use ($resource) {
        $trail->parent("$resource.index");
        $trail->push(__('resource.show'), route("$resource.show", 'id'));
    });

    // ホーム > リソースモデル > 編集
    Breadcrumbs::for("$resource.edit", function (BreadcrumbTrail $trail) use ($resource) {
        $trail->parent("$resource.index");
        $trail->push(__('resource.edit'), route("$resource.edit", 'id'));
    });
}

//// Home > Blog
//Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
//    $trail->parent('home');
//    $trail->push('Blog', route('blog'));
//});
//
//// Home > Blog > [Category]
//Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//    $trail->parent('blog');
//    $trail->push($category->title, route('category', $category));
//});
