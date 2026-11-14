<?php include 'includes/navbar.php'; ?>

<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-hero-tag">Wellness</div>
        <h1>Daily Wellness Tips</h1>
        <p>Small daily practices that protect your mind, your energy, and your emotional wellbeing.</p>
    </div>
</section>

<div class="page-content">
    <div class="cards-grid">
        <?php
        $tips = [
            ['meditation.png', 'Mindfulness', 'Meditation & Mindfulness',
             'Spend 10–15 minutes daily in quiet reflection or guided meditation. Even short sessions reduce cortisol and improve your ability to focus through the day.'],
            ['sleep.png',      'Recovery',    'Better Sleep Habits',
             'Maintain a consistent sleep schedule, avoid screens 30 minutes before bed, and keep your room cool. Quality sleep is the foundation of recovery and mood.'],
            ['hydrat.png',     'Health',      'Stay Hydrated',
             'Aim for 2–2.5 liters of water daily. Hydration affects energy, skin clarity, digestion, and concentration — more than most people realize.'],
            ['journ.png',      'Mental',      'Journaling',
             'Write your thoughts, wins, and feelings each morning or evening. Regular journaling builds self-awareness, reduces anxiety, and helps you set clearer intentions.'],
            ['stretching.png', 'Movement',    'Daily Stretching',
             'Incorporate 5–10 minutes of stretching or gentle yoga into your routine. It reduces muscle tension, improves posture, and signals your body to relax.'],
            ['nature.png',     'Outdoors',    'Connect with Nature',
             'Spend time outdoors daily — even a short walk in natural light boosts serotonin, reduces stress hormones, and resets your mental state.'],
        ];
        foreach ($tips as [$img,$tag,$title,$text]):
        ?>
        <div class="content-card">
            <div style="overflow:hidden"><img src="pics/<?= $img ?>" alt="<?= $title ?>"></div>
            <div class="content-card-body">
                <span class="content-card-tag"><?= $tag ?></span>
                <h3><?= $title ?></h3>
                <p><?= $text ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
