<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .perspective-1000 {
            perspective: 1500px;
        }

        .rotate-y-2 {
            transform: rotateY(2deg);
        }

        .rotate-x-2 {
            transform: rotateX(2deg);
        }

        #tilt-card {
            transform-style: preserve-3d;
            will-change: transform;
            backface-visibility: hidden;
        }

        #tilt-card img {
            transform-style: preserve-3d;
            will-change: transform;
            backface-visibility: hidden;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-fade-in-left {
            animation: fadeInLeft 0.6s ease-out forwards;
        }

        .animate-fade-in-right {
            animation: fadeInRight 0.6s ease-out forwards;
        }

        /* Add stagger delay classes */
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .stagger-5 { animation-delay: 0.5s; }



             /* Newsletter specific mobile optimizations */
             @media (max-width: 640px) {
            /* Improved input spacing */
            .newsletter-form input {
                margin-bottom: 1rem;
            }

            /* Better touch targets */
            .newsletter-form button {
                padding: 0.875rem;
                margin-top: 0.5rem;
            }

            /* Adjusted text sizes */
            .newsletter-heading {
                font-size: 1.5rem;
                line-height: 1.3;
            }

            /* Improved spacing */
            .newsletter-content {
                padding: 1.5rem;
            }
        }

        /* Smooth transitions */
        .newsletter-input {
            transition: all 0.2s ease-in-out;
        }

        /* Focus states */
        .newsletter-input:focus {
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2);
        }
    </style>

    <!-- Add this script in the head section -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const fadeInUpObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const fadeInLeftObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-left');
                    entry.target.classList.remove('opacity-0', '-translate-x-10');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const fadeInRightObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-right');
                    entry.target.classList.remove('opacity-0', 'translate-x-10');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Select all elements to animate
        document.querySelectorAll('.animate-on-scroll').forEach((el) => {
            const animation = el.dataset.animation || 'fade-up';
            el.classList.add('opacity-0');

            switch(animation) {
                case 'fade-left':
                    el.classList.add('-translate-x-10');
                    fadeInLeftObserver.observe(el);
                    break;
                case 'fade-right':
                    el.classList.add('translate-x-10');
                    fadeInRightObserver.observe(el);
                    break;
                default:
                    el.classList.add('translate-y-10');
                    fadeInUpObserver.observe(el);
            }
        });
    });
    </script>
