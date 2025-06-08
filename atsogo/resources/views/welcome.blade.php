<x-layout>
         <div style="background-image: url(/plot.jpg) ;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh; color: white; padding: 20px;">

            <h3 class="title">ATSOGO ESTATE AGENCY</h3>
           
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
         </div>
</x-layout>
   