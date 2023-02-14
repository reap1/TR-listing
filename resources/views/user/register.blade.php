<x-layout>
  <x-card style="width: 40%;" class="p-10 mx-auto mt-3">
    <header class="text-center">
      <h2 class=" font-bold uppercase mb-1">Register</h2>
      <p class="mb-4 text-2xl">Create an account to gain access</p>
    </header>

    <form method="POST" action="/sign-up/register" >
      @csrf
      <div class="mb-6">
        <label for="name" class="inline-block text-xl mb-2"> Name </label>
        <input type="text" autocomplete="off" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{old('name')}}" />

        @error('name')
        <p class="text-red-500 text-s mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="email" class="inline-block text-xl mb-2">Email</label>
        <input type="email" autocomplete="off" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old('email')}}" />

        @error('email')
        <p class="text-red-500 text-s mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="password" class="inline-block text-xl mb-2" >
          Password
        </label>
        <input type="password" autocomplete="off" class="border border-gray-200 rounded p-2 w-full" name="password"
          value="{{old('password')}}" maxlength="10"/>

        @error('password')
        <p class="text-red-500 text-s mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="password2" class="inline-block text-xl mb-2">
          Confirm Password
        </label>
        <input type="password" autocomplete="off" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation"
          value="{{old('password_confirmation')}}" />

        @error('password_confirmation')
        <p class="text-red-500 text-s mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Sign Up
        </button>
      </div>

      <div class="mt-8">
        <p>
          Already have an account?
          <a href="/" class="text-laravel">Login</a>
        </p>
      </div>
    </form>
  </x-card>
</x-layout>