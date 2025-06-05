<x-layout>
    
    <div class="max-w-md mx-auto p-8 bg-white shadow-md rounded-lg mt-20">
      <h3 class="title">ATSOGO SIGNUP PAGE</h3>
        <form action="{{ route('register') }}" method="post">
          @csrf
             {{-- {{ username }} --}}
           <div class="mb-4">
            <label for="username">Username</label><br>
            <input type="text" class="input @error('username') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="username" value="{{ old('username') }}">
            @error('username') <p class="error">{{ $message }}</p> @enderror
           </div>
          
            {{-- {{ email }} --}}
            <div class="mb-4">
            <label for="email">Email</label><br>
            <input type="text" class="input @error('email') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="email" value="{{ old('email') }}">
            @error('email') <p class="error">{{ $message }}</p> @enderror
           </div>

           {{-- {{phone number }} --}}
            <div class="mb-4">
            <label for="phone_number">Phone Number</label><br>
            <input type="text" class="input @error('phone_number') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="phone_number" value="{{ old('phone_number') }}">
            @error('phone_number') <p class="error">{{ $message }}</p> @enderror
           </div>
            {{-- {{ password }} --}}
            <div class="mb-4">
            <label for="password">Password</label><br>
            <input type="password" class="input @error('password') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password" >
            @error('password') <p class="error">{{ $message }}</p> @enderror
           </div>
             {{-- {{ confirm-password }} --}}
            <div class="mb-4">
            <label for="password_confirmation">Confirm-password  </label><br>
            <input type="password" class="input @error('password_confirmation') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation">
            @error('password_confirmation') <p class="error">{{ $message }}</p> @enderror
           </div>
           <div>
               <button class=" w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>
           </div>
        </form>
    </div>
   
</div>
</x-layout>