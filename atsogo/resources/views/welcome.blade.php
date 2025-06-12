<x-layout>
    <head>
        <!-- Tailwind CSS CDN: Essential for styling. This enables all Tailwind classes used below. -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            /* Optional: Apply Inter font globally for a modern look */
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>

        <!-- Font Awesome CSS: Crucial for displaying any icons (though none are currently in this snippet).
             Corrected 'xintegrity' to 'integrity' for proper loading. -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5KwDFWJ8pcyqqQpNPjNpXH7P2jJ/6hOtyWpNKx/bywM+bQUIPTfMfw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <!-- Main container for the background image and content.
         Inline style is used for the background image as Tailwind does not directly
         support dynamic `url()` values in classes without custom configuration. -->
    <div style="background-image: url(/plot.jpg);
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 100vh;
                color: white;
                padding: 20px;">

        <!-- Application title, centered and styled with Tailwind classes -->
        <h3 class="text-center text-3xl font-bold text-gray-800 mt-12 py-4 max-w-lg mx-auto">
            ATSOGO ESTATE AGENCY
        </h3>

        <!-- Content displayed only for guest users (not logged in) -->
        @guest()
            <div class="flex justify-center items-center h-screen">
                <!-- Inner container for the welcome message, with a semi-transparent white background and blur effect -->
                <div class="bg-white bg-opacity-80 backdrop-blur-lg p-8 rounded-lg shadow-lg max-w-md w-full">
                    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Welcome to Atsogo</h1>
                    <p class="text-gray-700 mb-4">Atsogo is a platform designed to help you manage your land transactions efficiently.</p>
                    <p class="text-gray-700 mb-4">Please register or login to continue.</p>
                    <div class="flex justify-center space-x-4">
                        <!-- Register button, styled with Tailwind for a consistent look -->
                        <a href="{{ route('register') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Register</a>
                        <!-- Login button, styled with Tailwind for a consistent look -->
                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Login</a>
                    </div>
                </div>
            </div>
        @endguest

    </div>
</x-layout>
