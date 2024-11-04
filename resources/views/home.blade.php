<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite('resources/css/app.css')
    <!-- Tambahkan ini di dalam <head> HTML -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">
</head>

<body class="bg-amber-50">
    <section class="bg-gray-50 font-[Poppins]">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0">
                <h1
                    class="text-4xl font-bold tracking-normal leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                    Sign In
                </h1>
            </div>
            <div
                class="w-full bg-amber-400 rounded-[40px] shadow border md:mt-0 sm:max-w-md xl:p-0 shadow-[4px_4px_10px_3px_#c7c7c7]">
                <div class="p-6 py-10 space-y-4 md:space-y-6 sm:p-8">

                    <form class="space-y-4 md:space-y-6" action="#">
                        <div>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-[30px] focus:ring-primary-600 focus:border-primary-600 block w-full px-3 py-1.5"
                                placeholder="username" required="">
                        </div>
                        <div>
                            <input type="password" name="password" id="password" placeholder="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-[30px] focus:ring-primary-600 focus:border-primary-600 block w-full px-3 py-1.5  mb-12"
                                required="">
                        </div>
                        <button type="submit"
                            class="flex justify-center w-full text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center shadow-[2px_3px_10px_1px_#3d3d3d]">
                            Sign in <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="ms-2 size-4">
                                <path fill-rule="evenodd"
                                    d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
