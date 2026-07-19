@props(['href' => '#'])

<a {{ $attributes->merge(['href' => $href, 'class' => 'block w-full px-4 py-2.5 text-start text-sm leading-5 text-gray-700 dark:text-gray-100 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-primary dark:hover:text-blue-300 focus:outline-none focus:bg-blue-50 dark:focus:bg-gray-700 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>