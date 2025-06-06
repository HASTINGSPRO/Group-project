<x-layout>
<div style="background-image: url(/plot.jpg) ;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh; color: white; padding: 20px;">

@auth()
<div id="theme-body" class="flex min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white font-inter transition-colors duration-300 antialiased">

    <!-- Sidebar -->
    <aside id="sidebar" class="w-72 md:w-280px lg:w-280px bg-white dark:bg-gray-800 p-6 shadow-md flex flex-col transition-all duration-300 flex-shrink-0 relative z-50">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-xl font-bold text-indigo-600 whitespace-nowrap overflow-hidden">ATSOGO</h1>
            <button id="close-sidebar" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-0 md:hidden" style="display: none;">
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

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="flex justify-between items-center px-8 py-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm flex-shrink-0">
            <button id="open-sidebar" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-0 mr-4 md:hidden" style="display: none;">
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
                            <h3 class="m-0 mt-1 text-2xl font-bold text-indigo-600">15</h3>
                        </div>
                        <i data-lucide="message-square" class="text-indigo-600 text-4xl opacity-70"></i>
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
                        <div class="chat-message ai bg-yellow-400 text-gray-800 p-2 rounded-lg rounded-bl-sm mb-3 max-w-4/5 self-start break-words leading-tight">Hello! How can I assist you today?</div>
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
            <div id="my-inquiries-content" class="content-section hidden animate-fadeIn">
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
                                    <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Agricultural Land with River Access"</td>
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
            <div id="saved-lands-content" class="content-section hidden animate-fadeIn">
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
                                        <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200">View</button>
                                        <button class="bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-red-700 transition-colors duration-200">Remove</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Urban Development Land"</td>
                                    <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Central Region</td>
                                    <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">$120,000</td>
                                    <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-03-10</td>
                                    <td class="p-3 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">
                                        <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200">View</button>
                                        <button class="bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-red-700 transition-colors duration-200">Remove</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 text-gray-800 dark:text-white font-medium border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">"Small Farm Land"</td>
                                    <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">Southern Region</td>
                                    <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">$35,000</td>
                                    <td class="p-3 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">2025-02-28</td>
                                    <td class="p-3 border-b border-gray-200 dark:border-gray-700 whitespace-nowrap">
                                        <button class="bg-yellow-500 text-gray-800 px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-yellow-600 transition-colors duration-200">View</button>
                                        <button class="bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-semibold cursor-pointer hover:bg-red-700 transition-colors duration-200">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recently Viewed Content -->
            <div id="recently-viewed-content" class="content-section hidden animate-fadeIn">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                    <button class="back-to-dashboard-btn flex items-center gap-1 mt-4 mb-4 px-3 py-2 bg-transparent border-none text-blue-600 font-semibold cursor-pointer rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 w-fit">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        Back to Dashboard
                    </button>
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Recently Viewed Lands</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">This is a quick access list of all the land properties you've recently viewed. Click on any property to revisit its details page, or use the "Browse More Lands" button to explore new listings.</p>
                    <button class="bg-yellow-500 text-gray-800 px-4 py-2 rounded-md font-semibold cursor-pointer transition-colors duration-200 hover:bg-yellow-600 mb-6 flex items-center gap-2">
                        <i data-lucide="compass" class="w-4 h-4"></i> Browse More Lands
                    </button>
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
                        <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                            <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+5" alt="Land 5" class="w-full h-24 object-cover rounded-sm mb-3">
                            <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Lakefront Property</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Leisure</p>
                        </div>
                        <div class="text-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm hover:translate-y-[-3px] transition-transform duration-200">
                            <img src="https://placehold.co/150x100/374151/9CA3AF?text=Land+6" alt="Land 6" class="w-full h-24 object-cover rounded-sm mb-3">
                            <p class="font-semibold text-gray-800 dark:text-white mb-1 text-sm">Industrial Zone Plot</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Industrial</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div id="profile-content" class="content-section hidden animate-fadeIn">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                    <button class="back-to-dashboard-btn flex items-center gap-1 mt-4 mb-4 px-3 py-2 bg-transparent border-none text-blue-600 font-semibold cursor-pointer rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 w-fit">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        Back to Dashboard
                    </button>
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">My Profile</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Here you can update your personal information, contact details, and account settings. Keeping your profile up-to-date helps us provide you with the best service and relevant land recommendations.</p>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="profile-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name:</label>
                            <div class="relative flex items-center">
                                <input type="text" id="profile-name" class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 focus:outline-none focus:border-yellow-500" value="Cynthia Dube">
                                <i data-lucide="user" class="absolute left-3 text-gray-500"></i>
                            </div>
                        </div>
                        <div>
                            <label for="profile-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address:</label>
                            <div class="relative flex items-center">
                                <input type="email" id="profile-email" class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 focus:outline-none focus:border-yellow-500" value="cynthia.dube@example.com">
                                <i data-lucide="mail" class="absolute left-3 text-gray-500"></i>
                            </div>
                        </div>
                        <div>
                            <label for="profile-phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number:</label>
                            <div class="relative flex items-center">
                                <input type="text" id="profile-phone" class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 focus:outline-none focus:border-yellow-500" value="+265 999 123 456">
                                <i data-lucide="phone" class="absolute left-3 text-gray-500"></i>
                            </div>
                        </div>
                        <div>
                            <label for="profile-address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address:</label>
                            <div class="relative flex items-center">
                                <input type="text" id="profile-address" class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 focus:outline-none focus:border-yellow-500" value="123 Main Street, Lilongwe, Malawi">
                                <i data-lucide="map-pin" class="absolute left-3 text-gray-500"></i>
                            </div>
                        </div>
                        <button class="bg-yellow-500 text-gray-800 px-6 py-3 rounded-md font-semibold cursor-pointer transition-colors duration-200 hover:bg-yellow-600 mt-4">Update Profile</button>
                    </div>
                </div>
            </div>

            <!-- Notifications Content -->
            <div id="notifications-content" class="content-section hidden animate-fadeIn">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                    <button class="back-to-dashboard-btn flex items-center gap-1 mt-4 mb-4 px-3 py-2 bg-transparent border-none text-blue-600 font-semibold cursor-pointer rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 w-fit">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        Back to Dashboard
                    </button>
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Notifications</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Stay updated with important alerts and messages regarding your inquiries, saved lands, and new listings. We'll keep you informed about activities that matter to you.</p>
                    <button class="bg-yellow-500 text-gray-800 px-4 py-2 rounded-md font-semibold cursor-pointer transition-colors duration-200 hover:bg-yellow-600 mb-4 flex items-center gap-2">
                        <i data-lucide="check-check" class="w-4 h-4"></i> Mark all as read
                    </button>
                    <ul class="list-none p-0">
                        <li class="flex items-start gap-3 mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                            <i data-lucide="check-circle" class="text-emerald-500 w-6 h-6 flex-shrink-0"></i>
                            <div>
                                <p class="font-semibold m-0 text-gray-800 dark:text-white">Your inquiry #1002 has been responded to!</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 m-0 mt-1">Check 'My Inquiries' for details. <span class="italic">(2 hours ago)</span></p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                            <i data-lucide="alert-triangle" class="text-yellow-500 w-6 h-6 flex-shrink-0"></i>
                            <div>
                                <p class="font-semibold m-0 text-gray-800 dark:text-white">Action Required: Complete your profile!</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 m-0 mt-1">Update your profile to 100% for better recommendations. <span class="italic">(1 day ago)</span></p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 mb-4">
                            <i data-lucide="info" class="text-blue-600 w-6 h-6 flex-shrink-0"></i>
                            <div>
                                <p class="font-semibold m-0 text-gray-800 dark:text-white">New land listing in Lilongwe matching your preferences!</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 m-0 mt-1">Explore new opportunities. <span class="italic">(3 days ago)</span></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
    </div>

    <!-- Land Recommendation Generator Modal -->
    <div id="recommendation-generator-modal" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-[1000] opacity-0 invisible transition-all duration-300">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl w-11/12 max-w-lg translate-y-[-20px] transition-transform duration-300 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">💡 Get Land Recommendations</h3>
                <button id="close-recommendation-generator" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-0">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <div class="flex justify-end mb-4">
                <label for="recommendation-language-select" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mr-2 self-center">Language:</label>
                <select id="recommendation-language-select" class="w-auto px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 focus:outline-none focus:border-yellow-500">
                    <option value="English">English</option>
                    <option value="Chichewa">Chichewa</option>
                    <option value="Yao">Yao</option>
                    <option value="Tumbuka">Tumbuka</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="preferences-input" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tell us your land preferences (e.g., location, size, type, budget, desired features):</label>
                <textarea id="preferences-input" rows="6" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 resize-y focus:outline-none focus:border-yellow-500" placeholder="e.g., I'm looking for agricultural land near a river in the Southern Region, around 10-20 acres, with good soil for maize, budget up to $50,000."></textarea>
            </div>
            <button id="get-recommendations-btn" class="bg-yellow-500 text-gray-800 px-6 py-3 rounded-md font-semibold cursor-pointer transition-colors duration-200 hover:bg-yellow-600 flex items-center justify-center gap-2 w-full disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed disabled:opacity-70">
                <span id="recommend-button-text">Get Recommendations</span>
                <svg id="recommend-loading-spinner" class="animate-spin w-5 h-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            <div class="mt-6">
                <h4 class="text-base font-semibold text-gray-800 dark:text-white mb-2">AI-Powered Recommendations:</h4>
                <div id="recommendations-output" class="p-3 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 min-h-[100px] max-h-[300px] overflow-y-auto whitespace-pre-wrap">
                    Enter your preferences above and click "Get Recommendations" to receive personalized land suggestions based on your criteria.
                </div>
            </div>
        </div>
    </div>

    <!-- Bank Transfer Payment Modal -->
    <div id="bank-payment-modal" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-[1000] opacity-0 invisible transition-all duration-300">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl w-11/12 max-w-lg translate-y-[-20px] transition-transform duration-300 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">💰 Bank Transfer Payment</h3>
                <button id="close-bank-payment-modal" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-0">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                To make a payment, please transfer the required amount to the bank account details below.
                <strong class="font-bold">Crucially, include the unique reference number provided below in your bank transfer description.</strong>
                This helps us quickly identify and process your payment.
            </p>

            <div class="grid grid-cols-1 gap-4 mb-6">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">Account Name:</p>
                        <p class="text-base text-gray-600 dark:text-gray-400">ATSOGO Land Trust</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">Bank Name:</p>
                        <p class="text-base text-gray-600 dark:text-gray-400">Malawi National Bank</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">Account Number:</p>
                        <p class="text-base text-gray-600 dark:text-gray-400">1234567890123</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">SWIFT/BIC:</p>
                        <p class="text-base text-gray-600 dark:text-gray-400">MNBLMWMW</p>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="payment-reference" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Unique Payment Reference:</label>
                <div class="relative flex items-center">
                    <input type="text" id="payment-reference" class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md text-base text-indigo-600 font-bold bg-gray-100 dark:bg-gray-700 focus:outline-none focus:border-yellow-500" readonly>
                    <i data-lucide="tag" class="absolute left-3 text-gray-500"></i>
                </div>
            </div>

            <div class="mb-4">
                <label for="transferred-amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Amount Transferred (e.g., 500.00):</label>
                <div class="relative flex items-center">
                    <input type="number" id="transferred-amount" class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md text-base text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 focus:outline-none focus:border-yellow-500" placeholder="e.g., 1000.00" step="0.01">
                    <i data-lucide="dollar-sign" class="absolute left-3 text-gray-500"></i>
                </div>
            </div>

            <button id="confirm-transfer-btn" class="bg-yellow-500 text-gray-800 px-6 py-3 rounded-md font-semibold cursor-pointer transition-colors duration-200 hover:bg-yellow-600 flex items-center justify-center gap-2 w-full disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed disabled:opacity-70">
                <span id="confirm-transfer-button-text">Confirm My Transfer</span>
                <svg id="confirm-transfer-loading-spinner" class="animate-spin w-5 h-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            <div id="payment-message" class="mt-4 text-sm text-gray-600 dark:text-gray-400"></div>
        </div>
    </div>

    <!-- Confirmation/Alert Modal -->
    <div id="alert-modal" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-[1000] opacity-0 invisible transition-all duration-300">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl w-11/12 max-w-md text-center translate-y-[-20px] transition-transform duration-300 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 id="alert-modal-title" class="text-xl font-semibold text-gray-800 dark:text-white m-0"></h3>
                <button id="close-alert-modal" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-0">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <p id="alert-modal-message" class="text-gray-600 dark:text-gray-400 mb-6"></p>
            <button id="alert-modal-confirm-btn" class="bg-yellow-500 text-gray-800 px-6 py-3 rounded-md font-semibold cursor-pointer transition-colors duration-200 hover:bg-yellow-600 w-full hidden">Confirm</button>
            <button id="alert-modal-ok-btn" class="bg-yellow-500 text-gray-800 px-6 py-3 rounded-md font-semibold cursor-pointer transition-colors duration-200 hover:bg-yellow-600 w-full">OK</button>
        </div>
    </div>

