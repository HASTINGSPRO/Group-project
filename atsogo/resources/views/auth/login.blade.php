<x-layout>
     <style>
        /* Define CSS variables for colors - consistent with dashboard */
        :root {
            /* Dark mode default */
            --bg-primary: #1A232F; /* Deeper, richer charcoal-blue */
            --bg-secondary: #2C3E50; /* Slightly lighter for cards/forms */
            --bg-tertiary: #34495E; /* Medium Dark Blue-Gray for input backgrounds/hover */
            --text-primary: #FDFCEE; /* Very subtle warm off-white/cream */
            --text-secondary: #C0C7D0; /* Slightly warmer light gray */
            --border-color: #4A5568; /* Border color */

            /* Accent Colors (yellow/gold themed) - consistent with dashboard */
            --yellow-light-accent: #FCD34D; /* Lighter yellow for accents */
            --yellow-main-accent: #FBBF24; /* Primary golden yellow */
            --yellow-dark-accent: #D97706; /* Deeper orange-gold */
            --yellow-darker-accent: #B45309; /* Richer, darker orange-gold */

            /* Mapping to original indigo variables for consistency in usage */
            --indigo-400: var(--yellow-light-accent);
            --indigo-500: var(--yellow-main-accent);
            --indigo-600: var(--yellow-dark-accent);
            --indigo-700: var(--yellow-darker-accent);

            --white: #ffffff;
            --red-500: #EF4444; /* For error messages */
            --emerald-500: #10B981; /* For success messages */

            /* Password strength colors */
            --strength-weak: #EF4444; /* Red */
            --strength-medium: #FACC15; /* Yellow */
            --strength-strong: #10B981; /* Green */
        }

        /* Light mode overrides - consistent with dashboard */
        body.light-mode {
            --bg-primary: #F5F7FA; /* Very light, cool off-white */
            --bg-secondary: #FFFFFF; /* White background for cards/forms */
            --bg-tertiary: #F3F4F6; /* Light gray for input backgrounds/hover */
            --text-primary: #2D3748; /* Dark Blue-Gray text */
            --text-secondary: #718096; /* Medium Gray text */
            --border-color: #E2E8F0; /* Light border color */

            /* Accent Colors (yellow/gold themed for light mode) */
            --yellow-light-accent: #FBBF24; /* Primary golden yellow */
            --yellow-main-accent: #D97706; /* Deeper orange-gold */
            --yellow-dark-accent: #B45309; /* Darker, richer orange-gold */
            --yellow-darker-accent: #92400E; /* Even darker */

            /* Mapping to original indigo variables for consistency in usage */
            --indigo-400: var(--yellow-light-accent);
            --indigo-500: var(--yellow-main-accent);
            --indigo-600: var(--yellow-dark-accent);
            --indigo-700: var(--yellow-darker-accent);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth theme transition */
            margin: 0;
            display: flex;
            flex-direction: column; /* Allow content to stack vertically */
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem; /* p-4 */
            box-sizing: border-box; /* Ensure padding doesn't cause overflow */
        }

        .login-container {
            background-color: var(--bg-secondary);
            border-radius: 0.75rem; /* rounded-lg */
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.2), 0 4px 8px -2px rgba(0, 0, 0, 0.1); /* shadow-xl */
            padding: 2rem; /* p-8 */
            width: 100%;
            max-width: 448px; /* max-w-md */
            box-sizing: border-box; /* Ensure padding doesn't cause overflow */
            transition: all 0.2s ease; /* Keep transition for other effects if any, but remove transform/shadow on hover */
            position: relative; /* Needed for feedback message positioning */
        }

        /* Removed .login-container:hover effect as requested */

        .login-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem; /* mb-6 */
            padding-bottom: 0.75rem; /* Added padding for visual separation */
            border-bottom: 1px solid var(--border-color); /* Subtle line below header */
        }

        .login-title {
            font-size: 1.875rem; /* text-3xl */
            font-weight: 700; /* font-bold */
            color: var(--indigo-400); /* text-indigo-400 */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .theme-toggle-btn {
            color: var(--text-secondary); /* text-[var(--text-secondary)] */
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
            padding: 0.25rem; /* Small padding for click area */
            transition: color 0.2s ease; /* transition-colors duration-200 */
        }
        .theme-toggle-btn:hover {
            color: var(--text-primary); /* hover:text-[var(--text-primary)] */
        }
        .theme-toggle-btn .lucide {
            width: 1.5rem; /* w-6 */
            height: 1.5rem; /* h-6 */
        }

        .form-group {
            margin-bottom: 1rem; /* mb-4 */
            position: relative; /* For icon positioning */
            /* New: Negative margins to make inputs "extend" visually */
            margin-left: -2rem; /* Pulls left edge of form-group out by 2rem */
            margin-right: -2rem; /* Pulls right edge of form-group out by 2rem */
            padding: 0 2rem; /* Add back padding inside form-group for label and error messages */
        }
        .form-group:last-of-type {
            margin-bottom: 1.5rem; /* mb-6 for password field */
        }

        .form-label {
            display: block;
            font-size: 0.875rem; /* text-sm */
            font-weight: 500; /* font-medium */
            color: var(--text-secondary); /* text-[var(--text-secondary)] */
            margin-bottom: 0.5rem; /* mb-2 */
            padding-left: 0; /* Reset padding from form-group if inherited */
            padding-right: 0; /* Reset padding from form-group if inherited */
        }

        .input-wrapper { /* New wrapper for input and its internal icons/buttons */
            position: relative;
            display: flex; /* To contain input and clear button */
            align-items: center; /* Vertically align items */
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem; /* py-2 */
            padding-left: 2.5rem; /* Space for icon */
            border-radius: 0.5rem; /* rounded-lg */
            background-color: var(--bg-tertiary); /* bg-[var(--bg-tertiary)] */
            color: var(--text-primary); /* text-[var(--text-primary)] */
            outline: none;
            transition: all 0.2s ease; /* transition-colors duration-200 */
            border: 1px solid transparent; /* To prevent layout shift on focus */
            box-sizing: border-box; /* Include padding in width calculation */
        }
        /* Specific padding for password input to accommodate eye icon */
        #password.form-input, #signup-password.modal-input, #signup-confirm-password.modal-input {
            padding-right: 2.5rem; /* Space for eye icon */
        }

        .form-input::placeholder {
            color: var(--text-secondary); /* placeholder-[var(--text-secondary)] */
            opacity: 0.7; /* Make placeholder a bit lighter */
        }
        .form-input:focus {
            border-color: var(--indigo-500); /* focus:ring-2 focus:ring-indigo-500 */
            box-shadow: 0 0 0 2px var(--indigo-500);
        }
        .form-input.invalid {
            border-color: var(--red-500);
            box-shadow: 0 0 0 2px var(--red-500);
        }

        .input-icon {
            position: absolute;
            left: 0.75rem; /* Position icon inside input field */
            top: 50%; /* Center vertically within input-wrapper */
            transform: translateY(-50%);
            color: var(--text-secondary);
            width: 1.25rem; /* w-5 */
            height: 1.25rem; /* h-5 */
            pointer-events: none; /* Allow clicks to pass through to input */
            z-index: 1; /* Ensure icon is above input text */
        }

        .password-toggle-btn, .clear-input-btn {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
            color: var(--text-secondary);
            padding: 0.25rem;
            transition: color 0.2s ease;
            z-index: 2; /* Ensure toggle button is above input text */
        }
        .password-toggle-btn:hover, .clear-input-btn:hover {
            color: var(--text-primary);
        }
        .password-toggle-btn .lucide, .clear-input-btn .lucide {
            width: 1.25rem; /* w-5 */
            height: 1.25rem; /* h-5 */
        }
        .clear-input-btn {
            display: none; /* Hidden by default */
        }


        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem; /* mb-6 */
            padding: 0 2rem; /* Match form-group padding */
        }

        .checkbox-group {
            display: flex;
            align-items: center;
        }

        .checkbox-input {
            height: 1rem; /* h-4 */
            width: 1rem; /* w-4 */
            color: var(--indigo-600); /* text-indigo-600 */
            border-radius: 0.25rem; /* rounded */
            border: 1px solid var(--border-color); /* border-gray-300 */
            background-color: var(--bg-tertiary); /* bg-[var(--bg-tertiary)] */
            cursor: pointer;
            transition: all 0.2s ease;
            /* Custom checkbox styling */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            position: relative;
            display: inline-block;
            vertical-align: middle;
        }
        .checkbox-input:checked {
            background-color: var(--indigo-600);
            border-color: var(--indigo-600);
        }
        .checkbox-input:checked::before {
            content: '';
            display: block;
            width: 0.5rem; /* checkmark width */
            height: 0.8rem; /* checkmark height */
            border: solid var(--white);
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            position: absolute;
            top: 0px;
            left: 4px;
        }
        .checkbox-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px var(--indigo-500); /* focus:ring-indigo-500 */
        }

        .checkbox-label {
            margin-left: 0.5rem; /* ml-2 */
            font-size: 0.875rem; /* text-sm */
            color: var(--text-secondary); /* text-[var(--text-secondary)] */
        }

        .forgot-password-link {
            font-size: 0.875rem; /* text-sm */
            color: var(--indigo-400); /* text-indigo-400 */
            text-decoration: none;
            transition: color 0.2s ease; /* transition-colors duration-200 */
        }
        .forgot-password-link:hover {
            color: var(--indigo-300); /* hover:text-indigo-300 */
            text-decoration: underline;
        }

        .btn-primary {
            width: calc(100% - 4rem); /* 100% of container width minus 2x padding */
            margin-left: 2rem; /* Align with new form-group padding */
            margin-right: 2rem; /* Align with new form-group padding */
            background-color: var(--indigo-600); /* bg-indigo-600 */
            color: var(--white); /* text-white */
            font-weight: 700; /* font-bold */
            padding: 0.75rem 1rem; /* py-3 px-4 */
            border-radius: 0.5rem; /* rounded-lg */
            outline: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease; /* transition-all duration-200 */
            box-shadow: 0 4px 10px -2px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.08); /* shadow-md */
            display: flex; /* For centering content and spinner */
            align-items: center;
            justify-content: center;
            gap: 0.5rem; /* Space between text and spinner */
        }
        .btn-primary:hover:not(:disabled) {
            background-color: var(--indigo-700); /* hover:bg-indigo-700 */
            transform: translateY(-2px);
            box-shadow: 0 6px 12px -3px rgba(0, 0, 0, 0.3);
        }
        .btn-primary:focus {
            box-shadow: 0 0 0 3px var(--indigo-500), 0 0 0 6px rgba(var(--indigo-500-rgb), 0.3); /* focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-[var(--bg-secondary)] */
        }
        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background-color: var(--indigo-600); /* Keep original color but with opacity */
            transform: none;
            box-shadow: none;
        }

        .loading-spinner {
            animation: spin 1s linear infinite;
            height: 1.25rem; /* h-5 */
            width: 1.25rem; /* w-5 */
            color: var(--white);
            display: none; /* hidden by default */
        }
        .loading-spinner.show {
            display: inline-block; /* Show when active */
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .signup-text {
            text-align: center;
            font-size: 0.875rem; /* text-sm */
            color: var(--text-secondary); /* text-[var(--text-secondary)] */
            margin-top: 1.5rem; /* mt-6 */
        }

        .signup-link {
            color: var(--indigo-400); /* text-indigo-400 */
            text-decoration: none;
            transition: color 0.2s ease; /* transition-colors duration-200 */
        }
        .signup-link:hover {
            color: var(--indigo-300); /* hover:text-indigo-300 */
            text-decoration: underline;
        }

        .error-message {
            color: var(--red-500);
            font-size: 0.75rem;
            margin-top: 0.25rem;
            min-height: 1rem; /* Prevent layout shift */
            padding-left: 2rem; /* Align with input content */
            padding-right: 2rem; /* Align with input content */
        }

        /* Modal specific styles (for Forgot Password and Sign Up) */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            background-color: var(--bg-secondary);
            border-radius: 0.75rem; /* Slightly more rounded */
            padding: 2rem;
            width: 90%;
            max-width: 500px; /* Adjusted max-width for modals */
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.3), 0 4px 8px -2px rgba(0, 0, 0, 0.15); /* Stronger shadow */
            transform: translateY(-20px);
            transition: transform 0.3s ease;
            max-height: 90vh; /* Limit height for scrollable content */
            overflow-y: auto; /* Enable scrolling for modal content */
        }
        .modal-overlay.show .modal-content {
            transform: translateY(0);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-color);
        }
        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--indigo-500);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        .modal-close-btn {
            color: var(--text-secondary);
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
        }
        .modal-close-btn:hover {
            color: var(--text-primary);
        }
        .modal-form-group {
            margin-bottom: 1rem;
            position: relative; /* For icons */
        }
        .modal-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }
        .modal-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
            outline: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            box-sizing: border-box;
        }
        .modal-input:focus {
            border-color: var(--indigo-500);
            box-shadow: 0 0 0 2px var(--indigo-500);
        }
        .modal-input.invalid {
            border-color: var(--red-500);
            box-shadow: 0 0 0 2px var(--red-500);
        }
        .modal-error-message {
            color: var(--red-500);
            font-size: 0.75rem;
            margin-top: 0.25rem;
            min-height: 1rem;
        }
        .modal-btn-primary {
            width: 100%;
            background-color: var(--indigo-600);
            color: var(--white);
            font-weight: 700;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            outline: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px -2px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }
        .modal-btn-primary:hover:not(:disabled) {
            background-color: var(--indigo-700);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px -3px rgba(0, 0, 0, 0.3);
        }
        .modal-btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .modal-feedback-message {
            color: var(--emerald-500);
            text-align: center;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
        .modal-feedback-message.error {
            color: var(--red-500);
        }

        .password-strength-indicator {
            margin-top: 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            text-align: right;
            min-height: 1rem; /* Prevent layout shift */
        }
        .strength-weak { color: var(--strength-weak); }
        .strength-medium { color: var(--strength-medium); }
        .strength-strong { color: var(--strength-strong); }

        /* Feedback Message (for main login form) */
        .feedback-message {
            position: fixed; /* Changed to fixed for consistency with dashboard */
            top: 1rem;
            right: 1rem;
            transform: translateY(-100%); /* Start above and hidden */
            background-color: var(--emerald-500); /* Emerald green for success */
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 1001;
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap; /* Prevent message from wrapping too much */
        }
        .feedback-message.show {
            opacity: 1;
            transform: translateY(0); /* Slide down into view */
        }
        .feedback-message.error {
            background-color: var(--red-500);
        }
        .feedback-message .lucide {
            width: 1.2rem;
            height: 1.2rem;
        }

        /* Styling for the "Powered by ATSOGO" footer */
        .powered-by-atsogo {
            margin-top: 2.5rem; /* Increased margin for better separation */
            font-size: 0.875rem; /* Slightly larger font size */
            color: var(--text-secondary); /* More prominent color */
            text-align: center;
            font-weight: 500; /* Medium font weight */
            letter-spacing: 0.025em; /* Small letter spacing for style */
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); /* Subtle text shadow */
            transition: color 0.3s ease; /* Smooth transition for theme change */
            display: flex; /* Enable flexbox for icon and text alignment */
            align-items: center; /* Vertically align items */
            justify-content: center; /* Center horizontally */
            gap: 0.5rem; /* Space between icon and text */
        }
        .powered-by-atsogo .lucide {
            width: 1rem; /* Adjust icon size */
            height: 1rem;
            color: var(--indigo-500); /* Color the icon with an accent color */
            flex-shrink: 0; /* Prevent icon from shrinking */
        }
        /* Light mode specific adjustment for the powered by text */
        body.light-mode .powered-by-atsogo {
            color: var(--text-secondary); /* Ensure it's visible in light mode too */
        }


        /* Responsive adjustments */
        @media (max-width: 640px) {
            .login-container {
                padding: 1.5rem; /* Adjust padding for smaller screens */
            }
            .login-title {
                font-size: 1.5rem; /* Smaller title on mobile */
            }
            .form-group {
                margin-left: -1.5rem; /* Adjust negative margin for smaller screens */
                margin-right: -1.5rem;
                padding: 0 1.5rem;
            }
            /* Adjust icon positions within the new input-wrapper */
            .input-icon {
                left: 0.75rem; /* Relative to input-wrapper */
            }
            .password-toggle-btn, .clear-input-btn {
                right: 0.75rem; /* Relative to input-wrapper */
            }
            .form-options {
                padding: 0 1.5rem;
            }
            .btn-primary {
                width: calc(100% - 3rem); /* Adjust width based on new form-group padding */
                margin-left: 1.5rem;
                margin-right: 1.5rem;
            }
            .error-message {
                padding-left: 1.5rem; /* Adjust padding for error messages */
                padding-right: 1.5rem;
            }
            .feedback-message {
                width: calc(100% - 2rem); /* Adjust width for mobile padding */
                left: 1rem;
                right: 1rem;
                transform: translateY(-100%); /* Still slide from top */
            }
            .feedback-message.show {
                transform: translateY(0);
            }
            .powered-by-atsogo {
                margin-top: 2rem; /* Slightly less margin on mobile */
                font-size: 0.8rem; /* Slightly smaller font on mobile */
            }
        }
    </style>
