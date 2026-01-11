/**
 * Location Premium - Modern UI/UX JavaScript
 * Interactions et animations avancées
 */

// Configuration
const CONFIG = {
    animationDuration: 300,
    toastDuration: 5000,
    searchDebounce: 300
};

// Utilitaires
const Utils = {
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },
    
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    },
    
    formatPrice(price) {
        return new Intl.NumberFormat('fr-FR').format(price) + ' FCFA';
    },
    
    formatDate(date) {
        return new Intl.DateTimeFormat('fr-FR').format(new Date(date));
    }
};

// Toast Notifications
class Toast {
    static show(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type} fade-in`;
        toast.innerHTML = `
            <div style="display: flex; align-items: center; gap: 1rem;">
                <i class="fas fa-${this.getIcon(type)}"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => toast.remove(), 300);
        }, CONFIG.toastDuration);
    }
    
    static getIcon(type) {
        const icons = {
            success: 'check-circle',
            error: 'exclamation-circle',
            warning: 'exclamation-triangle',
            info: 'info-circle'
        };
        return icons[type] || 'info-circle';
    }
}

// Loader
class Loader {
    static show() {
        const loader = document.createElement('div');
        loader.className = 'loader-overlay';
        loader.innerHTML = '<div class="loader"></div>';
        loader.id = 'app-loader';
        document.body.appendChild(loader);
    }
    
    static hide() {
        const loader = document.getElementById('app-loader');
        if (loader) loader.remove();
    }
}

// Navbar Scroll Effect
class NavbarScroll {
    constructor() {
        this.navbar = document.querySelector('.navbar');
        if (this.navbar) {
            window.addEventListener('scroll', Utils.throttle(() => this.handleScroll(), 100));
        }
    }
    
    handleScroll() {
        if (window.scrollY > 50) {
            this.navbar.classList.add('scrolled');
        } else {
            this.navbar.classList.remove('scrolled');
        }
    }
}

// Search with Suggestions
class SearchBar {
    constructor(inputSelector) {
        this.input = document.querySelector(inputSelector);
        if (this.input) {
            this.init();
        }
    }
    
    init() {
        this.input.addEventListener('input', Utils.debounce((e) => {
            this.handleSearch(e.target.value);
        }, CONFIG.searchDebounce));
    }
    
    handleSearch(query) {
        if (query.length < 2) return;
        console.log('Searching for:', query);
    }
}

// Intersection Observer for Animations
class AnimateOnScroll {
    constructor() {
        this.observer = new IntersectionObserver(
            (entries) => this.handleIntersection(entries),
            { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
        );
        this.observe();
    }
    
    observe() {
        document.querySelectorAll('.card, .category-card, .product-card').forEach(el => {
            this.observer.observe(el);
        });
    }
    
    handleIntersection(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('slide-up');
                this.observer.unobserve(entry.target);
            }
        });
    }
}

// Image Lazy Loading
class LazyImages {
    constructor() {
        if ('IntersectionObserver' in window) {
            this.observer = new IntersectionObserver(
                (entries) => this.handleIntersection(entries)
            );
            this.observe();
        }
    }
    
    observe() {
        document.querySelectorAll('img[data-src]').forEach(img => {
            this.observer.observe(img);
        });
    }
    
    handleIntersection(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                this.observer.unobserve(img);
            }
        });
    }
}

// Cart Management
class Cart {
    constructor() {
        this.items = JSON.parse(localStorage.getItem('cart') || '[]');
        this.updateCounter();
    }
    
    add(item) {
        this.items.push(item);
        this.save();
        this.updateCounter();
        Toast.show('Article ajouté au panier', 'success');
    }
    
    remove(itemId) {
        this.items = this.items.filter(item => item.id !== itemId);
        this.save();
        this.updateCounter();
        Toast.show('Article retiré du panier', 'info');
    }
    
    clear() {
        this.items = [];
        this.save();
        this.updateCounter();
    }
    
    save() {
        localStorage.setItem('cart', JSON.stringify(this.items));
    }
    
    updateCounter() {
        const counter = document.querySelector('.cart-counter');
        if (counter) {
            counter.textContent = this.items.length;
            counter.style.display = this.items.length > 0 ? 'flex' : 'none';
        }
    }
    
    getTotal() {
        return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    }
}

// Form Validation
class FormValidator {
    constructor(formSelector) {
        this.form = typeof formSelector === 'string' ? document.querySelector(formSelector) : formSelector;
        if (this.form) {
            this.init();
        }
    }
    
