<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferentielsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Années académiques
        DB::table('annees_academiques')->insert([
            ['libelle' => '2024-2025', 'date_debut' => '2024-10-01', 'date_fin' => '2025-09-30', 'est_courante' => false, 'created_at' => $now, 'updated_at' => $now],
            ['libelle' => '2025-2026', 'date_debut' => '2025-10-01', 'date_fin' => '2026-09-30', 'est_courante' => true,  'created_at' => $now, 'updated_at' => $now],
        ]);

        // Filières (données fictives)
        DB::table('filieres')->insert([
            ['code' => 'IG',   'libelle' => 'Informatique de Gestion',   'departement' => 'Informatique', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'STAT', 'libelle' => 'Statistique',               'departement' => 'Statistique',  'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ECO',  'libelle' => 'Économie Appliquée',        'departement' => 'Économie',     'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GES',  'libelle' => 'Gestion des Organisations', 'departement' => 'Gestion',      'created_at' => $now, 'updated_at' => $now],
        ]);

        // Niveaux
        DB::table('niveaux')->insert([
            ['code' => 'L1', 'libelle' => 'Licence 1', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'L2', 'libelle' => 'Licence 2', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'L3', 'libelle' => 'Licence 3', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'M1', 'libelle' => 'Master 1',  'created_at' => $now, 'updated_at' => $now],
            ['code' => 'M2', 'libelle' => 'Master 2',  'created_at' => $now, 'updated_at' => $now],
        ]);

        // Semestres : numérotation continue (L1 = S1-S2, L2 = S3-S4, ...)
        $numero = 1;
        foreach (DB::table('niveaux')->orderBy('id')->get() as $niveau) {
            for ($i = 0; $i < 2; $i++) {
                DB::table('semestres')->insert([
                    'niveau_id' => $niveau->id,
                    'numero' => $numero++,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // Promotions : année courante x filières x L1-L3
        $annee = DB::table('annees_academiques')->where('est_courante', true)->first();
        $licences = DB::table('niveaux')->whereIn('code', ['L1', 'L2', 'L3'])->get();

        foreach (DB::table('filieres')->get() as $filiere) {
            foreach ($licences as $niveau) {
                DB::table('promotions')->insert([
                    'annee_academique_id' => $annee->id,
                    'filiere_id' => $filiere->id,
                    'niveau_id' => $niveau->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}