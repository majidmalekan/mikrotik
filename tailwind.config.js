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
                pending:'#FEEEDF',
                closed:'#E4F2EE',
                answered:'#EBF0FE'
            },
            colors:{
                customBlue: '#145192', // Custom text color
                ticketStatus:{
                    pending:'#7D4400',
                    closed:'#31684E',
                    answered:'#1551A0'
                }
            },
            boxShadow: {
                custom: '32px 32px 2px #145192, 0 8px 16px rgba(20, 81, 146, 0.25)',
            },
        },
    },
    plugins: [],
}

