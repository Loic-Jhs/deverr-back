<?php

namespace Tests\Feature;

use App\Models\Developer;
use App\Models\User;

it('should return 201 when a client registers', function () {
    // Génère un objet user avec des valeurs aléatoires (depuis les factories)
    $user = User::factory()->raw();
    //compte client
    $user['role_id'] = 1;
    $tabPost = $user;
    //permet l'envoi d'information supplémentaire au controller pour le traitement (type de compte)
    $tabPost['type'] = 'client';
    // Post les valeurs de l'objet utilisateur sur la route /register
    $response = $this->postJson('/register', $tabPost);
    //Récupère le code de la requête HTTP
    $response->assertStatus(201);
});

it('should return 201 when a developer registers', function () {
    // Génère un objet user avec des valeurs aléatoires (depuis les factories)
    $user = User::factory()->raw();
    $dev = Developer::factory()->raw();
    //compte developpeur
    $user['role_id'] = 2;
    $tabPost = $user;
    //permet l'envoi d'information supplémentaire au controller pour le traitement (type de compte)
    $tabPost['type'] = 'developer';
    $tabPost = array_merge($tabPost, $dev);

    // Post les valeurs de l'objet utilisateur sur la route /register
    $response = $this->postJson('/register', $tabPost);
    //Récupère le code de la requête HTTP
    $response->assertStatus(201);
});
