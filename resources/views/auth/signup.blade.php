<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up || POS</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body {
            background: url('/files/background2.jpg');
            background-size: cover;
        }

        /* Glassmorphism card effect */
        .card {
            backdrop-filter: blur(5px) saturate(150%);
            -webkit-backdrop-filter: blur(10px) saturate(150%);
            background-color: rgba(255, 255, 255, 0.4);
        }

        /* Generated by https://generator.ui.glass/ */
    </style>
</head>

<body>
    <div
        class="flex flex-col items-center justify-center px-12 py-8 mx-auto min-h-screen">
        <div
            class="card w-full rounded-lg md:mt-0 sm:w-3/5 xl:p-0">
            <div
                class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl font-bold leading-tight tracking-tight text-center text-gray-900 md:text-2xl">
                    Register
                </h1>
                <!-- ERROR FIELD -->
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                    <div>
                        <span class="font-medium">Error!</span> {{ $error }}
                    </div>
                </div>
                @endforeach
                @endif
                <!-- SIGN UP FORM -->
                <form
                    action="/signup"
                    enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div>
                            <label
                                for="name"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="John Doe"
                                required>
                        </div>
                        <div>
                            <label
                                for="email"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Email Address
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="name@mail.com"
                                required>
                        </div>
                        <div>
                            <label
                                for="phone"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Phone
                            </label>
                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="01234 567891"
                                required>
                        </div>
                        <div>
                            <label
                                for="address"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Address
                            </label>
                            <input
                                type="text"
                                name="address"
                                id="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Type your address"
                                required>
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900"
                                for="photo">
                                Upload photo
                            </label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                id="photo"
                                name="photo"
                                type="file">
                        </div>
                        <div>
                            <label
                                for="password"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Password
                            </label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="••••••••"
                                required>
                        </div>
                    </div>
                    <div class="mt-8 px-16">
                        <button
                            type="submit"
                            class="w-full text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 text-center">
                            Sign up
                        </button>
                    </div>
                    <p
                        class="text-sm font-light text-center text-gray-700 mt-4">
                        Already registered?<a
                            href="{{ route('login') }}"
                            class="font-medium text-primary-600 underline">
                            Login
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>