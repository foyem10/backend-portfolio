<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'formulaire-inscription',
                'title' => 'Formulaire d\'inscription en ligne',
                'summary' => 'Application d\'inscription complète : un formulaire React valide les saisies et une API Laravel les enregistre dans MySQL.',
                'description' => 'Frontend React, TypeScript et Vite (Bootstrap) déployé sur Vercel avec redéploiement automatique à chaque push. API Laravel et base MySQL déployées sur Railway. Projet d\'entraînement au déploiement de bout en bout.',
                'result' => null, // À COMPLÉTER : ce que le projet t'a appris ou apporté
                'stack' => ['React', 'TypeScript', 'Vite', 'Bootstrap', 'Laravel', 'MySQL', 'Vercel', 'Railway'],
                'github_url' => 'https://github.com/foyem10/formulaire-d-inscription',
                'demo_url' => 'https://formulaire-d-inscription-ygaz.vercel.app',
                'featured' => true,
                'is_published' => true,
                'position' => 1,
            ],
            [
                'slug' => 'hackathon-indabax-2026',
                'title' => 'Modèle de Machine Learning, hackathon IndabaX 2026',
                'summary' => 'Développement en équipe de modèles de Machine Learning pour résoudre un problème réel, présentés devant un jury technique.',
                'description' => null, // À COMPLÉTER : le problème, les données, l'approche
                'result' => null, // À COMPLÉTER : score, classement, métrique
                'stack' => ['Python', 'Machine Learning'],
                'featured' => true,
                'is_published' => true,
                'position' => 2,
            ],
            [
                'slug' => 'chatbot-ia-orange-digital-center',
                'title' => 'Chatbot IA pour l\'automatisation de processus',
                'summary' => 'Conception et déploiement de chatbots IA pour automatiser des processus métier, dans le cadre de la formation Data & IA de l\'Orange Digital Center.',
                'description' => null, // À COMPLÉTER
                'result' => null,
                'stack' => ['IA générative', 'Chatbot', 'Automatisation'],
                'featured' => true,
                'is_published' => true,
                'position' => 3,
            ],
            [
                'slug' => 'application-gestion-taches',
                'title' => 'Application de gestion de tâches',
                'summary' => 'To-do list développée avec React et Vite lors de ma formation Développement Web & Linux.',
                'stack' => ['React', 'Vite'],
                'is_published' => true,
                'position' => 4,
            ],
            // Projets à publier une fois les informations complétées (stack, liens, résultat).
            [
                'slug' => 'incubateur-neonatal-home-ai',
                'title' => 'Incubateur néonatal connecté (Home AI)',
                'summary' => 'Prototype d\'incubateur néonatal combinant IoT et intelligence artificielle, développé en équipe.',
                'stack' => ['IoT', 'Systèmes embarqués', 'IA', 'Wokwi'],
                'featured' => true,
                'is_published' => false,
                'position' => 5,
            ],
            [
                'slug' => 'site-tcf-canada',
                'title' => 'Site e-commerce de préparation au TCF Canada',
                'summary' => 'Boutique en ligne de packs de préparation à l\'examen TCF Canada.',
                'stack' => ['E-commerce'],
                'is_published' => false,
                'position' => 6,
            ],
        ];

        foreach ($projects as $data) {
            Project::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}