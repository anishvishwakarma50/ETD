// script.js

document.addEventListener('DOMContentLoaded', () => {
    // --- Sticky & Hide-on-Scroll Header ---
    const header = document.querySelector('.header');
    let lastScrollY = window.scrollY;
    
    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;
        
        // Translucent background
        if (currentScrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        // Hide/Show logic with a threshold to prevent jitter
        if (Math.abs(currentScrollY - lastScrollY) > 10) {
            if (currentScrollY > lastScrollY && currentScrollY > 100) {
                // Scrolling down and past the top area
                header.classList.add('hidden');
            } else if (currentScrollY < lastScrollY) {
                // Scrolling up
                header.classList.remove('hidden');
            }
            lastScrollY = currentScrollY;
        }
    });

    // --- Mobile Menu Toggle ---
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('.nav');
    
    if (hamburger) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            nav.classList.toggle('active');
        });
        
        // Close menu when clicking a link
        document.querySelectorAll('.nav a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                nav.classList.remove('active');
            });
        });
    }

    // --- Smooth Scrolling for Anchor Links ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if(targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const headerOffset = 80;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
  
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });

    // --- Scroll Reveal Animation using Intersection Observer ---
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');

    const revealOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealOnScroll = new IntersectionObserver(function(
        entries,
        observer
    ) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            } else {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, revealOptions);

    revealElements.forEach(el => {
        revealOnScroll.observe(el);
    });
    // --- Team Member Modal Logic ---
    const teamMembers = document.querySelectorAll('.team-member');
    const modal = document.getElementById('team-modal');
    const modalClose = document.querySelector('.modal-close');
    const knowMoreBtn = document.querySelector('.know-more');
    
    if (modal && teamMembers.length > 0) {
        const modalImg = document.getElementById('modal-image');
        const modalName = document.getElementById('modal-name');
        const modalRole = document.getElementById('modal-role');
        const modalBio = document.getElementById('modal-bio');
        const modalLinkedin = document.getElementById('modal-linkedin');
        const modalEmail = document.getElementById('modal-email');
        
        teamMembers.forEach(member => {
            member.style.cursor = 'pointer';
            
            member.addEventListener('click', () => {
                // Reset states
                modalBio.classList.remove('scrollable');
                if (knowMoreBtn) knowMoreBtn.style.display = 'block';
                
                // Populate data
                modalImg.src = member.dataset.image || '';
                modalName.textContent = member.dataset.name || '';
                modalRole.textContent = member.dataset.role || '';
                modalBio.textContent = member.dataset.bio || '';
                modalLinkedin.href = member.dataset.linkedin || '#';
                modalEmail.href = member.dataset.email || '#';
                
                // Show modal
                modal.classList.add('active');
                document.body.style.overflow = 'hidden'; // prevent scrolling behind modal
                
                // Check if content exceeds container height after rendering
                setTimeout(() => {
                    if (knowMoreBtn) {
                        if (modalBio.scrollHeight > modalBio.clientHeight) {
                            knowMoreBtn.style.display = 'block';
                        } else {
                            knowMoreBtn.style.display = 'none';
                        }
                    }
                }, 50);
            });
        });
        
        if (knowMoreBtn) {
            knowMoreBtn.addEventListener('click', (e) => {
                e.preventDefault();
                modalBio.classList.add('scrollable');
                knowMoreBtn.style.display = 'none';
            });
        }
        
        // Close modal handlers
        const closeModal = () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        };
        
        modalClose.addEventListener('click', closeModal);
        
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
        
        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeModal();
            }
        });
    }
});
