<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATSOGO Customer Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons CDN (for SVG icons) -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Chart.js CDN (for the profile completion chart) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Custom styles for sidebar transition and content animation */
        #sidebar {
            transition: width 0.3s ease-in-out, transform 0.3s ease-in-out;
            transform: translateX(0); /* Default state: visible */
        }

        #sidebar.collapsed {
            width: 0 !important;
            overflow: hidden;
            transform: translateX(-100%); /* Slide out completely */
        }

        .content-area {
            transition: margin-left 0.3s ease-in-out;
        }

        @media (max-width: 767px) {
            #sidebar {
                position: fixed;
                height: 100vh;
                top: 0;
                left: 0;
                width: 72px; /* Default width on mobile */
                z-index: 100; /* Ensure sidebar is above other content */
            }
            #sidebar.collapsed {
                width: 0 !important; /* Fully collapse on mobile */
                transform: translateX(-100%);
            }
            .content-area {
                margin-left: 0; /* No margin on mobile when sidebar is collapsed */
            }
            /* Overlay for mobile sidebar */
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 99;
                display: none;
            }
            .overlay.visible {
                display: block;
            }
        }

        /* Active navigation item styling */
        .active-nav {
            background-color: theme('colors.yellow.400');
            color: theme('colors.gray.900') !important; /* Ensure text color changes on hover */
        }
        .active-nav .nav-text, .active-nav i {
             color: theme('colors.gray.900'); /* Ensure text and icon color changes */
        }

        /* Keyframes for fade-in animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Custom scrollbar for chat messages */
        #chat-messages::-webkit-scrollbar {
            width: 8px;
        }

        #chat-messages::-webkit-scrollbar-track {
            background: theme('colors.gray.200');
            border-radius: 10px;
        }

        #chat-messages::-webkit-scrollbar-thumb {
            background: theme('colors.yellow.500');
            border-radius: 10px;
        }

        #chat-messages::-webkit-scrollbar-thumb:hover {
            background: theme('colors.yellow.600');
        }

        .dark #chat-messages::-webkit-scrollbar-track {
            background: theme('colors.gray.700');
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white font-sans transition-colors duration-300 antialiased overflow-hidden">

    <!-- Mobile Overlay for Sidebar -->
    <div id="sidebar-overlay" class="overlay"></div>

    <!-- Main Dashboard Container -->
    <div id="theme-body" class="flex min-h-screen">

        <!-- Sidebar -->
        <aside id="sidebar" class="w-72 bg-white dark:bg-gray-800 p-6 shadow-md flex flex-col transition-all duration-300 flex-shrink-0 relative z-50">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-xl font-bold text-yellow-500 whitespace-nowrap overflow-hidden">ATSOGO</h1>
                <button id="close-sidebar" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-0 md:hidden">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- User Profile -->
            <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-200 dark:border-gray-700 transition-all duration-300">
                <img src="https://placehold.co/40x40/000000/FFFFFF?text=CD" alt="User Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 flex-shrink-0">
                <div class="flex flex-col whitespace-nowrap overflow-hidden flex-grow">
                    <span class="font-semibold text-gray-800 dark:text-white text-base">Cynthia Dube</span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Customer</span>
                </div>
            </div>

            <nav class="flex-1">
                <ul>
                    <li class="mb-2">
                        <a href="#" class="nav-item-content flex items-center gap-3 px-4 py-3 rounded-md text-gray-600 dark:text-gray-300 no-underline transition-colors duration-200 hover:bg-yellow-400 hover:text-gray-900 dark:hover:text-gray-900 active-nav" data-content-id="dashboard-content">
                            <i data-lucide="home" class="w-5 h-5 flex-shrink-0"></i>
                            <span class="nav-text text-sm">My Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item-content flex items-center gap-3 px-4 py-3 rounded-md text-gray-600 dark:text-gray-300 no-underline transition-colors duration-200 hover:bg-yellow-400 hover:text-gray-900 dark:hover:text-gray-900" data-content-id="my-inquiries-content">
                            <i data-lucide="file-text" class="w-5 h-5 flex-shrink-0"></i>
                            <span class="nav-text text-sm">My Inquiries</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item-content flex items-center gap-3 px-4 py-3 rounded-md text-gray-600 dark:text-gray-300 no-underline transition-colors duration-200 hover:bg-yellow-400 hover:text-gray-900 dark:hover:text-gray-900" data-content-id="saved-lands-content">
                            <i data-lucide="bookmark" class="w-5 h-5 flex-shrink-0"></i>
                            <span class="nav-text text-sm">Saved Lands</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item-content flex items-center gap-3 px-4 py-3 rounded-md text-gray-600 dark:text-gray-300 no-underline transition-colors duration-200 hover:bg-yellow-400 hover:text-gray-900 dark:hover:text-gray-900" data-content-id="recently-viewed-content">
                            <i data-lucide="history" class="w-5 h-5 flex-shrink-0"></i>
                            <span class="nav-text text-sm">Recently Viewed</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" id="open-recommendation-generator" class="nav-item-content flex items-center gap-3 px-4 py-3 rounded-md text-gray-600 dark:text-gray-300 no-underline transition-colors duration-200 hover:bg-yellow-400 hover:text-gray-900 dark:hover:text-gray-900">
                            <i data-lucide="lightbulb" class="w-5 h-5 flex-shrink-0"></i>
                            <span class="nav-text text-sm">💡 Get Land Recommendations</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" id="open-bank-payment-modal" class="nav-item-content flex items-center gap-3 px-4 py-3 rounded-md text-gray-600 dark:text-gray-300 no-underline transition-colors duration-200 hover:bg-yellow-400 hover:text-gray-900 dark:hover:text-gray-900">
                            <i data-lucide="wallet" class="w-5 h-5 flex-shrink-0"></i>
                            <span class="nav-text text-sm">💰 Make a Payment</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item-content flex items-center gap-3 px-4 py-3 rounded-md text-gray-600 dark:text-gray-300 no-underline transition-colors duration-200 hover:bg-yellow-400 hover:text-gray-900 dark:hover:text-gray-900" data-content-id="profile-content">
                            <i data-lucide="user" class="w-5 h-5 flex-shrink-0"></i>
                            <span class="nav-text text-sm">Profile</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item-content flex items-center gap-3 px-4 py-3 rounded-md text-gray-600 dark:text-gray-300 no-underline transition-colors duration-200 hover:bg-yellow-400 hover:text-gray-900 dark:hover:text-gray-900" data-content-id="notifications-content">
                            <i data-lucide="bell" class="w-5 h-5 flex-shrink-0"></i>
                            <span class="nav-text text-sm">Notifications</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="mt-auto pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="#" class="nav-item-content flex items-center gap-3 px-4 py-3 rounded-md text-gray-600 dark:text-gray-300 no-underline transition-colors duration-200 hover:bg-yellow-400 hover:text-gray-900 dark:hover:text-gray-900" data-content-id="logout-action">
                    <i data-lucide="log-out" class="w-5 h-5 flex-shrink-0"></i>
                    <span class="nav-text text-sm">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden content-area">
            <header class="flex justify-between items-center px-8 py-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm flex-shrink-0">
                <button id="open-sidebar" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-0 mr-4 md:hidden">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white m-0">Customer Dashboard</h2>
                <div class="flex items-center gap-4">
                    <div class="relative flex items-center">
                        <input type="text" id="search-input" placeholder="Search lands..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 transition-colors duration-200 focus:outline-none focus:border-yellow-500">
                        <i data-lucide="search" class="absolute left-3 text-gray-500"></i>
                    </div>
                    <button id="theme-toggle" class="p-2 rounded-full text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-0 transition-colors duration-200">
                        <i data-lucide="moon" id="theme-icon" class="w-6 h-6"></i>
                    </button>
                    <div class="relative inline-block">
                        <button id="notification-bell-button" class="p-2 rounded-full text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-0 transition-colors duration-200">
                            <i data-lucide="bell" class="w-6 h-6"></i>
                        </button>
                        <span id="notification-badge" class="absolute top-0 right-0 bg-red-600 text-white rounded-full w-3.5 h-3.5 text-xs flex justify-center items-center opacity-0 invisible scale-50 transition-all duration-200 border border-white dark:border-gray-800"></span>
                    </div>
                    <div class="relative">
                        <img src="https://placehold.co/40x40/000000/FFFFFF?text=CD" alt="Customer Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400">
                    </div>
                </div>
            </header>

            <main class="flex-1 p-8 overflow-y-auto">
                <!-- My Dashboard Content -->
                <div id="dashboard-content" class="content-section active animate-fadeIn">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm hover:translate-y-[-3px] transition-transform duration-200 flex justify-between items-center">
                            <div>
                                <p class="m-0 text-gray-600 dark:text-gray-400 text-sm">Total Inquiries</p>
                                <h3 class="m-0 mt-1 text-2xl font-bold text-yellow-500">15</h3>
                            </div>
                            <i data-lucide="message-square" class="text-yellow-500 text-4xl opacity-70"></i>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm hover:translate-y-[-3px] transition-transform duration-200 flex justify-between items-center">
                            <div>
                                <p class="m-0 text-gray-600 dark:text-gray-400 text-sm">Saved Lands</p>
                                <h3 class="m-0 mt-1 text-2xl font-bold text-emerald-500">7</h3>
                            </div>
                            <i data-lucide="bookmark" class="text-emerald-500 text-4xl opacity-70"></i>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm hover:translate-y-[-3px] transition-transform duration-200 flex justify-between items-center">
                            <div>
                                <p class="m-0 text-gray-600 dark:text-gray-400 text-sm">Profile Completion</p>
                                <h3 class="m-0 mt-1 text-2xl font-bold text-purple-600">80%</h3>
                            </div>
                            <canvas id="profile-completion-chart" width="80" height="80"></canvas>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">My Recent Inquiries</h3>
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse mt-4">
                                    <thead>
                                        <tr>
                                            <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Land Title</th>
                                            <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Date</th>
                                            <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Residential Plot in Area A"</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-05-28</td>
                                            <td class="p-3 text-blue-600 font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Pending Response</td>
                                        </tr>
                                        <tr>
                                            <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Commercial Space near Market"</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-05-20</td>
                                            <td class="p-3 text-emerald-500 font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Responded</td>
                                        </tr>
                                        <tr>
                                            <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Agricultural Land with River Access"</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-05-15</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Closed</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">My Saved Lands</h3>
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse mt-4">
                                    <thead>
                                        <tr>
                                            <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Land Title</th>
                                            <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Location</th>
                                            <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Scenic Plot with Mountain View"</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Northern Region</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">$50,000</td>
                                        </tr>
                                        <tr>
                                            <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Urban Development Land"</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Central Region</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">$120,000</td>
                                        </tr>
                                        <tr>
                                            <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Small Farm Land"</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Southern Region</td>
                                            <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">$35,000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Recently Viewed Lands</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                                <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+1" alt="Land 1" class="w-full h-24 object-cover rounded-sm mb-3">
                                <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Plot in Lilongwe</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Residential</p>
                            </div>
                            <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                                <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+2" alt="Land 2" class="w-full h-24 object-cover rounded-sm mb-3">
                                <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Farm in Mzuzu</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Agricultural</p>
                            </div>
                            <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                                <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+3" alt="Land 3" class="w-full h-24 object-cover rounded-sm mb-3">
                                <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Commercial Blantyre</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Commercial</p>
                            </div>
                            <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                                <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+4" alt="Land 4" class="w-full h-24 object-cover rounded-sm mb-3">
                                <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Rural Plot</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Residential</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                            <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                            Chat with Support
                        </h3>
                        <div class="flex justify-end mb-4">
                            <label for="chat-language-select" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mr-2 self-center">Language:</label>
                            <select id="chat-language-select" class="w-auto px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 focus:outline-none focus:border-yellow-500">
                                <option value="English">English</option>
                                <option value="Chichewa">Chichewa</option>
                                <option value="Yao">Yao</option>
                                <option value="Tumbuka">Tumbuka</option>
                            </select>
                        </div>
                        <div id="chat-messages" class="bg-gray-100 dark:bg-gray-700 rounded-md p-4 mb-4 h-52 overflow-y-auto flex flex-col border border-gray-200 dark:border-gray-700">
                            <div class="chat-message ai bg-yellow-400 text-gray-800 p-2 rounded-lg rounded-bl-sm mb-3 max-w-[80%] self-start break-words leading-tight">Hello! How can I assist you today?</div>
                            <!-- Example user message (add this dynamically) -->
                            <!-- <div class="chat-message user bg-blue-500 text-white p-2 rounded-lg rounded-br-sm mb-3 max-w-[80%] self-end break-words leading-tight">I need help with my inquiry.</div> -->
                        </div>
                        <div class="flex gap-2">
                            <input type="text" id="chat-input" placeholder="Type your message..." class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 focus:outline-none focus:border-yellow-500">
                            <button id="send-chat-btn" class="bg-yellow-500 text-gray-800 px-4 py-2 rounded-md font-semibold cursor-pointer transition-colors duration-200 hover:bg-yellow-600 whitespace-nowrap">
                                Send
                            </button>
                        </div>
                    </div>
                </div>

                <!-- My Inquiries Content -->
                <div id="my-inquiries-content" class="content-section hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <button class="back-to-dashboard-btn flex items-center gap-1 mt-4 mb-4 px-3 py-2 bg-transparent border-none text-blue-600 font-semibold cursor-pointer rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 w-fit">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            Back to Dashboard
                        </button>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">My Inquiries</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Here you can view all your past and current land inquiries. Each inquiry has a status to help you track its progress.</p>
                        <button class="bg-yellow-500 text-gray-800 px-4 py-2 rounded-md font-semibold cursor-pointer transition-colors duration-200 hover:bg-yellow-600 mb-4 flex items-center gap-2">
                            <i data-lucide="plus" class="w-4 h-4"></i> Add New Inquiry
                        </button>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Inquiry ID</th>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Land Title</th>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Date Submitted</th>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Status</th>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">#1001</td>
                                        <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Residential Plot in Area A"</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-05-28</td>
                                        <td class="p-3 text-blue-600 font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Pending Response</td>
                                        <td class="p-3 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">
                                            <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200">View Details</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">#1002</td>
                                        <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Commercial Space near Market"</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-05-20</td>
                                        <td class="p-3 text-emerald-500 font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Responded</td>
                                        <td class="p-3 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">
                                            <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200">View Response</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">#1003</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-05-15</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Closed</td>
                                        <td class="p-3 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">
                                            <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200">View Archive</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">#1004</td>
                                        <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Small Urban Plot"</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-05-10</td>
                                        <td class="p-3 text-emerald-500 font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Responded</td>
                                        <td class="p-3 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">
                                            <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200">View Response</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Saved Lands Content -->
                <div id="saved-lands-content" class="content-section hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <button class="back-to-dashboard-btn flex items-center gap-1 mt-4 mb-4 px-3 py-2 bg-transparent border-none text-blue-600 font-semibold cursor-pointer rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 w-fit">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            Back to Dashboard
                        </button>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">My Saved Lands</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">This section displays all the land properties you've marked as favorites. Review their details, or remove them from your saved list if you're no longer interested. Saved lands help you keep track of properties that caught your eye for future consideration.</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Land Title</th>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Location</th>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Price</th>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Saved Date</th>
                                        <th class="p-3 text-left text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Scenic Plot with Mountain View"</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Northern Region</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">$50,000</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-04-20</td>
                                        <td class="p-3 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">
                                            <button class="bg-red-500 text-white px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-red-600 transition-colors duration-200">Remove</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Urban Development Land"</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Central Region</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">$120,000</td>
                                        <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-03-10</td>
                                        <td class="p-3 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">
                                            <button class="bg-red-500 text-white px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-red-600 transition-colors duration-200">Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recently Viewed Content -->
                <div id="recently-viewed-content" class="content-section hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <button class="back-to-dashboard-btn flex items-center gap-1 mt-4 mb-4 px-3 py-2 bg-transparent border-none text-blue-600 font-semibold cursor-pointer rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 w-fit">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            Back to Dashboard
                        </button>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Recently Viewed Lands</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Explore the land properties you've recently looked at. This section helps you quickly revisit listings that you might be interested in, ensuring you don't lose track of potential investments or dream properties.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                            <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                                <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+1" alt="Land 1" class="w-full h-24 object-cover rounded-sm mb-3">
                                <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Plot in Lilongwe</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Residential</p>
                                <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200 mt-2">View Details</button>
                            </div>
                            <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                                <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+2" alt="Land 2" class="w-full h-24 object-cover rounded-sm mb-3">
                                <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Farm in Mzuzu</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Agricultural</p>
                                <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200 mt-2">View Details</button>
                            </div>
                            <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                                <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+3" alt="Land 3" class="w-full h-24 object-cover rounded-sm mb-3">
                                <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Commercial Blantyre</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Commercial</p>
                                <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200 mt-2">View Details</button>
                            </div>
                            <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                                <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+4" alt="Land 4" class="w-full h-24 object-cover rounded-sm mb-3">
                                <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Rural Plot</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Residential</p>
                                <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200 mt-2">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Content -->
                <div id="profile-content" class="content-section hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <button class="back-to-dashboard-btn flex items-center gap-1 mt-4 mb-4 px-3 py-2 bg-transparent border-none text-blue-600 font-semibold cursor-pointer rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 w-fit">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            Back to Dashboard
                        </button>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">My Profile</h3>
                        <div class="flex items-center gap-6 mb-8">
                            <img src="https://placehold.co/100x100/000000/FFFFFF?text=CD" alt="User Avatar" class="w-24 h-24 rounded-full object-cover border-4 border-yellow-400 flex-shrink-0">
                            <div>
                                <h4 class="text-xl font-bold text-gray-800 dark:text-white">Cynthia Dube</h4>
                                <p class="text-gray-600 dark:text-gray-400">cynthia.dube@example.com</p>
                                <p class="text-gray-600 dark:text-gray-400">+265 999 123 456</p>
                                <button class="mt-3 bg-blue-500 text-white px-4 py-2 rounded-md font-semibold cursor-pointer hover:bg-blue-600 transition-colors duration-200">Edit Profile</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md">
                                <h4 class="font-semibold text-lg text-gray-800 dark:text-white mb-2">Personal Information</h4>
                                <p class="text-gray-600 dark:text-gray-300"><strong>Name:</strong> Cynthia Dube</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong>Email:</strong> cynthia.dube@example.com</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong>Phone:</strong> +265 999 123 456</p>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md">
                                <h4 class="font-semibold text-lg text-gray-800 dark:text-white mb-2">Account Settings</h4>
                                <p class="text-gray-600 dark:text-gray-300"><strong>Member Since:</strong> January 2024</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong>Last Login:</strong> 2025-06-06</p>
                                <button class="mt-3 bg-red-500 text-white px-4 py-2 rounded-md font-semibold cursor-pointer hover:bg-red-600 transition-colors duration-200">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifications Content -->
                <div id="notifications-content" class="content-section hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <button class="back-to-dashboard-btn flex items-center gap-1 mt-4 mb-4 px-3 py-2 bg-transparent border-none text-blue-600 font-semibold cursor-pointer rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 w-fit">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            Back to Dashboard
                        </button>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Notifications</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Here you can view all your notifications. Stay updated on new land listings, responses to your inquiries, payment reminders, and important announcements from ATSOGO.</p>

                        <div class="space-y-4">
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md flex items-start gap-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <i data-lucide="bell" class="w-6 h-6 text-yellow-500 flex-shrink-0 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800 dark:text-white">New Land Listing!</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">A new residential plot in Area C has just been listed. <a href="#" class="text-blue-600 hover:underline">View details</a>.</p>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">2 hours ago</span>
                                </div>
                                <button class="ml-auto text-gray-500 hover:text-red-500 transition-colors duration-200" data-lucide="x"></button>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md flex items-start gap-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <i data-lucide="mail" class="w-6 h-6 text-emerald-500 flex-shrink-0 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800 dark:text-white">Inquiry Response for "Commercial Space"</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">Your inquiry for "Commercial Space near Market" has received a response. <a href="#" class="text-blue-600 hover:underline">View response</a>.</p>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">1 day ago</span>
                                </div>
                                <button class="ml-auto text-gray-500 hover:text-red-500 transition-colors duration-200" data-lucide="x"></button>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md flex items-start gap-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <i data-lucide="wallet" class="w-6 h-6 text-purple-600 flex-shrink-0 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800 dark:text-white">Payment Reminder</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">Your quarterly payment for "Plot in Lilongwe" is due on 2025-06-15. <a href="#" class="text-blue-600 hover:underline">Make payment</a>.</p>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">3 days ago</span>
                                </div>
                                <button class="ml-auto text-gray-500 hover:text-red-500 transition-colors duration-200" data-lucide="x"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommendation Generator Modal -->
                <div id="recommendation-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 items-center justify-center p-4 z-[100] hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-lg relative">
                        <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300" id="close-recommendation-modal">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Generate Land Recommendations</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Tell us your preferences to get personalized land recommendations.</p>
                        <div class="mb-4">
                            <label for="land-type" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Preferred Land Type</label>
                            <select id="land-type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Select a type</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Agricultural">Agricultural</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="location-preference" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Location Preference</label>
                            <input type="text" id="location-preference" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:border-gray-600" placeholder="e.g., Urban, Rural, Near water">
                        </div>
                        <div class="mb-6">
                            <label for="budget" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Maximum Budget ($)</label>
                            <input type="number" id="budget" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:border-gray-600" placeholder="e.g., 100000">
                        </div>
                        <button id="generate-recommendations-btn" class="bg-yellow-500 text-gray-800 px-6 py-2 rounded-md font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200 w-full flex items-center justify-center gap-2">
                            <span id="generate-recommendations-text">Generate Recommendations</span>
                            <div id="loading-spinner" class="hidden animate-spin rounded-full h-5 w-5 border-b-2 border-gray-900"></div>
                        </button>
                        <div id="recommendation-results" class="mt-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-md max-h-60 overflow-y-auto hidden">
                            <h4 class="font-semibold text-gray-800 dark:text-white mb-2">Your Personalized Recommendations:</h4>
                            <!-- Recommendations will be inserted here by JS -->
                            <p class="text-gray-600 dark:text-gray-300">No recommendations generated yet. Please fill in your preferences.</p>
                        </div>
                    </div>
                </div>

                <!-- Bank Payment Modal -->
                <div id="bank-payment-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 items-center justify-center p-4 z-[100] hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-md relative">
                        <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300" id="close-bank-payment-modal">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Make a Bank Payment</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Please use the following bank details to make your payment. After making the payment, you can upload proof of payment below.</p>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md mb-6">
                            <p class="font-semibold text-gray-800 dark:text-white mb-2">Bank Details:</p>
                            <p class="text-gray-600 dark:text-gray-300"><strong>Bank Name:</strong> ATSOGO Bank PLC</p>
                            <p class="text-gray-600 dark:text-gray-300"><strong>Account Name:</strong> ATSOGO Land Services</p>
                            <p class="text-gray-600 dark:text-gray-300"><strong>Account Number:</strong> 1234567890</p>
                            <p class="text-gray-600 dark:text-gray-300"><strong>Swift Code:</strong> ATSGMZMW</p>
                            <button id="copy-bank-details" class="mt-3 bg-blue-500 text-white px-4 py-2 rounded-md text-sm font-semibold cursor-pointer hover:bg-blue-600 transition-colors duration-200">Copy Details</button>
                        </div>

                        <div class="mb-4">
                            <label for="proof-of-payment" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Upload Proof of Payment</label>
                            <input type="file" id="proof-of-payment" accept=".pdf,.jpg,.png" class="block w-full text-sm text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 transition duration-200">
                        </div>
                        <div class="mb-6">
                            <label for="payment-notes" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Payment Notes (Optional)</label>
                            <textarea id="payment-notes" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:border-gray-600" placeholder="e.g., Reference number, additional details"></textarea>
                        </div>
                        <button id="submit-payment-proof" class="bg-yellow-500 text-gray-800 px-6 py-2 rounded-md font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200 w-full">
                            Submit Proof of Payment
                        </button>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const openSidebarBtn = document.getElementById('open-sidebar');
        const closeSidebarBtn = document.getElementById('close-sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const navItems = document.querySelectorAll('.nav-item-content');
        const contentSections = document.querySelectorAll('.content-section');
        const backToDashboardBtns = document.querySelectorAll('.back-to-dashboard-btn');
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const notificationBadge = document.getElementById('notification-badge');
        const notificationBellButton = document.getElementById('notification-bell-button');
        const chatInput = document.getElementById('chat-input');
        const sendChatBtn = document.getElementById('send-chat-btn');
        const chatMessages = document.getElementById('chat-messages');
        const chatLanguageSelect = document.getElementById('chat-language-select');

        // Modal Elements
        const recommendationModal = document.getElementById('recommendation-modal');
        const openRecommendationGeneratorBtn = document.getElementById('open-recommendation-generator');
        const closeRecommendationModalBtn = document.getElementById('close-recommendation-modal');
        const generateRecommendationsBtn = document.getElementById('generate-recommendations-btn');
        const recommendationResults = document.getElementById('recommendation-results');
        const loadingSpinner = document.getElementById('loading-spinner');
        const generateRecommendationsText = document.getElementById('generate-recommendations-text');

        const bankPaymentModal = document.getElementById('bank-payment-modal');
        const openBankPaymentModalBtn = document.getElementById('open-bank-payment-modal');
        const closeBankPaymentModalBtn = document.getElementById('close-bank-payment-modal');
        const copyBankDetailsBtn = document.getElementById('copy-bank-details');
        const submitPaymentProofBtn = document.getElementById('submit-payment-proof');


        // --- Sidebar Toggling Logic ---
        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
            sidebarOverlay.classList.toggle('visible');
            document.body.classList.toggle('overflow-hidden'); // Prevent scrolling body when sidebar is open
        }

        openSidebarBtn.addEventListener('click', toggleSidebar);
        closeSidebarBtn.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar); // Close sidebar when clicking overlay

        // Close sidebar on larger screens if it's open on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768 && sidebar.classList.contains('collapsed')) {
                sidebar.classList.remove('collapsed');
                sidebarOverlay.classList.remove('visible');
                document.body.classList.remove('overflow-hidden');
            }
            // Redraw chart on resize to ensure responsiveness
            if (profileCompletionChart) {
                profileCompletionChart.resize();
            }
        });

        // --- Theme Toggling Logic ---
        function toggleTheme() {
            const isDarkMode = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
            updateThemeIcon(isDarkMode);
        }

        function updateThemeIcon(isDarkMode) {
            if (isDarkMode) {
                themeIcon.setAttribute('data-lucide', 'sun');
            } else {
                themeIcon.setAttribute('data-lucide', 'moon');
            }
            lucide.createIcons(); // Re-render icon after changing data-lucide attribute
        }

        // Apply theme on load
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            updateThemeIcon(true);
        } else {
            document.documentElement.classList.remove('dark');
            updateThemeIcon(false);
        }

        themeToggleBtn.addEventListener('click', toggleTheme);

        // --- Navigation and Content Switching Logic ---
        function showContent(contentId) {
            // Hide all content sections
            contentSections.forEach(section => {
                section.classList.add('hidden');
                section.classList.remove('animate-fadeIn');
            });

            // Show the selected content section
            const targetContent = document.getElementById(contentId);
            if (targetContent) {
                targetContent.classList.remove('hidden');
                targetContent.classList.add('animate-fadeIn');
            }
        }

        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class from all nav items
                navItems.forEach(nav => nav.classList.remove('active-nav'));
                // Add active class to the clicked item
                this.classList.add('active-nav');
                // Show corresponding content
                const contentId = this.getAttribute('data-content-id');
                if (contentId === 'logout-action') {
                    // Handle logout action (e.g., redirect to logout route)
                    console.log('Logout action triggered');
                    // For a real app, you would redirect to: window.location.href = '/logout';
                } else {
                    showContent(contentId);
                    // Close sidebar on mobile after navigation
                    if (window.innerWidth < 768 && !sidebar.classList.contains('collapsed')) {
                        toggleSidebar();
                    }
                }
            });
        });

        backToDashboardBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                // Find and activate the dashboard nav item
                const dashboardNavItem = document.querySelector('[data-content-id="dashboard-content"]');
                if (dashboardNavItem) {
                    navItems.forEach(nav => nav.classList.remove('active-nav'));
                    dashboardNavItem.classList.add('active-nav');
                }
                showContent('dashboard-content');
            });
        });

        // --- Profile Completion Chart ---
        const ctx = document.getElementById('profile-completion-chart').getContext('2d');
        let profileCompletionChart; // Declare outside to make it accessible for resize

        function createOrUpdateChart() {
            if (profileCompletionChart) {
                profileCompletionChart.destroy(); // Destroy existing chart before creating a new one
            }
            profileCompletionChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [80, 20], // 80% completed, 20% remaining
                        backgroundColor: [
                            '#F59E0B', // yellow-500
                            '#E5E7EB'  // gray-200
                        ],
                        borderColor: [
                            '#F59E0B',
                            '#E5E7EB'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%', // Make it a doughnut chart
                    plugins: {
                        tooltip: {
                            enabled: false // Disable tooltips
                        },
                        legend: {
                            display: false // Hide legend
                        }
                    }
                }
            });
        }
        createOrUpdateChart(); // Initial chart creation

        // --- Notification Badge Logic ---
        function updateNotificationBadge(count) {
            if (count > 0) {
                notificationBadge.textContent = ''; // Optionally put count here
                notificationBadge.classList.remove('opacity-0', 'invisible', 'scale-50');
                notificationBadge.classList.add('opacity-100', 'visible', 'scale-100');
            } else {
                notificationBadge.classList.remove('opacity-100', 'visible', 'scale-100');
                notificationBadge.classList.add('opacity-0', 'invisible', 'scale-50');
            }
        }
        // Example: Set initial notification count (e.g., from server)
        updateNotificationBadge(3); // Shows a badge for 3 notifications

        notificationBellButton.addEventListener('click', function() {
            // When bell is clicked, assume notifications are viewed and clear badge
            updateNotificationBadge(0);
            // Also navigate to notifications content
            const notificationsNavItem = document.querySelector('[data-content-id="notifications-content"]');
            if (notificationsNavItem) {
                navItems.forEach(nav => nav.classList.remove('active-nav'));
                notificationsNavItem.classList.add('active-nav');
            }
            showContent('notifications-content');
        });


        // --- Chat Functionality ---
        sendChatBtn.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        async function sendMessage() {
            const userMessageText = chatInput.value.trim();
            const selectedLanguage = chatLanguageSelect.value;

            if (userMessageText === '') return;

            // Add user message to chat
            appendMessage(userMessageText, 'user');
            chatInput.value = ''; // Clear input

            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Show a "typing" indicator or spinner (optional)
            const typingIndicator = appendMessage('...', 'ai');
            typingIndicator.classList.add('typing-indicator'); // Add class for pulsing dots if desired
            chatMessages.scrollTop = chatMessages.scrollHeight;

            try {
                // Simulate API call for AI response
                const prompt = `Translate the following user message to ${selectedLanguage} and then respond as a helpful land service assistant. User message: "${userMessageText}"`;
                const payload = { contents: [{ role: "user", parts: [{ text: prompt }] }] };
                const apiKey = ""; // Canvas will provide this at runtime
                const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();
                let aiResponseText = "I'm sorry, I couldn't get a response. Please try again.";

                if (result.candidates && result.candidates.length > 0 &&
                    result.candidates[0].content && result.candidates[0].content.parts &&
                    result.candidates[0].content.parts.length > 0) {
                    aiResponseText = result.candidates[0].content.parts[0].text;
                }

                // Remove typing indicator and append AI response
                chatMessages.removeChild(typingIndicator);
                appendMessage(aiResponseText, 'ai');

            } catch (error) {
                console.error('Error fetching AI response:', error);
                chatMessages.removeChild(typingIndicator); // Remove typing indicator even on error
                appendMessage("I'm having trouble connecting right now. Please try again later.", 'ai');
            }

            // Scroll to bottom after AI response
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function appendMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add(
                'chat-message',
                'p-2',
                'rounded-lg',
                'mb-3',
                'max-w-[80%]',
                'break-words',
                'leading-tight'
            );

            if (sender === 'user') {
                messageDiv.classList.add('bg-blue-500', 'text-white', 'rounded-br-sm', 'self-end');
            } else { // sender === 'ai'
                messageDiv.classList.add('bg-yellow-400', 'text-gray-800', 'rounded-bl-sm', 'self-start');
            }
            messageDiv.textContent = text;
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight; // Auto-scroll to latest message
            return messageDiv;
        }

        // --- Modal Logic (Recommendation Generator) ---
        function openModal(modalElement) {
            modalElement.classList.remove('hidden');
            modalElement.classList.add('flex');
            document.body.classList.add('overflow-hidden'); // Prevent body scrolling
        }

        function closeModal(modalElement) {
            modalElement.classList.add('hidden');
            modalElement.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        openRecommendationGeneratorBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal(recommendationModal);
        });
        closeRecommendationModalBtn.addEventListener('click', () => {
            closeModal(recommendationModal);
        });

        generateRecommendationsBtn.addEventListener('click', async () => {
            const landType = document.getElementById('land-type').value;
            const locationPreference = document.getElementById('location-preference').value;
            const budget = document.getElementById('budget').value;

            // Basic validation
            if (!landType && !locationPreference && !budget) {
                recommendationResults.innerHTML = '<p class="text-red-500">Please provide at least one preference.</p>';
                recommendationResults.classList.remove('hidden');
                return;
            }

            generateRecommendationsText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            recommendationResults.classList.add('hidden'); // Hide previous results

            try {
                const prompt = `Generate 3 land recommendations based on the following criteria: Type: ${landType || 'any'}, Location: ${locationPreference || 'any'}, Max Budget: ${budget ? '$' + budget : 'any'}. Format the output as a JSON array of objects with properties: "title", "location", "price", "description".`;
                const payload = {
                    contents: [{ role: "user", parts: [{ text: prompt }] }],
                    generationConfig: {
                        responseMimeType: "application/json",
                        responseSchema: {
                            type: "ARRAY",
                            items: {
                                type: "OBJECT",
                                properties: {
                                    "title": { "type": "STRING" },
                                    "location": { "type": "STRING" },
                                    "price": { "type": "STRING" },
                                    "description": { "type": "STRING" }
                                },
                                propertyOrdering: ["title", "location", "price", "description"]
                            }
                        }
                    }
                };
                const apiKey = "";
                const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();
                let recommendations = [];

                if (result.candidates && result.candidates.length > 0 &&
                    result.candidates[0].content && result.candidates[0].content.parts &&
                    result.candidates[0].content.parts.length > 0) {
                    try {
                        recommendations = JSON.parse(result.candidates[0].content.parts[0].text);
                    } catch (parseError) {
                        console.error('Failed to parse JSON:', parseError);
                        recommendationResults.innerHTML = '<p class="text-red-500">Error: Could not parse recommendations.</p>';
                    }
                }

                if (recommendations.length > 0) {
                    let html = '<ul class="list-disc pl-5 space-y-3">';
                    recommendations.forEach(rec => {
                        html += `<li class="text-gray-600 dark:text-gray-300">
                                    <strong class="text-gray-800 dark:text-white">${rec.title}</strong><br>
                                    Location: ${rec.location}<br>
                                    Price: ${rec.price}<br>
                                    ${rec.description}
                                  </li>`;
                    });
                    html += '</ul>';
                    recommendationResults.innerHTML = html;
                } else {
                    recommendationResults.innerHTML = '<p class="text-gray-600 dark:text-gray-300">No recommendations found for your criteria. Please try different preferences.</p>';
                }
                recommendationResults.classList.remove('hidden');

            } catch (error) {
                console.error('Error generating recommendations:', error);
                recommendationResults.innerHTML = '<p class="text-red-500">Failed to generate recommendations. Please try again.</p>';
                recommendationResults.classList.remove('hidden');
            } finally {
                loadingSpinner.classList.add('hidden');
                generateRecommendationsText.classList.remove('hidden');
            }
        });


        // --- Modal Logic (Bank Payment) ---
        openBankPaymentModalBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal(bankPaymentModal);
        });
        closeBankPaymentModalBtn.addEventListener('click', () => {
            closeModal(bankPaymentModal);
        });

        copyBankDetailsBtn.addEventListener('click', () => {
            const bankDetailsText = `Bank Name: ATSOGO Bank PLC\nAccount Name: ATSOGO Land Services\nAccount Number: 1234567890\nSwift Code: ATSGMZMW`;
            const textarea = document.createElement('textarea');
            textarea.value = bankDetailsText;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            const originalText = copyBankDetailsBtn.textContent;
            copyBankDetailsBtn.textContent = 'Copied!';
            setTimeout(() => {
                copyBankDetailsBtn.textContent = originalText;
            }, 2000);
        });

        submitPaymentProofBtn.addEventListener('click', () => {
            // In a real application, you would handle file upload here (e.g., via FormData and Fetch API to your backend)
            const proofFile = document.getElementById('proof-of-payment').files[0];
            const paymentNotes = document.getElementById('payment-notes').value;

            if (proofFile) {
                console.log('Submitting proof of payment:', proofFile.name);
                console.log('Payment Notes:', paymentNotes);
                alert('Proof of payment submitted successfully! (This is a demo action)'); // Use a custom modal in production
                closeModal(bankPaymentModal);
                // Clear form fields
                document.getElementById('proof-of-payment').value = '';
                document.getElementById('payment-notes').value = '';
            } else {
                alert('Please select a file to upload as proof of payment.'); // Use a custom modal in production
            }
        });

    </script>
</body>
</html>
