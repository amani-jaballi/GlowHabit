<?php include 'includes/navbar.php'; ?>

<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-hero-tag">Fitness</div>
        <h1>Workout Programs</h1>
        <p>Exercise plans designed for real results — whether you're building muscle or burning fat.</p>
    </div>
</section>

<div class="page-content">

    <div class="section-divider">
        <span class="cat-pill">💪 Build Muscle</span>
        <h2>Gain Weight Workouts</h2>
    </div>
    <div class="cards-grid">
        <?php
        $gainWorkouts = [
            ['s1.png', 'Strength', 'Squats',         '3 sets × 12 reps — Strengthens quads, glutes, and hamstrings for overall lower-body power.'],
            ['s2.png', 'Chest',    'Bench Press',     '3 sets × 10 reps — Primary chest builder, also engages triceps and anterior deltoids.'],
            ['s3.png', 'Back',     'Deadlifts',       '3 sets × 8 reps — The king of compound lifts. Strengthens your entire posterior chain.'],
            ['s11.png','Back',     'Pull-Ups',        '3 sets × 8 reps — Builds a wide, strong back and powerful biceps.'],
            ['s22.png','Shoulders','Shoulder Press',  '3 sets × 10 reps — Develops full shoulder width and tricep strength.'],
            ['s33.png','Legs',     'Lunges',          '3 sets × 12 reps each leg — Unilateral training for leg balance and functional strength.'],
        ];
        foreach ($gainWorkouts as [$img,$tag,$name,$desc]):
        ?>
        <div class="content-card">
            <div style="overflow:hidden"><img src="pics/<?= $img ?>" alt="<?= $name ?>"></div>
            <div class="content-card-body">
                <span class="content-card-tag"><?= $tag ?></span>
                <h3><?= $name ?></h3>
                <p><?= $desc ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="section-divider" style="margin-top:50px">
        <span class="cat-pill" style="background:var(--coral)">🔥 Burn Fat</span>
        <h2>Lose Weight Workouts</h2>
    </div>
    <div class="cards-grid">
        <?php
        $loseWorkouts = [
            ['s4.png', 'Cardio',      'Jump Rope',         '15 minutes — One of the most calorie-dense cardio workouts per minute.'],
            ['s5.png', 'Full Body',   'Burpees',           '3 sets × 12 reps — Full-body, high-intensity movement that torches fat fast.'],
            ['s6.png', 'Core',        'Mountain Climbers', '3 sets × 20 reps — Cardio and core combined for maximum metabolic impact.'],
            ['s44.png','Cardio',      'High Knees',        '3 sets × 30 sec — Elevates heart rate quickly, great warm-up and fat burner.'],
            ['s55.png','Core & Cardio','Plank Jacks',      '3 sets × 20 reps — Challenges your stability while keeping your heart rate up.'],
            ['s66.png','Abs',         'Bicycle Crunches',  '3 sets × 15 reps — Targets obliques and deep core muscles for a defined midsection.'],
        ];
        foreach ($loseWorkouts as [$img,$tag,$name,$desc]):
        ?>
        <div class="content-card">
            <div style="overflow:hidden"><img src="pics/<?= $img ?>" alt="<?= $name ?>"></div>
            <div class="content-card-body">
                <span class="content-card-tag"><?= $tag ?></span>
                <h3><?= $name ?></h3>
                <p><?= $desc ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
