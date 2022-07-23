<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'name' => 'Ahmed Adel',
                'email' => 'user1@site.com',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'je4GVY6O5E',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/admin.jpeg',
                'changed_password' => '1',
            ),
            1 => 
            array (
                'name' => 'Mahmoud Adel',
                'email' => 'user2@site.com',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => '6GRsUUl1zW',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/4.png',
                'changed_password' => '1',
            ),
            2 => 
            array (
                'name' => 'Joanie Braun',
                'email' => 'eileen.volkman@example.com',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'KfnTxJArRB',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            3 => 
            array (
                'name' => 'Mr. Jarvis Wintheiser II',
                'email' => 'ohowe@example.com',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'pW0MdbWPVA',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            4 => 
            array (
                'name' => 'Ms. Virgie Weissnat',
                'email' => 'acorkery@example.net',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'trraprTTQQ',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            5 => 
            array (
                'name' => 'Ms. Rosamond Champlin V',
                'email' => 'julie56@example.org',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'Qpok8j9PDU',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            6 => 
            array (
                'name' => 'Prof. Nigel Terry Jr.',
                'email' => 'zheidenreich@example.net',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'uDUJBkMTZX',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            7 => 
            array (
                'name' => 'Lily Powlowski',
                'email' => 'hermiston.barton@example.com',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'x38RD8loqI',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/1.png',
                'changed_password' => '1',
            ),
            8 => 
            array (
                'name' => 'Luis Wisoky',
                'email' => 'annie.bergstrom@example.com',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'DlBvMeR7ce',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            9 => 
            array (
                'name' => 'Dr. Christina Feest PhD',
                'email' => 'dejah.sporer@example.com',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'zs1IuTKNQN',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            10 => 
            array (
                'name' => 'Elliott Barton',
                'email' => 'ewuckert@example.net',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => '1xwgLBcKP9',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/4.png',
                'changed_password' => '1',
            ),
            11 => 
            array (
                'name' => 'Dr. Janelle Moen',
                'email' => 'nico68@example.com',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => '8XR7lVvPyb',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            12 => 
            array (
                'name' => 'Natalie Watsica IV',
                'email' => 'bergstrom.dahlia@example.org',
                'email_verified_at' => '2022-07-23 08:45:23',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'vQkc5sW2H8',
                'created_at' => '2022-07-23 08:45:23',
                'updated_at' => '2022-07-23 08:45:23',
                'avatar' => '/users/1.png',
                'changed_password' => '1',
            ),
            13 => 
            array (
                'name' => 'Ettie Hackett',
                'email' => 'frau@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'fuFnXdw9sB',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            14 => 
            array (
                'name' => 'Mrs. Abbigail Spinka',
                'email' => 'brendon.gulgowski@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 't5hsXkdOWx',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            15 => 
            array (
                'name' => 'Miss Precious Lakin MD',
                'email' => 'reichel.chance@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'Q9ALK8sk99',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            16 => 
            array (
                'name' => 'Vernon Leffler',
                'email' => 'king.adah@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => '1VsRu7BC97',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            17 => 
            array (
                'name' => 'Bertram Turner III',
                'email' => 'allan16@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'R7iFBkcpYD',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/4.png',
                'changed_password' => '1',
            ),
            18 => 
            array (
                'name' => 'Tiara Rogahn',
                'email' => 'wisozk.bulah@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'h1153NJs3A',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            19 => 
            array (
                'name' => 'Richard Larkin IV',
                'email' => 'dessie.labadie@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'ozFxMISfvi',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/6.png',
                'changed_password' => '1',
            ),
            20 => 
            array (
                'name' => 'Garth Frami',
                'email' => 'susan77@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'IYOqFLUSPk',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            21 => 
            array (
                'name' => 'Prof. Khalil Miller',
                'email' => 'cheyanne.orn@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'NmgNINGIj9',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/6.png',
                'changed_password' => '1',
            ),
            22 => 
            array (
                'name' => 'Daphnee Mertz',
                'email' => 'chance.dietrich@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'EsmQ9ghGlt',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            23 => 
            array (
                'name' => 'Miss Lorine Parisian',
                'email' => 'ngutkowski@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'TvVvO8Q1Bi',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            24 => 
            array (
                'name' => 'Dr. Douglas Keeling IV',
                'email' => 'annie87@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'xcD8Z1TqOG',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/4.png',
                'changed_password' => '1',
            ),
            25 => 
            array (
                'name' => 'Mrs. Dixie Medhurst III',
                'email' => 'esta.swift@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'qZLHW0u7zt',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            26 => 
            array (
                'name' => 'Mr. Nicola Schuster',
                'email' => 'effie.block@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'CDX2kLxh8a',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/6.png',
                'changed_password' => '1',
            ),
            27 => 
            array (
                'name' => 'Lottie Nolan',
                'email' => 'frosenbaum@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'hosd6tMpiB',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            28 => 
            array (
                'name' => 'Sabryna Murray',
                'email' => 'olson.cyril@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'aW1Anzl40J',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            29 => 
            array (
                'name' => 'Nigel Gutkowski',
                'email' => 'rolfson.rosalinda@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'vPCznsjnkI',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            30 => 
            array (
                'name' => 'Domenica Considine',
                'email' => 'bailey.clemmie@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'GN734xfCeq',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/1.png',
                'changed_password' => '1',
            ),
            31 => 
            array (
                'name' => 'Frankie Moen',
                'email' => 'queenie19@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'ODrvMxalgE',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            32 => 
            array (
                'name' => 'Elnora Shanahan',
                'email' => 'jadyn.hand@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'R7zn3vPbu0',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/1.png',
                'changed_password' => '1',
            ),
            33 => 
            array (
                'name' => 'Carleton Osinski',
                'email' => 'chet37@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'VkynkUTD6r',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/6.png',
                'changed_password' => '1',
            ),
            34 => 
            array (
                'name' => 'Virgie Emmerich',
                'email' => 'lhoppe@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => '0OKRTalGPt',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            35 => 
            array (
                'name' => 'Maddison Rempel',
                'email' => 'jordane46@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'jUzwi44lpa',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/1.png',
                'changed_password' => '1',
            ),
            36 => 
            array (
                'name' => 'Mr. Emmett Wolf II',
                'email' => 'hackett.kenyatta@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'ARRCF7yGAy',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            37 => 
            array (
                'name' => 'Daphney Kling',
                'email' => 'deontae08@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'B8dZQkqRq1',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            38 => 
            array (
                'name' => 'Leonor Lindgren',
                'email' => 'marilou72@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => '1w6h3j0vfN',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            39 => 
            array (
                'name' => 'Miss Maci Armstrong',
                'email' => 'haley.mark@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'ONjSgg4KBy',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            40 => 
            array (
                'name' => 'Mr. Immanuel Crooks',
                'email' => 'leannon.deven@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'JUa5nqwkXq',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            41 => 
            array (
                'name' => 'Deshaun Oberbrunner IV',
                'email' => 'mharber@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'fkrQuBv18N',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/4.png',
                'changed_password' => '1',
            ),
            42 => 
            array (
                'name' => 'Jaiden Welch',
                'email' => 'gerda.kutch@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'QL1OkDsnLK',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            43 => 
            array (
                'name' => 'Darrel Hoppe',
                'email' => 'garth85@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'AfHjAm3ozP',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/4.png',
                'changed_password' => '1',
            ),
            44 => 
            array (
                'name' => 'Tyson Zulauf',
                'email' => 'tony.walsh@example.net',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'BKMPZx0V29',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/6.png',
                'changed_password' => '1',
            ),
            45 => 
            array (
                'name' => 'Sylvan Pfannerstill',
                'email' => 'hester18@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'GlbwghQzK9',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/4.png',
                'changed_password' => '1',
            ),
            46 => 
            array (
                'name' => 'Ms. Jermaine Osinski',
                'email' => 'brekke.bert@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'tzcG8FoWb2',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            47 => 
            array (
                'name' => 'Abel Bogan',
                'email' => 'maya.quitzon@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'ZrAfRYKGDY',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/5.png',
                'changed_password' => '1',
            ),
            48 => 
            array (
                'name' => 'Chauncey Glover III',
                'email' => 'okemmer@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'armsXAkAsV',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/6.png',
                'changed_password' => '1',
            ),
            49 => 
            array (
                'name' => 'Concepcion Von II',
                'email' => 'toy.nakia@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'v0hLw1c2nV',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/3.png',
                'changed_password' => '1',
            ),
            50 => 
            array (
                'name' => 'Kailey Schowalter V',
                'email' => 'boreilly@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'uVbMz1weYV',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
            51 => 
            array (
                'name' => 'Juvenal Stamm',
                'email' => 'sawayn.cesar@example.com',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'qesDIZxUOb',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/4.png',
                'changed_password' => '1',
            ),
            52 => 
            array (
                'name' => 'Carmela Rogahn PhD',
                'email' => 'feil.dejah@example.org',
                'email_verified_at' => '2022-07-23 08:45:24',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'f0UuN1UCAZ',
                'created_at' => '2022-07-23 08:45:24',
                'updated_at' => '2022-07-23 08:45:24',
                'avatar' => '/users/2.png',
                'changed_password' => '1',
            ),
        ));
        
        
    }
}