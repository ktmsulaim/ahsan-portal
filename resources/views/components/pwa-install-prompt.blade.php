@php
    $storageKey = 'ahsan_pwa_install';
    $dismissDays = 7;
@endphp
<div id="pwa-install-banner" class="pwa-install-banner" style="display: none;">
    <div class="pwa-install-banner__inner">
        <div class="pwa-install-banner__content">
            <span class="pwa-install-banner__icon" aria-hidden="true">📱</span>
            <div>
                <strong id="pwa-install-title">Install Ahsan Portal</strong>
                <span id="pwa-install-desc">Add to your home screen for quick access.</span>
            </div>
        </div>
        <div class="pwa-install-banner__actions">
            <button type="button" id="pwa-install-btn" class="pwa-install-banner__btn pwa-install-banner__btn--primary">Install</button>
            <button type="button" id="pwa-install-dismiss" class="pwa-install-banner__btn pwa-install-banner__btn--secondary">Not now</button>
        </div>
    </div>
</div>

<style>
.pwa-install-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 9999;
    padding: 12px 16px;
    padding-bottom: max(12px, env(safe-area-inset-bottom));
    background: #343a40;
    color: #fff;
    box-shadow: 0 -2px 12px rgba(0,0,0,0.15);
    font-size: 14px;
}
.pwa-install-banner__inner {
    max-width: 480px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}
.pwa-install-banner__content {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    min-width: 0;
}
.pwa-install-banner__icon { font-size: 1.5rem; }
.pwa-install-banner__content strong { display: block; }
.pwa-install-banner__content span { opacity: 0.9; font-size: 13px; }
.pwa-install-banner__actions { display: flex; gap: 8px; flex-shrink: 0; }
.pwa-install-banner__btn {
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    font-weight: 500;
}
.pwa-install-banner__btn--primary { background: #fff; color: #343a40; }
.pwa-install-banner__btn--secondary { background: transparent; color: rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.4); }
</style>

<script>
(function() {
    var storageKey = '{{ $storageKey }}';
    var dismissDays = {{ $dismissDays }};

    function isStandalone() {
        return window.matchMedia('(display-mode: standalone)').matches
            || window.navigator.standalone === true
            || document.referrer.includes('android-app://');
    }

    function wasDismissed() {
        try {
            var raw = localStorage.getItem(storageKey);
            if (!raw) return false;
            var data = JSON.parse(raw);
            if (data.installed) return true;
            if (data.dismissedAt && (Date.now() - data.dismissedAt) < dismissDays * 24 * 60 * 60 * 1000) return true;
        } catch (e) {}
        return false;
    }

    function setDismissed() {
        try {
            localStorage.setItem(storageKey, JSON.stringify({ dismissedAt: Date.now() }));
        } catch (e) {}
    }

    function setInstalled() {
        try {
            localStorage.setItem(storageKey, JSON.stringify({ installed: true }));
        } catch (e) {}
    }

    var banner = document.getElementById('pwa-install-banner');
    var titleEl = document.getElementById('pwa-install-title');
    var descEl = document.getElementById('pwa-install-desc');
    var installBtn = document.getElementById('pwa-install-btn');
    var dismissBtn = document.getElementById('pwa-install-dismiss');

    if (!banner || isStandalone() || wasDismissed()) return;

    var isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);
    var deferredPrompt = null;

    function showBanner() {
        banner.style.display = 'block';
    }

    function hideBanner() {
        banner.style.display = 'none';
    }

    if (isIOS) {
        titleEl.textContent = 'Add Ahsan to Home Screen';
        descEl.textContent = 'Tap Share \u2191 then "Add to Home Screen".';
        installBtn.textContent = 'Got it';
        installBtn.addEventListener('click', function() {
            setDismissed();
            hideBanner();
        });
    } else {
        window.addEventListener('beforeinstallprompt', function(e) {
            e.preventDefault();
            deferredPrompt = e;
            showBanner();
        });

        installBtn.addEventListener('click', function() {
            if (!deferredPrompt) return;
            deferredPrompt.prompt();
            deferredPrompt.userChoice.then(function(choice) {
                if (choice.outcome === 'accepted') setInstalled();
                deferredPrompt = null;
                hideBanner();
            });
        });
    }

    dismissBtn.addEventListener('click', function() {
        setDismissed();
        hideBanner();
    });

    if (isIOS) {
        showBanner();
    }
})();
</script>
