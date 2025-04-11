tailwind.config = {
    theme: {
        extend: {
        screens: {
            'mobile': {'min': '360px', 'max': '576px'}
        },
        fontFamily: {
            sans: [
            '"Spoqa Han Sans Neo"',
            '"Noto Sans KR"',
            '"Nanum Gothic"',
            'MalgunGothic',
            'Dotum',
            'sans-serif'
            ],
            mono: [
            'SFMono-Regular',
            'Menlo',
            'Monaco',
            'Consolas',
            'monospace'
            ],
        },
        colors: {
            primary: '#569bf7',
        },
        zIndex: {
            '100': '100',
        },
        }
    }
} 