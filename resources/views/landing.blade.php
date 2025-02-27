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
    </style>
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
    <section id="home" class="pt-32 pb-20 bg-gradient-to-b from-[#F5F5FF] to-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <!-- Left Content -->
                <div class="lg:w-1/2 space-y-8">
                    <h1 class="text-5xl font-bold leading-tight text-gray-900">
                        Learn From World's Best Instructors Around The World
                    </h1>
                    <p class="text-lg text-gray-600">
                        Join millions of learners from around the world already learning on 5 Minute School. 
                        Find the right instructor for you.
                    </p>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('register') }}" 
                           class="px-8 py-3 bg-[#6C63FF] text-white rounded-full font-medium hover:bg-[#5B53E0] transform hover:-translate-y-0.5 transition-all duration-200">
                            Start Learning Now
                        </a>
                        <a href="#courses" 
                           class="px-8 py-3 border border-[#6C63FF] text-[#6C63FF] rounded-full font-medium hover:bg-[#6C63FF] hover:text-white transition-all duration-200">
                            View Courses
                        </a>
                    </div>
                    <!-- Stats -->
                    <div class="flex items-center space-x-12 pt-8">
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900">15K+</h3>
                            <p class="text-gray-600">Active Students</p>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900">10K+</h3>
                            <p class="text-gray-600">Total Courses</p>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900">250+</h3>
                            <p class="text-gray-600">Expert Instructors</p>
                        </div>
                    </div>
                </div>
                <!-- Right Image -->
                <div class="lg:w-1/2">
                    <img src="{{ asset('images/hero-illustration.svg') }}" 
                         alt="Learning Illustration" 
                         class="w-full max-w-2xl mx-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose 5 Minute School?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    We provide the best features to make your learning journey easier and more effective
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-2xl bg-[#F8F9FF] hover:shadow-lg transition-shadow duration-200">
                    <div class="w-14 h-14 bg-[#6C63FF]/10 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Expert Instructors</h3>
                    <p class="text-gray-600">Learn from industry experts who have hands-on experience in their fields</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-2xl bg-[#F8F9FF] hover:shadow-lg transition-shadow duration-200">
                    <div class="w-14 h-14 bg-[#6C63FF]/10 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Quality Content</h3>
                    <p class="text-gray-600">Access high-quality video lessons, resources, and learning materials</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-2xl bg-[#F8F9FF] hover:shadow-lg transition-shadow duration-200">
                    <div class="w-14 h-14 bg-[#6C63FF]/10 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[#6C63FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Learn at Your Pace</h3>
                    <p class="text-gray-600">Study at your own schedule with lifetime access to course content</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Courses Section -->
    <section id="courses" class="py-20 bg-[#F5F5FF]">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Popular Courses</h2>
                    <p class="text-gray-600">Explore our most enrolled and highly rated courses</p>
                </div>
                <a href="#" class="text-[#6C63FF] font-medium hover:text-[#5B53E0] transition-colors">
                    View All Courses →
                </a>
            </div>
            <!-- Course Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Course Cards will be here -->
            </div>
        </div>
    </section>

    <!-- Instructors Section -->
    <section id="instructors" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Meet Our Expert Instructors</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Learn from industry experts who share their knowledge and real-world experiences
                </p>
            </div>
            
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Instructor Card 1 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-xl mb-4">
                        <img src="https://source.unsplash.com/random/400x400?teacher" alt="Instructor" class="w-full aspect-square object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                            <div class="p-4 w-full">
                                <div class="flex justify-center space-x-3">
                                    <a href="#" class="text-white hover:text-[#6C63FF]">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                                    </a>
                                    <a href="#" class="text-white hover:text-[#6C63FF]">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h4 class="text-lg font-semibold text-gray-900">Sarah Johnson</h4>
                        <p class="text-sm text-gray-600">UI/UX Design Expert</p>
                    </div>
                </div>
                
                <!-- More instructor cards... -->
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-[#F5F5FF]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">What Our Students Say</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Discover how 5 Minute School has helped students achieve their learning goals
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="https://source.unsplash.com/random/100x100?person" alt="Student" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-semibold text-gray-900">Alex Thompson</h4>
                            <p class="text-sm text-gray-600">Web Developer</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">
                        "The courses here are incredible! I've learned more in 3 months than I did in a year of self-study. The instructors are knowledgeable and the content is well-structured."
                    </p>
                    <div class="flex items-center gap-1 text-yellow-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                </div>
                <!-- More testimonials... -->
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto bg-[#6C63FF] rounded-2xl p-12 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Stay Updated with Our Newsletter</h2>
                <p class="text-white/80 mb-8">Get the latest updates about new courses and features</p>
                <form class="flex max-w-md mx-auto">
                    <input 
                        type="email" 
                        placeholder="Enter your email" 
                        class="flex-1 px-6 py-3 rounded-l-full focus:outline-none focus:ring-2 focus:ring-white/20"
                    >
                    <button 
                        type="submit"
                        class="px-8 py-3 bg-white text-[#6C63FF] rounded-r-full font-medium hover:bg-gray-100 transition-colors"
                    >
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-[#F5F5FF]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Find answers to common questions about our platform
                </p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <!-- FAQ Item -->
                <div class="bg-white rounded-xl">
                    <button class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="font-semibold text-gray-900">How do I get started?</span>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="px-6 pb-4">
                        <p class="text-gray-600">
                            Getting started is easy! Simply create an account, browse our course catalog, and enroll in any course that interests you. You'll get immediate access to the course content.
                        </p>
                    </div>
                </div>
                <!-- More FAQ items... -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-white">5</span>
                        <span class="text-sm">Minute<br>School</span>
                    </div>
                    <p class="text-gray-400">
                        Learn from the world's best instructors at your own pace.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Courses</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Instructors</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400">support@5minuteschool.com</li>
                        <li class="text-gray-400">+1 (555) 123-4567</li>
                    </ul>
                </div>

                <!-- Social Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0-.795-.646-1.44-1.44-1.44-.795 0-1.44.646-1.44 1.44 0 .794.646 1.439 1.44 1.439.793-.001 1.44-.645 1.44-1.439z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>© 2024 5 Minute School. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html> 