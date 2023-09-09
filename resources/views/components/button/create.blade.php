<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-gray-300 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-600 uppercase tracking-widest shadow-sm hover:bg-blue-500 hover:text-white dark:hover:bg-blue-300 dark:hover:text-black disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>