</head>
<body>
    <!-- Navbar -->
    <nav class="fixed w-full bg-white/90 backdrop-blur-sm z-50 shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold text-[#6C63FF]">5</span>
                    <span class="text-sm">Minute<br>School</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-[#6C63FF] transition-colors">Home</a>
                    <a href="#courses" class="text-gray-700 hover:text-[#6C63FF] transition-colors">Courses</a>
                    <a href="#instructors" class="text-gray-700 hover:text-[#6C63FF] transition-colors">Instructors</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-[#6C63FF] transition-colors">Testimonials</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}"
                       class="px-6 py-2 text-[#6C63FF] font-medium hover:text-[#5B53E0] transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-6 py-2 bg-[#6C63FF] text-white rounded-full font-medium hover:bg-[#5B53E0] transform hover:-translate-y-0.5 transition-all duration-200">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-32 pb-20 bg-gradient-to-b from-[#F5F5FF] to-white animate-on-scroll" data-animation="fade-up">
        <div class="container mx-auto px-6">
            <div class="flex flex-col items-center text-center mb-16">
                <h1 class="text-6xl font-bold leading-tight tracking-tight text-gray-900 mb-6 max-w-4xl">
                    Kelola Tugas Harian Anda dengan Lebih Mudah
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl">
                    Aplikasi todo list modern yang membantu Anda tetap produktif dan terorganisir. Rencanakan, lacak, dan selesaikan tugas dengan lebih efisien.
                </p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('register') }}"
                       class="px-8 py-4 bg-[#6C63FF] text-white rounded-lg font-medium hover:bg-[#5B53E0] transition-all">
                        Mulai Gratis
                    </a>
                </div>
                <!-- Social Proof -->
                <div class="mt-12 flex flex-wrap justify-center gap-8">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-gray-900">50K+</span>
                        <span class="text-gray-600">Pengguna Aktif</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-gray-900">1M+</span>
                        <span class="text-gray-600">Tugas Selesai</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-gray-900">4.8/5</span>
                        <span class="text-gray-600">Rating Pengguna</span>
                    </div>
                </div>
            </div>
            <!-- Hero Image with 3D Effect -->
            <div class="max-w-6xl mx-auto perspective-1000">
                <div id="tilt-card" class="transform-gpu transition-transform duration-300 cursor-pointer">
                    <div class="relative">
                        <!-- Glow Effect -->
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-[#6C63FF] to-[#5B54D9] rounded-3xl opacity-20 blur-lg group-hover:opacity-30 transition duration-500"></div>

                        <!-- Main Image -->
                        <img src="https://res.cloudinary.com/dzwqifa7j/image/upload/v1740593688/pklkthcnzrsjtk4n3sse.png"
                             alt="TodoList App Interface"
                             class="relative w-full rounded-3xl shadow-2xl transform transition-all duration-300">

                        <!-- 3D Shadow Effect -->
                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-black/5 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Media Coverage Section -->
    <section class="py-16 bg-white animate-on-scroll" data-animation="fade-up">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto">
                <!-- First Row -->
                <div class="grid grid-cols-2 md:grid-cols-5 gap-8 items-center mb-12">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/media/mkbhd.png') }}"
                             alt="MKBHD"
                             class="h-8 object-contain grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/media/wirecutter.png') }}"
                             alt="Wirecutter"
                             class="h-8 object-contain grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/media/theverge.png') }}"
                             alt="The Verge"
                             class="h-8 object-contain grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/media/mashable.png') }}"
                             alt="Mashable"
                             class="h-8 object-contain grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/media/digitaltrends.png') }}"
                             alt="Digital Trends"
                             class="h-8 object-contain grayscale hover:grayscale-0 transition-all">
                    </div>
                </div>

                <!-- Second Row -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/media/lifehacker.png') }}"
                             alt="Lifehacker"
                             class="h-8 object-contain grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/media/gizmodo.png') }}"
                             alt="Gizmodo"
                             class="h-8 object-contain grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/media/androidcentral.png') }}"
                             alt="Android Central"
                             class="h-8 object-contain grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/media/androidauthority.png') }}"
                             alt="Android Authority"
                             class="h-8 object-contain grayscale hover:grayscale-0 transition-all">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Catalog Section -->
    <section class="py-24 bg-gradient-to-b from-white to-[#F5F5FF] animate-on-scroll" data-animation="fade-up">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <span class="text-[#6C63FF] font-medium mb-4 block">Our Popular Courses</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Explore Our Course Catalog</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Discover a wide range of courses designed to help you master new skills quickly and effectively
                </p>
            </div>

            <!-- Course Cards Container -->
            <div class="space-y-32">
                <!-- Course 1 - Image Right -->
                <div class="flex flex-col lg:flex-row items-center justify-evenly md:gap-0 animate-on-scroll" data-animation="fade-up">
                    <div class="lg:w-1/3">
                        <div class="max-w-xl">
                            <div class="inline-flex items-center px-4 py-2 bg-[#6C63FF]/10 rounded-full mb-6">
                                <svg class="w-5 h-5 text-[#6C63FF] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                                <span class="text-[#6C63FF] font-medium">Programming & Development</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-6">Learn to Code with Python</h3>
                            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                Master Python programming from scratch. Perfect for beginners, this course covers everything from basic syntax to advanced concepts like OOP and data structures.
                            </p>
                            <ul class="space-y-4 mb-10">
                                <li class="flex items-center text-gray-600">
                                    <span class="flex-shrink-0 w-6 h-6 bg-[#6C63FF]/10 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-4 h-4 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                    20+ Hours of Video Content
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <span class="flex-shrink-0 w-6 h-6 bg-[#6C63FF]/10 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-4 h-4 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                    100+ Practice Exercises
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <span class="flex-shrink-0 w-6 h-6 bg-[#6C63FF]/10 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-4 h-4 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                    Certificate of Completion
                                </li>
                            </ul>
                            <div class="flex items-center gap-4">
                                <a href="#" class="inline-flex items-center px-8 py-4 text-white bg-[#6C63FF] rounded-xl hover:bg-[#5B54D9] transition-all transform hover:-translate-y-0.5">
                                    Start Learning
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>
                                <span class="text-gray-600">
                                    <span class="font-bold text-gray-900">$49.99</span> / month
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/3">
                        <div class="relative">
                            <div class="absolute inset-0 bg-[#6C63FF] rounded-3xl rotate-3 opacity-10"></div>
                            <img src="https://cdn3d.iconscout.com/3d/premium/thumb/to-do-list-3d-illustration-download-in-png-blend-fbx-gltf-file-formats--checklist-task-work-completed-pack-business-illustrations-3926031.png"
                                 alt="Python Programming Course"
                                 class="relative rounded-3xl shadow-xl w-full">
                        </div>
                    </div>
                </div>

                <!-- Course 2 - Image Left -->
                <div class="flex flex-col-reverse lg:flex-row items-center justify-around gap-10 md:gap-0  animate-on-scroll" data-animation="fade-up">
                    <div class="lg:w-1/3">
                        <div class="relative">
                            <div class="absolute inset-0 bg-[#6C63FF] rounded-3xl -rotate-3 opacity-10"></div>
                            <img src="https://cdn3d.iconscout.com/3d/premium/thumb/check-list-3d-illustration-download-in-png-blend-fbx-gltf-file-formats--checklist-todo-business-pack-illustrations-3626704.png"
                                 alt="Digital Marketing Course"
                                 class="relative rounded-3xl shadow-xl w-full">
                        </div>
                    </div>
                    <div class="lg:w-1/3">
                        <div class="max-w-xl">
                            <div class="inline-flex items-center px-4 py-2 bg-[#6C63FF]/10 rounded-full mb-6">
                                <svg class="w-5 h-5 text-[#6C63FF] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                                </svg>
                                <span class="text-[#6C63FF] font-medium">Digital Marketing</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-6">Master Digital Marketing</h3>
                            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                Learn the latest digital marketing strategies and tools. From SEO to social media marketing, get the skills needed to grow your online presence.
                            </p>
                            <ul class="space-y-4 mb-10">
                                <li class="flex items-center text-gray-600">
                                    <span class="flex-shrink-0 w-6 h-6 bg-[#6C63FF]/10 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-4 h-4 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                    15+ Marketing Tools Covered
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <span class="flex-shrink-0 w-6 h-6 bg-[#6C63FF]/10 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-4 h-4 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                    Real-world Case Studies
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <span class="flex-shrink-0 w-6 h-6 bg-[#6C63FF]/10 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-4 h-4 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                    Industry Certification
                                </li>
                            </ul>
                            <div class="flex items-center gap-4">
                                <a href="#" class="inline-flex items-center px-8 py-4 text-white bg-[#6C63FF] rounded-xl hover:bg-[#5B54D9] transition-all transform hover:-translate-y-0.5">
                                    Explore Course
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>
                                <span class="text-gray-600">
                                    <span class="font-bold text-gray-900">$39.99</span> / month
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Cross-Platform Section -->
    <section class="py-2 bg-white animate-on-scroll" data-animation="fade-up">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-center gap-5">
                <div class="md:w-1/3">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Sync across all devices</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Whether you're on your phone, computer, or tablet, access your courses seamlessly with real-time synchronization.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#" class="flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.5 1.32-1.17 2.61-2.53 4.08zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.27 2.33-1.83 4.11-3.74 4.25z"/>
                            </svg>
                            iOS App
                        </a>
                        <a href="#" class="flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.523 15.384l5.664 5.664-2.139 2.139-5.664-5.664a10.5 10.5 0 112.139-2.139zm-3.523-.884a7.5 7.5 0 10-15 0 7.5 7.5 0 0015 0z"/>
                            </svg>
                            Android App
                        </a>
                    </div>
                </div>
                <div class="md:w-1/3">
                    <img src="https://png.pngtree.com/png-clipart/20240825/original/pngtree-laptop-device-3d-image-png-image_15848876.png" alt="Cross-platform devices" class="w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 bg-gradient-to-b from-white to-[#F5F5FF] animate-on-scroll" data-animation="fade-up">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Pengguna Menyukai 4TODO</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Bergabung dengan ribuan pengguna yang telah meningkatkan produktivitas mereka dengan fitur-fitur unggulan kami
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow animate-on-scroll stagger-1" data-animation="fade-left">
                    <div class="w-12 h-12 bg-[#6C63FF]/10 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Manajemen Tugas Cepat</h3>
                    <p class="text-gray-600">
                        Buat dan atur tugas dengan cepat. Fitur drag-and-drop intuitif dan shortcut keyboard membantu Anda tetap fokus pada pekerjaan.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow animate-on-scroll stagger-2" data-animation="fade-left">
                    <div class="w-12 h-12 bg-[#6C63FF]/10 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Prioritas & Kategori</h3>
                    <p class="text-gray-600">
                        Kelompokkan tugas berdasarkan prioritas dan kategori. Gunakan label warna dan tag untuk organisasi yang lebih baik.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow animate-on-scroll stagger-3" data-animation="fade-left">
                    <div class="w-12 h-12 bg-[#6C63FF]/10 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Analytic Views</h3>
                    <p class="text-gray-600">
                        Kami menampilkan Jumlah berdasarkan Retensi Analytic di halaman TodoSpace utama.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow animate-on-scroll stagger-4" data-animation="fade-left">
                    <div class="w-12 h-12 bg-[#6C63FF]/10 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Pengingat Pintar</h3>
                    <p class="text-gray-600">
                        Jangan lewatkan deadline dengan pengingat pintar. Sinkronisasi dengan kalender dan notifikasi yang dapat disesuaikan.
                    </p>
                </div>

                <!-- Card 5 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow animate-on-scroll stagger-5" data-animation="fade-left">
                    <div class="w-12 h-12 bg-[#6C63FF]/10 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Analisis Produktivitas</h3>
                    <p class="text-gray-600">
                        Pantau produktivitas Anda dengan grafik dan laporan terperinci. Identifikasi pola dan tingkatkan efisiensi kerja.
                    </p>
                </div>

                <!-- Card 6 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow animate-on-scroll stagger-1" data-animation="fade-left">
                    <div class="w-12 h-12 bg-[#6C63FF]/10 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Integrasi Lengkap</h3>
                    <p class="text-gray-600">
                        Integrasikan dengan aplikasi favorit Anda seperti Google Calendar, Slack, dan Microsoft Teams untuk alur kerja yang mulus.
                    </p>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center px-8 py-3 text-lg font-medium text-white bg-[#6C63FF] rounded-full hover:bg-[#5B54D9] transition-colors">
                    Mulai Gratis
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

     <!-- Testimonials Section -->
    <section class="py-20 bg-[#F5F5FF] animate-on-scroll" data-animation="fade-up">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-[#6C63FF] mb-4">Ulasan Pengguna Kami</h2>
                <p class="text-2xl font-bold text-gray-900">Lihat apa yang dikatakan pengguna tentang TodoList App</p>
            </div>

            <div class="max-w-6xl mx-auto">
                <!-- Grid container with masonry-like layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-auto">
                    <!-- Testimonial 1 - Large -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow md:col-span-2 animate-on-scroll stagger-1" data-animation="fade-left">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-1"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Budi Santoso</h4>
                                <p class="text-sm text-gray-600">Project Manager di TechCorp</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Aplikasi ini benar-benar mengubah cara tim kami mengelola proyek. Fitur kategorisasi dan prioritas tugas sangat membantu, plus kemampuan kolaborasi tim membuat produktivitas kami meningkat drastis. Interface-nya intuitif dan sinkronisasi di berbagai perangkat berjalan mulus. Sekarang jadi tools wajib untuk daily standup kami."
                        </p>
                    </div>

                    <!-- Testimonial 2 - Small -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow animate-on-scroll stagger-2" data-animation="fade-right">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-2"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Dewi Lestari</h4>
                                <p class="text-sm text-gray-600">Freelance Designer</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Akhirnya nemuin aplikasi todo list yang beneran membantu! Fitur pengingat berulang dan notifikasi pintar bikin saya nggak pernah telat deadline. Tampilannya juga clean, jadi tetap fokus sama yang penting."
                        </p>
                    </div>

                    <!-- Testimonial 3 - Small -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow animate-on-scroll stagger-3" data-animation="fade-left">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-3"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Rina Wijaya</h4>
                                <p class="text-sm text-gray-600">Mahasiswa UI</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Timer Pomodoro dan fitur kategorisasi tugas sangat membantu rutinitas belajar saya. Gampang tracking tugas kuliah dan jadwal belajar. Fitur habit tracking juga membantu bangun kebiasaan belajar yang lebih baik."
                        </p>
                    </div>

                    <!-- Testimonial 4 - Large -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow md:col-span-2 animate-on-scroll stagger-4" data-animation="fade-right">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-4"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Ahmad Faisal</h4>
                                <p class="text-sm text-gray-600">Pemilik UMKM</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Sebagai pemilik bisnis, saya harus handle banyak proyek setiap hari. Fitur prioritas tugas dan kolaborasi tim sangat membantu. Tag dan filter memudahkan sortir tugas, dan laporan analitik memberikan insight yang jelas tentang produktivitas tim kami."
                        </p>
                    </div>

                    <!-- Testimonial 5 - Large -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow md:col-span-2 animate-on-scroll stagger-5" data-animation="fade-left">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-5"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Siti Rahayu</h4>
                                <p class="text-sm text-gray-600">Digital Marketing Manager</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Integrasi kalender dan manajemen deadline sangat cocok untuk kampanye marketing kami. Mudah koordinasi berbagai proyek dan tracking deliverable. Kemampuan lampirkan file dan tambah komentar sangat membantu komunikasi tim."
                        </p>
                    </div>

                    <!-- Testimonial 6 - Small -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow animate-on-scroll stagger-1" data-animation="fade-left">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-6"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Rudi Hermawan</h4>
                                <p class="text-sm text-gray-600">Software Engineer</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Integrasi API dan shortcut keyboard bikin aplikasi ini jadi favorit developer. Bisa automate workflow dan sync dengan tools lain dengan mudah. Dark mode-nya enak di mata pas coding malam."
                        </p>
                    </div>

                    <!-- Additional Testimonials -->
                    <!-- Testimonial 7 - Small -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow animate-on-scroll stagger-2" data-animation="fade-right">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-7"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Anita Wijayanti</h4>
                                <p class="text-sm text-gray-600">Content Creator</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Sebagai content creator, jadwal konten harus teratur. TodoList App bantu saya track ide konten, jadwal posting, dan kolaborasi dengan tim. Fitur reminder-nya bener-bener bikin konsisten posting!"
                        </p>
                    </div>

                    <!-- Testimonial 8 - Large -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow md:col-span-2 animate-on-scroll stagger-3" data-animation="fade-left">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-8"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Bambang Kusumo</h4>
                                <p class="text-sm text-gray-600">Kepala Sekolah SMA Negeri</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "TodoList App membantu manajemen sekolah kami jadi lebih efisien. Dari jadwal rapat guru, agenda kegiatan sekolah, sampai monitoring tugas administrasi, semua jadi lebih terorganisir. Fitur berbagi tugas antarstaf sangat membantu koordinasi."
                        </p>
                    </div>

                    <!-- Testimonial 9 - Small -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow animate-on-scroll stagger-4" data-animation="fade-right">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-9"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Maya Putri</h4>
                                <p class="text-sm text-gray-600">Wedding Planner</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Perfect banget buat planning wedding! Bisa bikin checklist detail, share ke vendor-vendor, dan set deadline tiap milestone. Client juga bisa lihat progress langsung. Game changer buat bisnis wedding organizer!"
                        </p>
                    </div>

                    <!-- Testimonial 10 - Small -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow animate-on-scroll stagger-5" data-animation="fade-left">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-10"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Dimas Prayoga</h4>
                                <p class="text-sm text-gray-600">Personal Trainer</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Saya pakai buat tracking progress client fitness. Bisa set program latihan, jadwal konsultasi, dan reminder diet. Plus, clientnya juga bisa update progress langsung di app. Mantap!"
                        </p>
                    </div>



                    <!-- Testimonial 12 - Small -->
                    <div class="bg-white p-6 rounded-xl hover:shadow-lg transition-shadow animate-on-scroll stagger-2" data-animation="fade-left">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://source.unsplash.com/random/100x100?face-12"
                                 alt="User"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">Fajar Ramadhan</h4>
                                <p class="text-sm text-gray-600">Mahasiswa Kedokteran</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "TodoList App jadi asisten pribadi selama kuliah kedokteran. Bisa kategoriin tugas per mata kuliah, set jadwal praktikum, dan reminder ujian. Fitur attach file berguna banget buat nyimpen catatan kuliah!"
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

     <!-- FAQ Section -->
     <section class="py-24 bg-gradient-to-b from-[#F5F5FF] to-white animate-on-scroll" data-animation="fade-up">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="text-[#6C63FF] font-medium mb-4 block">FAQ</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Pertanyaan yang Sering Diajukan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Pertanyaan umum tentang platform manajemen tugas dan produktivitas kami
                </p>
            </div>

            <!-- FAQ Grid -->
            <div class="max-w-4xl mx-auto space-y-4">
                <!-- FAQ Item 1 -->
                <div class="group">
                    <button class="flex items-center justify-between w-full p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-4">
                            <span class="flex-shrink-0 w-10 h-10 bg-[#6C63FF]/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <span class="text-lg font-semibold text-gray-900">Bagaimana cara mengorganisir tugas di aplikasi ini?</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-[#6C63FF] transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="overflow-hidden transition-all duration-300 max-h-0 group-hover:max-h-96">
                        <div class="p-6 bg-white rounded-b-2xl">
                            <p class="text-gray-600">
                                Aplikasi kami menggunakan sistem daftar tugas yang intuitif dengan fitur tag dan tingkat prioritas. Anda dapat membuat beberapa daftar, mengatur tenggat waktu, menambahkan pengingat, dan menggunakan matriks Eisenhower untuk memprioritaskan tugas. Semua data tersinkronisasi secara real-time di semua perangkat Anda.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="group">
                    <button class="flex items-center justify-between w-full p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-4">
                            <span class="flex-shrink-0 w-10 h-10 bg-[#6C63FF]/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <span class="text-lg font-semibold text-gray-900">Apa saja pilihan berlangganan yang tersedia?</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-[#6C63FF] transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="overflow-hidden transition-all duration-300 max-h-0 group-hover:max-h-96">
                        <div class="p-6 bg-white rounded-b-2xl">
                            <p class="text-gray-600">
                                Kami menawarkan paket Gratis dengan fitur dasar, dan paket Premium seharga Rp 79.000/bulan dengan fitur lanjutan seperti tugas tak terbatas, lampiran file, dukungan prioritas, dan alat kolaborasi tim. Berlangganan tahunan mendapat diskon 2 bulan. Tersedia diskon khusus untuk pelajar dan tim.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="group">
                    <button class="flex items-center justify-between w-full p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-4">
                            <span class="flex-shrink-0 w-10 h-10 bg-[#6C63FF]/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </span>
                            <span class="text-lg font-semibold text-gray-900">Apakah data saya aman dan ter-backup?</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-[#6C63FF] transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="overflow-hidden transition-all duration-300 max-h-0 group-hover:max-h-96">
                        <div class="p-6 bg-white rounded-b-2xl">
                            <p class="text-gray-600">
                                Ya, kami sangat memperhatikan keamanan data. Semua tugas dan data Anda dienkripsi end-to-end dan disimpan di server cloud yang aman dengan backup rutin. Kami menggunakan enkripsi SSL standar industri dan mengikuti pedoman privasi yang ketat. Anda juga dapat mengekspor data Anda kapan saja.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="group">
                    <button class="flex items-center justify-between w-full p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-4">
                            <span class="flex-shrink-0 w-10 h-10 bg-[#6C63FF]/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                </svg>
                            </span>
                            <span class="text-lg font-semibold text-gray-900">Bisakah saya berkolaborasi dengan tim saya?</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-[#6C63FF] transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="overflow-hidden transition-all duration-300 max-h-0 group-hover:max-h-96">
                        <div class="p-6 bg-white rounded-b-2xl">
                            <p class="text-gray-600">
                                Tentu saja! Paket Premium kami mencakup fitur kolaborasi yang lengkap. Anda dapat berbagi daftar tugas, menugaskan pekerjaan, mengatur tenggat waktu tim, dan melacak kemajuan bersama. Anggota tim dapat memberikan komentar pada tugas, melampirkan file, dan menerima notifikasi. Cocok untuk tim kecil maupun organisasi besar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="text-center mt-12">
                <p class="text-gray-600 mb-4">Masih punya pertanyaan?</p>
                <a href="#" class="inline-flex items-center px-6 py-3 text-[#6C63FF] bg-[#6C63FF]/10 rounded-xl hover:bg-[#6C63FF] hover:text-white transition-all duration-200">
                    Hubungi Dukungan
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

      <!-- Newsletter Section -->
      <section class="py-12 md:py-24 bg-gradient-to-br from-[#6C63FF]/5 via-white to-[#6C63FF]/5">
        <div class="container mx-auto px-4 md:px-6">
            <div class="relative max-w-6xl mx-auto">
                <!-- Decorative Elements - Hidden on small mobile -->
                <div class="absolute -top-12 -left-12 w-24 h-24 bg-[#6C63FF]/10 rounded-full blur-2xl hidden sm:block"></div>
                <div class="absolute -bottom-12 -right-12 w-32 h-32 bg-[#6C63FF]/10 rounded-full blur-2xl hidden sm:block"></div>

                <!-- Main Content -->
                <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="p-6 md:p-12">
                        <!-- Content Grid -->
                        <div class="flex flex-col lg:flex-row items-center gap-8 md:gap-12">
                            <!-- Left Column - Text Content -->
                            <div class="w-full lg:w-1/2 text-center lg:text-left">
                                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                                    Dapatkan Tips Produktivitas Mingguan
                                </h2>
                                <p class="text-base md:text-lg text-gray-600 mb-6">
                                    Bergabunglah dengan ribuan pengguna 4ToDO untuk mendapatkan tips manajemen waktu, template tugas, dan pembaruan fitur terbaru.
                                </p>

                                <!-- Trust Badges - Grid on mobile, row on desktop -->
                                <div class="grid grid-cols-2 sm:flex gap-4 justify-center lg:justify-start mb-6">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span class="text-sm text-gray-600">Tips Produktivitas</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span class="text-sm text-gray-600">Template Gratis</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span class="text-sm text-gray-600">Update Fitur</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Form -->
                            <div class="w-full lg:w-1/2">
                                <form class="space-y-4">
                                    <!-- Name Input -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                        <input type="text"
                                               id="name"
                                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#6C63FF] focus:border-transparent transition-all"
                                               placeholder="Masukkan nama Anda">
                                    </div>

                                    <!-- Email Input -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                                        <input type="email"
                                               id="email"
                                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#6C63FF] focus:border-transparent transition-all"
                                               placeholder="Masukkan email Anda">
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit"
                                            class="w-full px-6 py-3 bg-[#6C63FF] text-white rounded-xl font-medium hover:bg-[#5B53E0] transform hover:-translate-y-0.5 transition-all duration-200">
                                        Berlangganan Newsletter
                                    </button>

                                    <!-- Privacy Notice -->
                                    <p class="text-xs text-center text-gray-500">
                                        Dengan berlangganan, Anda menyetujui
                                        <a href="#" class="text-[#6C63FF] hover:underline">Kebijakan Privasi</a>
                                        dan
                                        <a href="#" class="text-[#6C63FF] hover:underline">Ketentuan Layanan</a> kami
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Proof -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        Dipercaya oleh
                        <span class="font-semibold text-gray-700">15.000+</span>
                        pengguna aktif di Indonesia
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-gray-50">
        <!-- Main Footer -->
        <div class="py-12 border-b border-gray-200">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-5 gap-12">
                    <!-- Brand Column -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center gap-2 mb-6">
                            <span class="text-2xl font-bold text-gray-900">5</span>
                            <span class="text-sm text-gray-900">Minute<br>School</span>
                        </div>
                        <p class="text-gray-600 mb-8 max-w-md">
                            Transform your learning journey with bite-sized lessons. Join millions of learners worldwide who trust 5 Minute School for their educational needs.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="text-gray-400 hover:text-[#6C63FF] transition-colors">
                                <span class="sr-only">Facebook</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-[#6C63FF] transition-colors">
                                <span class="sr-only">Twitter</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-[#6C63FF] transition-colors">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Product Column -->
                    <div>
                        <h3 class="text-gray-900 font-semibold mb-6">Product</h3>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Features</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Pricing</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Integrations</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Updates</a></li>
                        </ul>
                    </div>

                    <!-- Company Column -->
                    <div>
                        <h3 class="text-gray-900 font-semibold mb-6">Company</h3>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">About</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Blog</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Careers</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Press</a></li>
                        </ul>
                    </div>

                    <!-- Support Column -->
                    <div>
                        <h3 class="text-gray-900 font-semibold mb-6">Support</h3>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Help Center</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Contact Us</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#6C63FF] transition-colors">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sub Footer -->
        <div class="py-6 bg-white">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-500 text-sm mb-4 md:mb-0">
                        © 2024 5 Minute School. All rights reserved.
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="#" class="text-gray-500 hover:text-[#6C63FF] text-sm transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-500 hover:text-[#6C63FF] text-sm transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-500 hover:text-[#6C63FF] text-sm transition-colors">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Add this script before closing body tag -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const card = document.getElementById('tilt-card');
        const container = card.parentElement;

        // Reduced tilt settings for more subtle effect
        const TILT_SETTINGS = {
            max: 5, // Reduced from 15 to 5 degrees
            perspective: 1500, // Increased for more subtle depth
            scale: 1.02, // Reduced from 1.05 for subtler scaling
            speed: 800, // Increased for smoother transition
            easing: "cubic-bezier(0.23, 1, 0.32, 1)" // Smoother easing
        };

        // Initialize start position
        let bounds = card.getBoundingClientRect();

        function updateTilt(e) {
            const mouseX = e.clientX;
            const mouseY = e.clientY;

            // Get position relative to card
            const xVal = (mouseX - bounds.x) / bounds.width;
            const yVal = (mouseY - bounds.y) / bounds.height;

            // Calculate rotation angles with dampening
            const tiltX = ((TILT_SETTINGS.max / 2 - (yVal * TILT_SETTINGS.max)) * 0.8).toFixed(2); // Added dampening factor
            const tiltY = (((xVal * TILT_SETTINGS.max) - TILT_SETTINGS.max / 2) * 0.8).toFixed(2); // Added dampening factor

            // Smoother transform with subtle movement
            requestAnimationFrame(() => {
                card.style.transform = `
                    perspective(${TILT_SETTINGS.perspective}px)
                    rotateX(${tiltX}deg)
                    rotateY(${tiltY}deg)
                    scale3d(${TILT_SETTINGS.scale},${TILT_SETTINGS.scale},${TILT_SETTINGS.scale})
                `;
            });
        }

        function resetTilt() {
            requestAnimationFrame(() => {
                card.style.transform = `
                    perspective(${TILT_SETTINGS.perspective}px)
                    rotateX(0deg)
                    rotateY(0deg)
                    scale3d(1,1,1)
                `;
            });
        }

        // Add event listeners with debounce for smoother performance
        let timeout;
        container.addEventListener('mousemove', (e) => {
            if (timeout) clearTimeout(timeout);
            timeout = setTimeout(() => updateTilt(e), 10);
        });

        container.addEventListener('mouseleave', resetTilt);

        // Update bounds on resize with debounce
        let resizeTimeout;
        window.addEventListener('resize', () => {
            if (resizeTimeout) clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                bounds = card.getBoundingClientRect();
            }, 100);
        });

        // Add smoother transition style
        card.style.transition = `transform ${TILT_SETTINGS.speed}ms ${TILT_SETTINGS.easing}`;
    });
    </script>
</body>
</html>
