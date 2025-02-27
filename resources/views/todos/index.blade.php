<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4TODO Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .dashboard-card {
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
    <!-- Di bagian head atau sebelum </body> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50" x-data="{ 
    showCreateModal: false, 
    showEditModal: false,
    showDeleteModal: false,
    deletingTodo: null,
    editingTodo: null,
    initializePickers() {
        setTimeout(() => {
            flatpickr('.datepicker', {
                dateFormat: 'Y-m-d'
            });
            flatpickr('.timepicker', {
                enableTime: true,
                noCalendar: true,
                dateFormat: 'H:i',
                time_24hr: true
            });
        }, 100);
    }
}">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-[#0A192F] text-white">
        <!-- Logo/Brand -->
        <div class="border-gray-200 border-b  border-neutral-700">
            <h1 class="text-3xl font-bold text-center mt-11 mb-10 ">4TO<span class="text-indigo-600">DO</span></h1>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-6 space-y-4">
            <!-- Dashboard Link -->
            <a href="{{ route('todos.index') }}" 
               class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200 
               {{ !request('view') ? 'bg-gray-100' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <!-- Today's Tasks -->
            <a href="{{ route('todos.index', ['due' => 'today']) }}" 
               class="flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200 
               {{ request('due') === 'today' ? 'bg-gray-100' : '' }}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Today's Tasks
                </div>
                <span class="px-2 py-1 text-xs font-medium bg-indigo-50 text-indigo-600 rounded-full">
                    {{ $todos->where('due_date', today()->format('Y-m-d'))->count() }}
                </span>
            </a>

            <!-- Upcoming Tasks -->
            <a href="{{ route('todos.index', ['due' => 'upcoming']) }}" 
               class="flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200 
               {{ request('due') === 'upcoming' ? 'bg-gray-100' : '' }}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Upcoming
                </div>
                <span class="px-2 py-1 text-xs font-medium bg-indigo-50 text-indigo-600 rounded-full">
                    {{ $todos->where('due_date', '>', today()->format('Y-m-d'))->count() }}
                </span>
            </a>

            <!-- Completed Tasks -->
            <a href="{{ route('todos.index', ['completed' => 'true']) }}" 
               class="flex items-center justify-between px-4 py-3 text-white hover:bg-[#1A2942] rounded-lg transition-colors duration-200 
               {{ request('completed') === 'true' ? 'bg-[#1A2942]' : '' }}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Completed
                </div>
                <span class="px-2 py-1 text-xs font-medium bg-green-50 text-green-600 rounded-full">
                    {{ $todos->where('completed', true)->count() }}
                </span>
            </a>

            <!-- Tasks Menu with Submenu -->
            <div x-data="{ 
                open: {{ request('priority') ? 'true' : 'false' }} 
            }">
                <button @click="open = !open" 
                        class="flex items-center justify-between w-full px-4 py-3 text-white hover:bg-[#1A2942] rounded-lg transition-colors duration-200"
                        :class="{ 'bg-[#1A2942]': open }">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Tasks
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" 
                         :class="{ 'rotate-180': open }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <!-- Submenu -->
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="pl-2 pr-4 py-2 space-y-2">
                    <a href="{{ route('todos.index') }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-300 hover:text-[#40E0D0] hover:bg-[#1A2942] rounded-lg transition-colors duration-200 
                       {{ !request('priority') ? 'bg-[#1A2942] text-[#40E0D0]' : '' }}">
                        <span class="w-2 h-2 rounded-full bg-gray-400 mr-3"></span>
                        All Tasks
                    </a>
                    <a href="{{ route('todos.index', ['priority' => 'high']) }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-300 hover:text-[#FF2E63] hover:bg-[#1A2942] rounded-lg transition-colors duration-200 
                       {{ request('priority') === 'high' ? 'bg-[#1A2942] text-[#FF2E63]' : '' }}">
                        <span class="w-2 h-2 rounded-full bg-red-500 mr-3"></span>
                        High Priority
                    </a>
                    <a href="{{ route('todos.index', ['priority' => 'medium']) }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-300 hover:text-[#FFA41B] hover:bg-[#1A2942] rounded-lg transition-colors duration-200 
                       {{ request('priority') === 'medium' ? 'bg-[#1A2942] text-[#FFA41B]' : '' }}">
                        <span class="w-2 h-2 rounded-full bg-yellow-500 mr-3"></span>
                        Medium Priority
                    </a>
                    <a href="{{ route('todos.index', ['priority' => 'low']) }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-300 hover:text-[#40E0D0] hover:bg-[#1A2942] rounded-lg transition-colors duration-200 
                       {{ request('priority') === 'low' ? 'bg-[#1A2942] text-[#40E0D0]' : '' }}">
                        <span class="w-2 h-2 rounded-full bg-green-500 mr-3"></span>
                        Low Priority
                    </a>
                </div>
            </div>

            <!-- Categories Menu -->
            <div x-data="{ open: {{ request('category') ? 'true' : 'false' }} }" class="mb-4">
                <button @click="open = !open" 
                        class="flex items-center justify-between w-full px-4 py-3 text-white hover:bg-[#1A2942] rounded-lg transition-colors duration-200"
                        :class="{ 'bg-[#1A2942]': open }">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Categories
                    </div>
                    <div class="flex items-center">
                        <span class="text-xs text-gray-500 mr-2">{{ array_sum($categoryStats) }}</span>
                        <svg class="w-4 h-4 transition-transform duration-200" 
                             :class="{ 'rotate-180': open }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button>
                
                <!-- Categories Submenu -->
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="pl-12 pr-4 py-2 space-y-2">
                    <a href="{{ route('todos.index', ['category' => 'personal']) }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-200 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-colors duration-200 {{ request('category') === 'personal' ? 'bg-purple-50 text-purple-600' : '' }}">
                        <span class="w-2 h-2 rounded-full bg-purple-500 mr-3"></span>
                        <div class="flex items-center justify-between w-full">
                            <span>Personal</span>
                            <span class="text-xs {{ request('category') === 'personal' ? 'text-purple-600' : 'text-gray-400' }}">
                                {{ $categoryStats['personal'] }}
                            </span>
                        </div>
                    </a>
                    <a href="{{ route('todos.index', ['category' => 'work']) }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-200 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200 {{ request('category') === 'work' ? 'bg-blue-50 text-blue-600' : '' }}">
                        <span class="w-2 h-2 rounded-full bg-blue-500 mr-3"></span>
                        <div class="flex items-center justify-between w-full">
                            <span>Work</span>
                            <span class="text-xs {{ request('category') === 'work' ? 'text-blue-600' : 'text-gray-400' }}">
                                {{ $categoryStats['work'] }}
                            </span>
                        </div>
                    </a>
                    <a href="{{ route('todos.index', ['category' => 'shopping']) }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-200 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-colors duration-200 {{ request('category') === 'shopping' ? 'bg-pink-50 text-pink-600' : '' }}">
                        <span class="w-2 h-2 rounded-full bg-pink-500 mr-3"></span>
                        <div class="flex items-center justify-between w-full">
                            <span>Shopping</span>
                            <span class="text-xs {{ request('category') === 'shopping' ? 'text-pink-600' : 'text-gray-400' }}">
                                {{ $categoryStats['shopping'] }}
                            </span>
                        </div>
                    </a>
                    <a href="{{ route('todos.index', ['category' => 'others']) }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-200 hover:text-gray-600 hover:bg-gray-50 rounded-lg transition-colors duration-200 {{ request('category') === 'others' ? 'bg-gray-100 text-gray-600' : '' }}">
                        <span class="w-2 h-2 rounded-full bg-gray-500 mr-3"></span>
                        <div class="flex items-center justify-between w-full">
                            <span>Others</span>
                            <span class="text-xs {{ request('category') === 'others' ? 'text-gray-600' : 'text-gray-400' }}">
                                {{ $categoryStats['others'] }}
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Reports -->
       
        </nav>        
    </div>

    <!-- Main Content -->
    <div class="ml-64 bg-neutral-50">
        <!-- Sticky Header Section -->
        <div class="sticky top-0 z-10">
            <div class="bg-gradient-to-r from-[#0A192F] via-[#FF2E63] to-[#40E0D0] p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Welcome Back! 👋</h1>
                        <p class="text-gray-100 mt-1">Here's your todo list for today</p>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <!-- Search Component -->
                        <div class="relative flex-1 md:min-w-[300px]">
                            <form action="{{ route('todos.index') }}" method="GET">
                                <div class="relative">
                                    <input type="text" 
                                           name="search" 
                                           placeholder="Search tasks..."
                                           value="{{ request('search') }}"
                                           class="w-full pl-11 pr-4 py-3 bg-white/90 backdrop-blur-sm border border-white/20 rounded-xl focus:ring-2 focus:ring-[#40E0D0] focus:border-[#40E0D0] transition-all duration-200 placeholder-gray-400">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Create Task Button -->
                        <button @click="showCreateModal = true" 
                                class="inline-flex items-center px-4 py-3 bg-[#FFA41B] text-white rounded-xl hover:bg-[#FF2E63] focus:ring-2 focus:ring-[#40E0D0] focus:ring-offset-2 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Task
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filter Tags (if any) -->
            <div class="bg-gray-50  border-gray-200 px-8 py-3">
                <div class="flex flex-wrap gap-2">
                    @if(request('priority'))
                    <div class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-sm">
                        <span class="text-gray-600">Priority: </span>
                        <span class="ml-1.5 font-medium {{ 
                            request('priority') === 'high' ? 'text-[#FF2E63]' : 
                            (request('priority') === 'medium' ? 'text-[#FFA41B]' : 'text-[#40E0D0]') 
                        }}">{{ ucfirst(request('priority')) }}</span>
                        <a href="{{ route('todos.index', request()->except('priority')) }}" 
                           class="ml-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                    @endif
                    @if(request('category'))
                    <div class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-sm">
                        <span class="text-gray-600">Category: </span>
                        <span class="ml-1.5 font-medium {{ 
                            request('category') === 'personal' ? 'text-purple-600' : 
                            (request('category') === 'work' ? 'text-blue-600' : 
                            (request('category') === 'shopping' ? 'text-pink-600' : 'text-gray-600'))
                        }}">{{ ucfirst(request('category')) }}</span>
                        <a href="{{ route('todos.index', request()->except('category')) }}" 
                           class="ml-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                    @endif
                    @if(request('search'))
                    <div class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-sm">
                        <span class="text-gray-600">Search: </span>
                        <span class="ml-1.5 font-medium text-indigo-600">{{ request('search') }}</span>
                        <a href="{{ route('todos.index', request()->except('search')) }}" 
                           class="ml-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content Area with Padding -->
        <div class="p-8 pt-4">
            <!-- Main Content with Sidebar Layout -->
            <div class="flex flex-col lg:flex-row gap-6 relative">
                <!-- Main Content Area (Todo Cards) with Independent Scroll -->
                <div class="flex-1">
                    @if(!request('view'))
                        <!-- Scrollable Container for Todo Cards -->
                        <div class="h-[calc(100vh-12rem)] overflow-y-auto pr-4">
                            <!-- Existing Todo Cards Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                                @foreach($todos as $todo)
                                    <div x-data="{ 
                                        show: false,
                                        expanded: false,
                                        isLongText: false,
                                        description: '{{ $todo->description }}',
                                        init() {
                                            this.isLongText = this.description.length > 100;
                                        }
                                    }"
                                         x-init="setTimeout(() => show = true, {{ $loop->index * 100 }})"
                                         x-show="show"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0 transform -translate-y-4"
                                         x-transition:enter-end="opacity-100 transform translate-y-0"
                                         class="bg-white rounded-xl shadow-sm border border-gray-100 hover:border-[#40E0D0] transition-all duration-200">
                                        <div class="p-6">
                                            <!-- Task Header -->
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center gap-3">
                                                    <!-- Completed Toggle Button -->
                                                    <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" 
                                                                class="flex items-center justify-center w-6 h-6 rounded-full border-2 
                                                                {{ $todo->completed 
                                                                    ? 'bg-green-500 border-green-500 hover:bg-green-600' 
                                                                    : 'border-gray-300 hover:border-green-500' }} 
                                                                transition-colors duration-200">
                                                            @if($todo->completed)
                                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" 
                                                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" 
                                                                          clip-rule="evenodd"/>
                                                                </svg>
                                                            @endif
                                                        </button>
                                                    </form>

                                                    <!-- Priority Badge -->
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        {{ $todo->priority === 'high' ? 'bg-[#FF2E63]/10 text-[#FF2E63]' : '' }}
                                                        {{ $todo->priority === 'medium' ? 'bg-[#FFA41B]/10 text-[#FFA41B]' : '' }}
                                                        {{ $todo->priority === 'low' ? 'bg-[#40E0D0]/10 text-[#40E0D0]' : '' }}">
                                                        {{ ucfirst($todo->priority) }}
                                                    </span>
                                                </div>

                                                <!-- Action Buttons -->
                                                <div class="flex items-center gap-2">
                                                    <button @click="editingTodo = {{ $todo->toJson() }}; showEditModal = true" 
                                                            class="text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </button>
                                                    <button @click="deletingTodo = {{ $todo->toJson() }}; showDeleteModal = true" 
                                                            class="text-gray-400 hover:text-red-600 transition-colors duration-200">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Task Content -->
                                            <div class="mb-4">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-1 
                                                    {{ $todo->completed ? 'line-through text-gray-400' : '' }}">
                                                    {{ $todo->title }}
                                                </h3>
                                                <div class="relative">
                                                    <div x-show="!expanded && isLongText" 
                                                         x-transition:enter="transition-opacity ease-out duration-300"
                                                         x-transition:enter-start="opacity-0"
                                                         x-transition:enter-end="opacity-100"
                                                         x-transition:leave="transition-opacity ease-in duration-200"
                                                         x-transition:leave-start="opacity-100"
                                                         x-transition:leave-end="opacity-0"
                                                         class="absolute bottom-0 w-full h-12 bg-gradient-to-t from-white to-transparent">
                                                    </div>
                                                    <div x-show="expanded || !isLongText"
                                                         x-transition:enter="transition ease-out duration-300"
                                                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                                                         x-transition:enter-end="opacity-100 transform translate-y-0"
                                                         x-transition:leave="transition ease-in duration-200"
                                                         x-transition:leave-start="opacity-100 transform translate-y-0"
                                                         x-transition:leave-end="opacity-0 transform -translate-y-2">
                                                        <p class="text-gray-600 {{ $todo->completed ? 'line-through text-gray-400' : '' }}">
                                                            {{ $todo->description }}
                                                        </p>
                                                    </div>
                                                    <div x-show="!expanded && isLongText"
                                                         x-transition:enter="transition ease-out duration-300"
                                                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                                                         x-transition:enter-end="opacity-100 transform translate-y-0"
                                                         x-transition:leave="transition ease-in duration-200"
                                                         x-transition:leave-start="opacity-100 transform translate-y-0"
                                                         x-transition:leave-end="opacity-0 transform -translate-y-2">
                                                        <p class="text-gray-600 line-clamp-2 {{ $todo->completed ? 'line-through text-gray-400' : '' }}">
                                                            {{ $todo->description }}
                                                        </p>
                                                    </div>
                                                    <template x-if="isLongText">
                                                        <div class="mt-2">
                                                            <button 
                                                                @click="expanded = !expanded"
                                                                class="text-sm text-[#40E0D0] hover:text-[#FF2E63] transition-all duration-200 flex items-center gap-1 group"
                                                            >
                                                                <span x-text="expanded ? 'Show Less' : 'Show More'"
                                                                      class="relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-px after:bg-current after:origin-left after:scale-x-0 group-hover:after:scale-x-100 after:transition-transform after:duration-200">
                                                                </span>
                                                                <svg 
                                                                    class="w-4 h-4 transition-transform duration-300"
                                                                    :class="{ 'rotate-180': expanded }"
                                                                    fill="none" 
                                                                    stroke="currentColor" 
                                                                    viewBox="0 0 24 24"
                                                                >
                                                                    <path 
                                                                        stroke-linecap="round" 
                                                                        stroke-linejoin="round" 
                                                                        stroke-width="2" 
                                                                        d="M19 9l-7 7-7-7"
                                                                    />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>

                                            <!-- Task Footer -->
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $todo->category === 'personal' ? 'bg-purple-100 text-purple-800' : '' }}
                                                    {{ $todo->category === 'work' ? 'bg-blue-100 text-blue-800' : '' }}
                                                    {{ $todo->category === 'shopping' ? 'bg-pink-100 text-pink-800' : '' }}
                                                    {{ $todo->category === 'others' ? 'bg-gray-100 text-gray-800' : '' }}">
                                                    {{ ucfirst($todo->category) }}
                                                </span>
                                                <div class="flex items-center text-gray-500">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($todo->due_date)->format('M d, Y') }}
                                                    <svg class="w-4 h-4 ml-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($todo->due_time)->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $todos->links() }}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Sidebar - Stats & Charts (Fixed) -->
                <div class="lg:w-1/3 space-y-6 fixed right-8 max-w-[540px]">
                    <!-- Quick Stats with Live Calendar -->
                    <div class="bg-white rounded-xl shadow-sm border border-[#E6D7F3] p-4">
                        <!-- Live Time & Date Carousel -->
                        <div x-data="calendar()" class="mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-[#0A192F]">Calendar</h3>
                                <div class="text-[#FF2E63] font-medium" x-text="currentTime"></div>
                            </div>
                            
                            <!-- Date Carousel -->
                            <div class="relative">
                                <div class="flex overflow-hidden">
                                    <template x-for="(date, index) in dateRange" :key="index">
                                        <div class="w-full flex-shrink-0 transition-transform duration-300 ease-in-out"
                                             :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
                                            <div class="flex items-center justify-center space-x-4">
                                                <!-- Previous Date -->
                                                <div class="text-center opacity-50">
                                                    <div class="text-sm text-gray-500" x-text="formatDay(date.prev.getDay())"></div>
                                                    <div class="text-2xl font-bold text-[#0A192F]" x-text="date.prev.getDate()"></div>
                                                </div>
                                                <!-- Current Date -->
                                                <div class="text-center">
                                                    <div class="text-sm text-[#FF2E63]" x-text="formatDay(date.current.getDay())"></div>
                                                    <div class="text-3xl font-bold text-[#FF2E63]" x-text="date.current.getDate()"></div>
                                                    <div class="text-sm text-[#FF2E63]" x-text="formatMonth(date.current)"></div>
                                                </div>
                                                <!-- Next Date -->
                                                <div class="text-center opacity-50">
                                                    <div class="text-sm text-gray-500" x-text="formatDay(date.next.getDay())"></div>
                                                    <div class="text-2xl font-bold text-[#0A192F]" x-text="date.next.getDate()"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                
                                <!-- Navigation Dots -->
                                <div class="flex justify-center space-x-2 mt-4">
                                    <template x-for="(_, index) in dateRange" :key="index">
                                        <button @click="currentSlide = index"
                                                class="w-2 h-2 rounded-full transition-colors duration-200"
                                                :class="currentSlide === index ? 'bg-[#FF2E63]' : 'bg-gray-300'">
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-[#40E0D0]/10 rounded-lg p-3">
                                <div class="text-sm text-[#0A192F]">Total Tasks</div>
                                <div class="text-xl font-bold text-[#FF2E63]">{{ $analyticsData['total'] ?? 0 }}</div>
                            </div>
                            <div class="bg-[#E6D7F3] rounded-lg p-3">
                                <div class="text-sm text-[#4A4A4A]">Completed</div>
                                <div class="text-xl font-bold text-[#553D8B]">{{ $analyticsData['completed'] ?? 0 }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Grid -->
                    @if(isset($analyticsData['priority_stats']) && isset($categoryStats) && isset($lastWeek))
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Priority Distribution Chart -->
                            <div class="bg-white rounded-xl shadow-sm border border-[#E6D7F3] p-3">
                                <h3 class="text-sm font-semibold text-[#0A192F] mb-2">Priority Distribution</h3>
                                <canvas id="priorityChart" height="120"></canvas>
                            </div>

                            <!-- Category Distribution Chart -->
                            <div class="bg-white rounded-xl shadow-sm border border-[#E6D7F3] p-3">
                                <h3 class="text-sm font-semibold text-[#1F1A24] mb-2">Category Distribution</h3>
                                <canvas id="categoryChart" height="120"></canvas>
                            </div>
                        </div>

                        <!-- Weekly Progress Chart -->
                        <div class="bg-white rounded-xl shadow-sm border border-[#E6D7F3] p-3">
                            <h3 class="text-sm font-semibold text-[#1F1A24] mb-2">Weekly Progress</h3>
                            <canvas id="weeklyChart" height="100"></canvas>
                        </div>

                        <!-- Charts Script -->
                        <script>
                            // Memastikan data tersedia sebelum membuat charts
                            const priorityStats = @json($analyticsData['priority_stats'] ?? []);
                            const categoryStats = @json($categoryStats ?? []);
                            const weeklyData = @json($lastWeek ?? []);

                            // Update chart options for smaller size
                            const commonOptions = {
                                responsive: true,
                                maintainAspectRatio: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            boxWidth: 12,
                                            padding: 8,
                                            font: {
                                                size: 11
                                            }
                                        }
                                    }
                                }
                            };

                            if (Object.keys(priorityStats).length > 0) {
                                new Chart(document.getElementById('priorityChart'), {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['High', 'Medium', 'Low'],
                                        datasets: [{
                                            data: [
                                                priorityStats.high || 0,
                                                priorityStats.medium || 0,
                                                priorityStats.low || 0
                                            ],
                                            backgroundColor: ['#FF2E63', '#FFA41B', '#40E0D0'],
                                            borderWidth: 0
                                        }]
                                    },
                                    options: commonOptions
                                });
                            }

                            if (Object.keys(categoryStats).length > 0) {
                                new Chart(document.getElementById('categoryChart'), {
                                    type: 'pie',
                                    data: {
                                        labels: {!! json_encode(array_map('ucfirst', array_keys($categoryStats))) !!},
                                        datasets: [{
                                            data: {!! json_encode(array_values($categoryStats)) !!},
                                            backgroundColor: ['#553D8B', '#6B5CA5', '#E6D7F3', '#4A4A4A'],
                                            borderWidth: 0
                                        }]
                                    },
                                    options: commonOptions
                                });
                            }

                            if (weeklyData.length > 0) {
                                new Chart(document.getElementById('weeklyChart'), {
                                    type: 'line',
                                    data: {
                                        labels: {!! json_encode($lastWeek->pluck('date')) !!},
                                        datasets: [{
                                            label: 'Completed Tasks',
                                            data: {!! json_encode($lastWeek->pluck('completed')) !!},
                                            borderColor: '#6B5CA5',
                                            backgroundColor: 'rgba(107, 92, 165, 0.1)',
                                            tension: 0.4,
                                            fill: true
                                        }]
                                    },
                                    options: {
                                        ...commonOptions,
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                ticks: {
                                                    stepSize: 1,
                                                    font: {
                                                        size: 10
                                                    }
                                                },
                                                grid: {
                                                    display: false
                                                }
                                            },
                                            x: {
                                                ticks: {
                                                    font: {
                                                        size: 10
                                                    }
                                                },
                                                grid: {
                                                    display: false
                                                }
                                            }
                                        }
                                    }
                                });
                            }
                        </script>
                    @endif
                </div>

                <!-- Spacer for Fixed Sidebar -->
                <div class="lg:w-1/3 hidden lg:block"></div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div x-show="showCreateModal" 
         class="fixed inset-0 bg-[#0A192F]/50 flex items-center justify-center backdrop-blur-sm z-50"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
        <div class="bg-white w-full max-w-2xl mx-4 rounded-2xl shadow-2xl overflow-hidden"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             @click.away="if (!$event.target.closest('.flatpickr-calendar')) showCreateModal = false">
            
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-[#FF2E63] to-[#40E0D0] p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Create New Task</h2>
                    <button @click="showCreateModal = false" 
                            class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <p class="text-indigo-100 mt-1">Add a new task to your list</p>
            </div>

            <!-- Form Content -->
            <form action="{{ route('todos.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-6">
                    <!-- Title Input -->
                    <div class="relative">
                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Title
                        </label>
                        <input type="text" name="title" 
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200" 
                               placeholder="Enter task title"
                               required>
                    </div>

                    <!-- Description Input -->
                    <div class="relative">
                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Description
                        </label>
                        <textarea name="description" 
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200" 
                                  rows="3"
                                  placeholder="Enter task description"></textarea>
                    </div>

                    <!-- Category Selection -->
                    <div x-data="{ open: false, selected: 'personal' }" class="relative">
                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Category
                        </label>
                        <input type="hidden" name="category" x-bind:value="selected">
                        <button type="button"
                                @click="open = !open"
                                class="relative w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full"
                                          :class="{
                                              'bg-purple-500': selected === 'personal',
                                              'bg-blue-500': selected === 'work',
                                              'bg-pink-500': selected === 'shopping',
                                              'bg-gray-500': selected === 'others'
                                          }"></span>
                                    <span x-text="selected.charAt(0).toUpperCase() + selected.slice(1)"
                                          :class="{
                                              'text-purple-700': selected === 'personal',
                                              'text-blue-700': selected === 'work',
                                              'text-pink-700': selected === 'shopping',
                                              'text-gray-700': selected === 'others'
                                          }"></span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        
                        <!-- Category Dropdown -->
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-lg border border-gray-100 py-2">
                            <button type="button"
                                    @click="selected = 'personal'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-purple-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                <span class="text-purple-700">Personal</span>
                            </button>
                            <button type="button"
                                    @click="selected = 'work'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-blue-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                <span class="text-blue-700">Work</span>
                            </button>
                            <button type="button"
                                    @click="selected = 'shopping'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-pink-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                                <span class="text-pink-700">Shopping</span>
                            </button>
                            <button type="button"
                                    @click="selected = 'others'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-gray-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                                <span class="text-gray-700">Others</span>
                            </button>
                        </div>
                    </div>

                    <!-- Priority Selection -->
                    <div x-data="{ open: false, selected: 'medium' }" class="relative">
                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                            </svg>
                            Priority
                        </label>
                        <input type="hidden" name="priority" x-bind:value="selected">
                        <button type="button"
                                @click="open = !open"
                                class="relative w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full"
                                          :class="{
                                              'bg-red-500': selected === 'high',
                                              'bg-yellow-500': selected === 'medium',
                                              'bg-green-500': selected === 'low'
                                          }"></span>
                                    <span x-text="selected.charAt(0).toUpperCase() + selected.slice(1)"
                                          :class="{
                                              'text-red-700': selected === 'high',
                                              'text-yellow-700': selected === 'medium',
                                              'text-green-700': selected === 'low'
                                          }"></span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        
                        <!-- Priority Dropdown -->
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-lg border border-gray-100 py-2">
                            <button type="button"
                                    @click="selected = 'high'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-red-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                <span class="text-red-700">High</span>
                            </button>
                            <button type="button"
                                    @click="selected = 'medium'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-yellow-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                <span class="text-yellow-700">Medium</span>
                            </button>
                            <button type="button"
                                    @click="selected = 'low'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-green-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                <span class="text-green-700">Low</span>
                            </button>
                        </div>
                    </div>

                    <!-- Date and Time Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Due Date
                            </label>
                            <input type="text" name="due_date" 
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 datepicker" 
                                   placeholder="Select date"
                                   required>
                        </div>
                        <div class="relative">
                            <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Due Time
                            </label>
                            <input type="text" name="due_time" 
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 timepicker" 
                                   placeholder="Select time"
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" @click="showCreateModal = false" 
                            class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 focus:ring-2 focus:ring-gray-200 transition duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200">
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="showEditModal" 
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center backdrop-blur-sm z-50"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
        <div class="bg-white w-full max-w-2xl mx-4 rounded-2xl shadow-2xl overflow-hidden"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             @click.away="if (!$event.target.closest('.flatpickr-calendar')) showEditModal = false">
            
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Edit Task</h2>
                    <button @click="showEditModal = false" 
                            class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <p class="text-indigo-100 mt-1">Update your task details</p>
            </div>

            <!-- Form Content -->
            <form x-bind:action="'/todos/' + editingTodo?.id" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <!-- Title Input -->
                    <div class="relative">
                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Title
                        </label>
                        <input type="text" 
                               name="title" 
                               x-bind:value="editingTodo?.title"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200" 
                               required>
                    </div>

                    <!-- Description Input -->
                    <div class="relative">
                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Description
                        </label>
                        <textarea name="description" 
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200" 
                                  rows="3"
                                  x-text="editingTodo?.description"></textarea>
                    </div>

                    <!-- Category Selection -->
                    <div x-data="{ open: false, selected: editingTodo?.category || 'personal' }" class="relative">
                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Category
                        </label>
                        <input type="hidden" name="category" x-bind:value="selected">
                        <button type="button"
                                @click="open = !open"
                                class="relative w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full"
                                          :class="{
                                              'bg-purple-500': selected === 'personal',
                                              'bg-blue-500': selected === 'work',
                                              'bg-pink-500': selected === 'shopping',
                                              'bg-gray-500': selected === 'others'
                                          }"></span>
                                    <span x-text="selected.charAt(0).toUpperCase() + selected.slice(1)"
                                          :class="{
                                              'text-purple-700': selected === 'personal',
                                              'text-blue-700': selected === 'work',
                                              'text-pink-700': selected === 'shopping',
                                              'text-gray-700': selected === 'others'
                                          }"></span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        
                        <!-- Category Dropdown -->
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-lg border border-gray-100 py-2">
                            <button type="button"
                                    @click="selected = 'personal'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-purple-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                <span class="text-purple-700">Personal</span>
                            </button>
                            <button type="button"
                                    @click="selected = 'work'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-blue-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                <span class="text-blue-700">Work</span>
                            </button>
                            <button type="button"
                                    @click="selected = 'shopping'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-pink-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                                <span class="text-pink-700">Shopping</span>
                            </button>
                            <button type="button"
                                    @click="selected = 'others'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-gray-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                                <span class="text-gray-700">Others</span>
                            </button>
                        </div>
                    </div>

                    <!-- Priority Selection -->
                    <div x-data="{ open: false }" class="relative">
                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                            </svg>
                            Priority
                        </label>
                        <input type="hidden" name="priority" x-bind:value="editingTodo?.priority">
                        <button type="button"
                                @click="open = !open"
                                class="relative w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full"
                                          :class="{
                                              'bg-red-500': editingTodo?.priority === 'high',
                                              'bg-yellow-500': editingTodo?.priority === 'medium',
                                              'bg-green-500': editingTodo?.priority === 'low'
                                          }"></span>
                                    <span x-text="editingTodo?.priority.charAt(0).toUpperCase() + editingTodo?.priority.slice(1)"
                                          :class="{
                                              'text-red-700': editingTodo?.priority === 'high',
                                              'text-yellow-700': editingTodo?.priority === 'medium',
                                              'text-green-700': editingTodo?.priority === 'low'
                                          }"></span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        
                        <!-- Priority Dropdown -->
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-lg border border-gray-100 py-2">
                            <button type="button"
                                    @click="editingTodo.priority = 'high'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-red-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                <span class="text-red-700">High</span>
                            </button>
                            <button type="button"
                                    @click="editingTodo.priority = 'medium'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-yellow-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                <span class="text-yellow-700">Medium</span>
                            </button>
                            <button type="button"
                                    @click="editingTodo.priority = 'low'; open = false"
                                    class="w-full px-4 py-2.5 text-left hover:bg-green-50 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                <span class="text-green-700">Low</span>
                            </button>
                        </div>
                    </div>

                    <!-- Date and Time Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Due Date
                            </label>
                            <input type="text" 
                                   name="due_date" 
                                   x-bind:value="editingTodo?.due_date"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 datepicker" 
                                   required>
                        </div>
                        <div class="relative">
                            <label class="text-sm font-medium text-gray-700 flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Due Time
                            </label>
                            <input type="text" 
                                   name="due_time" 
                                   x-bind:value="editingTodo?.due_time"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 timepicker" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" @click="showEditModal = false" 
                            class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 focus:ring-2 focus:ring-gray-200 transition duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200">
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" 
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center backdrop-blur-sm z-50"
         x-cloak>
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 overflow-hidden"
             @click.away="showDeleteModal = false">
            <div class="p-6">
                <div class="w-16 h-16 rounded-full bg-red-100 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 text-center mb-1">Delete Task</h3>
                <p class="text-gray-500 text-center mb-6">
                    Are you sure you want to delete "<span x-text="deletingTodo?.title" class="font-medium"></span>"? 
                    This action cannot be undone.
                </p>

                <div class="flex space-x-3">
                    <button @click="showDeleteModal = false" 
                            class="flex-1 px-4 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl font-medium transition-colors duration-200">
                        Cancel
                    </button>
                    
                    <form x-bind:action="'/todos/' + deletingTodo?.id" 
                          method="POST" 
                          class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full px-4 py-3 text-white bg-red-600 hover:bg-red-700 rounded-xl font-medium transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this script before closing body tag -->
    <script>
 AOS.init();


    function calendar() {
        return {
            currentTime: '',
            currentSlide: 0,
            dateRange: [],
            init() {
                this.updateTime();
                setInterval(() => this.updateTime(), 1000);
                this.generateDateRange();
                
                // Auto-slide every 5 seconds
                setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % this.dateRange.length;
                }, 5000);
            },
            updateTime() {
                this.currentTime = new Date().toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                });
            },
            generateDateRange() {
                const today = new Date();
                this.dateRange = Array.from({ length: 5 }, (_, i) => {
                    const current = new Date(today);
                    current.setDate(today.getDate() + i);
                    const prev = new Date(current);
                    prev.setDate(current.getDate() - 1);
                    const next = new Date(current);
                    next.setDate(current.getDate() + 1);
                    return { prev, current, next };
                });
            },
            formatDay(day) {
                return ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'][day];
            },
            formatMonth(date) {
                return date.toLocaleString('default', { month: 'short' });
            }
        }
    }
    </script>
</body>
</html> 