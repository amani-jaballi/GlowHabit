<?php include 'includes/navbar.php'; ?>

<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-hero-tag">Nutrition · Gain Weight</div>
        <h1>Muscle-Building Meal Plans</h1>
        <p>High-protein, calorie-dense recipes to fuel your gains and support muscle recovery.</p>
    </div>
</section>

<div class="page-content">

<?php
$meals = [
    'Breakfast' => [
        ['a1.png',  'Peanut Butter Banana Smoothie', 'Banana, peanut butter, whole milk, oats — packed with calories and protein.'],
        ['a2.png',  'Avocado Toast + Eggs',           'Whole grain bread, mashed avocado, 2 poached eggs, chia seeds.'],
        ['a3.png',  'Greek Yogurt Parfait',           'Full-fat Greek yogurt, granola, honey, mixed berries, nuts.'],
        ['a4.png',  'Oatmeal with Nut Butter',        'Oats cooked with milk, almonds, almond butter, banana.'],
    ],
    'Lunch' => [
        ['a5.png',  'Chicken Quinoa Bowl',            'Grilled chicken, quinoa, avocado, roasted vegetables, olive oil.'],
        ['a6.png',  'Salmon & Sweet Potato',          'Grilled salmon, sweet potato, steamed broccoli, olive oil.'],
        ['a7.png',  'Beef Rice Bowl',                 'Sautéed beef, brown rice, colorful vegetables, light soy sauce.'],
        ['a8.png',  'Pasta with Chicken & Pesto',     'Whole wheat pasta, grilled chicken, pesto, green vegetables.'],
    ],
    'Dinner' => [
        ['a9.png',  'Grilled Chicken & Veggies',      'Grilled chicken, broccoli, carrots, brown rice.'],
        ['a10.png', 'Tuna Salad Wrap',                'Whole wheat tortilla, tuna, avocado, vegetables, yogurt sauce.'],
        ['a11.png', 'Stir-Fry Tofu & Rice',           'Sautéed tofu, brown rice, crunchy vegetables, soy sauce.'],
        ['a12.png', 'Salmon & Quinoa Salad',          'Salmon, quinoa, spinach, avocado, walnut oil.'],
    ],
];
foreach ($meals as $mealTime => $items):
?>
    <div class="section-divider">
        <span class="cat-pill">🍽 <?= $mealTime ?></span>
        <h2><?= $mealTime ?></h2>
    </div>
    <div class="meals-grid">
        <?php foreach ($items as [$img, $title, $desc]): ?>
        <div class="meal-card">
            <img src="pics/<?= $img ?>" alt="<?= htmlspecialchars($title) ?>">
            <div class="meal-card-body">
                <h3><?= htmlspecialchars($title) ?></h3>
                <p><?= htmlspecialchars($desc) ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

</div>

<?php include 'includes/footer.php'; ?>
