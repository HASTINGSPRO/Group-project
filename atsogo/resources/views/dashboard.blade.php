<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env(key: 'APP_NAME')}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            @apply bg-gray-100 text-gray-800; /* Default light mode background and text */
        }
        /* Dark mode styles, toggle with a 'dark' class on the html tag */
        html.dark body {
            @apply bg-gray-900 text-gray-200;
        }
        html.dark .dark-mode-toggle {
            @apply bg-gray-700 text-yellow-400; /* Adjust dark mode toggle color */
        }
        html.dark .card {
            @apply bg-gray-800 text-gray-200 shadow-md;
        }
        html.dark .sidebar-item.active {
            @apply bg-yellow-600 text-white; /* Active sidebar item in dark mode */
        }
        html.dark .sidebar-item {
            @apply text-gray-300 hover:bg-gray-700;
        }
        html.dark .top-nav input {
            @apply bg-gray-700 text-gray-200 placeholder-gray-400 border-gray-600;
        }
        html.dark .top-nav button {
            @apply text-gray-300 hover:text-white;
        }
        html.dark .top-nav .icon-btn {
            @apply hover:bg-gray-700;
        }
        html.dark .logout-modal-content {
            @apply bg-gray-800 text-gray-200;
        }

        /* Custom styles for sidebar transition */
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        /* Hide scrollbar for consistent look, but still allow scrolling */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        /* Modal specific styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 100; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
            text-align: center;
        }
        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 w-64 bg-white shadow-xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 flex flex-col no-scrollbar overflow-y-auto rounded-r-xl">
        <div class="p-6 flex items-center justify-between lg:justify-start">
            <h1 class="text-2xl font-bold text-gray-900 inline-block align-middle">Atsogo</h1>
            <button class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none" onclick="toggleSidebar()">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <nav class="flex-grow p-4">
            <ul>
                <li class="mb-2">
                    <a href="{{ route('dashboard') }}" class="sidebar-item {{ ($activeView ?? 'overview') === 'overview' ? 'active bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-200' }} flex items-center p-3 rounded-lg font-medium">
                        <i class="fas fa-home mr-3 text-lg"></i>
                        My Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('dashboard', ['viewType' => 'plots']) }}" class="sidebar-item {{ ($activeView ?? '') === 'all_plots' ? 'active bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-200' }} flex items-center p-3 rounded-lg font-medium">
                        <i class="fas fa-list-alt mr-3 text-lg"></i>
                        All Land Plots
                    </a>
                </li>
                {{-- Admin Specific Sidebar Items --}}
                @if(auth()->check() && auth()->user()->isAdmin())
                <li class="mb-2 mt-4 border-t border-gray-200 pt-4">
                    <span class="text-xs font-semibold uppercase text-gray-500 px-3">Admin Panel</span>
                </li>
                <li class="mb-2">
                    <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots']) }}" class="sidebar-item {{ ($activeView ?? '') === 'admin_plots_index' ? 'active bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-200' }} flex items-center p-3 rounded-lg font-medium">
                        <i class="fas fa-th-list mr-3 text-lg"></i>
                        Manage Plots
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots/create']) }}" class="sidebar-item {{ ($activeView ?? '') === 'admin_plots_create' ? 'active bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-200' }} flex items-center p-3 rounded-lg font-medium">
                        <i class="fas fa-plus-square mr-3 text-lg"></i>
                        Add New Plot
                    </a>
                </li>
                {{-- Add more admin links here (e.g., Manage Users, Settings) --}}
                @endif
                {{-- End Admin Specific Sidebar Items --}}

                <li class="mb-2">
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-question-circle mr-3 text-lg"></i>
                        My Inquiries
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-bookmark mr-3 text-lg"></i>
                        Saved Land
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-magnifying-glass-location mr-3 text-lg"></i>
                        Review Land
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-lightbulb mr-3 text-lg"></i>
                        Land Recommendation
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-money-check-alt mr-3 text-lg"></i>
                        Payment
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-user mr-3 text-lg"></i>
                        Profile
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-bell mr-3 text-lg"></i>
                        Notifications
                    </a>
                </li>
                <!-- Logout option moved to sidebar -->
                <li class="mt-4 border-t border-gray-200 pt-4">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); showLogoutModal();" class="sidebar-item flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-sign-out-alt mr-3 text-lg"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-h-screen overflow-y-auto no-scrollbar">
        <header class="bg-white shadow-md p-4 flex items-center justify-between sticky top-0 z-30 top-nav">
            <button class="lg:hidden p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-300" onclick="toggleSidebar()">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <div class="relative flex-grow mx-4 max-w-lg hidden sm:block">
                <input type="text" placeholder="Search land plots..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <div class="flex items-center space-x-4">
                <button id="dark-mode-toggle" class="p-2 rounded-full hover:bg-gray-200 dark-mode-toggle transition-colors duration-300">
                    <i class="fas fa-moon text-lg"></i>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-200 icon-btn relative">
                    <i class="fas fa-bell text-lg"></i>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">2</span>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-200 icon-btn relative">
                    <i class="fas fa-comment-dots text-lg"></i>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-blue-100 bg-blue-600 rounded-full">5</span>
                </button>
                <!-- User Profile (without Logout dropdown) -->
                <div class="flex items-center space-x-2 cursor-pointer">
                    <img src="https://placehold.co/40x40/FFD700/FFFFFF?text={{ strtoupper(substr(auth()->user()->username, 0, 2)) }}" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-yellow-500">
                    <span class="font-semibold hidden sm:block">{{ auth()->user()->username }}</span>
                </div>
            </div>
        </header>

        <main class="p-6 flex-1">
            {{-- Conditional rendering of content based on activeView --}}

            {{-- Admin Views --}}
            @if(auth()->check() && auth()->user()->isAdmin())
                @if(isset($activeView) && $activeView === 'admin_plots_index')
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Manage Land Plots (Admin)</h2>
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots/create']) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Add New Land Plot
                        </a>
                    </div>
                    <div class="p-6 rounded-xl shadow-lg">
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif
                        @if ($Plots->isEmpty())
                            <div class="alert bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative">No land plots found for administration.</div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Area (sqm)</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Location</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">New Listing</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($Plots as $plot)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $plot->title }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">${{ number_format($plot->price, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ number_format($plot->area_sqm, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $plot->location }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ ucfirst($plot->status) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $plot->is_new_listing ? 'Yes' : 'No' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots/' . $plot->id]) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-2">View</a>
                                                    <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots/' . $plot->id . '/edit']) }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-200 mr-2">Edit</a>
                                                    <form action="{{ route('admin.plots.destroy', $plot->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200" onclick="return confirm('Are you sure you want to delete this land plot?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $Plots->links() }}
                            </div>
                        @endif
                    </div>

                @elseif(isset($activeView) && $activeView === 'admin_plots_create')
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Create New Land Plot (Admin)</h2>
                    <div class="p-6 rounded-xl shadow-lg">
                        <form action="{{ route('admin.plots.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title:</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description:</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>{{ old('description') }}</textarea>
                                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price ($):</label>
                                <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="area_sqm" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Area (sqm):</label>
                                <input type="number" id="area_sqm" name="area_sqm" step="0.01" value="{{ old('area_sqm') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('area_sqm')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location:</label>
                                <input type="text" id="location" name="location" value="{{ old('location') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status:</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                    <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                </select>
                                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" id="is_new_listing" name="is_new_listing" value="1" {{ old('is_new_listing') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                <label for="is_new_listing" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Is New Listing?</label>
                                @error('is_new_listing')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">Cancel</a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Create Plot</button>
                            </div>
                        </form>
                    </div>

                @elseif(isset($activeView) && $activeView === 'admin_plots_edit')
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Edit Land Plot (Admin) - {{ $Plot->title }}</h2>
                    <div class="p-6 rounded-xl shadow-lg">
                        <form action="{{ route('admin.plots.update', $Plot->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title:</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $Plot->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description:</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>{{ old('description', $Plot->description) }}</textarea>
                                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price ($):</label>
                                <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $Plot->price) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="area_sqm" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Area (sqm):</label>
                                <input type="number" id="area_sqm" name="area_sqm" step="0.01" value="{{ old('area_sqm', $Plot->area_sqm) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('area_sqm')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location:</label>
                                <input type="text" id="location" name="location" value="{{ old('location', $Plot->location) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status:</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                    <option value="available" {{ (old('status', $Plot->status) == 'available') ? 'selected' : '' }}>Available</option>
                                    <option value="sold" {{ (old('status', $Plot->status) == 'sold') ? 'selected' : '' }}>Sold</option>
                                    <option value="reserved" {{ (old('status', $Plot->status) == 'reserved') ? 'selected' : '' }}>Reserved</option>
                                </select>
                                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" id="is_new_listing" name="is_new_listing" value="1" {{ old('is_new_listing', $Plot->is_new_listing) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                <label for="is_new_listing" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Is New Listing?</label>
                                @error('is_new_listing')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">Cancel</a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Update Plot</button>
                            </div>
                        </form>
                    </div>

                @elseif(isset($activeView) && $activeView === 'admin_plots_show')
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Land Plot Details (Admin) - {{ $Plot->title }}</h2>
                    <div class="p-6 rounded-xl shadow-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-2"><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Title:</strong> {{ $Plot->title }}</p></div>
                            <div class="col-span-2"><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Description:</strong></p><p class="text-gray-900 dark:text-gray-100 mt-1">{{ $Plot->description }}</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Price:</strong> ${{ number_format($Plot->price, 2) }}</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Area:</strong> {{ number_format($Plot->area_sqm, 2) }} sqm</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Location:</strong> {{ $Plot->location }}</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Status:</strong> {{ ucfirst($Plot->status) }}</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>New Listing:</strong> {{ $Plot->is_new_listing ? 'Yes' : 'No' }}</p></div>
                            <div class="col-span-2"><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Created At:</strong> {{ $Plot->created_at->format('M d, Y H:i A') }}</p></div>
                            <div class="col-span-2"><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Last Updated:</strong> {{ $Plot->updated_at->format('M d, Y H:i A') }}</p></div>
                        </div>
                        <div class="mt-6 flex justify-start">
                            <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots/' . $Plot->id . '/edit']) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">Edit</a>
                            <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Back to List</a>
                        </div>
                    </div>
                @else {{-- Customer Views (or default if not admin) --}}
                    @if (isset($activeView) && $activeView === 'single_plot')
                        {{-- Content from customer/plots/show.blade.php --}}
                        <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Land Plot Details: {{ $Plot->title }}</h2>
                        <div class="p-6 rounded-xl shadow-lg">
                            @if ($Plot->status !== 'available')
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    <span class="block sm:inline">This land plot is currently {{ ucfirst($Plot->status) }} and not available for purchase.</span>
                                </div>
                            @endif
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Price:</strong> ${{ number_format($Plot->price, 2) }}</p></div>
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Area:</strong> {{ number_format($Plot->area_sqm, 2) }} sqm</p></div>
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Location:</strong> {{ $Plot->location }}</p></div>
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Status:</strong> {{ ucfirst($Plot->status) }}</p></div>
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">New Listing:</strong> {{ $Plot->is_new_listing ? 'Yes' : 'No' }}</p></div>
                            <div class="mb-6"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Listed On:</strong> {{ $Plot->created_at->format('M d, Y') }}</p></div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">Description</h3>
                                <p class="text-gray-800 dark:text-gray-200 leading-relaxed">{{ $Plot->description }}</p>
                            </div>
                            <div class="mt-8">
                                <a href="{{ route('dashboard', ['viewType' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Back to All Plots</a>
                            </div>
                        </div>
                    @elseif (isset($activeView) && $activeView === 'all_plots')
                        {{-- Content from customer/plots/index.blade.php --}}
                        <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Available Land Plots</h2>
                        <div class="flex flex-col sm:flex-row mb-4 gap-4 items-center justify-between">
                            <div class="w-full sm:w-auto">
                                <form action="{{ route('dashboard', ['viewType' => 'plots']) }}" method="GET" class="w-full">
                                    <div class="relative">
                                        <input type="text" name="search" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" placeholder="Search plots..." value="{{ request('search') }}">
                                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    </div>
                                </form>
                            </div>
                            <div class="flex flex-wrap gap-2 w-full sm:w-auto justify-end">
                                <a href="{{ route('dashboard', ['viewType' => 'plots', 'new_listings' => true]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Show New Listings Only</a>
                                <a href="{{ route('dashboard', ['viewType' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Clear Filters</a>
                            </div>
                        </div>
                        <div class="p-6 rounded-xl shadow-lg">
                            @if($Plots->isEmpty())
                                <div class="alert bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative">No land plots available matching your criteria.</div>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($Plots as $plot)
                                        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                                            @if($plot->is_new_listing)
                                                <div class="badge bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full absolute top-3 right-3 z-10">New</div>
                                            @endif
                                            <div class="p-4 flex-grow">
                                                <h5 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $plot->title }}</h5>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ Str::limit($plot->description, 100) }}</p>
                                                <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                                                    <li class="flex justify-between items-center py-1"><strong>Price:</strong><span>${{ number_format($plot->price, 2) }}</span></li>
                                                    <li class="flex justify-between items-center py-1"><strong>Area:</strong><span>{{ number_format($plot->area_sqm, 2) }} sqm</span></li>
                                                    <li class="flex justify-between items-center py-1"><strong>Location:</strong><span>{{ $plot->location }}</span></li>
                                                </ul>
                                            </div>
                                            <div class="p-4 border-t border-gray-200 dark:border-gray-600">
                                                <a href="{{ route('dashboard', ['viewType' => 'plot', 'id' => $plot->id]) }}" class="block w-full text-center px-4 py-2 bg-yellow-500 text-white rounded-md font-semibold text-sm uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">View Details</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-6 flex justify-center">
                                    {{ $Plots->appends(request()->query())->links() }}
                                </div>
                            @endif
                        </div>
                    @else
                        {{-- Default dashboard overview content --}}
                        <h2 class="text-3xl font-bold mb-6">My Dashboard - Overview</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <div class="card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                                <div><p class="text-gray-500 text-sm font-medium">Available Land Plots</p><p class="text-4xl font-bold text-indigo-700 mt-2">205</p></div>
                                <div class="text-indigo-400 text-5xl"><i class="fas fa-map-marker-alt"></i></div>
                            </div>
                            <div class="card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                                <div><p class="text-gray-500 text-sm font-medium">New Listings (30 Days)</p><p class="text-4xl font-bold text-green-600 mt-2">22</p></div>
                                <div class="text-green-400 text-5xl"><i class="fas fa-chart-line"></i></div>
                            </div>
                            <div class="card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                                <div><p class="text-gray-500 text-sm font-medium">Your Inquiries (Pending)</p><p class="text-4xl font-bold text-orange-600 mt-2">3</p></div>
                                <div class="text-orange-400 text-5xl"><i class="fas fa-calendar-alt"></i></div>
                            </div>
                            <div class="card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                                <div><p class="text-gray-500 text-sm font-medium">Avg. Land Price (per sqm)</p><p class="text-4xl font-bold text-purple-700 mt-2">K 50,000</p></div>
                                <div class="text-purple-400 text-5xl"><i class="fas fa-dollar-sign"></i></div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
                            <h3 class="text-xl font-semibold mb-4">New Land Listings & Inquiries Over Time</h3>
                            <div class="w-full h-80 bg-gray-50 flex items-center justify-center rounded-lg border border-dashed border-gray-300 text-gray-500"><p>Chart will go here (e.g., using Chart.js)</p></div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-semibold mb-4">Recent Land Listings & Your Inquiries</h3>
                            <div class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300 text-gray-500">
                                <p>Details of recent land listings and your inquiries will be displayed here.</p>
                                <ul class="mt-4 space-y-2">
                                    <li class="p-2 bg-white rounded-md border border-gray-200"><a href="{{ route('dashboard', ['viewType' => 'plot', 'id' => 1]) }}" class="text-blue-600 hover:underline">Land Plot A - New Listing (View Details)</a></li>
                                    <li class="p-2 bg-white rounded-md border border-gray-200">Inquiry for Land Plot B - Pending (Check Status)</li>
                                    <li class="p-2 bg-white rounded-md border border-gray-200"><a href="{{ route('dashboard', ['viewType' => 'plot', 'id' => 3]) }}" class="text-blue-600 hover:underline">Land Plot C - Price Updated (View Details)</a></li>
                                    <li class="p-2 bg-white rounded-md border border-gray-200"><a href="{{ route('dashboard', ['viewType' => 'plots']) }}" class="text-blue-600 hover:underline">View All Available Plots</a></li>
                                </ul>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        </main>
    </div>

    <div id="logout-modal" class="modal hidden">
        <div class="modal-content logout-modal-content">
            <h4 class="text-lg font-bold mb-4">Confirm Logout</h4>
            <p>Are you sure you want to log out?</p>
            <div class="modal-buttons">
                <button id="confirm-logout-btn" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Yes, Logout</button>
                <button onclick="hideLogoutModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const logoutModal = document.getElementById('logout-modal');
        const logoutForm = document.getElementById('logout-form');
        const confirmLogoutBtn = document.getElementById('confirm-logout-btn');

        function toggleSidebar() { sidebar.classList.toggle('-translate-x-full'); mobileMenuOverlay.classList.toggle('hidden'); }
        darkModeToggle.addEventListener('click', () => { document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light'); });
        window.addEventListener('load', () => { if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) { document.documentElement.classList.add('dark'); } else { document.documentElement.classList.remove('dark'); } });
        window.addEventListener('resize', () => { if (window.innerWidth >= 1024) { sidebar.classList.remove('-translate-x-full'); mobileMenuOverlay.classList.add('hidden'); } });
        function showLogoutModal() { logoutModal.classList.remove('hidden'); }
        function hideLogoutModal() { logoutModal.classList.add('hidden'); }
        confirmLogoutBtn.addEventListener('click', () => { logoutForm.submit(); });
    </script>
</body>
</html>
