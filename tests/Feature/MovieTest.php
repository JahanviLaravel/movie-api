<?php

test('this is an example test', function() {
    $this->assertEquals(1, 1);
});

test('submitting a movie with invalid genre and actor data results in a validation error', function () {
    $response = $this->post('/store', [
        'name' => 'Test Movie',
        'user_id' => 1,
        'synopsis' => 'Test Synopsis',
        'image_url' => 'https://test.com/image.jpg',
        'release_date' => '2022-01-01',
        'rating' => 'PG',
        'award_winning' => false,
        'genres' => [1, 2],
        'actors' => [1],
    ]);

    $response->assertSessionHasErrors([
        'genres.*',
        'actors.*',
    ]);
});

test('submitting a movie with invalid data results in a validation error', function () {
    $response = $this->post('/store', [
        'name' => '',
        'user_id' => 1,
        'synopsis' => '',
        'image_url' => '',
        'release_date' => '',
        'rating' => '',
        'award_winning' => false,
        'genres' => [],
        'actors' => [],
    ]);

    $response->assertSessionHasErrors([
        'name',
        'synopsis',
        'image_url',
        'release_date',
        'rating',
    ]);
});
