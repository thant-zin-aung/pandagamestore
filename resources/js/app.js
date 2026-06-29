import './bootstrap';

const menuToggle = document.querySelector('[data-menu-toggle]');
const mobileMenu = document.querySelector('#mobileMenu');
const filterToggles = document.querySelectorAll('[data-filter-toggle]');
const filterPanel = document.querySelector('[data-filter-panel]');
const filterClose = document.querySelector('[data-filter-close]');
const categoryButtons = document.querySelectorAll('[data-category-filter]');
const regionSelect = document.querySelector('[data-region-select]');
const regionButtons = document.querySelectorAll('[data-region]');
const productCards = document.querySelectorAll('[data-name]');
const orderName = document.querySelector('[data-order-name]');
const orderPrice = document.querySelector('[data-order-price]');

let activeCategory = 'all';
let activeRegion = 'all';

function setMenuState(isOpen) {
    if (!mobileMenu || !menuToggle) return;

    mobileMenu.classList.toggle('is-open', isOpen);
    menuToggle.setAttribute('aria-expanded', String(isOpen));
}

function setFilterState(isOpen) {
    if (!filterPanel) return;

    filterPanel.classList.toggle('is-open', isOpen);
}

function filterProducts() {
    productCards.forEach((card) => {
        const matchesCategory = activeCategory === 'all' || card.dataset.category === activeCategory;
        const regions = card.dataset.regions?.split(' ') ?? [];
        const matchesRegion = activeRegion === 'all' || regions.includes(activeRegion);

        card.classList.toggle('is-hidden', !(matchesCategory && matchesRegion));
    });
}

menuToggle?.addEventListener('click', () => {
    setMenuState(!mobileMenu?.classList.contains('is-open'));
});

mobileMenu?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => setMenuState(false));
});

filterToggles.forEach((button) => {
    button.addEventListener('click', () => {
        setFilterState(!filterPanel?.classList.contains('is-open'));
    });
});

filterClose?.addEventListener('click', () => setFilterState(false));

categoryButtons.forEach((button) => {
    button.addEventListener('click', () => {
        activeCategory = button.dataset.categoryFilter;
        categoryButtons.forEach((item) => item.classList.toggle('active', item === button));
        filterProducts();
    });
});

regionSelect?.addEventListener('change', (event) => {
    activeRegion = event.target.value;
    regionButtons.forEach((button) => button.classList.toggle('active', button.dataset.region === activeRegion));
    filterProducts();
});

regionButtons.forEach((button) => {
    button.addEventListener('click', () => {
        activeRegion = button.dataset.region;

        if (regionSelect) {
            regionSelect.value = activeRegion;
        }

        regionButtons.forEach((item) => item.classList.toggle('active', item === button));
        filterProducts();
    });
});

document.querySelectorAll('[data-add-product]').forEach((button) => {
    button.addEventListener('click', () => {
        const product = button.closest('[data-name]');

        if (!product || !orderName || !orderPrice) return;

        orderName.textContent = product.dataset.name;
        orderPrice.textContent = `$${Number(product.dataset.price).toFixed(2)}`;
    });
});
