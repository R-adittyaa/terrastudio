<!DOCTYPE html>
<html lang="id" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>TerraStudio — Unfiltered Literary Workspace 📖</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            terradark: '#0a0304',
            terracard: '#18070a',
            terraborder: '#2a0a0f',
            terracrimson: '#991b1b',
            terrared: '#dc2626',
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&family=Merriweather:ital,wght@0,300;0,400;1,300&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0304; color: #e5e7eb; -webkit-tap-highlight-color: transparent; }
    .font-serif-read { font-family: 'Merriweather', serif; }
    .font-sans-read { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-mono-read { font-family: 'JetBrains Mono', monospace; }
    .font-title { font-family: 'Cinzel', serif; }

    .theme-puredark { background-color: #120407; color: #e5e7eb; }
    .theme-sepia { background-color: #1c1512; color: #d7c4b7; }
    .theme-crimson { background-color: #26050b; color: #fca5a5; }

    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: #0a0304; }
    ::-webkit-scrollbar-thumb { background: #991b1b; border-radius: 4px; }

    /* Keyframes Splash Animation */
    @keyframes pulseGlow {
      0%, 100% { opacity: 0.3; transform: scale(0.95); }
      50% { opacity: 0.8; transform: scale(1.05); }
    }
    .glow-pulse { animation: pulseGlow 2s infinite ease-in-out; }
  </style>
</head>
<body class="antialiased min-h-screen flex flex-col justify-between selection:bg-red-600 selection:text-white pb-20 md:pb-0 overflow-hidden" id="mainBody">

  <!-- 1. SPLASH SCREEN INTRO ANIMATED (FITUR BARU) -->
  <div id="splashScreen" class="fixed inset-0 bg-[#070203] z-[100] flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
    <div class="absolute w-96 h-96 bg-red-600/15 rounded-full blur-[140px] pointer-events-none glow-pulse"></div>
    
    <div class="text-center relative z-10 px-6">
      <div class="flex items-center justify-center gap-2 mb-3">
        <div class="w-3 h-3 rounded-full bg-red-600 animate-ping"></div>
        <span class="font-title text-3xl md:text-5xl tracking-widest text-white">TERRA<span class="text-red-500">.STUDIO</span></span>
      </div>
      <p class="text-xs md:text-sm text-gray-400 font-mono tracking-widest uppercase mb-8">Unfiltered Literary Workspace</p>

      <!-- Progress Line Loader -->
      <div class="w-48 md:w-64 h-1 bg-red-950/80 rounded-full mx-auto overflow-hidden border border-red-900/30">
        <div id="splashProgress" class="h-full bg-red-600 transition-all duration-[1500ms] ease-out w-0 shadow-[0_0_12px_#dc2626]"></div>
      </div>
    </div>
  </div>

  <!-- READING PROGRESS BAR -->
  <div id="progressBar" class="fixed top-0 left-0 h-1 bg-red-600 z-50 transition-all duration-150 w-0 shadow-[0_0_12px_#dc2626]"></div>

  <!-- Toast Notification System -->
  <div id="toastBox" class="fixed bottom-20 md:bottom-6 right-4 left-4 md:left-auto md:right-6 z-50 hidden transition-all transform translate-y-4">
    <div class="bg-terracard border border-red-700/60 text-white text-xs px-4 py-3 rounded-2xl shadow-2xl flex items-center justify-between md:justify-start gap-2 backdrop-blur-md">
      <span id="toastMsg">Notifikasi</span>
    </div>
  </div>

  <!-- Ambient Glow Backdrop -->
  <div class="fixed inset-0 -z-10 pointer-events-none overflow-hidden">
    <div class="absolute -top-40 right-0 w-80 md:w-[30rem] h-80 md:h-[30rem] bg-red-950/20 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 left-0 w-80 md:w-[30rem] h-80 md:h-[30rem] bg-rose-950/15 rounded-full blur-[120px]"></div>
  </div>

  <!-- COLLAPSIBLE SIDEBAR MENU -->
  <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 hidden transition-opacity"></div>
  
  <aside id="sidebar" class="fixed top-0 left-0 h-full w-80 max-w-[85vw] bg-terracard border-r border-red-950/80 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out p-6 flex flex-col justify-between">
    <div>
      <div class="flex items-center justify-between border-b border-red-950/80 pb-4 mb-6">
        <div class="flex items-center gap-2">
          <div class="w-3 h-3 rounded-full bg-red-600 animate-pulse"></div>
          <span class="font-title text-lg tracking-widest text-white">TERRA<span class="text-red-500">.STUDIO</span></span>
        </div>
        <button onclick="toggleSidebar()" class="text-gray-400 hover:text-white text-sm bg-red-950/60 p-2 rounded-xl border border-red-900/40">✕</button>
      </div>

      <nav class="space-y-2 mb-6">
        <button onclick="playSfx('click'); showCatalog(); toggleSidebar();" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl bg-red-950/30 hover:bg-red-900/40 text-red-300 font-bold text-xs border border-red-900/30 transition-all active:scale-95">
          <span>📚</span> Katalog Utama
        </button>
        <button onclick="playSfx('click'); openNotesModal(); toggleSidebar();" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl bg-red-950/20 hover:bg-red-900/30 text-gray-300 font-bold text-xs border border-red-950 transition-all active:scale-95">
          <span>📝</span> Author Scratchpad
        </button>
      </nav>

      <!-- BOOKMARK SECTION IN SIDEBAR -->
      <div class="mb-6">
        <h4 class="text-[11px] font-bold text-red-500/80 uppercase tracking-wider mb-3 flex items-center justify-between">
          <span>🔖 Bookmark Tersimpan</span>
          <button onclick="clearAllBookmarks()" class="text-[9px] text-gray-500 hover:text-red-400">Reset</button>
        </h4>
        <div id="bookmarkList" class="space-y-2 max-h-48 overflow-y-auto pr-1">
          <p class="text-[11px] text-gray-500 italic">Belum ada bab yang ditandai.</p>
        </div>
      </div>
    </div>

    <div class="border-t border-red-950/80 pt-4 space-y-2">
      <button onclick="playSfx('click'); openSettingsModal();" class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-terradark text-xs text-gray-300 hover:text-red-400 border border-red-950 transition-all active:scale-95">
        <span class="flex items-center gap-2">⚙️ Audio Profile</span>
        <span id="sfxStatusText" class="text-[10px] text-red-500 font-bold uppercase">Cyber</span>
      </button>
    </div>
  </aside>

  <!-- HEADER NAVBAR -->
  <header class="max-w-4xl mx-auto w-full px-4 md:px-6 py-4 md:py-6 flex items-center justify-between border-b border-red-950/60 sticky top-0 bg-terradark/90 backdrop-blur-md z-30">
    <div class="flex items-center gap-3 md:gap-4">
      <button onclick="playSfx('click'); toggleSidebar();" class="p-2.5 bg-terracard hover:bg-red-950/50 border border-red-900/40 rounded-2xl text-red-400 transition-all active:scale-95">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
      </button>
      <div class="flex items-center gap-2 cursor-pointer" onclick="playSfx('click'); showCatalog();">
        <span class="font-title text-lg md:text-xl tracking-widest text-white">TERRA<span class="text-red-500">.STUDIO</span></span>
      </div>
    </div>
    <div class="flex items-center gap-2">
      <button onclick="playSfx('click'); openNotesModal();" class="text-xs bg-red-950/60 hover:bg-red-900 border border-red-800/40 text-red-300 p-2 md:px-3 md:py-1.5 rounded-xl font-bold transition-all active:scale-95 flex items-center gap-1">
        📝 <span class="hidden md:inline">Notes</span>
      </button>
    </div>
  </header>

  <!-- MAIN CENTERED CONTAINER -->
  <main class="max-w-4xl mx-auto w-full px-4 md:px-6 py-6 md:py-8 flex-1">
    <div id="appView">
      <p class="text-center text-xs text-gray-500 py-12">Memuat TerraStudio...</p>
    </div>
  </main>

  <!-- MODAL PERSONAL AUTHOR NOTES -->
  <div id="notesModal" class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 hidden flex items-center justify-center p-4">
    <div class="bg-terracard border border-red-700/50 w-full max-w-lg rounded-3xl p-6 relative shadow-2xl">
      <button onclick="closeNotesModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white bg-red-950 border border-red-800/40 w-8 h-8 rounded-full flex items-center justify-center">✕</button>
      
      <div class="flex items-center gap-2 mb-4 border-b border-red-950 pb-3">
        <span class="text-lg">📝</span>
        <h3 class="text-base font-bold text-white font-title">Personal Author Scratchpad</h3>
      </div>
      
      <p class="text-[11px] text-gray-400 mb-3">Tulis ide cerita, plot twist, atau draf mentahmu di sini. Otomatis tersimpan di browsermu!</p>

      <textarea id="authorNotesArea" rows="8" placeholder="Tuliskan catatan ide kamu di sini..." class="w-full bg-terradark border border-red-900/40 rounded-2xl p-4 text-xs text-white focus:outline-none focus:border-red-500 font-sans leading-relaxed resize-none"></textarea>

      <div class="flex justify-between items-center mt-4">
        <span id="notesSaveStatus" class="text-[10px] text-gray-500">Tersimpan otomatis</span>
        <button onclick="saveAuthorNotes()" class="bg-red-600 hover:bg-red-500 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition-all active:scale-95">Simpan Note 🚀</button>
      </div>
    </div>
  </div>

  <!-- MODAL SETTINGS AUDIOS & SFX CHOOSER -->
  <div id="settingsModal" class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 hidden flex items-center justify-center p-4">
    <div class="bg-terracard border border-red-700/50 w-full max-w-sm rounded-3xl p-6 relative">
      <button onclick="closeSettingsModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white bg-red-950 border border-red-800/40 w-8 h-8 rounded-full flex items-center justify-center">✕</button>
      <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">⚙️ Pengaturan SFX & Audio</h3>
      
      <div class="space-y-4">
        <div>
          <label class="block text-xs font-bold text-gray-400 mb-2">Pilih Profil Efek Suara (UI SFX)</label>
          <select id="sfxProfileSelect" onchange="changeSfxProfile(this.value)" class="w-full bg-terradark border border-red-900/40 rounded-xl px-3 py-2.5 text-xs text-white focus:outline-none focus:border-red-500">
            <option value="cyber">🔊 Cyber Synth (Default)</option>
            <option value="mech">⌨️ Mechanical Keyboard</option>
            <option value="wood">🪵 Cozy Wood Click</option>
            <option value="mute">🔇 Mute / Hening Total</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="text-center py-6 border-t border-red-950/60 text-gray-500 text-xs">
    <p class="tracking-wide">TERRASTUDIO &copy; 2026 — <span class="text-red-500 font-semibold">Home of Unfiltered Stories</span></p>
  </footer>

  <script>
    let currentChapterId = null;
    let totalReadingMinutes = 0;
    let currentSfxProfile = 'cyber';
    let allWorksData = [];

    let readerFont = 'font-serif-read';
    let readerSize = 'text-base md:text-lg';
    let readerTheme = 'theme-puredark';

    // ANIMASI SPLASH SCREEN LOGIC
    function triggerSplashScreen() {
      const splash = document.getElementById('splashScreen');
      const progress = document.getElementById('splashProgress');
      const body = document.getElementById('mainBody');

      // Animasi bar bergerak
      setTimeout(() => { if (progress) progress.style.width = '100%'; }, 100);

      // Fade Out Splash
      setTimeout(() => {
        if (splash) {
          splash.classList.add('opacity-0', 'pointer-events-none', 'scale-105');
          body.classList.remove('overflow-hidden');
          setTimeout(() => splash.remove(), 700);
        }
      }, 1600);
    }

    // SFX Synth Engine
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    
    function playSfx(type) {
      if (currentSfxProfile === 'mute') return;
      if (audioCtx.state === 'suspended') audioCtx.resume();

      const osc = audioCtx.createOscillator();
      const gain = audioCtx.createGain();
      osc.connect(gain);
      gain.connect(audioCtx.destination);
      const now = audioCtx.currentTime;

      if (currentSfxProfile === 'cyber') {
        osc.type = 'sine';
        osc.frequency.setValueAtTime(type === 'like' ? 440 : 500, now);
        osc.frequency.exponentialRampToValueAtTime(type === 'like' ? 880 : 180, now + 0.06);
        gain.gain.setValueAtTime(0.12, now);
        gain.gain.exponentialRampToValueAtTime(0.01, now + 0.06);
        osc.start();
        osc.stop(now + 0.06);
      } else if (currentSfxProfile === 'mech') {
        osc.type = 'square';
        osc.frequency.setValueAtTime(1200, now);
        osc.frequency.exponentialRampToValueAtTime(300, now + 0.02);
        gain.gain.setValueAtTime(0.08, now);
        gain.gain.exponentialRampToValueAtTime(0.001, now + 0.02);
        osc.start();
        osc.stop(now + 0.02);
      } else if (currentSfxProfile === 'wood') {
        osc.type = 'triangle';
        osc.frequency.setValueAtTime(220, now);
        osc.frequency.exponentialRampToValueAtTime(80, now + 0.04);
        gain.gain.setValueAtTime(0.2, now);
        gain.gain.exponentialRampToValueAtTime(0.01, now + 0.04);
        osc.start();
        osc.stop(now + 0.04);
      }
    }

    function changeSfxProfile(val) {
      currentSfxProfile = val;
      document.getElementById('sfxStatusText').innerText = val.toUpperCase();
      playSfx('click');
      showToast(`🔊 SFX: ${val.toUpperCase()}`);
    }

    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');
      sidebar.classList.toggle('-translate-x-full');
      overlay.classList.toggle('hidden');
      renderBookmarksSidebar();
    }

    function showToast(msg) {
      const toast = document.getElementById('toastBox');
      const text = document.getElementById('toastMsg');
      text.innerText = msg;
      toast.classList.remove('hidden', 'translate-y-4');
      setTimeout(() => {
        toast.classList.add('translate-y-4');
        setTimeout(() => toast.classList.add('hidden'), 200);
      }, 3000);
    }

    // Scroll Progress
    window.addEventListener('scroll', () => {
      const bar = document.getElementById('progressBar');
      const timeRemainingEl = document.getElementById('timeRemaining');
      
      const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
      if (totalHeight <= 0) return;

      const progress = (window.scrollY / totalHeight) * 100;
      if (bar) bar.style.width = `${Math.min(100, Math.max(0, progress))}%`;

      if (timeRemainingEl && totalReadingMinutes > 0) {
        const remainingPercent = (100 - progress) / 100;
        const minsLeft = Math.ceil(totalReadingMinutes * remainingPercent);
        timeRemainingEl.innerText = (progress >= 95) ? "Selesai ✨" : `Sisa ~${minsLeft} mnt`;
      }
    });

    // View 1: Katalog Utama
    async function showCatalog(filterType = 'all') {
      const app = document.getElementById('appView');
      app.innerHTML = '<p class="text-center text-xs text-gray-500 py-12">Memuat Katalog...</p>';
      document.getElementById('progressBar').style.width = '0%';

      try {
        if (!allWorksData.length) {
          const res = await fetch('/api/works');
          const json = await res.json();
          allWorksData = json.data;
        }

        let filteredWorks = allWorksData;
        if (filterType !== 'all') {
          filteredWorks = allWorksData.filter(w => w.type === filterType);
        }

        let totalViewsSum = 0;
        allWorksData.forEach(w => totalViewsSum += w.views);

        let html = `
          <!-- HERO SHOWCASE BANNER -->
          <div class="bg-gradient-to-r from-red-950/60 via-terracard to-terradark border border-red-900/40 p-6 md:p-8 rounded-3xl mb-8 relative overflow-hidden shadow-2xl">
            <div class="flex justify-between items-start mb-4">
              <span class="text-[10px] font-bold px-3 py-1 rounded-full bg-red-950 text-red-400 border border-red-800/40 uppercase tracking-widest">Unfiltered Literary Workspace</span>
              <span class="text-[11px] font-mono text-gray-400 bg-red-950/40 border border-red-900/30 px-3 py-1 rounded-full flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Writing Active</span>
              </span>
            </div>

            <h1 class="text-2xl md:text-4xl font-extrabold text-white mb-2 font-title">TERRA<span class="text-red-500">.STUDIO</span></h1>
            <p class="text-xs md:text-sm text-gray-300 leading-relaxed max-w-xl mb-6">"Setiap karya dibuat tanpa kompromi. Hanya kata-kata jujur tentang jalanan, waktu, dan apa yang tersisa di balik malam."</p>

            <!-- AUTHOR LIVE STATS STRIP -->
            <div class="grid grid-cols-3 gap-3 border-t border-red-950/80 pt-4 text-center md:text-left">
              <div>
                <span class="block text-lg font-bold text-white font-mono">${allWorksData.length}</span>
                <span class="text-[10px] text-gray-500 uppercase tracking-wider">Karya Published</span>
              </div>
              <div>
                <span class="block text-lg font-bold text-red-400 font-mono">${totalViewsSum}</span>
                <span class="text-[10px] text-gray-500 uppercase tracking-wider">Total Readers</span>
              </div>
              <div>
                <span class="block text-lg font-bold text-gray-300 font-mono">2026</span>
                <span class="text-[10px] text-gray-500 uppercase tracking-wider">Digital Era</span>
              </div>
            </div>
          </div>

          <!-- INTERACTIVE TABS FILTER -->
          <div class="flex items-center gap-2 overflow-x-auto pb-2 mb-6 no-scrollbar">
            <button onclick="playSfx('click'); showCatalog('all')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap ${filterType === 'all' ? 'bg-red-600 text-white shadow-lg shadow-red-950' : 'bg-terracard text-gray-400 border border-red-950 hover:text-white'}">
              Semua Karya
            </button>
            <button onclick="playSfx('click'); showCatalog('novel')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap ${filterType === 'novel' ? 'bg-red-600 text-white shadow-lg shadow-red-950' : 'bg-terracard text-gray-400 border border-red-950 hover:text-white'}">
              📖 Serial Novel
            </button>
            <button onclick="playSfx('click'); showCatalog('poetry')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap ${filterType === 'poetry' ? 'bg-red-600 text-white shadow-lg shadow-red-950' : 'bg-terracard text-gray-400 border border-red-950 hover:text-white'}">
              📜 Antologi Puisi
            </button>
            <button onclick="playSfx('click'); showCatalog('short_story')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap ${filterType === 'short_story' ? 'bg-red-600 text-white shadow-lg shadow-red-950' : 'bg-terracard text-gray-400 border border-red-950 hover:text-white'}">
              ⚡ Short Story
            </button>
            <button onclick="playSfx('click'); showCatalog('essay')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap ${filterType === 'essay' ? 'bg-red-600 text-white shadow-lg shadow-red-950' : 'bg-terracard text-gray-400 border border-red-950 hover:text-white'}">
              💡 Esai & Catatan
            </button>
          </div>

          <!-- KATALOG GRID -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        `;

        if (!filteredWorks.length) {
          html += `<div class="col-span-2 text-center py-12 text-gray-500 text-xs">Belum ada karya untuk kategori ini.</div>`;
        } else {
          filteredWorks.forEach(w => {
            const coverHtml = w.cover_image 
              ? `<div class="w-full h-40 rounded-xl overflow-hidden mb-3 border border-red-950/60 relative">
                   <img src="${w.cover_image}" alt="${w.title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                   <div class="absolute inset-0 bg-gradient-to-t from-terracard via-transparent to-transparent"></div>
                 </div>`
              : '';

            html += `
              <div onclick="playSfx('click'); showWorkDetail(${w.id});" class="bg-terracard border border-red-950 hover:border-red-600/60 p-5 md:p-6 rounded-2xl cursor-pointer transition-all duration-300 group shadow-lg active:scale-[0.98] flex flex-col justify-between">
                <div>
                  ${coverHtml}
                  <div class="flex justify-between items-start mb-2">
                    <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-red-950 text-red-400 border border-red-800/40 uppercase tracking-wider">${w.genre}</span>
                    <span class="text-xs text-gray-500">👁️ ${w.views} views</span>
                  </div>
                  <h3 class="text-lg md:text-xl font-bold text-white group-hover:text-red-400 transition-colors mb-2">${w.title}</h3>
                  <p class="text-xs text-gray-400 line-clamp-3 leading-relaxed mb-4">${w.synopsis}</p>
                </div>
                <div class="flex justify-between items-center text-xs text-red-500 font-bold border-t border-red-950/60 pt-3">
                  <span>${w.chapters_count} Bab Tersedia</span>
                  <span>Baca Sekarang →</span>
                </div>
              </div>
            `;
          });
        }

        html += `</div>`;
        app.innerHTML = html;
      } catch (err) {
        app.innerHTML = '<p class="text-center text-xs text-red-400">Gagal memuat katalog karya.</p>';
      }
    }

    // View 2: Detail Karya & List Bab
    async function showWorkDetail(workId) {
      const app = document.getElementById('appView');
      app.innerHTML = '<p class="text-center text-xs text-gray-500 py-12">Membuka lembaran karya...</p>';
      document.getElementById('progressBar').style.width = '0%';

      try {
        const res = await fetch(`/api/works/${workId}`);
        const json = await res.json();
        const w = json.data;

        const bannerCover = w.cover_image 
          ? `<div class="w-full h-48 md:h-64 rounded-2xl overflow-hidden mb-6 border border-red-900/40 relative">
               <img src="${w.cover_image}" alt="${w.title}" class="w-full h-full object-cover" />
               <div class="absolute inset-0 bg-gradient-to-t from-terracard via-terracard/50 to-transparent"></div>
             </div>`
          : '';

        let html = `
          <button onclick="playSfx('click'); showCatalog();" class="text-xs text-gray-400 hover:text-red-400 mb-4 md:mb-6 flex items-center gap-1 active:scale-95">← Kembali ke Katalog</button>
          
          <div class="bg-terracard border border-red-900/40 p-5 md:p-8 rounded-3xl mb-6 md:mb-8 overflow-hidden shadow-2xl">
            ${bannerCover}
            <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-red-950 text-red-400 border border-red-800/40 uppercase tracking-wider">${w.genre}</span>
            <h1 class="text-2xl md:text-3xl font-extrabold text-white mt-3 mb-3 font-title">${w.title}</h1>
            <p class="text-xs md:text-sm text-gray-300 leading-relaxed">${w.synopsis}</p>
          </div>

          <h3 class="text-base md:text-lg font-bold text-white mb-4 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-red-500"></span> Daftar Bab / Content
          </h3>
          <div class="space-y-3">
        `;

        if(w.chapters.length === 0) {
          html += `<p class="text-xs text-gray-500 py-4">Belum ada bab di buku ini.</p>`;
        } else {
          w.chapters.forEach(c => {
            html += `
              <div onclick="playSfx('click'); readChapter(${c.id});" class="p-4 bg-terracard hover:bg-red-950/30 border border-red-950 hover:border-red-600/40 rounded-xl cursor-pointer flex justify-between items-center transition-all active:scale-[0.98]">
                <div>
                  <h4 class="font-bold text-white text-sm">${c.title}</h4>
                  <p class="text-[11px] text-gray-500 mt-0.5">⏱️ ${c.reading_time_minutes} min read • ❤️ ${c.likes} likes</p>
                </div>
                <span class="text-xs text-red-400 font-bold">Baca →</span>
              </div>
            `;
          });
        }

        html += `</div>`;
        app.innerHTML = html;
      } catch (err) {
        app.innerHTML = '<p class="text-center text-xs text-red-400">Gagal memuat detail karya.</p>';
      }
    }

    // View 3: Reader Mode
    async function readChapter(chapId) {
      currentChapterId = chapId;
      const app = document.getElementById('appView');
      app.innerHTML = '<p class="text-center text-xs text-gray-500 py-12">Memuat naskah...</p>';

      try {
        const res = await fetch(`/api/chapters/${chapId}`);
        const json = await res.json();
        const c = json.data;
        totalReadingMinutes = c.reading_time_minutes || 3;

        let html = `
          <div class="flex flex-col sm:flex-row gap-3 sm:items-center justify-between mb-6">
            <button onclick="playSfx('click'); showWorkDetail(${c.work_id});" class="text-xs text-gray-400 hover:text-red-400 flex items-center gap-1 active:scale-95">← Daftar Bab</button>
            
            <div class="flex items-center justify-between sm:justify-end gap-2">
              <span id="timeRemaining" class="text-[10px] font-mono text-red-400/80 bg-red-950/60 border border-red-900/40 px-2.5 py-1 rounded-full">Sisa ~${totalReadingMinutes} mnt</span>

              <button onclick="toggleBookmark(${c.id}, '${c.title.replace(/'/g, "\\'")}')" class="text-xs bg-red-950 hover:bg-red-900 text-red-300 border border-red-800/40 px-3 py-1 rounded-full font-bold transition-all active:scale-95">
                🔖 Bookmark
              </button>

              <div class="flex items-center gap-1.5 bg-terracard border border-red-900/50 px-2.5 py-1 rounded-full text-xs">
                <button onclick="playSfx('click'); changeFontSize('small');" class="hover:text-red-400 text-[10px] font-bold px-1">A-</button>
                <button onclick="playSfx('click'); changeFontSize('large');" class="hover:text-red-400 text-xs font-bold px-1">A+</button>
                <span class="text-red-950">|</span>
                <button onclick="playSfx('click'); changeFontFamily('font-serif-read');" class="hover:text-red-400 px-1 font-serif text-[10px]">Serif</button>
                <button onclick="playSfx('click'); changeFontFamily('font-sans-read');" class="hover:text-red-400 px-1 font-sans text-[10px]">Sans</button>
                <span class="text-red-950">|</span>
                <button onclick="playSfx('click'); changeTheme('theme-puredark');" class="w-3 h-3 rounded-full bg-gray-900 border border-gray-600"></button>
                <button onclick="playSfx('click'); changeTheme('theme-crimson');" class="w-3 h-3 rounded-full bg-[#26050b] border border-red-500"></button>
              </div>
            </div>
          </div>

          <article id="readerBox" class="${readerTheme} border border-red-950/80 p-5 md:p-12 rounded-3xl mb-8 shadow-2xl transition-all duration-300">
            <header class="border-b border-red-950/50 pb-6 mb-8 text-center">
              <p class="text-xs text-red-500 font-mono mb-2">${c.work.title}</p>
              <h1 class="text-xl md:text-3xl font-extrabold mb-3">${c.title}</h1>
              <div class="flex items-center justify-center gap-4 text-xs opacity-70">
                <span>⏱️ ${c.reading_time_minutes} min read</span>
                <button onclick="likeCurrentChapter()" class="text-red-400 hover:scale-110 transition-transform font-bold flex items-center gap-1">
                  ❤️ <span id="likeCount">${c.likes}</span> Likes
                </button>
              </div>
            </header>

            <div id="readerContent" class="${readerFont} ${readerSize} leading-relaxed space-y-6 whitespace-pre-line">
              ${c.content}
            </div>
          </article>

          <section class="bg-terracard border border-red-950 p-5 md:p-6 rounded-2xl">
            <h3 class="text-base md:text-lg font-bold text-white mb-4">Respon & Jejak Pembaca</h3>

            <form onsubmit="submitComment(event)" class="mb-6 space-y-3">
              <input type="text" id="comUser" placeholder="Nama / Nickname kamu..." required class="w-full bg-terradark border border-red-900/40 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-red-500" />
              <textarea id="comText" placeholder="Tinggalkan jejak apresiasi atau pendapatmu..." required rows="2" class="w-full bg-terradark border border-red-900/40 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-red-500"></textarea>
              <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-bold text-xs px-6 py-2.5 rounded-xl transition-all active:scale-95 shadow-lg shadow-red-950">Kirim Tanggapan 🚀</button>
            </form>

            <div id="commentList" class="space-y-3 border-t border-red-950 pt-4">
        `;

        if(c.comments.length === 0) {
          html += `<p class="text-xs text-gray-500 text-center py-2">Belum ada komentar di bab ini.</p>`;
        } else {
          c.comments.forEach(cm => {
            html += `
              <div class="p-3 bg-terradark rounded-xl border border-red-950">
                <div class="flex justify-between items-center mb-1">
                  <span class="font-bold text-xs text-red-400">${cm.username}</span>
                  <span class="text-[9px] text-gray-600">${new Date(cm.created_at).toLocaleDateString('id-ID')}</span>
                </div>
                <p class="text-xs text-gray-300">${cm.comment}</p>
              </div>
            `;
          });
        }

        html += `</div></section>`;
        app.innerHTML = html;
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } catch (err) {
        app.innerHTML = '<p class="text-center text-xs text-red-400">Gagal memuat halaman baca.</p>';
      }
    }

    // Customizer
    function changeFontSize(action) {
      const content = document.getElementById('readerContent');
      if (!content) return;
      readerSize = (action === 'small') ? 'text-sm md:text-base' : 'text-lg md:text-xl';
      content.className = `${readerFont} ${readerSize} leading-relaxed space-y-6 whitespace-pre-line`;
    }

    function changeFontFamily(fontClass) {
      const content = document.getElementById('readerContent');
      if (!content) return;
      readerFont = fontClass;
      content.className = `${readerFont} ${readerSize} leading-relaxed space-y-6 whitespace-pre-line`;
    }

    function changeTheme(themeClass) {
      const box = document.getElementById('readerBox');
      if (!box) return;
      readerTheme = themeClass;
      box.className = `${readerTheme} border border-red-950/80 p-5 md:p-12 rounded-3xl mb-8 shadow-2xl transition-all duration-300`;
    }

    // Notes Logic
    function openNotesModal() {
      document.getElementById('notesModal').classList.remove('hidden');
      document.getElementById('authorNotesArea').value = localStorage.getItem('terra_author_notes') || '';
    }
    function closeNotesModal() { document.getElementById('notesModal').classList.add('hidden'); }
    function saveAuthorNotes() {
      localStorage.setItem('terra_author_notes', document.getElementById('authorNotesArea').value);
      showToast("📝 Author note berhasil disimpan!");
      closeNotesModal();
    }

    // Bookmark Logic
    function toggleBookmark(id, title) {
      let bms = JSON.parse(localStorage.getItem('terra_bookmarks') || '[]');
      const existIndex = bms.findIndex(b => b.id === id);

      if (existIndex > -1) {
        bms.splice(existIndex, 1);
        showToast("🔖 Bookmark dihapus!");
      } else {
        bms.push({ id, title });
        showToast("🔖 Bab berhasil ditandai ke Bookmark!");
      }
      localStorage.setItem('terra_bookmarks', JSON.stringify(bms));
      renderBookmarksSidebar();
    }

    function renderBookmarksSidebar() {
      const list = document.getElementById('bookmarkList');
      let bms = JSON.parse(localStorage.getItem('terra_bookmarks') || '[]');

      if (!bms.length) {
        list.innerHTML = '<p class="text-[11px] text-gray-500 italic">Belum ada bab yang ditandai.</p>';
        return;
      }

      let html = '';
      bms.forEach(b => {
        html += `
          <div onclick="readChapter(${b.id}); toggleSidebar();" class="p-2.5 bg-terradark hover:bg-red-950/40 rounded-xl border border-red-950 text-xs text-gray-300 cursor-pointer transition-all flex items-center justify-between">
            <span class="truncate pr-2">${b.title}</span>
            <span class="text-red-500 font-bold">→</span>
          </div>
        `;
      });
      list.innerHTML = html;
    }

    function clearAllBookmarks() {
      localStorage.removeItem('terra_bookmarks');
      renderBookmarksSidebar();
      showToast("Semua bookmark dibersihkan.");
    }

    // Like System
    async function likeCurrentChapter() {
      if(!currentChapterId) return;

      const storageKey = `terra_like_chap_${currentChapterId}`;
      const lastLikeTime = localStorage.getItem(storageKey);
      const currentTime = Math.floor(Date.now() / 1000);
      const cooldown = 3600;

      if (lastLikeTime && (currentTime - lastLikeTime) < cooldown) {
        const minutesLeft = Math.ceil((cooldown - (currentTime - lastLikeTime)) / 60);
        showToast(`⏳ Kamu sudah menyukai bab ini! Coba lagi dalam ${minutesLeft} menit.`);
        return;
      }

      playSfx('like');
      try {
        const res = await fetch(`/api/chapters/${currentChapterId}/like`, { method: 'POST' });
        const json = await res.json();
        if(json.status === 'success') {
          document.getElementById('likeCount').innerText = json.likes;
          localStorage.setItem(storageKey, currentTime);
          showToast("❤️ " + json.message);
        }
      } catch(e) {
        showToast("Gagal memberikan Like.");
      }
    }

    // Submit Komentar
    async function submitComment(e) {
      e.preventDefault();
      const username = document.getElementById('comUser').value;
      const comment = document.getElementById('comText').value;

      try {
        const res = await fetch(`/api/chapters/${currentChapterId}/comments`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ username, comment })
        });
        const json = await res.json();
        if(json.status === 'success') {
          showToast("💬 Komentar berhasil dikirim!");
          readChapter(currentChapterId);
        }
      } catch(e) {
        showToast("Gagal mengirim komentar.");
      }
    }

    function openSettingsModal() { document.getElementById('settingsModal').classList.remove('hidden'); }
    function closeSettingsModal() { document.getElementById('settingsModal').classList.add('hidden'); }

    document.addEventListener('DOMContentLoaded', () => {
      triggerSplashScreen();
      showCatalog();
      renderBookmarksSidebar();
    });
  </script>
</body>
</html>