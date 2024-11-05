{{-- ini harusnya halaman home tapi tidak tahu home apa --}}
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
        </div>
    </section>

</body>

</html>