</head>
<body id="theme-body">

    <div class="login-container">
        <div class="login-header">
            <h2 class="login-title">ATSOGO Admin Login</h2>
            <button id="theme-toggle" class="theme-toggle-btn" aria-label="Toggle theme">
                <i data-lucide="moon" id="theme-icon"></i>
            </button>
        </div>

        <form id="login-form" aria-label="Login Form">
            <div class="form-group">
                <label for="email" class="form-label">Email Address<span style="color:var(--red-500);" aria-hidden="true">*</span></label>
                <div class="input-wrapper">
                    <i data-lucide="mail" class="input-icon" aria-hidden="true"></i>
                    <input type="email" id="email" name="email" class="form-input" placeholder="admin@atsogo.com" required aria-describedby="email-error" aria-invalid="false">
                    <button type="button" class="clear-input-btn" id="clear-email-btn" aria-label="Clear email input">
                        <i data-lucide="x-circle"></i>
                    </button>
                </div>
                <div class="error-message" id="email-error" role="alert" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password<span style="color:var(--red-500);" aria-hidden="true">*</span></label>
                <div class="input-wrapper">
                    <i data-lucide="lock" class="input-icon" aria-hidden="true"></i>
                    <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required aria-describedby="password-error" aria-invalid="false">
                    <button type="button" id="password-toggle" class="password-toggle-btn" aria-label="Show password">
                        <i data-lucide="eye" id="password-toggle-icon"></i>
                    </button>
                </div>
                <div class="error-message" id="password-error" role="alert" aria-live="polite"></div>
            </div>

            <div class="form-options">
                <div class="checkbox-group">
                    <input type="checkbox" id="remember_me" name="remember_me" class="checkbox-input" aria-label="Remember me">
                    <label for="remember_me" class="checkbox-label">Remember me</label>
                </div>
                <a href="#" class="forgot-password-link" id="forgot-password-link">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-primary" id="login-button">
                <span id="login-button-text">Login</span>
                <svg id="login-spinner" class="loading-spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </form>

        <p class="signup-text">
            New admin?
            <a href="#" class="signup-link" id="signup-link">Sign Up</a>
        </p>

        <p class="powered-by-atsogo">
            <i data-lucide="gem" aria-hidden="true"></i>
            <span>Powered by ATSOGO</span>
        </p>
    </div>

    <!-- Feedback Message Container -->
    <div id="feedback-message" class="feedback-message" role="status" aria-live="polite">
        <span id="feedback-icon"></span>
        <span id="feedback-text"></span>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgot-password-modal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="forgot-password-title">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="forgot-password-title">Forgot Password</h3>
                <button type="button" id="close-forgot-password-modal" class="modal-close-btn" aria-label="Close forgot password dialog">
                    <i data-lucide="x" class="action-icon"></i>
                </button>
            </div>
            <p style="color: var(--text-secondary); margin-bottom: 1rem;">Enter your email address to receive a password reset link.</p>
            <div class="modal-form-group">
                <label for="forgot-email" class="modal-label">Email Address<span style="color:var(--red-500);" aria-hidden="true">*</span></label>
                <input type="email" id="forgot-email" class="modal-input" placeholder="your@example.com" required aria-describedby="forgot-email-error" aria-invalid="false">
                <div class="modal-error-message" id="forgot-email-error" role="alert" aria-live="polite"></div>
            </div>
            <button type="button" id="send-reset-link-btn" class="modal-btn-primary">Send Reset Link</button>
            <p id="forgot-password-feedback" class="modal-feedback-message"></p>
            <p class="signup-text" style="margin-top: 1rem;">
                <a href="#" class="signup-link back-to-login" data-modal-to-close="forgot-password-modal">Back to Login</a>
            </p>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div id="signup-modal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="signup-title">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="signup-title">Sign Up for ATSOGO Admin</h3>
                <button type="button" id="close-signup-modal" class="modal-close-btn" aria-label="Close sign up dialog">
                    <i data-lucide="x" class="action-icon"></i>
                </button>
            </div>
            <p style="color: var(--text-secondary); margin-bottom: 1rem;">Create your new admin account.</p>
            <div class="modal-form-group">
                <label for="signup-name" class="modal-label">Full Name<span style="color:var(--red-500);" aria-hidden="true">*</span></label>
                <input type="text" id="signup-name" class="modal-input" placeholder="John Doe" required aria-describedby="signup-name-error" aria-invalid="false">
                <div class="modal-error-message" id="signup-name-error" role="alert" aria-live="polite"></div>
            </div>
            <div class="modal-form-group">
                <label for="signup-email" class="modal-label">Email Address<span style="color:var(--red-500);" aria-hidden="true">*</span></label>
                <input type="email" id="signup-email" class="modal-input" placeholder="your@example.com" required aria-describedby="signup-email-error" aria-invalid="false">
                <div class="modal-error-message" id="signup-email-error" role="alert" aria-live="polite"></div>
            </div>
            <div class="modal-form-group">
                <label for="signup-password" class="modal-label">Password<span style="color:var(--red-500);" aria-hidden="true">*</span></label>
                <div class="input-wrapper">
                    <input type="password" id="signup-password" class="modal-input" placeholder="••••••••" required aria-describedby="signup-password-error" aria-invalid="false">
                    <button type="button" id="signup-password-toggle" class="password-toggle-btn" aria-label="Show password">
                        <i data-lucide="eye" id="signup-password-toggle-icon"></i>
                    </button>
                </div>
                <div class="modal-error-message" id="signup-password-error" role="alert" aria-live="polite"></div>
            </div>
            <div class="modal-form-group">
                <label for="signup-confirm-password" class="modal-label">Confirm Password<span style="color:var(--red-500);" aria-hidden="true">*</span></label>
                <div class="input-wrapper">
                    <input type="password" id="signup-confirm-password" class="modal-input" placeholder="••••••••" required aria-describedby="signup-confirm-password-error" aria-invalid="false">
                    <button type="button" id="signup-confirm-password-toggle" class="password-toggle-btn" aria-label="Show password">
                        <i data-lucide="eye" id="signup-confirm-password-toggle-icon"></i>
                    </button>
                </div>
                <div class="modal-error-message" id="signup-confirm-password-error" role="alert" aria-live="polite"></div>
            </div>

            <div class="checkbox-group" style="margin-bottom: 1.5rem;">
                <input type="checkbox" id="signup-terms-agree" name="signup-terms-agree" class="checkbox-input" aria-label="Agree to terms and privacy policy">
                <label for="signup-terms-agree" class="checkbox-label">
                    I agree to the <a href="#terms-of-service" class="signup-link" target="_blank" rel="noopener noreferrer">Terms of Service</a> and <a href="#privacy-policy" class="signup-link" target="_blank" rel="noopener noreferrer">Privacy Policy</a>.
                </label>
            </div>
            <div class="modal-error-message" id="signup-terms-error" role="alert" aria-live="polite"></div>


            <button type="submit" id="signup-modal-btn" class="modal-btn-primary">
                <span id="signup-modal-button-text">Sign Up</span>
                <svg id="signup-modal-spinner" class="loading-spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            <p id="signup-modal-feedback" class="modal-feedback-message"></p>
            <p class="signup-text" style="margin-top: 1rem;">
                Already have an admin account?
                <a href="#" class="signup-link back-to-login" data-modal-to-close="signup-modal">Login</a>
            </p>
        </div>
    </div>


    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const themeBody = document.getElementById('theme-body');

        const loginForm = document.getElementById('login-form');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const rememberMeCheckbox = document.getElementById('remember_me');
        const loginButton = document.getElementById('login-button');
        const loginButtonText = document.getElementById('login-button-text');
        const loginSpinner = document.getElementById('login-spinner');

        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');

        const clearEmailBtn = document.getElementById('clear-email-btn');
        const passwordToggleBtn = document.getElementById('password-toggle');
        const passwordToggleIcon = document.getElementById('password-toggle-icon');

        const forgotPasswordLink = document.getElementById('forgot-password-link');
        const forgotPasswordModal = document.getElementById('forgot-password-modal');
        const closeForgotPasswordModalBtn = document.getElementById('close-forgot-password-modal');
        const forgotEmailInput = document.getElementById('forgot-email');
        const forgotEmailError = document.getElementById('forgot-email-error');
        const sendResetLinkBtn = document.getElementById('send-reset-link-btn');
        const forgotPasswordFeedback = document.getElementById('forgot-password-feedback');

        const signupLink = document.getElementById('signup-link');
        const signupModal = document.getElementById('signup-modal');
        const closeSignupModalBtn = document.getElementById('close-signup-modal');
        const signupNameInput = document.getElementById('signup-name');
        const signupEmailInput = document.getElementById('signup-email');
        const signupPasswordInput = document.getElementById('signup-password');
        const signupConfirmPasswordInput = document.getElementById('signup-confirm-password');
        const signupTermsAgreeCheckbox = document.getElementById('signup-terms-agree');
        const signupModalBtn = document.getElementById('signup-modal-btn');
        const signupModalButtonText = document.getElementById('signup-modal-button-text');
        const signupModalSpinner = document.getElementById('signup-modal-spinner');

        const signupNameError = document.getElementById('signup-name-error');
        const signupEmailError = document.getElementById('signup-email-error');
        const signupPasswordError = document.getElementById('signup-password-error');
        const signupConfirmPasswordError = document.getElementById('signup-confirm-password-error');
        const signupTermsError = document.getElementById('signup-terms-error');
        const signupModalFeedback = document.getElementById('signup-modal-feedback');

        const signupPasswordToggleBtn = document.getElementById('signup-password-toggle');
        const signupPasswordToggleIcon = document.getElementById('signup-password-toggle-icon');
        const signupConfirmPasswordToggleBtn = document.getElementById('signup-confirm-password-toggle');
        const signupConfirmPasswordToggleIcon = document.getElementById('signup-confirm-password-toggle-icon');


        // Feedback message elements (for overall success/error on main form)
        const feedbackMessage = document.getElementById('feedback-message');
        const feedbackIcon = document.getElementById('feedback-icon');
        const feedbackText = document.getElementById('feedback-text');


        // --- Utility Functions ---
        function showFeedback(message, type = 'success', targetElement = feedbackMessage, targetIcon = feedbackIcon, targetText = feedbackText) {
            targetText.textContent = message;
            targetElement.classList.remove('success', 'error');
            targetElement.classList.add(type);
            targetIcon.innerHTML = `<i data-lucide="${type === 'success' ? 'check-circle' : 'x-circle'}"></i>`;
            lucide.createIcons(); // Re-render icon

            targetElement.classList.add('show');

            setTimeout(() => {
                targetElement.classList.remove('show');
            }, 3000); // Hide after 3 seconds
        }

        function validateInput(inputElement, errorMessageElement) {
            if (inputElement.hasAttribute('required') && inputElement.value.trim() === '') {
                inputElement.classList.add('invalid');
                errorMessageElement.textContent = 'This field is required.';
                inputElement.setAttribute('aria-invalid', 'true');
                return false;
            } else if (inputElement.type === 'email' && !/\S+@\S+\.\S+/.test(inputElement.value)) {
                inputElement.classList.add('invalid');
                errorMessageElement.textContent = 'Please enter a valid email address.';
                inputElement.setAttribute('aria-invalid', 'true');
                return false;
            } else {
                inputElement.classList.remove('invalid');
                errorMessageElement.textContent = '';
                inputElement.setAttribute('aria-invalid', 'false');
                return true;
            }
        }

        function clearValidation(inputElement, errorMessageElement) {
            inputElement.classList.remove('invalid');
            errorMessageElement.textContent = '';
            inputElement.setAttribute('aria-invalid', 'false');
        }

        function togglePasswordVisibility(inputElement, iconElement, buttonElement) {
            const type = inputElement.getAttribute('type') === 'password' ? 'text' : 'password';
            inputElement.setAttribute('type', type);
            iconElement.setAttribute('data-lucide', type === 'password' ? 'eye' : 'eye-off');
            buttonElement.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
            lucide.createIcons();
        }

        // --- Theme management functions ---
        function setTheme(mode) {
            if (mode === 'light') {
                themeBody.classList.add('light-mode');
            } else {
                themeBody.classList.remove('light-mode');
            }
            themeIcon.setAttribute('data-lucide', 'moon');
            lucide.createIcons();
        }

        // Toggle theme manually via button
        themeToggleBtn.addEventListener('click', () => {
            if (themeBody.classList.contains('light-mode')) {
                setTheme('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                setTheme('light');
                localStorage.setItem('theme', 'light');
            }
        });

        // Listen for system theme changes
        const prefersLightScheme = window.matchMedia('(prefers-color-scheme: light)');

        function handleSystemThemeChange(e) {
            if (!localStorage.getItem('theme')) {
                setTheme(e.matches ? 'light' : 'dark');
            }
        }

        prefersLightScheme.addEventListener('change', handleSystemThemeChange);

        // Set initial theme and autofocus on load
        window.onload = () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                setTheme(savedTheme);
            } else {
                setTheme(prefersLightScheme.matches ? 'light' : 'dark');
            }
            emailInput.focus(); // Autofocus on the first input field
        };

        // --- Clear Input Button Logic ---
        emailInput.addEventListener('input', () => {
            if (emailInput.value.length > 0) {
                clearEmailBtn.style.display = 'block';
            } else {
                clearEmailBtn.style.display = 'none';
            }
            clearValidation(emailInput, emailError); // Clear validation on input
        });
        clearEmailBtn.addEventListener('click', () => {
            emailInput.value = '';
            clearEmailBtn.style.display = 'none';
            emailInput.focus();
            clearValidation(emailInput, emailError);
        });

        // Password visibility toggle
        passwordToggleBtn.addEventListener('click', () => {
            togglePasswordVisibility(passwordInput, passwordToggleIcon, passwordToggleBtn);
        });

        // Event listeners for input validation on blur and input
        emailInput.addEventListener('blur', () => validateInput(emailInput, emailError));
        passwordInput.addEventListener('blur', () => validateInput(passwordInput, passwordError));
        passwordInput.addEventListener('input', () => clearValidation(passwordInput, passwordError));


        // --- Main Login Form Submission ---
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const isEmailValid = validateInput(emailInput, emailError);
            const isPasswordValid = validateInput(passwordInput, passwordError);

            if (!isEmailValid || !isPasswordValid) {
                showFeedback('Please correct the errors in the form.', 'error');
                return;
            }

            const email = emailInput.value;
            const password = passwordInput.value;
            const rememberMe = rememberMeCheckbox.checked;

            // Show loading state
            loginButtonText.textContent = 'Logging In...';
            loginSpinner.classList.add('show');
            loginButton.disabled = true;
            loginButton.setAttribute('aria-busy', 'true');

            // Simulate API call
            setTimeout(() => {
                // In a real application, you'd send data to your backend for authentication
                console.log('Attempting login with:', { email, password, rememberMe });

                // Simulate successful login
                showFeedback('Login successful! Redirecting to dashboard...', 'success');

                setTimeout(() => {
                    window.location.href = 'customerdashboard.html'; // Redirect to dashboard
                }, 1500);

                // Reset loading state (if not redirecting immediately)
                // loginButtonText.textContent = 'Login';
                // loginSpinner.classList.remove('show');
                // loginButton.disabled = false;
                // loginButton.setAttribute('aria-busy', 'false');

            }, 2000); // Simulate network delay
        });

        // --- Forgot Password Modal Logic ---
        forgotPasswordLink.addEventListener('click', (e) => {
            e.preventDefault();
            forgotPasswordModal.classList.add('show');
            forgotEmailInput.value = ''; // Clear previous input
            forgotEmailError.textContent = ''; // Clear previous error
            forgotPasswordFeedback.textContent = ''; // Clear previous feedback
            forgotEmailInput.focus();
        });

        closeForgotPasswordModalBtn.addEventListener('click', () => {
            forgotPasswordModal.classList.remove('show');
        });

        sendResetLinkBtn.addEventListener('click', () => {
            const isForgotEmailValid = validateInput(forgotEmailInput, forgotEmailError);

            if (!isForgotEmailValid) {
                forgotPasswordFeedback.textContent = 'Please enter a valid email address.';
                forgotPasswordFeedback.classList.add('error');
                return;
            }

            const email = forgotEmailInput.value;
            forgotPasswordFeedback.textContent = 'Sending reset link...';
            forgotPasswordFeedback.classList.remove('error', 'success');

            // Simulate sending reset link
            setTimeout(() => {
                console.log('Sending password reset link to:', email);
                forgotPasswordFeedback.textContent = 'Password reset link sent to your email!';
                forgotPasswordFeedback.classList.add('success');
                // Optionally close modal after success
                // setTimeout(() => { forgotPasswordModal.classList.remove('show'); }, 2000);
            }, 1500);
        });

        // --- Sign Up Modal Logic ---
        signupLink.addEventListener('click', (e) => {
            e.preventDefault();
            signupModal.classList.add('show');
            // Clear all signup form fields and errors
            signupNameInput.value = '';
            signupEmailInput.value = '';
            signupPasswordInput.value = '';
            signupConfirmPasswordInput.value = '';
            signupTermsAgreeCheckbox.checked = false;

            clearValidation(signupNameInput, signupNameError);
            clearValidation(signupEmailInput, signupEmailError);
            clearValidation(signupPasswordInput, signupPasswordError);
            clearValidation(signupConfirmPasswordInput, signupConfirmPasswordError);
            signupTermsError.textContent = '';
            signupModalFeedback.textContent = '';

            signupNameInput.focus();
        });

        closeSignupModalBtn.addEventListener('click', () => {
            signupModal.classList.remove('show');
        });

        // Password visibility toggle for signup modal
        signupPasswordToggleBtn.addEventListener('click', () => {
            togglePasswordVisibility(signupPasswordInput, signupPasswordToggleIcon, signupPasswordToggleBtn);
        });
        signupConfirmPasswordToggleBtn.addEventListener('click', () => {
            togglePasswordVisibility(signupConfirmPasswordInput, signupConfirmPasswordToggleIcon, signupConfirmPasswordToggleBtn);
        });

        // Validation for signup modal inputs
        signupNameInput.addEventListener('blur', () => validateInput(signupNameInput, signupNameError));
        signupEmailInput.addEventListener('blur', () => validateInput(signupEmailInput, signupEmailError));
        signupPasswordInput.addEventListener('blur', () => {
            validateInput(signupPasswordInput, signupPasswordError);
            if (signupConfirmPasswordInput.value.length > 0) {
                validateInput(signupConfirmPasswordInput, signupConfirmPasswordError);
            }
        });
        signupConfirmPasswordInput.addEventListener('blur', () => validateInput(signupConfirmPasswordInput, signupConfirmPasswordError));

        signupNameInput.addEventListener('input', () => clearValidation(signupNameInput, signupNameError));
        signupEmailInput.addEventListener('input', () => clearValidation(signupEmailInput, signupEmailError));
        signupPasswordInput.addEventListener('input', () => {
            clearValidation(signupPasswordInput, signupPasswordError);
            if (signupConfirmPasswordInput.value.length > 0) {
                validateInput(signupConfirmPasswordInput, signupConfirmPasswordError);
            }
        });
        signupConfirmPasswordInput.addEventListener('input', () => clearValidation(signupConfirmPasswordInput, signupConfirmPasswordError));
        signupTermsAgreeCheckbox.addEventListener('change', () => {
            if (signupTermsAgreeCheckbox.checked) {
                signupTermsError.textContent = '';
            }
        });


        signupModalBtn.addEventListener('click', (e) => {
            e.preventDefault();

            const isNameValid = validateInput(signupNameInput, signupNameError);
            const isEmailValid = validateInput(signupEmailInput, signupEmailError);
            const isPasswordValid = validateInput(signupPasswordInput, signupPasswordError);
            const isConfirmPasswordValid = validateInput(signupConfirmPasswordInput, signupConfirmPasswordError);

            let allModalValid = isNameValid && isEmailValid && isPasswordValid && isConfirmPasswordValid;

            // Specific password validation rules for signup
            const password = signupPasswordInput.value; // Corrected: Removed 'const' here
            if (password.length > 0) {
                if (password.length < 8) {
                    signupPasswordInput.classList.add('invalid');
                    signupPasswordError.textContent = 'Password must be at least 8 characters.';
                    signupPasswordInput.setAttribute('aria-invalid', 'true');
                    allModalValid = false;
                } else if (!/[A-Z]/.test(password)) {
                    signupPasswordInput.classList.add('invalid');
                    signupPasswordError.textContent = 'Password needs an uppercase letter.';
                    signupPasswordInput.setAttribute('aria-invalid', 'true');
                    allModalValid = false;
                } else if (!/[a-z]/.test(password)) {
                    signupPasswordInput.classList.add('invalid');
                    signupPasswordError.textContent = 'Password needs a lowercase letter.';
                    signupPasswordInput.setAttribute('aria-invalid', 'true');
                    allModalValid = false;
                } else if (!/[0-9]/.test(password)) {
                    signupPasswordInput.classList.add('invalid');
                    signupPasswordError.textContent = 'Password needs a number.';
                    signupPasswordInput.setAttribute('aria-invalid', 'true');
                    allModalValid = false;
                } else if (!/[^A-Za-z0-9]/.test(password)) {
                    signupPasswordInput.classList.add('invalid');
                    signupPasswordError.textContent = 'Password needs a special character.';
                    signupPasswordInput.setAttribute('aria-invalid', 'true');
                    allModalValid = false;
                } else {
                    clearValidation(signupPasswordInput, signupPasswordError);
                }
            }

            if (signupPasswordInput.value !== signupConfirmPasswordInput.value) {
                signupConfirmPasswordInput.classList.add('invalid');
                signupConfirmPasswordError.textContent = 'Passwords do not match.';
                signupConfirmPasswordInput.setAttribute('aria-invalid', 'true');
                allModalValid = false;
            } else if (signupPasswordInput.value.length > 0 && signupConfirmPasswordInput.value.length > 0) {
                clearValidation(signupConfirmPasswordInput, signupConfirmPasswordError);
            }

            // Validate terms and conditions checkbox for signup
            if (!signupTermsAgreeCheckbox.checked) {
                signupTermsError.textContent = 'You must agree to the Terms of Service and Privacy Policy.';
                allModalValid = false;
            } else {
                signupTermsError.textContent = '';
            }


            if (!allModalValid) {
                signupModalFeedback.textContent = 'Please correct the errors in the form.';
                signupModalFeedback.classList.add('error');
                return;
            }

            const name = signupNameInput.value;
            const email = signupEmailInput.value;
            // const password = signupPasswordInput.value; // Already captured above for validation

            // Show loading state
            signupModalButtonText.textContent = 'Signing Up...';
            signupModalSpinner.classList.add('show');
            signupModalBtn.disabled = true;
            signupModalBtn.setAttribute('aria-busy', 'true');
            signupModalFeedback.textContent = ''; // Clear previous feedback

            // Simulate API call for signup
            setTimeout(() => {
                console.log('Attempting signup with:', { name, email, password });
                signupModalFeedback.textContent = 'Account created successfully! You can now log in.';
                signupModalFeedback.classList.add('success');

                // Optionally close signup modal and open login modal or redirect
                setTimeout(() => {
                    signupModal.classList.remove('show');
                    // If you want to automatically open login modal after signup:
                    // forgotPasswordModal.classList.add('show'); // Reusing forgotPasswordModal as a generic login modal
                    // emailInput.value = email; // Pre-fill email
                    // passwordInput.value = ''; // Clear password
                    // emailInput.focus();
                }, 1500);

                // Reset loading state
                signupModalButtonText.textContent = 'Sign Up';
                signupModalSpinner.classList.remove('show');
                signupModalBtn.disabled = false;
                signupModalBtn.setAttribute('aria-busy', 'false');

            }, 2000); // Simulate network delay
        });


        // Handle "Back to Login" links in modals
        document.querySelectorAll('.back-to-login').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const modalToCloseId = e.target.dataset.modalToClose;
                if (modalToCloseId) {
                    document.getElementById(modalToCloseId).classList.remove('show');
                }
                // Optionally, you can ensure the main login form is visible if it was hidden
                // For this structure, the main login form is always visible behind modals
            });
        });

        // Keyboard accessibility: Close modals with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (forgotPasswordModal.classList.contains('show')) {
                    forgotPasswordModal.classList.remove('show');
                }
                if (signupModal.classList.contains('show')) {
                    signupModal.classList.remove('show');
                }
            }
        });

    </script>
</body>

</x-layout>