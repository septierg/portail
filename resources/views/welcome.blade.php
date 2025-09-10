<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Zafe Mwen App</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-600">Zafe Mwen App</h1>
            <nav class="space-x-6">
                <a href="#features" class="hover:text-indigo-600">Fonctionnalités</a>
                <a href="#pricing" class="hover:text-indigo-600">Tarifs</a>
                <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Se connecter</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-indigo-50">
        <div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Gérez vos <span class="text-indigo-600">ventes et inscriptions</span> en toute simplicité</h2>
                <p class="text-lg text-gray-600 mb-6">
                    Que vous soyez une boulangerie, un garage, un centre communautaire ou un club sportif,
                    <strong>Zafe Mwen App</strong> vous aide à suivre vos ventes journalières et gérer vos inscriptions en ligne.
                </p>
                <div class="space-x-4">
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700">Commencer</a>
                    <a href="#features" class="text-indigo-600 font-semibold hover:underline">En savoir plus</a>
                </div>
            </div>
            <div>
                <img src="{{asset('img/breadcrumbs-bg.jpg')}}" alt="SaaS gestion" class="w-full">
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-gray-900 mb-12">Pourquoi choisir Zafe Mwen App ?</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Vente journalière -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <img src="{{asset('img/service.jpg')}}" alt="Ventes" class="w-20 mx-auto mb-4">
                    <h4 class="font-bold text-xl mb-2">Enregistrez vos ventes</h4>
                    <p class="text-gray-600">Notez facilement vos ventes du jour et recevez un rapport détaillé automatiquement.</p>
                </div>
                <!-- Inscriptions -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <img src="{{asset('img/about-2.jpg')}}" alt="Inscriptions" class="w-20 mx-auto mb-4">
                    <h4 class="font-bold text-xl mb-2">Gérez vos inscriptions</h4>
                    <p class="text-gray-600">Créez vos ateliers ou cours, et suivez les inscriptions de vos participants en temps réel.</p>
                </div>
                <!-- Rapports -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <img src="{{asset('img/about.jpg')}}" alt="Rapports" class="w-20 mx-auto mb-4">
                    <h4 class="font-bold text-xl mb-2">Rapports instantanés</h4>
                    <p class="text-gray-600">Consultez vos résultats financiers et vos listes d’inscrits d’un simple clic.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="relative py-20 text-center text-white">
        <!-- Background image -->
        <div class="absolute inset-0">
            <img src="https://www.transparenttextures.com/patterns/cubes.png"
                alt="Background pattern"
                class="w-full h-full object-cover">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-indigo-600/90"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-4xl mx-auto px-6">
            <h3 class="text-3xl font-bold mb-4">Gérez tout depuis une seule plateforme</h3>
            <p class="text-lg mb-6">Plus besoin de jongler entre plusieurs cahiers ou fichiers Excel.
            Avec <strong>Zafe Mwen App</strong>, vos ventes et inscriptions sont centralisées et accessibles partout.</p>
            <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                Créer mon compte gratuit
            </a>
        </div>
    </section>


    <!-- Pricing -->
    <section id="pricing" class="bg-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-gray-900 mb-6">Tarifs simples et transparents</h3>
            <p class="text-lg text-gray-600 mb-12">Essayez <strong>Zafe Mwen App</strong> gratuitement pendant <span class="text-indigo-600 font-semibold">3 mois</span>.
            Les frais d’abonnement mensuel ne commencent qu’après cette période.</p>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Gratuit -->
                <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition flex flex-col">
                    <h4 class="text-xl font-bold mb-4">Essai Gratuit</h4>
                    <p class="text-4xl font-bold text-indigo-600 mb-4">0 $</p>
                    <p class="text-gray-600 mb-6">Pendant 3 mois, profitez de toutes les fonctionnalités sans frais.</p>
                    <a href="{{ route('register') }}" class="mt-auto bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700">Commencer Gratuitement</a>
                </div>

                <!-- Standard -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border-2 border-indigo-600 flex flex-col">
                    <h4 class="text-xl font-bold mb-4">Standard</h4>
                    <p class="text-4xl font-bold text-indigo-600 mb-4">19 $ <span class="text-lg text-gray-600">/mois</span></p>
                    <p class="text-gray-600 mb-6">Idéal pour petites entreprises, artisans, clubs et associations.</p>
                    <a href="{{ route('register') }}" class="mt-auto bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700">Choisir ce plan</a>
                </div>

                <!-- Pro -->
                <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition flex flex-col">
                    <h4 class="text-xl font-bold mb-4">Pro</h4>
                    <p class="text-4xl font-bold text-indigo-600 mb-4">39 $ <span class="text-lg text-gray-600">/mois</span></p>
                    <p class="text-gray-600 mb-6">Pour structures plus grandes avec plusieurs utilisateurs et rapports avancés.</p>
                    <a href="{{ route('register') }}" class="mt-auto bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700">Choisir ce plan</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center">
        <p>© {{ date('Y') }} Zafe Mwen App — Tous droits réservés.</p>
    </footer>

</body>
</html>
