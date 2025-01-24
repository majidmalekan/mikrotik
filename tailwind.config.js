/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                'IRANSans': ['IRANSans'], // Add your custom font here
            },
            backgroundColor: {
                customBlue: '#145192', // Custom background color
            },
            color:{
                customBlue: '#145192', // Custom text color
            },
            boxShadow: {
                custom: '32px 32px 2px #145192, 0 8px 16px rgba(20, 81, 146, 0.25)',
            },
        },
    },
    plugins: [],
}

