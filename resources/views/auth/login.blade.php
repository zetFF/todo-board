<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
</style>

<body>
    <x-guest-layout>
        <!-- Main Container -->
        <div class="min-h-screen flex items-center justify-center bg-[#F5F5F5] p-6">
            <!-- Login Card Container -->
            <div class="bg-white rounded-[32px] shadow-xl w-full max-w-6xl flex overflow-hidden">

                <!-- Left Side - Content Section -->
                <div class="w-1/2 p-12 bg-[#6C63FF]  rounded-r-[32px] text-white hidden lg:block">
                    <!-- Brand Logo -->
                    <div class="mb-8">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl font-bold">5</span>
                            <span class="text-sm">Minute<br>School</span>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="mt-10">
                        <h1 class="text-2xl font-bold leading-tight mb-6">
                            Record your work activities <br> with ease and <br> structure.
                        </h1>

                        <!-- Illustration -->
                        <div class="relative mt-12">
                            <img src="https://cdn3d.iconscout.com/3d/premium/thumb/team-doing-schedule-management-3d-illustration-download-in-png-blend-fbx-gltf-file-formats--plan-time-infographic-pack-people-illustrations-10616234.png?f=webp"
                                alt="Learning Illustration" class=" max-w-md">
                        </div>
                    </div>
                </div>

                <!-- Right Side - Form Section -->
                <div class="w-full lg:w-1/2 p-12">
                    <!-- Language Selector -->
                    <div class="flex justify-end mb-12">
                        <div class="relative inline-block">
                            <button type="button"
                                class="inline-flex items-center justify-between w-44 px-4 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#6C63FF] focus:ring-opacity-20 transition-all duration-200"
                                onclick="document.getElementById('language-menu').classList.toggle('hidden')">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M2 12H22" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M12 2C14.5013 4.73835 15.9228 8.29203 16 12C15.9228 15.708 14.5013 19.2616 12 22C9.49872 19.2616 8.07725 15.708 8 12C8.07725 8.29203 9.49872 4.73835 12 2Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span>English (USA)</span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="language-menu"
                                class="hidden absolute right-0 mt-2 w-48 rounded-xl bg-white shadow-lg border border-gray-100 py-1 z-50">
                                <div class="max-h-60 overflow-y-auto">
                                    @foreach (['English (USA)', 'Español', 'Français', 'Deutsch', '日本語', '한국어', '中文'] as $language)
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#6C63FF] hover:text-white transition-colors duration-150">
                                            {{ $language }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Header -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800">Welcome Back</h2>
                    </div>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Form Fields -->
                        <div class="space-y-5">
                            <!-- Email Input -->
                            <div>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-3.5 rounded-full text-gray-800 bg-gray-50 border-transparent focus:border-[#6C63FF] focus:ring-2 focus:ring-[#6C63FF] focus:ring-opacity-20 focus:bg-white transition-all duration-200"
                                    placeholder="Email Address" required>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password Input -->
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="w-full px-4 py-3.5 rounded-full text-gray-800 bg-gray-50 border-transparent focus:border-[#6C63FF] focus:ring-2 focus:ring-[#6C63FF] focus:ring-opacity-20 focus:bg-white transition-all duration-200"
                                    placeholder="Password" required>
                                <button type="button"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between mt-6">


                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-[#6C63FF] hover:underline">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-[#6C63FF] text-white py-3.5 rounded-full font-medium hover:bg-[#5B53E0] transform hover:-translate-y-0.5 transition-all duration-200">
                            Sign In
                        </button>

                        <!-- Social Sign In -->
                        <div class="mt-8">
                            <p class="text-center text-sm text-gray-500 mb-4">Or Sign In With</p>
                            <div class="flex justify-center items-center space-x-4">
                                <!-- Google -->
                                <a href="#" class="p-2 hover:opacity-80 transition-opacity duration-200">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.8055 10.0415H21V10H12V14H17.6515C16.827 16.3285 14.6115 18 12 18C8.6865 18 6 15.3135 6 12C6 8.6865 8.6865 6 12 6C13.5295 6 14.921 6.577 15.9805 7.5195L18.809 4.691C17.023 3.0265 14.634 2 12 2C6.4775 2 2 6.4775 2 12C2 17.5225 6.4775 22 12 22C17.5225 22 22 17.5225 22 12C22 11.3295 21.931 10.675 21.8055 10.0415Z"
                                            fill="#FFC107" />
                                        <path
                                            d="M3.15302 7.3455L6.43852 9.755C7.32752 7.554 9.48052 6 12 6C13.5295 6 14.921 6.577 15.9805 7.5195L18.809 4.691C17.023 3.0265 14.634 2 12 2C8.15902 2 4.82802 4.1685 3.15302 7.3455Z"
                                            fill="#FF3D00" />
                                        <path
                                            d="M12 22C14.583 22 16.93 21.0115 18.7045 19.404L15.6095 16.785C14.5718 17.5742 13.3038 18.001 12 18C9.39897 18 7.19047 16.3415 6.35847 14.027L3.09747 16.5395C4.75247 19.778 8.11347 22 12 22Z"
                                            fill="#4CAF50" />
                                        <path
                                            d="M21.8055 10.0415H21V10H12V14H17.6515C17.2571 15.1082 16.5467 16.0766 15.608 16.7855L15.6095 16.785L18.7045 19.404C18.4855 19.6025 22 17 22 12C22 11.3295 21.931 10.675 21.8055 10.0415Z"
                                            fill="#1976D2" />
                                    </svg>
                                </a>

                                <!-- Facebook -->
                                <a href="#" class="p-2 hover:opacity-80 transition-opacity duration-200">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 17.9895 4.3882 22.954 10.125 23.8542V15.4688H7.07812V12H10.125V9.35625C10.125 6.34875 11.9166 4.6875 14.6576 4.6875C15.9701 4.6875 17.3438 4.92188 17.3438 4.92188V7.875H15.8306C14.34 7.875 13.875 8.80008 13.875 9.75V12H17.2031L16.6711 15.4688H13.875V23.8542C19.6118 22.954 24 17.9895 24 12Z"
                                            fill="#1877F2" />
                                        <path
                                            d="M16.6711 15.4688L17.2031 12H13.875V9.75C13.875 8.80102 14.34 7.875 15.8306 7.875H17.3438V4.92188C17.3438 4.92188 15.9701 4.6875 14.6576 4.6875C11.9166 4.6875 10.125 6.34875 10.125 9.35625V12H7.07812V15.4688H10.125V23.8542C11.3674 24.0486 12.6326 24.0486 13.875 23.8542V15.4688H16.6711Z"
                                            fill="white" />
                                    </svg>
                                </a>

                                <!-- Instagram -->
                                <a href="#" class="p-2 hover:opacity-80 transition-opacity duration-200">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 2C14.717 2 15.056 2.01 16.122 2.06C17.187 2.11 17.912 2.277 18.55 2.525C19.21 2.779 19.766 3.123 20.322 3.678C20.8305 4.1779 21.224 4.78259 21.475 5.45C21.722 6.087 21.89 6.813 21.94 7.878C21.987 8.944 22 9.283 22 12C22 14.717 21.99 15.056 21.94 16.122C21.89 17.187 21.722 17.912 21.475 18.55C21.2247 19.2178 20.8311 19.8226 20.322 20.322C19.822 20.8303 19.2173 21.2238 18.55 21.475C17.913 21.722 17.187 21.89 16.122 21.94C15.056 21.987 14.717 22 12 22C9.283 22 8.944 21.99 7.878 21.94C6.813 21.89 6.088 21.722 5.45 21.475C4.78233 21.2245 4.17753 20.8309 3.678 20.322C3.16941 19.8222 2.77593 19.2175 2.525 18.55C2.277 17.913 2.11 17.187 2.06 16.122C2.013 15.056 2 14.717 2 12C2 9.283 2.01 8.944 2.06 7.878C2.11 6.812 2.277 6.088 2.525 5.45C2.77524 4.78218 3.1688 4.17732 3.678 3.678C4.17767 3.16923 4.78243 2.77573 5.45 2.525C6.088 2.277 6.812 2.11 7.878 2.06C8.944 2.013 9.283 2 12 2Z"
                                            fill="url(#paint0_radial_87_7153)" />
                                        <path
                                            d="M12 2C14.717 2 15.056 2.01 16.122 2.06C17.187 2.11 17.912 2.277 18.55 2.525C19.21 2.779 19.766 3.123 20.322 3.678C20.8305 4.1779 21.224 4.78259 21.475 5.45C21.722 6.087 21.89 6.813 21.94 7.878C21.987 8.944 22 9.283 22 12C22 14.717 21.99 15.056 21.94 16.122C21.89 17.187 21.722 17.912 21.475 18.55C21.2247 19.2178 20.8311 19.8226 20.322 20.322C19.822 20.8303 19.2173 21.2238 18.55 21.475C17.913 21.722 17.187 21.89 16.122 21.94C15.056 21.987 14.717 22 12 22C9.283 22 8.944 21.99 7.878 21.94C6.813 21.89 6.088 21.722 5.45 21.475C4.78233 21.2245 4.17753 20.8309 3.678 20.322C3.16941 19.8222 2.77593 19.2175 2.525 18.55C2.277 17.913 2.11 17.187 2.06 16.122C2.013 15.056 2 14.717 2 12C2 9.283 2.01 8.944 2.06 7.878C2.11 6.812 2.277 6.088 2.525 5.45C2.77524 4.78218 3.1688 4.17732 3.678 3.678C4.17767 3.16923 4.78243 2.77573 5.45 2.525C6.088 2.277 6.812 2.11 7.878 2.06C8.944 2.013 9.283 2 12 2Z"
                                            fill="url(#paint1_radial_87_7153)" />
                                        <path
                                            d="M11.9999 15.3308C13.8409 15.3308 15.3307 13.841 15.3307 12C15.3307 10.159 13.8409 8.66919 11.9999 8.66919C10.1589 8.66919 8.66907 10.159 8.66907 12C8.66907 13.841 10.1589 15.3308 11.9999 15.3308Z"
                                            fill="white" />
                                        <path
                                            d="M16.3338 7.84615C16.3338 8.32265 15.9487 8.70775 15.4722 8.70775C14.9957 8.70775 14.6106 8.32265 14.6106 7.84615C14.6106 7.36965 14.9957 6.98455 15.4722 6.98455C15.9487 6.98455 16.3338 7.36965 16.3338 7.84615Z"
                                            fill="white" />
                                        <defs>
                                            <radialGradient id="paint0_radial_87_7153" cx="0" cy="0"
                                                r="1" gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(6.375 21.7222) rotate(-90) scale(19.8215 18.4355)">
                                                <stop stop-color="#FFDD55" />
                                                <stop offset="0.1" stop-color="#FFDD55" />
                                                <stop offset="0.5" stop-color="#FF543E" />
                                                <stop offset="1" stop-color="#C837AB" />
                                            </radialGradient>
                                            <radialGradient id="paint1_radial_87_7153" cx="0" cy="0"
                                                r="1" gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(-4.02133 3.24375) rotate(78.681) scale(8.86031 36.5225)">
                                                <stop stop-color="#3771C8" />
                                                <stop offset="0.128" stop-color="#3771C8" />
                                                <stop offset="1" stop-color="#6600FF" stop-opacity="0" />
                                            </radialGradient>
                                        </defs>
                                    </svg>
                                </a>

                                <!-- Twitter -->
                                <a href="#" class="p-2 hover:opacity-80 transition-opacity duration-200">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.633 7.997C19.646 8.172 19.646 8.346 19.646 8.52C19.646 13.845 15.593 19.981 8.186 19.981C5.904 19.981 3.784 19.32 2 18.172C2.324 18.209 2.636 18.222 2.973 18.222C4.856 18.222 6.589 17.586 7.974 16.501C6.203 16.464 4.719 15.304 4.207 13.708C4.456 13.745 4.706 13.77 4.968 13.77C5.329 13.77 5.692 13.72 6.029 13.633C4.182 13.259 2.799 11.638 2.799 9.68V9.63C3.336 9.929 3.959 10.116 4.619 10.141C3.534 9.419 2.823 8.184 2.823 6.787C2.823 6.039 3.022 5.353 3.371 4.755C5.354 7.198 8.335 8.795 11.677 8.97C11.615 8.67 11.577 8.359 11.577 8.047C11.577 5.834 13.373 4.039 15.585 4.039C16.735 4.039 17.782 4.517 18.523 5.292C19.441 5.125 20.32 4.797 21.097 4.382C20.798 5.251 20.156 5.984 19.317 6.468C20.131 6.379 20.92 6.15 21.645 5.858C21.099 6.614 20.424 7.284 19.633 7.997Z"
                                            fill="#1DA1F2" />
                                    </svg>
                                </a>

                                <!-- LinkedIn -->
                                <a href="#" class="p-2 hover:opacity-80 transition-opacity duration-200">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.447 20.452H16.893V14.883C16.893 13.555 16.866 11.846 15.041 11.846C13.188 11.846 12.905 13.291 12.905 14.785V20.452H9.351V9H12.765V10.561H12.811C13.288 9.661 14.448 8.711 16.181 8.711C19.782 8.711 20.448 11.081 20.448 14.166V20.452H20.447ZM5.337 7.433C4.193 7.433 3.274 6.507 3.274 5.368C3.274 4.23 4.194 3.305 5.337 3.305C6.477 3.305 7.401 4.23 7.401 5.368C7.401 6.507 6.476 7.433 5.337 7.433ZM7.119 20.452H3.555V9H7.119V20.452ZM22.225 0H1.771C0.792 0 0 0.774 0 1.729V22.271C0 23.227 0.792 24 1.771 24H22.222C23.2 24 24 23.227 24 22.271V1.729C24 0.774 23.2 0 22.222 0H22.225Z"
                                            fill="#0077B5" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Register Link -->
                        <p class="text-center text-sm text-gray-500 mt-8">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-[#6C63FF] hover:underline">Sign Up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </x-guest-layout>

</body>

</html>
