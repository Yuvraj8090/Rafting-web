<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RaftMS | Raft Management System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            blue: '#1d4ed8', // Primary Brand
                            dark: '#0f172a',
                        },
                        accent: {
                            cyan: '#06BBCC', // Action Color
                            hover: '#05a0af'
                        }
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                        'fade-up': 'fadeUp 0.8s ease-out forwards',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Reveal on Scroll Class */
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden font-sans">

    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-slate-200 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer">
                    <div class="w-8 h-8 bg-brand-blue rounded-lg flex items-center justify-center text-white">
                        <i data-lucide="waves" class="w-5 h-5"></i>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">Raft<span class="text-brand-blue">MS</span></span>
                </div>

                <div class="hidden md:flex space-x-8">
                    <a href="#features" class="text-slate-600 hover:text-brand-blue font-medium transition">Features</a>
                    <a href="#how-it-works" class="text-slate-600 hover:text-brand-blue font-medium transition">How it Works</a>
                    <a href="#mobile-app" class="text-slate-600 hover:text-brand-blue font-medium transition">Mobile App</a>
                    <a href="#contact" class="text-slate-600 hover:text-brand-blue font-medium transition">Contact</a>
                </div>

                <div class="hidden md:flex">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-2.5 rounded-full font-semibold transition-all flex items-center gap-2">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-accent-cyan hover:bg-accent-hover text-white px-6 py-2.5 rounded-full font-semibold transition-all shadow-md shadow-cyan-500/30 hover:shadow-cyan-500/50 flex items-center gap-2 animate-pulse hover:animate-none">
                                <i data-lucide="lock" class="w-4 h-4"></i> Admin Login
                            </a>
                        @endauth
                    @endif
                </div>

                <div class="md:hidden flex items-center">
                    <button class="text-slate-600 hover:text-brand-blue focus:outline-none">
                        <i data-lucide="menu" class="w-8 h-8"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <header class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute top-0 right-40 w-96 h-96 bg-cyan-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-16">
            
            <div class="lg:w-1/2 text-center lg:text-left z-10 reveal active">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-brand-blue text-sm font-semibold mb-6 border border-blue-100">
                    <span class="flex h-2 w-2 rounded-full bg-brand-blue mr-2"></span>
                    Now available for Enterprise
                </div>
                <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
                    Streamlining River <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-blue to-accent-cyan">Rafting Operations</span>
                </h1>
                <p class="text-lg text-slate-600 mb-8 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    An end-to-end digital solution for verifying drivers, managing boat capacity, and ensuring safety compliance via advanced QR technology and real-time analytics.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <button class="px-8 py-3.5 rounded-lg bg-slate-900 text-white font-semibold hover:bg-slate-800 transition shadow-lg flex items-center justify-center gap-2">
                        <i data-lucide="download-cloud" class="w-5 h-5"></i> Download Verifier
                    </button>
                    <button class="px-8 py-3.5 rounded-lg bg-white text-slate-900 border border-slate-200 font-semibold hover:bg-slate-50 transition shadow-sm flex items-center justify-center gap-2 group">
                        Request Demo <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </div>

            <div class="lg:w-1/2 w-full relative reveal">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-600/20 to-cyan-400/20 rounded-3xl transform rotate-3 scale-95 blur-sm"></div>
                
                <div class="relative bg-white rounded-xl shadow-2xl border border-slate-200 p-4 overflow-hidden transform hover:scale-[1.01] transition duration-500">
                    <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-2">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="w-16 bg-slate-50 rounded-lg h-48 flex flex-col items-center py-4 gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded mb-2"></div>
                            <div class="w-full h-[1px] bg-slate-200"></div>
                            <div class="w-6 h-6 bg-slate-200 rounded"></div>
                            <div class="w-6 h-6 bg-slate-200 rounded"></div>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex justify-between items-end h-32 mb-2 gap-2">
                                <div class="w-full bg-blue-500 rounded-t-md h-[40%] animate-pulse"></div>
                                <div class="w-full bg-blue-500 rounded-t-md h-[70%]"></div>
                                <div class="w-full bg-accent-cyan rounded-t-md h-[55%]"></div>
                                <div class="w-full bg-blue-500 rounded-t-md h-[85%]"></div>
                                <div class="w-full bg-blue-500 rounded-t-md h-[60%]"></div>
                            </div>
                            <div class="flex justify-between text-xs text-slate-400 font-mono">
                                <span>08:00</span><span>12:00</span><span>16:00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-10 -right-4 w-40 bg-slate-900 rounded-[2rem] border-4 border-slate-800 p-2 shadow-2xl transform -rotate-6">
                    <div class="bg-white rounded-[1.5rem] h-64 overflow-hidden relative">
                        <div class="absolute inset-0 bg-slate-800 flex flex-col items-center justify-center">
                            <div class="text-white text-xs mb-2 opacity-80">Scanning...</div>
                            <div class="w-24 h-24 border-2 border-accent-cyan rounded-lg relative">
                                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-accent-cyan"></div>
                                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-accent-cyan"></div>
                                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-accent-cyan"></div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-accent-cyan"></div>
                                <div class="absolute top-0 left-0 w-full h-0.5 bg-accent-cyan opacity-70 animate-[scan_2s_infinite]"></div>
                            </div>
                            <div class="mt-4 px-3 py-1 bg-white/10 backdrop-blur rounded-full text-[10px] text-white">Verifier Mode</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Engineered for Efficiency</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">From admin desks to the riverbanks, RMS provides specific tools for every role in the ecosystem.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group reveal">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-brand-blue transition-colors">
                        <i data-lucide="shield-check" class="w-7 h-7 text-brand-blue group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Role-Based Security</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Granular access controls for Admins, Verifiers, and Uploaders. Secure login ensures sensitive data is only seen by authorized personnel.</p>
                </div>

                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group reveal">
                    <div class="w-14 h-14 bg-cyan-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-accent-cyan transition-colors">
                        <i data-lucide="qr-code" class="w-7 h-7 text-accent-cyan group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Smart QR Verification</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Generate tamper-proof QR codes for PVC cards or digital wallets. Scan instantly to retrieve driver history and boat validity.</p>
                </div>

                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group reveal">
                    <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-orange-500 transition-colors">
                        <i data-lucide="bar-chart-3" class="w-7 h-7 text-orange-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Real-Time Traffic Logic</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Automated trip counting prevents overcrowding. System flags boats exceeding daily limits instantly.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="py-20 bg-slate-900 text-white overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10 pointer-events-none">
            <div class="absolute top-10 left-10 w-64 h-64 bg-brand-blue rounded-full filter blur-[100px]"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-accent-cyan rounded-full filter blur-[100px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                
                <div class="lg:w-1/2 reveal">
                    <h2 class="text-3xl lg:text-4xl font-bold mb-6">On-Ground Verification Made Simple</h2>
                    <p class="text-slate-300 text-lg mb-8">
                        Verifiers don't need to calculate stats. The app processes the QR scan and displays a simple "Traffic Light" status, enabling split-second decisions at the entry point.
                    </p>
                    
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-accent-cyan font-bold">1</div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold">Scan QR</h4>
                                <p class="text-slate-400 text-sm">Verifier scans the driver's PVC card.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-accent-cyan font-bold">2</div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold">Instant Analysis</h4>
                                <p class="text-slate-400 text-sm">System checks database for today's trip count.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-accent-cyan font-bold">3</div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold">Action Prompt</h4>
                                <p class="text-slate-400 text-sm">Approve or Deny based on the status badge.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="lg:w-1/2 w-full reveal">
                    <div class="bg-slate-800 rounded-2xl p-6 border border-slate-700 shadow-2xl">
                        <div class="text-center mb-6 text-sm font-mono text-slate-400 uppercase tracking-widest">Logic Visualization</div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between bg-slate-700/50 p-4 rounded-xl border border-slate-600">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-green-500/20 border border-green-500 flex items-center justify-center">
                                        <i data-lucide="check" class="text-green-500"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-white">0 Trips</div>
                                        <div class="text-xs text-green-400 font-medium uppercase">Fresh Entry</div>
                                    </div>
                                </div>
                                <span class="bg-green-500 text-slate-900 text-xs font-bold px-3 py-1 rounded-full">GO</span>
                            </div>

                            <div class="flex items-center justify-between bg-slate-700/50 p-4 rounded-xl border border-slate-600">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-yellow-500/20 border border-yellow-500 flex items-center justify-center">
                                        <i data-lucide="alert-circle" class="text-yellow-500"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-white">1 Trip Done</div>
                                        <div class="text-xs text-yellow-400 font-medium uppercase">Caution</div>
                                    </div>
                                </div>
                                <span class="bg-yellow-500 text-slate-900 text-xs font-bold px-3 py-1 rounded-full">CHECK</span>
                            </div>

                            <div class="flex items-center justify-between bg-slate-700/50 p-4 rounded-xl border border-red-500/50 shadow-[0_0_15px_rgba(239,68,68,0.2)]">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-red-500/20 border border-red-500 flex items-center justify-center">
                                        <i data-lucide="x-octagon" class="text-red-500"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-white">Limit Reached</div>
                                        <div class="text-xs text-red-400 font-medium uppercase">Maximum Capacity</div>
                                    </div>
                                </div>
                                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">DENY</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800">
        <div class="max-w-7xl mx-auto px-4 text-center text-white reveal">
            <i data-lucide="server" class="w-12 h-12 mx-auto mb-4 opacity-80"></i>
            <h2 class="text-2xl font-bold mb-2">Future-Ready Architecture</h2>
            <p class="max-w-2xl mx-auto text-blue-100 mb-8">
                Built on a scalable database design capable of supporting multiple rafting companies, 
                distinct departments, and thousands of concurrent verifications.
            </p>
            <div class="flex justify-center gap-4 text-sm font-mono opacity-70">
                <span class="border border-blue-400 px-3 py-1 rounded">High Availability</span>
                <span class="border border-blue-400 px-3 py-1 rounded">Secure API</span>
                <span class="border border-blue-400 px-3 py-1 rounded">Auto-Backup</span>
            </div>
        </div>
    </section>

    <footer id="contact" class="bg-slate-50 border-t border-slate-200 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-6 h-6 bg-brand-blue rounded flex items-center justify-center text-white">
                            <i data-lucide="waves" class="w-3 h-3"></i>
                        </div>
                        <span class="font-bold text-lg text-slate-900">RaftMS</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-xs">
                        Empowering river operations with digital trust and operational clarity.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900 mb-4">Product</h4>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-brand-blue transition">Verifier App</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition">Admin Dashboard</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition">Release Notes</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900 mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-brand-blue transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition">Support</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-200 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-400 text-xs">© 2024 Raft Management System. All rights reserved.</p>
                <div class="flex items-center gap-2 text-slate-500 text-xs">
                    <span>Powered by</span>
                    <span class="font-bold text-slate-700">YashiAssociates</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Icons
        lucide.createIcons();

        // Scroll Reveal Script
        window.addEventListener('scroll', reveal);
        function reveal() {
            var reveals = document.querySelectorAll('.reveal');
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 100;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add('active');
                }
            }
        }
        // Trigger once on load
        reveal();
    </script>
</body>
</html>