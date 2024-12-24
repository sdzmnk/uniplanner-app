<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Головна') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Ви успішно увійшли в акаунт!") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Перейдіть, будь ласка, на відповідну сторінку:") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <i class="fa-solid fa-user-shield"></i>
                    <a href="{{route('admin.index')}}" class="no-underline">
                        {{ __(" Сторінка адміністратора") }}
                    </a>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    <a href="{{route('teacher.index')}}" class="no-underline">
                        {{ __(" Сторінка викладача") }}
                    </a>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <i class="fa-solid fa-user-graduate"></i>
                    <a href="{{route('student.index')}}" class="no-underline">
                        {{ __(" Сторінка студента") }}
                    </a>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">
                        {{ __(" Перейдіть на сторінку свого профілю, щоб налаштувати акаунт.") }}
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
