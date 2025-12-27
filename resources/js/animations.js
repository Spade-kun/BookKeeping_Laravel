import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// Hero animations on page load
export function initHeroAnimations() {
    const heroHeadline = document.querySelector('.hero-headline');
    const heroSubheadline = document.querySelector('.hero-subheadline');
    const heroCta = document.querySelector('.hero-cta');
    
    // Only run animations if hero elements exist
    if (!heroHeadline && !heroSubheadline && !heroCta) return;
    
    const timeline = gsap.timeline({ defaults: { ease: 'power3.out' } });
    
    if (heroHeadline) {
        timeline.from('.hero-headline', {
            y: 40,
            opacity: 0,
            duration: 1,
        });
    }
    
    if (heroSubheadline) {
        timeline.from('.hero-subheadline', {
            y: 30,
            opacity: 0,
            duration: 0.8,
        }, '-=0.4');
    }
    
    if (heroCta) {
        timeline.from('.hero-cta', {
            y: 20,
            opacity: 0,
            duration: 0.6,
        }, '-=0.3');
    }
}

// Scroll-triggered section animations
export function initScrollAnimations() {
    const sections = document.querySelectorAll('.animate-section');
    
    if (sections.length === 0) return;
    
    sections.forEach((section) => {
        gsap.from(section, {
            scrollTrigger: {
                trigger: section,
                start: 'top 80%',
                toggleActions: 'play none none none',
            },
            y: 40,
            opacity: 0,
            duration: 1,
            ease: 'power3.out',
        });
    });
}

// Staggered children animations
export function initStaggerAnimations() {
    const containers = document.querySelectorAll('.stagger-container');
    
    if (containers.length === 0) return;
    
    containers.forEach((container) => {
        const children = container.querySelectorAll('.stagger-item');
        
        if (children.length === 0) return;
        
        gsap.from(children, {
            scrollTrigger: {
                trigger: container,
                start: 'top 80%',
                toggleActions: 'play none none none',
            },
            y: 30,
            opacity: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power3.out',
        });
    });
}

// Card hover animations
export function initCardHoverAnimations() {
    const cards = document.querySelectorAll('.hover-card');
    
    if (cards.length === 0) return;
    
    cards.forEach((card) => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                y: -8,
                boxShadow: '0 20px 40px rgba(0, 0, 0, 0.1)',
                duration: 0.3,
                ease: 'power2.out',
            });
        });
        
        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                y: 0,
                boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
                duration: 0.3,
                ease: 'power2.out',
            });
        });
    });
}

// Navigation scroll effect
export function initNavScroll() {
    const header = document.querySelector('header');
    
    if (!header) return;
    
    ScrollTrigger.create({
        start: 'top -100',
        end: 99999,
        toggleClass: { 
            targets: header, 
            className: 'scrolled' 
        },
    });
}

// Initialize all animations
export function initAnimations() {
    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', () => {
        initHeroAnimations();
        initScrollAnimations();
        initStaggerAnimations();
        initCardHoverAnimations();
        initNavScroll();
    });
}

// Auto-initialize
initAnimations();
