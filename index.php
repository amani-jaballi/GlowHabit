<?php include 'includes/navbar.php'; ?>

<section class="hero">
    <div class="hero-content">
        <div class="hero-eyebrow"><span></span> Your wellness journey starts here</div>
        <h1>Build habits that<br><em>actually stick.</em></h1>
        <p>GlowHabit gives you personalized meal plans, workout programs, and wellness guidance — all tailored to your body and your goals.</p>
        <div class="hero-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/pages/dashboard.php" class="btn-primary">Go to Dashboard →</a>
                <a href="/about.php" class="btn-outline">How it works</a>
            <?php else: ?>
                <a href="/signup.php" class="btn-primary">Start for free →</a>
                <a href="/about.php" class="btn-outline">How it works</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Features strip -->
<div class="features-strip">
    <div class="features-strip-inner">
        <div class="feat-item"><div class="feat-icon">🥗</div> Personalized meal plans</div>
        <div class="feat-item"><div class="feat-icon">💪</div> Adaptive workout programs</div>
        <div class="feat-item"><div class="feat-icon">🧘</div> Daily wellness tips</div>
        <div class="feat-item"><div class="feat-icon">📊</div> BMI & progress tracking</div>
        <div class="feat-item"><div class="feat-icon">🔒</div> Secure & private</div>
    </div>
</div>

<!-- Services -->
<section class="section" style="background:#fff">
    <div class="section-inner">
        <div class="section-label">What we offer</div>
        <h2 class="section-title">Everything you need<br>to feel your best</h2>
        <p class="section-sub">Three evidence-based pillars that work together to transform your daily routine.</p>
        <div class="services-grid">
            <div class="service-card">
                <div style="overflow:hidden"><img src="pics/d1.png" alt="Healthy Dishes"></div>
                <div class="service-card-body">
                    <span class="service-card-tag">Nutrition</span>
                    <h3>Healthy Meal Plans</h3>
                    <p>Discover balanced, delicious meals tailored to your goal — whether you want to lose, gain, or maintain weight.</p>
                    <div class="service-card-arrow">Explore recipes →</div>
                </div>
            </div>
            <div class="service-card">
                <div style="overflow:hidden"><img src="pics/d2.png" alt="Workout Plans"></div>
                <div class="service-card-body">
                    <span class="service-card-tag">Fitness</span>
                    <h3>Workout Programs</h3>
                    <p>From beginner cardio to advanced strength training — find the right program to reach your physical goals.</p>
                    <div class="service-card-arrow">Start training →</div>
                </div>
            </div>
            <div class="service-card">
                <div style="overflow:hidden"><img src="pics/d3.png" alt="Wellness Tips"></div>
                <div class="service-card-body">
                    <span class="service-card-tag">Wellness</span>
                    <h3>Wellness Tips</h3>
                    <p>Improve your sleep, mindset, and daily habits with simple, science-backed practices for holistic wellbeing.</p>
                    <div class="service-card-arrow">Read tips →</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-banner">
    <div class="section-label">Ready to begin?</div>
    <h2>Your healthiest self<br>is one habit away.</h2>
    <p>Create your free account and get a personalized dashboard in under 60 seconds.</p>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="/signup.php" class="btn-primary">Create free account →</a>
    <?php else: ?>
        <a href="/pages/dashboard.php" class="btn-primary">Go to Dashboard →</a>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>
