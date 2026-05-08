import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        // Safelist dynamic classes used in Blade conditionals
        'bg-emerald-50', 'text-emerald-600', 'border-emerald-200', 'bg-emerald-500', 'shadow-emerald-200',
        'bg-red-50', 'text-red-500', 'border-red-200', 'bg-red-500', 'shadow-red-200', 'border-red-100', 'bg-red-100', 'text-red-700', 'text-red-800', 'bg-red-400',
        'bg-amber-50', 'text-amber-500', 'border-amber-200', 'border-amber-100', 'bg-amber-500', 'shadow-amber-200', 'bg-amber-100', 'text-amber-600', 'text-amber-700', 'text-amber-800',
        'bg-violet-50', 'text-violet-600', 'border-violet-200',
        'from-emerald-400', 'to-emerald-500', 'from-amber-400', 'to-amber-500', 'from-red-400', 'to-red-500',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                },
                accent: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                }
            },
            borderRadius: {
                '4xl': '2rem',
                '5xl': '2.5rem',
            },
            boxShadow: {
                'premium': '0 20px 25px -5px rgba(15, 23, 42, 0.08), 0 10px 10px -5px rgba(15, 23, 42, 0.03)',
                'premium-hover': '0 30px 35px -5px rgba(15, 23, 42, 0.12), 0 15px 15px -5px rgba(15, 23, 42, 0.06)',
            }
        },
    },

    plugins: [forms],
};
