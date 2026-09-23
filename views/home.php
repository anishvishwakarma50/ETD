<?php
$settings = $pdo->query("SELECT key, value FROM settings")->fetchAll(PDO::FETCH_KEY_PAIR);
$partners = $pdo->query("SELECT * FROM partners ORDER BY display_order ASC, id ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Transformation | smmart</title>
    <meta name="description"
        content="smmart Enterprise Transformation covers the entire breadth of a business's operations.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=Outfit:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Header -->
    <header class="header">
        <div class="container header-container">
            <a href="#" class="logo">
                <img src="assets/logo-6712b347ef6bfbe8b880-533ab8320f.webp" alt="smmart Logo">
            </a>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class="nav">
                <a href="#practices">PRACTICES</a>
                <a href="#partner-us">PARTNER US</a>
                <a href="#testimonials">TESTIMONIALS</a>
                <a href="#reach-us">REACH US</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <video autoplay muted loop playsinline class="hero-video">
            <source src="<?= htmlspecialchars($settings['hero_video_portrait'] ?? '') ?>" media="(max-aspect-ratio: 1/1)" type="video/mp4">
            <source src="<?= htmlspecialchars($settings['hero_video_landscape'] ?? '') ?>" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <!-- Title moved to next section -->
        </div>
    </section>

    <!-- Intro Section -->
    <section class="intro section-padding">
        <div class="container">
            <div class="intro-header reveal">
                <h1 class="text-orange section-title intro-title">
                    TRANSFORMATION<br>BEFORE TRANSITION &gt;&gt;</h1>
                <h2 class="text-dark intro-subtitle">OUR ROLE IN YOUR
                    BUSINESS.</h2>
            </div>
            <div class="intro-grid">
                <div class="intro-text">
                    <p>Most businesses reach a point where growth stalls, competition intensifies and market share
                        starts to decline. Early success gradually gives way to market pressures and competitive price
                        wars.</p>
                    <p>Desperation pushes business owners to take mindless actions — pivot into a high-risk business
                        with limited expertise, lowering price and commoditising, chase new markets with uncertain
                        demand, or double down on templates that have already failed, repeating past strategies
                        rigorously. Instead of internally fixing bottlenecks, they try to move into untested areas to
                        feel secured.</p>
                    <p class="text-blue font-bold"><span class="text-blue font-bold">Transitioning is not the solution.
                            Transforming internally to create
                            a competitive edge, is.</span></p>
                    <p>Before you work on external market triggers, Work on internal structural inefficiencies. <br>
                        <span class="text-blue font-bold">smmart Enterprise Transformation will help.</span>
                    </p>
                </div>
                <div class="intro-image">
                    <img src="assets/Rectangle 8.png" alt="Transformation Abstract"
                        onerror="this.src='assets/Frame 6.png'">
                </div>
            </div>
            <div class="blue-banner reveal">
                <p>smmart Enterprise Transformation – we help you eliminate inefficiencies and create leverage, by
                    reversing fundamental problem areas with tech tools, learning modules, practical strategies and
                    expert deep diving.</p>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="divider">
        <svg viewBox="0 -60 1920 240" preserveAspectRatio="xMidYMid slice" class="svg-divider"
            xmlns="http://www.w3.org/2000/svg">
            <!-- Dashed Wave Path -->
            <path d="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" fill="transparent" stroke="#b3b3b3"
                stroke-width="1.5" stroke-dasharray="12, 12" />

            <!-- Set 1 -->
            <!-- Icon 1: Chart -->
            <g>
                <image href="assets/Asset%201%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="0s" />
            </g>

            <!-- Icon 2: People pointing at board -->
            <g>
                <image href="assets/Asset%202%201.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-5s" />
            </g>

            <!-- Icon 3: People shaking hands -->
            <g>
                <image href="assets/Asset%203%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-10s" />
            </g>

            <!-- Set 2 -->
            <!-- Icon 1: Chart -->
            <g>
                <image href="assets/Asset%201%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-15s" />
            </g>

            <!-- Icon 2: People pointing at board -->
            <g>
                <image href="assets/Asset%202%201.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-20s" />
            </g>

            <!-- Icon 3: People shaking hands -->
            <g>
                <image href="assets/Asset%203%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-25s" />
            </g>

        </svg>
    </div>

    <!-- We Solve For -->
    <section class="solve-for section-padding" style="padding-bottom: 0; padding-top: 0;">
        <div class="container text-center">
            <h2 class="section-title text-orange" style="margin-bottom: 30px;">WE SOLVE FOR</h2>
        </div>
        <div class="solve-box bg-blue reveal">
            <div class="container text-center">
                <h3>Business Bottlenecks, People Behaviour<br>& Systemic Inefficiencies.</h3>
                <table class="solve-table">
                    <tbody>
                        <tr>
                            <td>
                                <ul>
                                    <li>Arrest revenue decline</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Bring cross-functional alignment</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Build storytelling to drive growth</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Upgrade and develop new skills for a newer world</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <ul>
                                    <li>Boost sales team productivity</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Correct peoples' behaviours</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Coach for mindset shifts</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Streamline operational processes</li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="divider">
        <svg viewBox="0 -60 1920 240" preserveAspectRatio="xMidYMid slice" class="svg-divider"
            xmlns="http://www.w3.org/2000/svg">
            <!-- Dashed Wave Path -->
            <path d="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" fill="transparent" stroke="#b3b3b3"
                stroke-width="1.5" stroke-dasharray="12, 12" />

            <!-- Set 1 -->
            <!-- Icon 1: Chart -->
            <g>
                <image href="assets/Asset%201%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="0s" />
            </g>

            <!-- Icon 2: People pointing at board -->
            <g>
                <image href="assets/Asset%202%201.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-5s" />
            </g>

            <!-- Icon 3: People shaking hands -->
            <g>
                <image href="assets/Asset%203%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-10s" />
            </g>

            <!-- Set 2 -->
            <!-- Icon 1: Chart -->
            <g>
                <image href="assets/Asset%201%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-15s" />
            </g>

            <!-- Icon 2: People pointing at board -->
            <g>
                <image href="assets/Asset%202%201.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-20s" />
            </g>

            <!-- Icon 3: People shaking hands -->
            <g>
                <image href="assets/Asset%203%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-25s" />
            </g>


        </svg>
    </div>

    <!-- Why Partner Us -->
    <section id="partner-us" class="partner-us section-padding">
        <div class="container partner-grid">
            <div class="partner-image reveal-left">
                <img src="assets/partner.jpeg" alt="Team">
            </div>
            <div class="partner-text reveal-right">
                <h2 class="section-title text-orange text-left">WHY<br>PARTNER US?</h2>
                <h4 class="text-blue font-bold big-sub-title">Unlock Growth, Remove Entrepreneur Dependency, and Let
                    All-Round Experts
                    Take Over For a While.</h4>
                <ul class="custom-bullets">
                    <li>Overcome challenges you had sadly accepted as part of business</li>
                    <li>Become relevant and competitive again</li>
                    <li>Internally, take rebirth</li>
                    <li>Become future-ready</li>
                    <li>Break-free and enjoy freedom</li>
                    <li>See overall productivity going up</li>
                    <li>Build resilience, become shock-proof</li>
                    <li>Get the blueprint for creating a business legacy through our proven 10X roadmap</li>
                </ul>
                <a href="#reach-us" class="btn btn-blue btn-center">Enquire Now</a>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="divider">
        <svg viewBox="0 -60 1920 240" preserveAspectRatio="xMidYMid slice" class="svg-divider"
            xmlns="http://www.w3.org/2000/svg">
            <!-- Dashed Wave Path -->
            <path d="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" fill="transparent" stroke="#b3b3b3"
                stroke-width="1.5" stroke-dasharray="12, 12" />

            <!-- Set 1 -->
            <!-- Icon 1: Chart -->
            <g>
                <image href="assets/Asset%201%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="0s" />
            </g>

            <!-- Icon 2: People pointing at board -->
            <g>
                <image href="assets/Asset%202%201.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-5s" />
            </g>

            <!-- Icon 3: People shaking hands -->
            <g>
                <image href="assets/Asset%203%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-10s" />
            </g>

            <!-- Set 2 -->
            <!-- Icon 1: Chart -->
            <g>
                <image href="assets/Asset%201%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-15s" />
            </g>

            <!-- Icon 2: People pointing at board -->
            <g>
                <image href="assets/Asset%202%201.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-20s" />
            </g>

            <!-- Icon 3: People shaking hands -->
            <g>
                <image href="assets/Asset%203%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-25s" />
            </g>


        </svg>
    </div>

    <!-- We Are Not Consultants -->
    <section class="not-consultants section-padding" style="padding-top: 0;">
        <div class="container reveal">
            <h2 class="section-title text-orange text-center">WE ARE NOT CONSULTANTS &gt;&gt;</h2>
            <h3 class="subtitle text-grey font-bold text-center">We Understand, Diagnose, Build And Execute.</h3>
            <div class="text-content">
                <p>Consulting is a term used loosely by any service provider who enters a business, recommends solutions
                    and exits when the work is done.</p>
                <p class="text-blue font-bold">smmart Enterprise Transformation covers the entire breadth of a
                    business's operations – from shop floor to the Founder's office. We meet everyone – Investors,
                    Parent company stakeholders, Founders, Managing Directors, Human Resource personnel and front-line
                    sales executives.</p>
                <p>We dive deep into structural challenges. We study your business, people, processes and communication.
                    We break down the hardest bottlenecks and propose solutions that bridge the gap between a founder's
                    vision and a front-line executive's practical challenges on field.</p>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="divider">
        <svg viewBox="0 -60 1920 240" preserveAspectRatio="xMidYMid slice" class="svg-divider"
            xmlns="http://www.w3.org/2000/svg">
            <!-- Dashed Wave Path -->
            <path d="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" fill="transparent" stroke="#b3b3b3"
                stroke-width="1.5" stroke-dasharray="12, 12" />

            <!-- Set 1 -->
            <!-- Icon 1: Chart -->
            <g>
                <image href="assets/Asset%201%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="0s" />
            </g>

            <!-- Icon 2: People pointing at board -->
            <g>
                <image href="assets/Asset%202%201.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-5s" />
            </g>

            <!-- Icon 3: People shaking hands -->
            <g>
                <image href="assets/Asset%203%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-10s" />
            </g>

            <!-- Set 2 -->
            <!-- Icon 1: Chart -->
            <g>
                <image href="assets/Asset%201%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-15s" />
            </g>

            <!-- Icon 2: People pointing at board -->
            <g>
                <image href="assets/Asset%202%201.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-20s" />
            </g>

            <!-- Icon 3: People shaking hands -->
            <g>
                <image href="assets/Asset%203%202.png" x="-30" y="-56" width="60" height="60" />
                <animateMotion path="M -200 60 Q 250 180 700 60 T 1600 60 T 2500 60 T 3400 60" dur="30s"
                    repeatCount="indefinite" begin="-25s" />
            </g>


        </svg>
    </div>

    <!-- Deep Thinkers -->
    <section class="deep-thinkers section-padding reveal">
        <div class="container">
            <div class="deep-thinkers-text">
                <h2 class="section-title text-orange text-left">WE ARE<br>DEEP THINKERS<br>BUSINESS
                    ANALYSTS<br>STORYTELLERS<br>TECH ENABLERS<br>PROCESS & PEOPLE<br>ALIGNMENT EXPERTS.</h2>
                <p class="mt-2 text-white">Give us your business pain points and we will quickly detect the
                    hard-to-detect problems and offer solutions that you did not know were possible.</p>
            </div>
        </div>
    </section>

    <!-- Meet The Core Team -->
    <section class="core-team section-padding text-center">
        <div class="container">
            <h2 class="section-title text-orange">MEET THE CORE TEAM &gt;&gt;</h2>
            <p class="subtitle font-outfit">Mentors, Thinker-Doers, Deep-Diving Experts<br>And Master Implementers.</p>

            <div class="team-grid top-row reveal">
                <?php foreach ($partners as $partner): ?>
                <div class="team-member" 
                    data-name="<?= htmlspecialchars($partner['name']) ?>" 
                    data-role="<?= htmlspecialchars($partner['role']) ?>" 
                    data-bio="<?= htmlspecialchars($partner['bio']) ?>" 
                    data-image="<?= htmlspecialchars($partner['image']) ?>" 
                    data-linkedin="<?= htmlspecialchars($partner['linkedin'] ?? '#') ?>" 
                    data-email="<?= htmlspecialchars($partner['email'] ?? '#') ?>">
                    
                    <?php if ($partner['image']): ?>
                        <img src="<?= htmlspecialchars($partner['image']) ?>" alt="<?= htmlspecialchars($partner['name']) ?>">
                    <?php else: ?>
                        <!-- Fallback placeholder if no image -->
                        <div style="width: 100%; height: 100%; background: #ccc; display: flex; align-items: center; justify-content: center; color: #666; font-weight: bold; font-size: 1.5rem;">
                            <?= substr(htmlspecialchars($partner['name']), 0, 1) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <!-- <div class="team-grid bottom-row reveal">

                
            </div> -->
        </div>
    </section>

    <!-- Footer / Reach Us -->
    <footer id="reach-us" class="footer section-padding" style="padding:0;">
        <div class="footer-layout reveal">
            <div class="footer-top-row">
                <div class="footer-text-box">
                    <h2>Every transformation<br>starts with a conversation.<br>Share a few details and<br>our team will
                        reach out<br>within one business day.</h2>
                </div>
                <div class="footer-bg-image"></div>
            </div>

            <div class="footer-glass-box">
                <div class="form-label font-bold">Send Enquiry</div>
                <form class="enquiry-form">
                    <div class="input-group">
                        <input type="email" id="email" placeholder="Your Email" required>
                        <button type="submit" class="btn btn-orange">Send Email</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-watermark">smm-art</div>
    </footer>

    <script src="script.js"></script>

    <!-- Team Member Modal -->
    <div id="team-modal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <div class="modal-body">
                <div class="modal-left">
                    <img id="modal-image" src="" alt="Team Member">
                </div>
                <div class="modal-right">
                    <div class="modal-header-row">
                        <div>
                            <h3 id="modal-name"></h3>
                            <h4 id="modal-role"></h4>
                        </div>
                        <div class="modal-socials">
                            <a id="modal-linkedin" href="#" target="_blank" aria-label="LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                            </a>
                            <a id="modal-email" href="#" aria-label="Email">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            </a>
                        </div>
                    </div>
                    <p id="modal-bio"></p>
                    <a href="#" class="know-more">KNOW MORE &darr;</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>