</div>

@push('scripts')
    <!-- Lucide Icons (assuming it's loaded in x-layout, but kept here for self-contained example) -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons(); // Initialize Lucide icons on page load
    </script>

    <!-- JavaScript for interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const openSidebarBtn = document.getElementById('open-sidebar');
            const closeSidebarBtn = document.getElementById('close-sidebar');
            const body = document.getElementById('theme-body');
            const navLinks = document.querySelectorAll('.nav-item-content');
            const contentSections = document.querySelectorAll('.content-section');

            // Variable to store the ID of the last active content section
            let lastActiveContentId = 'dashboard-content'; // Default to dashboard

            // --- Helper function for custom alerts/confirms ---
            const alertModal = document.getElementById('alert-modal');
            const alertModalTitle = document.getElementById('alert-modal-title');
            const alertModalMessage = document.getElementById('alert-modal-message');
            const closeAlertModalBtn = document.getElementById('close-alert-modal');
            const alertModalConfirmBtn = document.getElementById('alert-modal-confirm-btn');
            const alertModalOkBtn = document.getElementById('alert-modal-ok-btn');

            function showAlert(title, message, isConfirm = false, onConfirm = null) {
                alertModalTitle.textContent = title;
                alertModalMessage.textContent = message;
                alertModal.classList.add('active'); // Use Tailwind's opacity/visibility for modal-overlay

                if (isConfirm) {
                    alertModalConfirmBtn.style.display = 'block';
                    alertModalOkBtn.textContent = 'Cancel';
                    alertModalConfirmBtn.onclick = () => {
                        alertModal.classList.remove('active');
                        if (onConfirm) onConfirm();
                    };
                } else {
                    alertModalConfirmBtn.style.display = 'none';
                    alertModalOkBtn.textContent = 'OK';
                }

                alertModalOkBtn.onclick = () => alertModal.classList.remove('active');
                closeAlertModalBtn.onclick = () => alertModal.classList.remove('active');
            }


            // --- Sidebar Toggle Logic (for mobile and Gemini AI-like hover) ---
            const triggerZoneWidth = 50; // Pixels from the left edge to trigger sidebar expansion
            let isMouseOverSidebar = false; // Flag to track if mouse is directly over the sidebar

            // Function to set sidebar state
            function setSidebarState(isExpanded) {
                const sidebarClasses = sidebar.classList;
                const navTextElements = sidebar.querySelectorAll('.nav-text');
                const userDetails = sidebar.querySelector('.user-profile .user-details');
                const avatar = sidebar.querySelector('.user-profile .avatar');
                const sidebarTitle = sidebar.querySelector('h1');

                if (isExpanded) {
                    sidebarClasses.remove('sidebar-collapsed');
                    sidebarClasses.add('sidebar-open'); // For mobile specific control
                    // Restore original widths/display for expanded state
                    sidebar.style.width = '280px'; // Explicitly set expanded width
                    closeSidebarBtn.style.display = 'block';
                    navTextElements.forEach(el => el.style.display = 'inline'); // Show text
                    if (userDetails) userDetails.style.display = 'flex'; // Show user details
                    if (avatar) avatar.style.margin = ''; // Remove auto margin if set
                    if (sidebarTitle) {
                        sidebarTitle.style.fontSize = ''; // Restore original font size
                        sidebarTitle.style.width = ''; // Restore original width
                        sidebarTitle.style.overflow = ''; // Restore original overflow
                        sidebarTitle.style.justifyContent = '';
                        sidebarTitle.style.textAlign = '';
                        // Remove ::before content if it exists
                        sidebarTitle.classList.remove('collapsed-logo');
                    }
                } else {
                    sidebarClasses.add('sidebar-collapsed');
                    sidebarClasses.remove('sidebar-open');
                    // Collapse to small width and hide elements
                    sidebar.style.width = '80px'; // Explicitly set collapsed width
                    closeSidebarBtn.style.display = 'none';
                    navTextElements.forEach(el => el.style.display = 'none'); // Hide text
                    if (userDetails) userDetails.style.display = 'none'; // Hide user details
                    if (avatar) avatar.style.margin = '0 auto'; // Center avatar
                    if (sidebarTitle) {
                        sidebarTitle.style.fontSize = '0'; // Hide text
                        sidebarTitle.style.width = '40px'; // Adjust width for icon
                        sidebarTitle.style.overflow = 'hidden';
                        sidebarTitle.style.justifyContent = 'center';
                        sidebarTitle.style.textAlign = 'center';
                        sidebarTitle.classList.add('collapsed-logo'); // Add class for ::before content
                    }
                }
            }

            // Dynamically add the CSS for collapsed-logo once
            if (!document.getElementById('collapsed-logo-style')) {
                const style = document.createElement('style');
                style.id = 'collapsed-logo-style'; // Add an ID to prevent duplicates
                style.textContent = `
                    aside#sidebar.sidebar-collapsed h1.collapsed-logo::before {
                        content: "A";
                        font-size: 1.5rem;
                        font-weight: 700;
                        color: var(--indigo-600); /* Use Tailwind color */
                        display: block;
                        text-align: center;
                        margin: 0 auto;
                    }
                `;
                document.head.appendChild(style);
            }


            // Initial sidebar state based on screen size
            if (window.innerWidth <= 768) {
                setSidebarState(false); // Collapsed on mobile
            } else {
                setSidebarState(true); // Expanded on desktop initially
            }

            // Event listeners for mobile toggle buttons
            openSidebarBtn.addEventListener('click', () => {
                setSidebarState(true);
            });

            closeSidebarBtn.addEventListener('click', () => {
                setSidebarState(false);
            });

            // Mouse interaction for desktop (Gemini AI-like behavior)
            document.addEventListener('mousemove', (event) => {
                // Only apply this behavior on desktop
                if (window.innerWidth > 768) {
                    // If mouse is within the trigger zone
                    if (event.clientX < triggerZoneWidth) {
                        setSidebarState(true); // Expand sidebar
                    } else if (!isMouseOverSidebar) {
                        // If mouse is outside trigger zone AND not over the sidebar itself, collapse
                        setSidebarState(false);
                    }
                }
            });

            // Keep sidebar expanded if mouse is directly over it
            sidebar.addEventListener('mouseenter', () => {
                isMouseOverSidebar = true;
                if (window.innerWidth > 768) {
                    setSidebarState(true); // Ensure it's expanded when hovered
                }
            });

            sidebar.addEventListener('mouseleave', () => {
                isMouseOverSidebar = false;
                if (window.innerWidth > 768) {
                    // This debounce/delay helps prevent flickering if mouse quickly leaves
                    // A simple solution here is to let the global mousemove handle the collapse.
                    // More complex solutions involve debouncing or checking distance on mouseleave.
                }
            });

            // Handle resize to adjust sidebar state (important for switching between desktop/mobile)
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    setSidebarState(true); // Always expanded on desktop
                } else {
                    setSidebarState(false); // Collapsed on mobile
                }
                // Re-create icons if the sidebar state changes visibility of elements that need icons re-rendered
                lucide.createIcons();
            });


            // --- Theme Toggle Logic ---
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');

            // Check for saved theme preference on load
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme) {
                body.classList.add(currentTheme);
                if (currentTheme === 'dark-theme') {
                    themeIcon.setAttribute('data-lucide', 'sun');
                }
            }

            themeToggleBtn.addEventListener('click', () => {
                body.classList.toggle('dark-theme');
                if (body.classList.contains('dark-theme')) {
                    themeIcon.setAttribute('data-lucide', 'sun');
                    localStorage.setItem('theme', 'dark-theme');
                } else {
                    themeIcon.setAttribute('data-lucide', 'moon');
                    localStorage.setItem('theme', 'light-theme');
                }
                lucide.createIcons(); // Re-render icon after changing data-lucide attribute
            });

            // --- Main Content Navigation Logic ---
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault(); // Prevent default link behavior
                    
                    // Store the ID of the currently active content section before changing
                    const currentlyActiveSection = document.querySelector('.content-section.active');
                    if (currentlyActiveSection) {
                        lastActiveContentId = currentlyActiveSection.id;
                    }

                    // Remove active class from all links
                    navLinks.forEach(nav => nav.classList.remove('active-nav'));
                    // Add active class to clicked link
                    link.classList.add('active-nav');

                    const contentId = link.dataset.contentId;

                    // Handle special cases (modals or actions)
                    if (link.id === 'open-recommendation-generator') {
                        document.getElementById('recommendation-generator-modal').classList.add('active');
                        // Ensure other sections are hidden if previously visible
                        contentSections.forEach(section => section.classList.remove('active'));
                        return; // Stop further content switching
                    } else if (link.id === 'open-bank-payment-modal') {
                        document.getElementById('bank-payment-modal').classList.add('active');
                        // Ensure other sections are hidden if previously visible
                        contentSections.forEach(section => section.classList.remove('active'));
                        // Generate a unique reference number on opening the payment modal
                        document.getElementById('payment-reference').value = `ATS-${Math.random().toString(36).substring(2, 11).toUpperCase()}`;
                        return; // Stop further content switching
                    } else if (contentId === 'logout-action') {
                        showAlert('Logout', 'Are you sure you want to log out?', true, () => {
                            // Simulate logout action
                            console.log("User logged out!");
                            // In a real app, you'd redirect to a login page or clear session.
                            showAlert('Logged Out', 'You have been successfully logged out.', false);
                        });
                        return; // Stop further content switching
                    }

                    // Hide all content sections and show the active one
                    contentSections.forEach(section => {
                        if (section.id === contentId) {
                            section.classList.add('active');
                        } else {
                            section.classList.remove('active');
                        }
                    });
                });
            });

            // --- Back to Dashboard Button Logic ---
            const backToDashboardButtons = document.querySelectorAll('.back-to-dashboard-btn');
            backToDashboardButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    // Activate the dashboard content
                    document.getElementById('dashboard-content').classList.add('active');
                    // Deactivate other content sections
                    contentSections.forEach(section => {
                        if (section.id !== 'dashboard-content') {
                            section.classList.remove('active');
                        }
                    });
                    // Set 'My Dashboard' link as active in sidebar
                    navLinks.forEach(link => {
                        if (link.dataset.contentId === 'dashboard-content') {
                            link.classList.add('active-nav');
                        } else {
                            link.classList.remove('active-nav');
                        }
                    });
                    lastActiveContentId = 'dashboard-content'; // Reset last active to dashboard
                });
            });


            // --- Land Recommendation Generator Modal Logic ---
            const closeRecGenBtn = document.getElementById('close-recommendation-generator');
            const getRecBtn = document.getElementById('get-recommendations-btn');
            const recTextarea = document.getElementById('preferences-input');
            const recOutput = document.getElementById('recommendations-output');
            const recommendButtonText = document.getElementById('recommend-button-text');
            const recommendLoadingSpinner = document.getElementById('recommend-loading-spinner');
            const recommendationGeneratorModal = document.getElementById('recommendation-generator-modal');
            const recommendationLanguageSelect = document.getElementById('recommendation-language-select');


            closeRecGenBtn.addEventListener('click', () => {
                recommendationGeneratorModal.classList.remove('active');
                // Re-activate the last active content section
                document.getElementById(lastActiveContentId).classList.add('active');
                // Ensure the corresponding nav link is also active
                navLinks.forEach(link => {
                    if (link.dataset.contentId === lastActiveContentId) {
                        link.classList.add('active-nav');
                    } else {
                        link.classList.remove('active-nav');
                    }
                });
            });

            getRecBtn.addEventListener('click', async () => {
                const preferences = recTextarea.value.trim();
                const selectedLanguage = recommendationLanguageSelect.value;
                if (!preferences) {
                    recOutput.textContent = "Please enter your preferences to get recommendations.";
                    recOutput.classList.add('text-red-500'); // Use Tailwind class for error
                    return;
                }
                recOutput.classList.remove('text-red-500'); // Clear error state if any

                recommendButtonText.style.display = 'none';
                recommendLoadingSpinner.style.display = 'block';
                getRecBtn.disabled = true;

                recOutput.textContent = "Generating recommendations...";
                try {
                    let prompt = `Generate land recommendations based on the following preferences: ${preferences}. Provide a brief description, location, and an estimated price. Give at least 3 distinct recommendations. Respond in ${selectedLanguage}. Format as a numbered list.`;
                    let chatHistory = [];
                    chatHistory.push({ role: "user", parts: [{ text: prompt }] });
                    const payload = { contents: chatHistory };
                    const apiKey = ""; // Canvas will automatically provide the API key
                    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                    const response = await fetch(apiUrl, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify(payload)
                            });
                    const result = await response.json();

                    if (result.candidates && result.candidates.length > 0 &&
                        result.candidates[0].content && result.candidates[0].content.parts &&
                        result.candidates[0].content.parts.length > 0) {
                        recOutput.textContent = result.candidates[0].content.parts[0].text;
                    } else {
                        recOutput.textContent = `Failed to generate recommendations in ${selectedLanguage}. Please try again.`;
                        recOutput.classList.add('text-red-500');
                    }
                } catch (error) {
                    console.error("Error generating recommendations:", error);
                    recOutput.textContent = "An error occurred while generating recommendations. Please try again later.";
                    recOutput.classList.add('text-red-500');
                } finally {
                    recommendButtonText.style.display = 'block';
                    recommendLoadingSpinner.style.display = 'none';
                    getRecBtn.disabled = false;
                }
            });

            // --- Bank Transfer Payment Modal Logic ---
            const closeBankPaymentBtn = document.getElementById('close-bank-payment-modal');
            const bankPaymentModal = document.getElementById('bank-payment-modal');
            const paymentRefInput = document.getElementById('payment-reference');
            const transferredAmountInput = document.getElementById('transferred-amount');
            const confirmTransferBtn = document.getElementById('confirm-transfer-btn');
            const paymentMessage = document.getElementById('payment-message');
            const confirmTransferButtonText = document.getElementById('confirm-transfer-button-text');
            const confirmTransferLoadingSpinner = document.getElementById('confirm-transfer-loading-spinner');

            closeBankPaymentBtn.addEventListener('click', () => {
                bankPaymentModal.classList.remove('active');
                // Re-activate the last active content section
                document.getElementById(lastActiveContentId).classList.add('active');
                 // Ensure the corresponding nav link is also active
                 navLinks.forEach(link => {
                    if (link.dataset.contentId === lastActiveContentId) {
                        link.classList.add('active-nav');
                    } else {
                        link.classList.remove('active-nav');
                    }
                });
            });

            confirmTransferBtn.addEventListener('click', async () => {
                const reference = paymentRefInput.value;
                const amount = transferredAmountInput.value;

                if (!reference || !amount || isNaN(amount) || parseFloat(amount) <= 0) {
                    paymentMessage.textContent = 'Please provide a valid amount and reference number.';
                    paymentMessage.classList.add('text-red-500');
                    paymentMessage.classList.remove('text-emerald-500');
                    return;
                }
                paymentMessage.classList.remove('text-red-500'); // Clear previous error

                confirmTransferButtonText.style.display = 'none';
                confirmTransferLoadingSpinner.style.display = 'block';
                confirmTransferBtn.disabled = true;

                // Simulate API call to confirm transfer (replace with actual backend call)
                await new Promise(resolve => setTimeout(resolve, 2000));

                paymentMessage.textContent = `Thank you! Your payment of $${parseFloat(amount).toFixed(2)} with reference ${reference} has been confirmed. It will be processed shortly.`;
                paymentMessage.classList.add('text-emerald-500');
                paymentMessage.classList.remove('text-red-500');

                confirmTransferButtonText.style.display = 'block';
                confirmTransferLoadingSpinner.style.display = 'none';
                confirmTransferBtn.disabled = false;
            });

            // --- Chat functionality (basic) ---
            const chatInput = document.getElementById('chat-input');
            const sendChatBtn = document.getElementById('send-chat-btn');
            const chatMessages = document.getElementById('chat-messages');
            const chatLanguageSelect = document.getElementById('chat-language-select');

            sendChatBtn.addEventListener('click', async () => {
                const message = chatInput.value.trim();
                const selectedLanguage = chatLanguageSelect.value;
                if (message) {
                    const userMessageDiv = document.createElement('div');
                    userMessageDiv.classList.add('chat-message', 'user'); // Use Tailwind for background later
                    userMessageDiv.textContent = message;
                    chatMessages.appendChild(userMessageDiv);
                    chatInput.value = '';
                    chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll to bottom

                    // Simulate AI response with API call
                    const aiMessageDiv = document.createElement('div');
                    aiMessageDiv.classList.add('chat-message', 'ai'); // Use Tailwind for background later
                    aiMessageDiv.textContent = "Typing..."; // Placeholder while waiting for response
                    chatMessages.appendChild(aiMessageDiv);
                    chatMessages.scrollTop = chatMessages.scrollHeight;

                    try {
                        let prompt = `${message} (Please respond in ${selectedLanguage})`;
                        let chatHistory = [{ role: "user", parts: [{ text: prompt }] }];
                        const payload = { contents: chatHistory };
                        const apiKey = ""; // Canvas will automatically provide the API key
                        const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                        const response = await fetch(apiUrl, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(payload)
                        });
                        const result = await response.json();

                        if (result.candidates && result.candidates.length > 0 &&
                            result.candidates[0].content && result.candidates[0].content.parts &&
                            result.candidates[0].content.parts.length > 0) {
                            aiMessageDiv.textContent = result.candidates[0].content.parts[0].text;
                        } else {
                            aiMessageDiv.textContent = `Sorry, I couldn't generate a response in ${selectedLanguage}.`;
                        }
                    } catch (error) {
                        console.error("Error sending message to AI:", error);
                        aiMessageDiv.textContent = "An error occurred. Please try again.";
                    } finally {
                        chatMessages.scrollTop = chatMessages.scrollHeight; // Ensure scrolled to bottom after response
                    }
                }
            });

            chatInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    sendChatBtn.click();
                }
            });

            // --- Notification Bell Badge Logic ---
            const notificationBellButton = document.getElementById('notification-bell-button');
            const notificationBadge = document.getElementById('notification-badge');

            // Set an initial state for the badge (e.g., active for a new message)
            // For demonstration, let's start with it active.
            notificationBadge.classList.add('active'); // Use active class for Tailwind transition
            
            // Toggle the badge on click
            notificationBellButton.addEventListener('click', () => {
                notificationBadge.classList.toggle('active');
            });

            // --- Canvas for Profile Completion ---
            const profileCompletionCanvas = document.getElementById('profile-completion-chart');
            if (profileCompletionCanvas) {
                const ctx = profileCompletionCanvas.getContext('2d');
                const percentage = 80; // Get this value dynamically from your data
                const radius = 30;
                const centerX = profileCompletionCanvas.width / 2;
                const centerY = profileCompletionCanvas.height / 2;
                const lineWidth = 8;
                const startAngle = -Math.PI / 2; // Start from the top

                function drawProgressCircle(currentPercentage) {
                    ctx.clearRect(0, 0, profileCompletionCanvas.width, profileCompletionCanvas.height); // Clear canvas

                    // Tailwind dark mode color compatibility for canvas
                    const isDarkMode = body.classList.contains('dark-theme');
                    const borderColor = isDarkMode ? '#333' : '#e0e0e0';
                    const textColor = isDarkMode ? '#ffffff' : '#333';
                    const purpleColor = isDarkMode ? '#8B5CF6' : '#8B5CF6'; // Purple might stay same or adjust

                    // Background circle
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
                    ctx.strokeStyle = borderColor; // Light grey background or dark equivalent
                    ctx.lineWidth = lineWidth;
                    ctx.stroke();

                    // Progress arc
                    const endAngle = startAngle + (currentPercentage / 100) * (2 * Math.PI);
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
                    ctx.strokeStyle = purpleColor; // Purple color for progress
                    ctx.lineWidth = lineWidth;
                    ctx.stroke();

                    // Text (optional)
                    ctx.fillStyle = textColor;
                    ctx.font = '16px Inter';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(`${Math.round(currentPercentage)}%`, centerX, centerY);
                }

                // Initial draw and redraw on theme change
                drawProgressCircle(percentage);
                themeToggleBtn.addEventListener('click', () => drawProgressCircle(percentage));
            }
        });
    </script>
@endpush

@endauth

@guest()
    <div class="flex justify-center items-center h-screen">
    <div class="bg-white bg-opacity-80 backdrop-blur-lg p-8 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="text-2xl font-bold mb-6 text-center">Welcome to Atsogo</h1>
        <p class="text-gray-700 mb-4">Atsogo is a platform designed to help you manage your land transactions efficiently.</p>
        <p class="text-gray-700 mb-4">Please register or login to continue.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('register') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Register</a>
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Login</a>
        </div>
    </div>
@endguest
    

</div>
</x-layout>
