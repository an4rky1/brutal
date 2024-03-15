<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BRUTAL THOUGHTS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes pulse-border {
            0%, 100% { box-shadow: 12px 12px 0px 0px #000000; }
            50% { box-shadow: 16px 16px 0px 0px #000000; }
        }

        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }

        @keyframes bounce-in {
            0% { transform: scale(0.9); opacity: 0; }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }

        @keyframes slide-up {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .bg-grid {
            background-image:
                linear-gradient(rgba(0,0,0,0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,0,0,0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .bg-dots {
            background-image: radial-gradient(rgba(0,0,0,0.15) 1px, transparent 1px);
            background-size: 16px 16px;
        }

        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-spin-slow { animation: spin-slow 20s linear infinite; }
        .animate-marquee { animation: marquee 30s linear infinite; }
        .animate-bounce-in { animation: bounce-in 0.4s ease-out; }
        .animate-wiggle { animation: wiggle 0.3s ease-in-out infinite; }
        .animate-slide-up { animation: slide-up 0.5s ease-out; }

        .neo-border {
            border: 4px solid #000;
            box-shadow: 8px 8px 0px 0px #000;
        }

        .neo-border-thick {
            border: 6px solid #000;
            box-shadow: 12px 12px 0px 0px #000;
        }

        .neo-border-xl {
            border: 8px solid #000;
            box-shadow: 16px 16px 0px 0px #000;
        }

        .neo-border-2xl {
            border: 10px solid #000;
            box-shadow: 20px 20px 0px 0px #000;
        }

        .neo-btn {
            border: 4px solid #000;
            box-shadow: 6px 6px 0px 0px #000;
            transition: all 0.1s ease;
        }

        .neo-btn:hover {
            box-shadow: 8px 8px 0px 0px #000;
            transform: translate(-2px, -2px);
        }

        .neo-btn:active {
            box-shadow: 0px 0px 0px 0px #000;
            transform: translate(6px, 6px);
        }

        .text-stroke {
            -webkit-text-stroke: 2px #000;
            color: transparent;
        }

        .poster-transition {
            transition: background-color 0.4s ease, color 0.4s ease, box-shadow 0.4s ease;
        }
    </style>
</head>
<body class="bg-[#f0ead6] min-h-screen flex items-center justify-center overflow-hidden relative bg-grid">

    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-20 h-20 bg-[#FFDE00] neo-border animate-float" style="animation-delay: 0s;"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-[#00FF41] neo-border rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-40 left-24 w-12 h-12 bg-[#FF3300] neo-border animate-wiggle"></div>
        <div class="absolute bottom-20 right-16 w-24 h-24 bg-[#CC00FF] neo-border rounded-full animate-spin-slow"></div>
        <div class="absolute top-1/2 left-8 w-8 h-8 bg-[#00E5FF] neo-border animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-20 left-1/3 w-6 h-6 bg-[#FF6600] neo-border animate-wiggle" style="animation-delay: 0.5s;"></div>
    </div>

    <div
        x-data="quotePoster()"
        x-init="init()"
        class="w-full max-w-5xl mx-4 md:mx-8 relative z-10"
    >

        <div class="overflow-hidden mb-6 neo-border bg-[#FFDE00]">
            <div class="animate-marquee whitespace-nowrap py-2 font-black text-lg uppercase tracking-widest">
                <span class="mx-8">★ BRUTAL THOUGHTS ★</span>
                <span class="mx-8">★ МЫСЛЬ ДНЯ ★</span>
                <span class="mx-8">★ QUOTE GENERATOR ★</span>
                <span class="mx-8">★ ВДОХНОВЕНИЕ ★</span>
                <span class="mx-8">★ BRUTAL THOUGHTS ★</span>
                <span class="mx-8">★ МЫСЛЬ ДНЯ ★</span>
                <span class="mx-8">★ QUOTE GENERATOR ★</span>
                <span class="mx-8">★ ВДОХНОВЕНИЕ ★</span>
            </div>
        </div>

        <div
            id="poster"
            class="relative p-6 md:p-12 lg:p-16 neo-border-2xl poster-transition"
            :style="`background-color: ${bgColor}; color: ${textColor};`"
            :class="{ 'animate-bounce-in': !loading && quote.text }"
        >
            <div class="absolute inset-0 pointer-events-none overflow-hidden" style="background-image: radial-gradient(rgba(0,0,0,0.12) 1.5px, transparent 1.5px); background-size: 18px 18px;"></div>

            <div class="uppercase tracking-widest text-xs md:text-sm font-black mb-4 md:mb-6 border-b-4 border-black pb-2 inline-block bg-black px-3 py-1" :style="`color: ${bgColor};`">
                Thought of the Day
            </div>

            <blockquote
                class="font-black text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl leading-[1.05] tracking-tight mb-6 md:mb-8"
                x-show="!loading"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-text="quote.text"
            ></blockquote>

            <div
                class="text-lg md:text-xl lg:text-2xl font-black uppercase tracking-wider"
                x-show="!loading"
                x-transition:enter="transition ease-out duration-300 delay-150"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <span class="border-t-4 border-black pt-3 inline-block" x-text="'— ' + quote.author"></span>
            </div>

            <div class="absolute top-4 right-4 md:top-6 md:right-6">
                <span
                    class="text-xs md:text-sm font-black uppercase tracking-widest bg-black px-3 py-1"
                    :style="`color: ${bgColor};`"
                    x-text="quote.category"
                ></span>
            </div>

            <div class="absolute bottom-4 right-4 md:bottom-6 md:right-6 opacity-20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 md:w-24 md:h-24 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 mt-8">
            <button
                @click="nextQuote()"
                class="group flex-1 bg-[#FFDE00] text-black font-black text-xl md:text-2xl uppercase tracking-wider neo-btn cursor-pointer"
                :disabled="loading"
            >
                <span class="flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:w-8 md:h-8 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                    Next thought
                </span>
            </button>

            <button
                @click="downloadPoster()"
                class="bg-black text-white font-black text-xl md:text-2xl uppercase tracking-wider neo-btn cursor-pointer hover:bg-gray-900"
            >
                <span class="flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:w-8 md:h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Save poster
                </span>
            </button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-xs uppercase tracking-widest opacity-50 font-bold">
                <span x-text="viewedCount"></span> / <span x-text="totalCount"></span> thoughts viewed
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script>
        function quotePoster() {
            return {
                quote: { text: '', author: '', category: '', bg_color: '#FFDE00', text_color: '#000000' },
                bgColor: '#FFDE00',
                textColor: '#000000',
                loading: false,
                viewedCount: 0,
                totalCount: 0,

                async init() {
                    await this.getTotalCount();
                    await this.nextQuote();
                },

                async getTotalCount() {
                    try {
                        const response = await fetch('/api/quote/count');
                        const data = await response.json();
                        this.totalCount = data.count;
                    } catch (error) {
                        console.error('Failed to fetch count:', error);
                    }
                },

                async nextQuote() {
                    this.loading = true;

                    try {
                        const response = await fetch('/api/quote/random');
                        const data = await response.json();

                        this.quote = data;
                        this.bgColor = data.bg_color;
                        this.textColor = data.text_color;
                        this.viewedCount++;
                    } catch (error) {
                        console.error('Failed to fetch quote:', error);
                    }

                    this.loading = false;
                },

                async downloadPoster() {
                    const poster = document.getElementById('poster');
                    const dotsOverlay = poster.querySelector('.absolute.inset-0.pointer-events-none');

                    try {
                        poster.style.animation = 'none';
                        poster.querySelectorAll('*').forEach(el => {
                            el.style.animation = 'none';
                            el.style.transition = 'none';
                        });

                        if (dotsOverlay) dotsOverlay.style.display = 'none';

                        await new Promise(r => setTimeout(r, 100));

                        const canvas = await html2canvas(poster, {
                            scale: 4,
                            backgroundColor: this.bgColor,
                            useCORS: true,
                            logging: false,
                            imageTimeout: 0,
                            letterRendering: true,
                            allowTaint: true,
                        });

                        if (dotsOverlay) dotsOverlay.style.display = '';

                        poster.querySelectorAll('*').forEach(el => {
                            el.style.animation = '';
                            el.style.transition = '';
                        });
                        poster.style.animation = '';

                        const link = document.createElement('a');
                        link.download = `brutal-thought-${Date.now()}.png`;
                        link.href = canvas.toDataURL('image/png', 1.0);
                        link.click();
                    } catch (error) {
                        if (dotsOverlay) dotsOverlay.style.display = '';
                        console.error('Failed to download poster:', error);
                    }
                },
            };
        }
    </script>
</body>
</html>
