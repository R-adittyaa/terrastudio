<!DOCTYPE html>
<html lang="id" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TerraStudio — Writer Workspace ✍️</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            terradark: '#0a0304',
            terracard: '#18070a',
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&family=Merriweather:ital,wght@0,300;0,400;1,300&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0304; }
    .font-serif-read { font-family: 'Merriweather', serif; }
    .font-title { font-family: 'Cinzel', serif; }
  </style>
</head>
<body class="text-gray-200 antialiased min-h-screen flex flex-col justify-between selection:bg-red-600 selection:text-white">

  <!-- Header Admin -->
  <header class="max-w-5xl mx-auto w-full px-6 py-6 flex items-center justify-between border-b border-red-950/60">
    <div class="flex items-center gap-3">
      <div class="w-3 h-3 rounded-full bg-red-600 animate-ping"></div>
      <span class="font-title text-xl tracking-widest text-white">TERRA<span class="text-red-500">.WORKSPACE</span></span>
    </div>
    <a href="/" target="_blank" class="text-xs bg-red-950 hover:bg-red-900 border border-red-800/60 text-red-300 font-bold px-4 py-2 rounded-full transition-all flex items-center gap-1">
      👁️ Lihat Web Live ↗
    </a>
  </header>

  <!-- Main Workspace -->
  <main class="max-w-3xl mx-auto w-full px-6 py-8 flex-1">
    
    <div class="bg-terracard border border-red-700/40 w-full rounded-3xl p-6 md:p-8 relative shadow-2xl">
      <div class="flex gap-6 border-b border-red-950 pb-4 mb-6">
        <button onclick="switchTab('newWork')" id="tabWorkBtn" class="text-sm font-bold text-red-400 border-b-2 border-red-500 pb-1">+ Terbitkan Buku Baru</button>
        <button onclick="switchTab('newChapter')" id="tabChapBtn" class="text-sm font-bold text-gray-500 pb-1">+ Tulis Bab / Chapter Baru</button>
      </div>

      <!-- Form 1: Karya Baru -->
      <form id="formNewWork" onsubmit="submitNewWork(event)" class="space-y-4">
        <div>
          <label class="block text-xs font-bold text-gray-400 mb-1">Judul Karya / Buku</label>
          <input type="text" id="wTitle" placeholder="Misal: Pedang Dan Janji Di Atas Bukit" required class="w-full bg-terradark border border-red-900/40 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-red-500" />
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-gray-400 mb-1">Kategori / Tipe</label>
            <select id="wType" class="w-full bg-terradark border border-red-900/40 rounded-xl px-3 py-3 text-xs text-white focus:outline-none focus:border-red-500">
              <option value="novel">Novel / Serial</option>
              <option value="poetry">Antologi Puisi</option>
              <option value="short_story">Cerita Pendek</option>
              <option value="essay">Esai / Catatan</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-bold text-gray-400 mb-1">Genre</label>
            <input type="text" id="wGenre" placeholder="Misal: Martial Arts, Slice of Life" required class="w-full bg-terradark border border-red-900/40 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-red-500" />
          </div>
        </div>
        <div>
          <label class="block text-xs font-bold text-gray-400 mb-1">URL Gambar Sampul / Ilustrasi (Opsional)</label>
          <input type="url" id="wCover" placeholder="https://images.unsplash.com/... (atau biarkan kosong)" class="w-full bg-terradark border border-red-900/40 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-red-500" />
        </div>
        <div>
          <label class="block text-xs font-bold text-gray-400 mb-1">Sinopsis Karya</label>
          <textarea id="wSynopsis" rows="4" placeholder="Gambarkan gambaran besar dari ceritamu..." required class="w-full bg-terradark border border-red-900/40 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-red-500 leading-relaxed"></textarea>
        </div>
        <button type="submit" class="w-full bg-red-600 hover:bg-red-500 text-white font-bold text-xs py-3.5 rounded-xl transition-all shadow-lg shadow-red-950">Terbitkan Buku Baru 🚀</button>
      </form>

      <!-- Form 2: Bab Baru -->
      <form id="formNewChapter" onsubmit="submitNewChapter(event)" class="space-y-4 hidden">
        <div>
          <label class="block text-xs font-bold text-gray-400 mb-1">Pilih Karya / Buku</label>
          <select id="cWorkId" required class="w-full bg-terradark border border-red-900/40 rounded-xl px-3 py-3 text-xs text-white focus:outline-none focus:border-red-500">
            <option value="">-- Loading daftar karya --</option>
          </select>
        </div>
        <div class="grid grid-cols-3 gap-4">
          <div class="col-span-2">
            <label class="block text-xs font-bold text-gray-400 mb-1">Judul Bab</label>
            <input type="text" id="cTitle" placeholder="Bab 2: Bayangan Di Ujung Lorong" required class="w-full bg-terradark border border-red-900/40 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-red-500" />
          </div>
          <div>
            <label class="block text-xs font-bold text-gray-400 mb-1">Nomor Bab</label>
            <input type="number" id="cNum" value="1" min="1" required class="w-full bg-terradark border border-red-900/40 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-red-500" />
          </div>
        </div>
        <div>
          <label class="block text-xs font-bold text-gray-400 mb-1">Isi Naskah Cerita / Bab (Teks Lengkap)</label>
          <textarea id="cContent" rows="12" placeholder="Tuliskan naskah/ceritamu di sini..." required class="w-full bg-terradark border border-red-900/40 rounded-xl px-4 py-3 text-xs text-white font-serif-read focus:outline-none focus:border-red-500 leading-relaxed"></textarea>
        </div>
        <button type="submit" class="w-full bg-red-600 hover:bg-red-500 text-white font-bold text-xs py-3.5 rounded-xl transition-all shadow-lg shadow-red-950">Publish Bab Baru 🚀</button>
      </form>

    </div>
  </main>

  <footer class="text-center py-6 border-t border-red-950/60 text-gray-500 text-xs">
    <p class="tracking-wide">TERRASTUDIO &copy; 2026 — <span class="text-red-500 font-semibold">Private Writer Suite</span></p>
  </footer>

  <script>
    async function loadWorksDropdown() {
      const select = document.getElementById('cWorkId');
      try {
        const res = await fetch('/api/works');
        const json = await res.json();
        const works = json.data;

        if(!works.length) {
          select.innerHTML = '<option value="">-- Belum ada karya --</option>';
          return;
        }

        let opts = '<option value="">-- Pilih Buku / Karya --</option>';
        works.forEach(w => {
          opts += `<option value="${w.id}">${w.title} (${w.genre})</option>`;
        });
        select.innerHTML = opts;
      } catch(e) {
        select.innerHTML = '<option value="">-- Gagal memuat karya --</option>';
      }
    }

    function switchTab(tab) {
      const formWork = document.getElementById('formNewWork');
      const formChap = document.getElementById('formNewChapter');
      const btnWork = document.getElementById('tabWorkBtn');
      const btnChap = document.getElementById('tabChapBtn');

      if(tab === 'newWork') {
        formWork.classList.remove('hidden');
        formChap.classList.add('hidden');
        btnWork.className = "text-sm font-bold text-red-400 border-b-2 border-red-500 pb-1";
        btnChap.className = "text-sm font-bold text-gray-500 pb-1";
      } else {
        formWork.classList.add('hidden');
        formChap.classList.remove('hidden');
        btnChap.className = "text-sm font-bold text-red-400 border-b-2 border-red-500 pb-1";
        btnWork.className = "text-sm font-bold text-gray-500 pb-1";
        loadWorksDropdown();
      }
    }

    async function submitNewWork(e) {
      e.preventDefault();
      const data = {
        title: document.getElementById('wTitle').value,
        type: document.getElementById('wType').value,
        genre: document.getElementById('wGenre').value,
        cover_image: document.getElementById('wCover').value || null,
        synopsis: document.getElementById('wSynopsis').value,
      };

      try {
        const res = await fetch('/api/works', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        });
        const json = await res.json();
        if(json.status === 'success') {
          alert("Buku baru berhasil diterbitkan! 🎉");
          location.reload();
        }
      } catch(err) {
        alert("Gagal menerbitkan buku.");
      }
    }

    async function submitNewChapter(e) {
      e.preventDefault();
      const data = {
        work_id: document.getElementById('cWorkId').value,
        title: document.getElementById('cTitle').value,
        chapter_number: document.getElementById('cNum').value,
        content: document.getElementById('cContent').value,
      };

      try {
        const res = await fetch('/api/chapters', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        });
        const json = await res.json();
        if(json.status === 'success') {
          alert("Bab baru berhasil dirilis! 🚀");
          location.reload();
        }
      } catch(err) {
        alert("Gagal merilis bab.");
      }
    }
  </script>
</body>
</html>