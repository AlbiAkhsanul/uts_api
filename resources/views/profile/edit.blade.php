<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
        <div class="max-w-7xl mx-auto sm:px-6 space-y-6">
            <div class="py-12 bg-gray-50 min-h-screen">
                <div class="max-w-4xl mx-auto px-6 space-y-6">
                    <!-- Greeting Card -->
                    <div class="p-6 bg-white shadow-lg rounded-2xl flex items-start gap-4">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.653 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Halo, {{ Auth::user()->name }} 👋</h3>
                            <p class="text-gray-600 mt-1">Senang melihat Anda kembali!</p>
                            <p class="text-sm text-gray-500 mt-2">📧 <span class="font-medium">{{ Auth::user()->email }}</span></p>
                        </div>
                    </div>
            
                    <!-- API Key Card -->
                    <div class="p-6 bg-white shadow-lg rounded-2xl flex items-start gap-4">
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m2-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">API Key Anda</h3>
                            <p class="mt-2 text-sm text-gray-500 break-all">🔑 {{ Auth::user()->api_key }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
