import React, { useState, useEffect } from 'react';

// Main App component
const App = () => {
  // State to manage authentication status and user data
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [user, setUser] = useState(null);
  const [showLogin, setShowLogin] = useState(true); // true for login, false for signup

  // Base URL for your Laravel API
  const API_BASE_URL = 'http://localhost:8000/api'; // *** IMPORTANT: Change this to your Laravel backend URL ***

  // Function to handle successful authentication
  const handleAuthSuccess = (userData, token) => { 
    setIsLoggedIn(true);
    setUser(userData);
    // Store token in localStorage (or sessionStorage) for persistence
    localStorage.setItem('authToken', token);
    console.log('Authentication successful!', userData);
  };

  // Function to handle logout
  const handleLogout = () => {
    setIsLoggedIn(false);
    setUser(null);
    localStorage.removeItem('authToken'); // Remove token on logout
    console.log('Logged out.');
  };

  // Check for existing token on component mount
  useEffect(() => {
    const token = localStorage.getItem('authToken');
    if (token) {
      // In a real app, you would verify this token with your backend
      // For this example, we'll just assume it's valid if present
      setIsLoggedIn(true);
      // You might also fetch user data here using the token
      // For now, we'll just set a placeholder user
      setUser({ name: 'Authenticated User', email: 'user@example.com' });
      console.log('Found existing token. User is logged in.');
    }
  }, []);

  // AuthForm Component for Login and Signup
  const AuthForm = ({ type, onAuthSuccess, apiBaseUrl, setShowLogin }) => {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const [error, setError] = useState(null);
    const [success, setSuccess] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    const isLogin = type === 'login';

    const handleSubmit = async (e) => {
      e.preventDefault();
      setError(null);
      setSuccess(null);
      setIsLoading(true);

      const endpoint = isLogin ? `${apiBaseUrl}/login` : `${apiBaseUrl}/register`;
      const payload = isLogin
        ? { email, password }
        : { name, email, password, password_confirmation: confirmPassword };

      if (!isLogin && password !== confirmPassword) {
        setError('Passwords do not match.');
        setIsLoading(false);
        return;
      }

      try {
        const response = await fetch(endpoint, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json', // Important for Laravel API responses
          },
          body: JSON.stringify(payload),
        });

        const data = await response.json();

        if (response.ok) {
          setSuccess(data.message || `${isLogin ? 'Login' : 'Registration'} successful!`);
          if (data.user && data.token) {
            onAuthSuccess(data.user, data.token);
          } else if (isLogin && data.access_token) { // Laravel Sanctum often uses 'access_token'
            onAuthSuccess(data.user || {email}, data.access_token);
          } else {
            // Handle cases where token/user might be in a different key or missing
            console.warn('Auth successful but user/token structure unexpected:', data);
            onAuthSuccess({email}, 'dummy_token_if_not_provided'); // Fallback
          }
        } else {
          // Handle API errors (e.g., validation errors from Laravel)
          if (data.errors) {
            const errorMessages = Object.values(data.errors).flat().join(' ');
            setError(errorMessages);
          } else {
            setError(data.message || `An error occurred during ${isLogin ? 'login' : 'registration'}.`);
          }
        }
      } catch (err) {
        console.error('Network or API error:', err);
        setError('Could not connect to the server. Please try again.');
      } finally {
        setIsLoading(false);
      }
    };

    return (
      <div className="auth-card">
        <h2 className="auth-heading">{isLogin ? 'Login' : 'Sign Up'}</h2>
        {error && <div className="error-message">{error}</div>}
        {success && <div className="success-message">{success}</div>}
        <form onSubmit={handleSubmit}>
          {!isLogin && (
            <div className="form-group">
              <label htmlFor="name" className="form-label">
                Full Name
              </label>
              <input
                type="text"
                id="name"
                className="form-input"
                value={name}
                onChange={(e) => setName(e.target.value)}
                required={!isLogin}
              />
            </div>
          )}
          <div className="form-group">
            <label htmlFor="email" className="form-label">
              Email Address
            </label>
            <input
              type="email"
              id="email"
              className="form-input"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />
          </div>
          <div className="form-group">
            <label htmlFor="password" className="form-label">
              Password
            </label>
            <input
              type="password"
              id="password"
              className="form-input"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />
          </div>
          {!isLogin && (
            <div className="form-group">
              <label htmlFor="confirmPassword" className="form-label">
                Confirm Password
              </label>
              <input
                type="password"
                id="confirmPassword"
                className="form-input"
                value={confirmPassword}
                onChange={(e) => setConfirmPassword(e.target.value)}
                required={!isLogin}
              />
            </div>
          )}
          <button
            type="submit"
            className="primary-button"
            disabled={isLoading}
          >
            {isLoading ? 'Loading...' : (isLogin ? 'Login' : 'Sign Up')}
          </button>
        </form>
        <span
          className="secondary-button-text"
          onClick={() => setShowLogin(!showLogin)} // Toggle login/signup view
        >
          {isLogin ? "Don't have an account? Sign Up" : "Already have an account? Login"}
        </span>
      </div>
    );
  };

  // Simple Dashboard Placeholder Component
  const Dashboard = ({ user, onLogout }) => (
    <div className="auth-card">
      <h2 className="auth-heading">Welcome to Your Dashboard!</h2>
      <p className="dashboard-text">Hello, {user?.name || user?.email || 'User'}!</p>
      <p className="dashboard-text">You are now logged in to the Land Accessibility Marketplace.</p>
      <button onClick={onLogout} className="logout-button">
        Logout
      </button>
      {/* You can integrate the previous dashboard content here */}
      {/* For now, a simple message */}
      <div className="dashboard-summary-card">
        <h3 className="dashboard-summary-heading">Your Listings Summary</h3>
        <p className="dashboard-summary-text">You have 3 active listings and 1 pending inquiry.</p>
        <p className="dashboard-summary-text">Explore your full dashboard features here.</p>
      </div>
    </div>
  );

  return (
    <div className="app-container">
      {/* Inter Font CDN */}
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
      <style>
        {`
          body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
          }

          .app-container {
            min-height: 100vh;
            background-color: #f3f4f6; /* bg-gray-100 */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem; /* p-4 */
          }

          @media (min-width: 640px) { /* sm: */
            .app-container {
              padding: 1.5rem; /* sm:p-6 */
            }
          }

          @media (min-width: 1024px) { /* lg: */
            .app-container {
              padding: 2rem; /* lg:p-8 */
            }
          }

          .auth-card {
            background-color: #fff; /* bg-white */
            border-radius: 0.5rem; /* rounded-lg */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-xl */
            padding: 2rem; /* p-8 */
            width: 100%; /* w-full */
            max-width: 28rem; /* max-w-md */
          }

          .auth-heading {
            font-size: 1.875rem; /* text-3xl */
            font-weight: 700; /* font-bold */
            color: #1f2937; /* text-gray-800 */
            margin-bottom: 1.5rem; /* mb-6 */
            text-align: center;
          }

          .form-group {
            margin-bottom: 1rem; /* mb-4 */
          }

          .form-label {
            display: block;
            color: #374151; /* text-gray-700 */
            font-size: 0.875rem; /* text-sm */
            font-weight: 500; /* font-medium */
            margin-bottom: 0.5rem; /* mb-2 */
          }

          .form-input {
            /* Removed box-shadow for a cleaner look */
            appearance: none;
            border: 1px solid #d1d5db; /* border border-gray-300 */
            border-radius: 0.375rem; /* rounded-md */
            width: 100%; /* w-full */
            padding: 0.75rem 1rem; /* py-3 px-4 */
            color: #374151; /* text-gray-700 */
            line-height: 1.25; /* leading-tight */
            font-weight: 600; /* Added to match button font-weight */
            transition: all 0.2s ease-in-out; /* transition-all duration-200 */
          }

          .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* focus:ring-2 focus:ring-blue-500 */
            border-color: transparent; /* focus:border-transparent */
          }

          .form-group:last-of-type {
            margin-bottom: 1.5rem; /* mb-6 */
          }

          .primary-button {
            width: 100%; /* w-full */
            padding: 0.75rem 1rem; /* py-3 px-4 */
            border-radius: 0.375rem; /* rounded-md */
            font-weight: 600; /* font-semibold */
            color: #fff; /* text-white */
            background-color: #2563eb; /* bg-blue-600 */
            transition: background-color 0.2s ease-in-out; /* transition-colors duration-200 */
            border: none;
            cursor: pointer;
          }

          .primary-button:hover {
            background-color: #1d4ed8; /* hover:bg-blue-700 */
          }

          .primary-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
          }

          .secondary-button-text {
            color: #2563eb; /* text-blue-600 */
            font-weight: 500; /* font-medium */
            font-size: 0.875rem; /* text-sm */
            margin-top: 1rem; /* mt-4 */
            display: block;
            text-align: center;
            cursor: pointer;
            transition: color 0.2s ease-in-out;
          }

          .secondary-button-text:hover {
            color: #1e40af; /* hover:text-blue-800 */
          }

          .error-message {
            background-color: #fee2e2; /* bg-red-100 */
            border: 1px solid #ef4444; /* border border-red-400 */
            color: #b91c1c; /* text-red-700 */
            padding: 1rem; /* px-4 py-3 */
            border-radius: 0.25rem; /* rounded */
            position: relative;
            margin-bottom: 1rem; /* mb-4 */
          }

          .success-message {
            background-color: #d1fae5; /* bg-green-100 */
            border: 1px solid #10b981; /* border border-green-400 */
            color: #065f46; /* text-green-700 */
            padding: 1rem; /* px-4 py-3 */
            border-radius: 0.25rem; /* rounded */
            position: relative;
            margin-bottom: 1rem; /* mb-4 */
          }

          .dashboard-text {
            color: #374151; /* text-gray-700 */
            text-align: center;
            margin-bottom: 1rem; /* mb-4 or mb-6 */
          }

          .logout-button {
            width: 100%; /* w-full */
            padding: 0.75rem 1rem; /* py-3 px-4 */
            border-radius: 0.375rem; /* rounded-md */
            font-weight: 600; /* font-semibold */
            color: #fff; /* text-white */
            background-color: #dc2626; /* bg-red-600 */
            transition: background-color 0.2s ease-in-out; /* transition-colors duration-200 */
            border: none;
            cursor: pointer;
          }

          .logout-button:hover {
            background-color: #b91c1c; /* hover:bg-red-700 */
          }

          .dashboard-summary-card {
            margin-top: 2rem; /* mt-8 */
            padding: 1rem; /* p-4 */
            background-color: #f9fafb; /* bg-gray-50 */
            border-radius: 0.375rem; /* rounded-md */
            border: 1px solid #e5e7eb; /* border border-gray-200 */
          }

          .dashboard-summary-heading {
            font-size: 1.125rem; /* text-lg */
            font-weight: 600; /* font-semibold */
            color: #1f2937; /* text-gray-800 */
            margin-bottom: 0.5rem; /* mb-2 */
          }

          .dashboard-summary-text {
            color: #4b5563; /* text-gray-600 */
          }
        `}
      </style>

      {isLoggedIn ? (
        <Dashboard user={user} onLogout={handleLogout} />
      ) : (
        <AuthForm
          type={showLogin ? 'login' : 'signup'}
          onAuthSuccess={handleAuthSuccess}
          apiBaseUrl={API_BASE_URL}
          setShowLogin={setShowLogin}
        />
      )}
    </div>
  );
};

export default App;
