<x-layout>
    
   <div class="max-w-md mx-auto p-8 bg-white shadow-md rounded-lg mt-20">
      <h3 class="title">ATSOGO LOGIN PAGE</h3>
        <form action="{{ route('login') }}" method="post">
          @csrf
             {{-- {{ email }} --}}
            <div class="mb-4">
            <label for="email">Email</label><br>
            <input type="text" class="input @error('email') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="email" value="{{ old('email') }}">
            @error('email') <p class="error">{{ $message }}</p> @enderror
           </div>

           <div class="remember">
             <input type="checkbox" name="remember" id="remember">
             <label for="remember">Remember me</label>
             <p></p>
           </div>

            {{-- {{ password }} --}}
            <div class="mb-4">
            <label for="password">Password</label><br>
            <input type="password" class="input @error('password') ring-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password" >
            @error('password') <p class="error">{{ $message }}</p> @enderror
           </div>           
           
          <div>
               <button class=" w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
           </div>
        </form>
    </div>
</x-layout>