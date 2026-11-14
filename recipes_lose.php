<?php include 'includes/navbar.php'; ?>

<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-hero-tag">Nutrition · Lose Weight</div>
        <h1>Weight Loss Meal Plans</h1>
        <p>Satisfying, low-calorie recipes that keep you full and energized.</p>
    </div>
</section>

<div class="page-content">

<?php
$meals = [
    'Breakfast' => [
        ['1.png',  'Oatmeal with Fresh Fruit',          'Rolled oats, almond milk, strawberries / banana, chia seeds.'],
        ['2.png',  'Green Detox Smoothie',               'Spinach, cucumber, green apple, lemon, ginger — boost your digestion and energy.'],
        ['3.png',  'Greek Yogurt with Honey & Berries',  'Greek yogurt (0%), light honey, blueberries.'],
        ['4.png',  'Egg White Omelette with Veggies',    'Egg whites, tomatoes, bell peppers, spinach.'],
    ],
    'Lunch' => [
        ['5.png',  'Light Chicken–Avocado Salad',        'Grilled chicken, ½ avocado, cucumber, lemon dressing.'],
        ['6.png',  'Power Bowl',                          'Quinoa, chickpeas, shredded carrots, cucumber, lemon dressing.'],
        ['7.png',  'Healthy Protein Wrap',               'Whole-wheat tortilla, chicken or tuna, lettuce, yogurt dressing.'],
        ['8.png',  'Light Lentil Soup',                  'Lentils, carrots, tomato, garlic — warming and filling.'],
    ],
    'Dinner' => [
        ['9.png',  'Grilled Fish + Steamed Vegetables',  'Salmon or white fish, broccoli, zucchini.'],
        ['10.png', 'Brown Rice + Stir-Fried Veggies',    'Brown rice, mushrooms, zucchini, light soy sauce.'],
        ['11.png', 'Light Tuna Salad',                   'Tuna, tomato, corn, cucumber.'],
        ['12.png', 'Paprika Grilled Chicken + Salad',    'Chicken breast, paprika, bell pepper, lettuce.'],
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
