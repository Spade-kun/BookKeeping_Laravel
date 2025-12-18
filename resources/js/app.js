import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import './animations';

// Register Alpine plugins
Alpine.plugin(collapse);

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

// Make Alpine and GSAP available globally
window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// Start Alpine
Alpine.start();
