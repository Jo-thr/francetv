<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('cache.headers:private;max_age=3600')->group(function () {
    Route::get('posts/filtered', 'Posts\GetPostCollectionFiltered')
    ->name('api.posts.filtered');

    Route::get('posts', 'Posts\GetPostCollection')
    ->name('api.posts.collection');

    Route::get('posts/slug={slug}', 'Posts\GetPostBySlug')
    ->name('api.posts.one.via.slug');

    Route::get('posts/{post}', 'Posts\GetPost')
    ->name('api.posts.one');

    Route::patch('posts/{post}', 'Posts\PatchPost')
    ->name('api.posts.patch');

    Route::get('tags/slug={slug}', 'Tags\GetTagBySlug')
    ->name('api.tag.one.via.slug');

    Route::get('tags/{tag}', 'Tags\GetTag')
    ->name('api.tag.one');

    Route::get('tags/slug={slug}/all', 'Tags\GetContentBySluggedTag')
    ->name('api.tag.via.slug.content');

    Route::get('tags/{tag}/all', 'Tags\GetContentByTag')
    ->name('api.tag.collection.content');

    Route::get('tags/slug={slug}/posts', 'Posts\GetPostsBySluggedTag')
    ->name('api.posts.collection.tag.via.slug');

    Route::get('tags/{tag}/posts', 'Posts\GetPostsByTag')
    ->name('api.posts.collection.tag');

    Route::get('tags', 'Tags\GetTagCollection')
    ->name('api.tags.collection');

    Route::get('headings/slug={slug}', 'Headings\GetHeadingBySlug')
    ->name('api.headings.one.via.slug');

    Route::get('headings', 'Headings\GetHeadingCollection')
    ->name('api.headings.collection');

    Route::get('headings/{slug}/posts', 'Posts\GetPostsByHeading')
    ->name('api.posts.collection.heading');

    Route::get('meta-media', 'MetaMedia\GetMetaMediaCollection')
    ->name('api.meta-media.collection');

    Route::get('meta-media/last', 'MetaMedia\GetLastMetaMediaCollection')
    ->name('api.meta-media.last');

    Route::get('layouts', 'Layouts\GetLayoutCollection')
    ->name('api.layouts.collection');

    Route::get('layouts/{name}', 'Layouts\GetLayout')
    ->name('api.layouts.one');

    Route::get('tests/slug={test}', 'Tests\GetTestBySlug')
    ->name('api.tests.one.via.slug');

    Route::get('tests/{test}', 'Tests\GetTest')
    ->name('api.tests.one');


    Route::get('tests', 'Tests\GetTestCollection')
    ->name('api.tests.collection');

    Route::post('tests/{test}/votes', 'Tests\PostVoteForTest')
    ->name('api.votes.post.test');

    Route::get('tests/{test}/votes/{token}', 'Tests\GetHasVoted')
        ->name('api.tests.hasvoted');

    Route::post('tokens', 'PostToken')
    ->name('api.tokens.post');

    Route::patch('tests/{test}/share', 'Tests\PatchShareTest')
    ->name('api.tokens.patch.share');

    Route::patch('tests/{test}/tested', 'Tests\PatchMakeTest')
    ->name('api.tokens.patch.tested');

    Route::middleware(['search'])->group(function () {
        Route::get('/search', 'Search\SearchInContent')
        ->name('api.search');

        Route::get('/search/posts', 'Search\SearchInPosts')
        ->name('api.posts.search');

        Route::get('/search/metamedia', 'Search\SearchInMetaMedia')
        ->name('api.metamedia.search');

        Route::get('/search/tests', 'Search\SearchInTests')
        ->name('api.tests.search');
    });

    Route::post('/contact', 'PostContact')
        ->name('api.contact');

    Route::fallback('GetFallbackAction')
    ->name('api.fallback');
});
