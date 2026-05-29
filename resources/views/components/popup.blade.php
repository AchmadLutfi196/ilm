@php
    use App\Models\WebSetting;
    $popupActive = (bool) WebSetting::get('popup_active', '0');
    $popupImage  = WebSetting::get('popup_image');
    $popupLink   = WebSetting::get('popup_link');
    $popupUrl    = $popupImage ? \Illuminate\Support\Facades\Storage::url($popupImage) : null;
@endphp

@if($popupActive && $popupUrl)
{{-- Popup Overlay --}}
<div id="site-popup" class="fixed inset-0 z-[9999] flex items-center justify-center p-6" style="background:rgba(0,0,0,0.7);backdrop-filter:blur(6px);">

    {{-- Popup Card --}}
    <div class="relative animate-popup" style="max-width:480px;width:100%;max-height:90vh;">

        {{-- ✕ Close Button — fixed di pojok kanan atas, ukuran besar dan kontras --}}
        <button
            onclick="closePopup()"
            aria-label="Tutup popup"
            style="position:absolute;top:-16px;right:-16px;z-index:10;
                   width:40px;height:40px;border-radius:50%;
                   background:#fff;border:none;cursor:pointer;
                   display:flex;align-items:center;justify-content:center;
                   box-shadow:0 4px 16px rgba(0,0,0,0.3);
                   transition:transform 0.15s,background 0.15s;"
            onmouseover="this.style.background='#fee2e2';this.style.transform='scale(1.15)'"
            onmouseout="this.style.background='#fff';this.style.transform='scale(1)'"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                 fill="none" stroke="#111" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>

        {{-- Popup Image — dibatasi tinggi agar tidak memenuhi layar --}}
        @if($popupLink)
        <a href="{{ $popupLink }}" target="_blank" rel="noopener noreferrer" onclick="closePopup()">
            <img
                src="{{ $popupUrl }}"
                alt="Popup"
                style="width:100%;max-height:80vh;object-fit:contain;border-radius:16px;box-shadow:0 25px 60px rgba(0,0,0,0.5);display:block;"
                loading="eager"
            >
        </a>
        @else
        <img
            src="{{ $popupUrl }}"
            alt="Popup"
            style="width:100%;max-height:80vh;object-fit:contain;border-radius:16px;box-shadow:0 25px 60px rgba(0,0,0,0.5);display:block;"
            loading="eager"
        >
        @endif
    </div>
</div>

<script>
    (function () {
        var POPUP_KEY = 'ilm_popup_seen';

        // Jika sudah pernah muncul di sesi ini, langsung hapus
        if (sessionStorage.getItem(POPUP_KEY)) {
            var el = document.getElementById('site-popup');
            if (el) el.remove();
            return;
        }

        // Tandai sudah tampil di sesi ini
        sessionStorage.setItem(POPUP_KEY, '1');

        // Klik di luar area gambar (overlay) = tutup
        document.getElementById('site-popup').addEventListener('click', function (e) {
            if (e.target === this) closePopup();
        });
    })();

    function closePopup() {
        var el = document.getElementById('site-popup');
        if (!el) return;
        el.style.transition = 'opacity 0.25s ease';
        el.style.opacity = '0';
        setTimeout(function () { el.remove(); }, 260);
    }
</script>

<style>
    @keyframes popupIn {
        from { opacity: 0; transform: scale(0.85) translateY(24px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-popup {
        animation: popupIn 0.3s cubic-bezier(0.34, 1.4, 0.64, 1) both;
    }
</style>
@endif
