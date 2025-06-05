<!-- This HTML code defines a password reset form for the ATSOGO application.
     It includes input fields for email, new password, and confirming the new password,
     along with integrated icons and a show/hide password toggle for better usability.
     The page is styled with Tailwind CSS for responsiveness and aesthetics. -->

<!-- It's assumed that the x-layout component includes the necessary
     Tailwind CSS setup and the Font Awesome CDN link in its <head> section.
     If not, ensure the Font Awesome link is correctly added in your main layout file:
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5KwDFWJ8pcyqqQpNPjNpXH7P2jJ/6hOtyWpNKx/bywM+bQUIPTfMfw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
-->

<x-layout>
    <!-- Main container for the reset password form, centered on the page and styled -->
    <div class="max-w-md mx-auto p-8 bg-white shadow-md rounded-lg mt-20">
        <!-- Page title -->
        <h3 class="text-yellow-500 text-2xl font-semibold mb-6 text-center">RESET YOUR PASSWORD</h3>

        <!-- Password reset form starts here -->
        <form action="{{ route('password.update') }}" method="post">
            <!-- CSRF token for security (Laravel specific) -->
            @csrf

            <!-- Hidden input for the password reset token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Input Field with Icon -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <!-- Input container for relative positioning of icon -->
                <div class="relative">
                    <!-- Email input field -->
                    <input
                        type="email"
                        id="email"
                        class="input @error('email') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 pl-10 pr-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-400 transition duration-200 ease-in-out"
                        name="email"
                        value="{{ old('email', $email ?? '') }}" {{-- Pre-fill email if available --}}
                        placeholder="Enter your email"
                        required
                        autocomplete="email"
                    >
                    <!-- Email icon using Font Awesome -->
                    <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <!-- Error message for email validation -->
                @error('email') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- New Password Input Field with Icon and Show/Hide Toggle -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <!-- Input container for relative positioning of icon and toggle -->
                <div class="relative">
                    <!-- Password input field -->
                    <input
                        type="password"
                        id="password"
                        class="input @error('password') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 pl-10 pr-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-400 transition duration-200 ease-in-out"
                        name="password"
                        placeholder="Enter new password"
                        required
                        autocomplete="new-password"
                    >
                    <!-- Password icon using Font Awesome (left side) -->
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <!-- Show/Hide Password Toggle Icon (right side) -->
                    <i class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer" onclick="togglePasswordVisibility('password')"></i>
                </div>
                <!-- Error message for new password validation -->
                @error('password') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Confirm New Password Input Field with Icon and Show/Hide Toggle -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                <!-- Input container for relative positioning of icon and toggle -->
                <div class="relative">
                    <!-- Confirm password input field -->
                    <input
                        type="password"
                        id="password_confirmation"
                        class="input @error('password_confirmation') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 pl-10 pr-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-400 transition duration-200 ease-in-out"
                        name="password_confirmation"
                        placeholder="Confirm new password"
                        required
                        autocomplete="new-password"
                    >
                    <!-- Confirm password icon using Font Awesome (left side) -->
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <!-- Show/Hide Password Toggle Icon (right side) -->
                    <i class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer" onclick="togglePasswordVisibility('password_confirmation')"></i>
                </div>
                <!-- Error message for confirm password validation -->
                @error('password_confirmation') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Global error message for failed password reset attempts -->
            @error('failed')
                <p class="text-red-500 text-xs italic mb-4">{{ $message }}</p>
            @enderror

            <!-- Reset Password button -->
            <div>
                <button
                    type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"
                >
                    Reset Password
                </button>
            </div>
        </form>
    </div>

    {{-- JavaScript for password visibility toggle --}}
    <script>
        /**
         * Toggles the visibility of a password input field.
         * Changes the input type between 'password' and 'text' and updates the eye icon.
         * @param {string} inputId The ID of the password input field.
         */
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = passwordInput.nextElementSibling; // Assumes the icon is the next sibling

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</x-layout>
