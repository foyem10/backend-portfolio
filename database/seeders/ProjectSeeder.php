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
                'title_en' => 'Online registration form',
                'summary' => 'Application d\'inscription complète : un formulaire React valide les saisies et une API Laravel les enregistre dans MySQL.',
                'summary_en' => 'Complete sign-up application: a React form validates input and a Laravel API stores it in MySQL.',
                'description' => 'Frontend React, TypeScript et Vite (Bootstrap) déployé sur Vercel avec redéploiement automatique à chaque push. API Laravel et base MySQL déployées sur Railway. Projet d\'entraînement au déploiement de bout en bout.',
                'description_en' => 'React, TypeScript and Vite (Bootstrap) frontend deployed on Vercel with automatic redeployment on every push. Laravel API and MySQL database deployed on Railway. End-to-end deployment practice project.',
                'result' => null, // À COMPLÉTER : ce que le projet t'a appris ou apporté
                'result_en' => null,
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
                'title_en' => 'Machine Learning model, IndabaX 2026 hackathon',
                'summary' => 'Développement en équipe de modèles de Machine Learning pour résoudre un problème réel, présentés devant un jury technique.',
                'summary_en' => 'Team-built Machine Learning models solving a real problem, presented to a technical jury.',
                'description' => null, // À COMPLÉTER : le problème, les données, l'approche
                'description_en' => null,
                'result' => null, // À COMPLÉTER : score, classement, métrique
                'result_en' => null,
                'stack' => ['Python', 'Machine Learning'],
                'featured' => true,
                'is_published' => true,
                'position' => 2,
            ],
            [
                'slug' => 'chatbot-ia-orange-digital-center',
                'title' => 'Chatbot IA pour l\'automatisation de processus',
                'title_en' => 'AI chatbot for process automation',
                'summary' => 'Conception et déploiement de chatbots IA pour automatiser des processus métier, dans le cadre de la formation Data & IA de l\'Orange Digital Center.',
                'summary_en' => 'Design and deployment of AI chatbots automating business processes during the Orange Digital Center Data & AI training.',
                'description' => null, // À COMPLÉTER
                'description_en' => null,
                'result' => null,
                'result_en' => null,
                'stack' => ['IA générative', 'Chatbot', 'Automatisation'],
                'featured' => true,
                'is_published' => true,
                'position' => 3,
            ],
            [
                'slug' => 'application-gestion-taches',
                'title' => 'Application de gestion de tâches',
                'title_en' => 'Task management app',
                'summary' => 'To-do list développée avec React et Vite lors de ma formation Développement Web & Linux.',
                'summary_en' => 'To-do list built with React and Vite during the Web Development & Linux training.',
                'stack' => ['React', 'Vite'],
                'is_published' => true,
                'position' => 4,
            ],
            // Projets à publier une fois les informations complétées (stack, liens, résultat).
            [
                'slug' => 'incubateur-neonatal-home-ai',
                'title' => 'Incubateur néonatal connecté (Home AI)',
                'title_en' => 'Connected neonatal incubator (Home AI)',
                'summary' => 'Prototype d\'incubateur néonatal combinant IoT et intelligence artificielle, développé en équipe.',
                'summary_en' => 'Neonatal incubator prototype combining IoT and artificial intelligence, built as a team.',
                'stack' => ['IoT', 'Systèmes embarqués', 'IA', 'Wokwi'],
                'featured' => true,
                'is_published' => false,
                'position' => 5,
            ],
            [
                'slug' => 'site-tcf-canada',
                'title' => 'Site e-commerce de préparation au TCF Canada',
                'title_en' => 'TCF Canada exam-prep e-commerce site',
                'summary' => 'Boutique en ligne de packs de préparation à l\'examen TCF Canada.',
                'summary_en' => 'Online store selling TCF Canada exam-preparation packs.',
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