    init() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        this.form.querySelectorAll('input, textarea, select').forEach(field => {
            field.addEventListener('blur', () => this.validateField(field));
        });
    }
    
    handleSubmit(e) {
        if (!this.form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            Toast.show('Veuillez remplir tous les champs requis', 'error');
        }
        this.form.classList.add('was-validated');
    }
    
    validateField(field) {
        if (!field.checkValidity()) {
            field.classList.add('is-invalid');
        } else {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
        }
    }
}

// Modal Manager
class ModalManager {
    static open(modalId) {
        const modal = document.getElementById(modalId);
        if (modal && typeof bootstrap !== 'undefined') {
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
        }
    }
    
    static close(modalId) {
        const modal = document.getElementById(modalId);
        if (modal && typeof bootstrap !== 'undefined') {
            const bsModal = bootstrap.Modal.getInstance(modal);
            if (bsModal) bsModal.hide();
        }
    }
}

// Hero Particles Effect
function createHeroParticles() {
    const hero = document.querySelector('.hero-section');
    if (!hero) return;
    
    for (let i = 0; i < 30; i++) {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: absolute;
            width: ${2 + Math.random() * 4}px;
            height: ${2 + Math.random() * 4}px;
            background: rgba(255,255,255,${0.2 + Math.random() * 0.3});
            border-radius: 50%;
            pointer-events: none;
            animation: float ${4 + Math.random() * 6}s ease-in-out infinite;
            left: ${Math.random() * 100}%;
            top: ${Math.random() * 100}%;
            animation-delay: ${Math.random() * 3}s;
        `;
        hero.appendChild(particle);
    }
}

// Counter Animation
function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'));
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;
    
    const updateCounter = () => {
        current += increment;
        if (current < target) {
            element.textContent = Math.ceil(current);
            requestAnimationFrame(updateCounter);
        } else {
            element.textContent = target;
        }
    };
    
    updateCounter();
}

// Initialize App
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize Bootstrap components
    if (typeof bootstrap !== 'undefined') {
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
            new bootstrap.Tooltip(el);
        });
        
        document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
            new bootstrap.Popover(el);
        });
    }
    
    // Initialize app components
    new NavbarScroll();
    new AnimateOnScroll();
    new LazyImages();
    new SearchBar('#search');
    
    // Initialize cart
    window.cart = new Cart();
    
    // Initialize forms
    document.querySelectorAll('.needs-validation').forEach(form => {
        new FormValidator(form);
    });
    
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });
    
    // Format prices
    document.querySelectorAll('.format-price').forEach(el => {
        const price = parseFloat(el.textContent);
        if (!isNaN(price)) {
            el.textContent = Utils.formatPrice(price);
        }
    });
    
    // Confirmation dialogs
    document.querySelectorAll('[data-confirm]').forEach(el => {
        el.addEventListener('click', function(e) {
            const message = this.getAttribute('data-confirm') || 'Êtes-vous sûr ?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
    
    // Auto-hide alerts
    document.querySelectorAll('.alert:not(.alert-permanent)').forEach(alert => {
        setTimeout(() => {
            alert.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => alert.remove(), 300);
        }, CONFIG.toastDuration);
    });
    
    // Image error handling
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('error', function() {
            this.src = '/images/placeholder.jpg';
            this.alt = 'Image non disponible';
        });
    });
    
    // Modal cleanup
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            const form = this.querySelector('form');
            if (form) {
                form.reset();
                form.classList.remove('was-validated');
            }
        });
    });
    
    // Sidebar toggle for mobile
    const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
    const sidebar = document.querySelector('.sidebar');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
    }
    
    // Initialize counters on scroll
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('.counter').forEach(counter => {
        counterObserver.observe(counter);
    });
    
    // Parallax Effect
    window.addEventListener('scroll', Utils.throttle(() => {
        const scrolled = window.pageYOffset;
        document.querySelectorAll('.parallax').forEach(el => {
            const speed = parseFloat(el.dataset.speed) || 0.5;
            el.style.transform = `translateY(${scrolled * speed}px)`;
        });
    }, 16));
    
    // Initialize hero particles
    createHeroParticles();
    
    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            document.querySelector('#search')?.focus();
        }
    });
    
    console.log('✨ Location Premium initialized');
});

// Export utilities
window.LocationApp = {
    Toast,
    Loader,
    ModalManager,
    Utils,
    Cart
};

// Service Worker Registration (PWA)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {});
    });
}
