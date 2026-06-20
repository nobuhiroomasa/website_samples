const siteHeader = document.querySelector('[data-site-header]');
const loader = document.getElementById('site-loader');
const mobilePanel = document.querySelector('[data-mobile-nav-panel]');
const mobileBackdrop = document.querySelector('[data-mobile-nav-backdrop]');
const mobileToggle = document.querySelector('[data-mobile-nav-toggle]');
const mobileClose = document.querySelector('[data-mobile-nav-close]');

const setHeaderState = () => {
    if (!siteHeader) {
        return;
    }

    const isHome = document.body.dataset.page === 'home';

    if (!isHome) {
        siteHeader.classList.add('is-solid');
        return;
    }

    siteHeader.classList.toggle('is-solid', window.scrollY > 24);
};

const setMobileMenu = (open) => {
    if (!mobilePanel || !mobileToggle) {
        return;
    }

    mobilePanel.hidden = !open;
    if (mobileBackdrop) {
        mobileBackdrop.hidden = true;
    }
    document.body.classList.toggle('overflow-hidden', open);
    mobileToggle.setAttribute('aria-expanded', String(open));
};

window.setShukufukuMobileMenu = setMobileMenu;

const initLoader = () => {
    if (!loader) {
        return;
    }

    window.setTimeout(() => {
        loader.classList.add('is-hidden');
    }, 900);
};

const initReveal = () => {
    const targets = document.querySelectorAll('[data-reveal]');

    if (!targets.length) {
        return;
    }

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        targets.forEach((target) => {
            target.classList.add('section-reveal', 'is-visible');
        });

        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            const delay = entry.target.dataset.revealDelay ?? entry.target.dataset.revealAutoDelay ?? '0';
            entry.target.style.transitionDelay = `${delay}ms`;
            entry.target.classList.add('section-reveal', 'is-visible');
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.16, rootMargin: '0px 0px -56px 0px' });

    targets.forEach((target) => {
        if (!target.dataset.revealDelay && target.matches('.public-panel, .room-card, .gallery-card')) {
            const siblings = [...target.parentElement.querySelectorAll('[data-reveal]')];
            const index = siblings.indexOf(target);
            target.dataset.revealAutoDelay = String(Math.min(index * 90, 360));
        }

        target.classList.add('section-reveal');
        observer.observe(target);
    });
};

const initGalleryFilter = () => {
    const filters = document.querySelectorAll('[data-gallery-filter]');
    const items = document.querySelectorAll('[data-gallery-item]');

    if (!filters.length || !items.length) {
        return;
    }

    filters.forEach((filter) => {
        filter.addEventListener('click', () => {
            const category = filter.dataset.galleryFilter;

            filters.forEach((button) => button.classList.toggle('is-active', button === filter));

            items.forEach((item) => {
                const shouldShow = category === 'all' || item.dataset.galleryItem === category;
                item.classList.toggle('is-hidden', !shouldShow);
            });
        });
    });
};

const initGalleryModal = () => {
    const modal = document.querySelector('[data-gallery-modal]');
    const modalImage = document.querySelector('[data-gallery-modal-image]');
    const modalCategory = document.querySelector('[data-gallery-modal-category]');
    const modalDescription = document.querySelector('[data-gallery-modal-description]');

    if (!modal || !modalImage || !modalCategory || !modalDescription) {
        return;
    }

    const close = () => {
        modal.hidden = true;
        document.body.classList.remove('overflow-hidden');
    };

    document.querySelectorAll('[data-gallery-open]').forEach((button) => {
        button.addEventListener('click', () => {
            modalImage.src = button.dataset.galleryImage ?? '';
            modalImage.alt = button.dataset.galleryDescription ?? '';
            modalCategory.textContent = button.dataset.galleryCategory ?? '';
            modalDescription.textContent = button.dataset.galleryDescription ?? '';
            modal.hidden = false;
            document.body.classList.add('overflow-hidden');
        });
    });

    modal.addEventListener('click', (event) => {
        if (event.target instanceof HTMLElement && event.target.closest('[data-gallery-modal-close]')) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.hidden) {
            close();
        }
    });
};

window.addEventListener('scroll', setHeaderState, { passive: true });
window.addEventListener('load', () => {
    setHeaderState();
    initLoader();
    initReveal();
    initGalleryFilter();
    initGalleryModal();
});

mobileToggle?.addEventListener('click', () => setMobileMenu(true));
mobileClose?.addEventListener('click', () => setMobileMenu(false));
mobileBackdrop?.addEventListener('click', () => setMobileMenu(false));

setHeaderState();
