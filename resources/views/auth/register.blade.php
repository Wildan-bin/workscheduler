<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
    <!-- Tambahkan ini di dalam <head> HTML -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FDFAEF]">
    <section class=pt-[30%] lg:pt-5 font-[Poppins]">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0">
                <h1
                    class="text-4xl font-bold tracking-normal leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                    Register
                </h1>
            </div>
            @if (session()->has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div
                class="w-full bg-amber-400 rounded-[40px] shadow border md:mt-0 sm:max-w-md xl:p-0 shadow-[4px_4px_10px_3px_#c7c7c7]">
                <div class="p-6 py-10 space-y-4 md:space-y-6 sm:p-8">

                    <form class="space-y-4 md:space-y-6" action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <div>
                            <input type="text" name="fullname" id="fullname"
                                class="text-xs bg-gray-50 border border-gray-300 text-gray-900 rounded-[30px] focus:ring-primary-600 focus:border-primary-600 block w-full px-3 py-1.5"
                                placeholder="fullname">
                            @if ($errors->has('fullname'))
                                <span class="text-red-900 text-xs">
                                    {{ $errors->first('fullname') }}
                                </span>
                            @endif
                        </div>
                        <div>
                            <input type="email" name="email" id="email"
                                class="text-xs bg-gray-50 border border-gray-300 text-gray-900 rounded-[30px] focus:ring-primary-600 focus:border-primary-600 block w-full px-3 py-1.5"
                                placeholder="email" required="">
                            @if ($errors->has('email'))
                                <span class="text-red-900 text-xs">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div>
                            <input type="password" name="password" id="password" placeholder="password"
                                class="text-xs bg-gray-50 border border-gray-300 text-gray-900 rounded-[30px] focus:ring-primary-600 focus:border-primary-600 block w-full px-3 py-1.5  mb-12"
                                required="">
                            @if ($errors->has('password'))
                                <span class="text-red-900 text-xs">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                        <button type="submit"
                            class="flex justify-center w-full text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center shadow-[2px_3px_10px_1px_#3d3d3d]">
                            Sign Up
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
