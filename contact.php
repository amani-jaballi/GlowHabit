<?php
include 'includes/navbar.php';
include 'includes/database.php';

$db   = new Database();
$conn = $db->connect();
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? 'General inquiry'));
    $message = htmlspecialchars(trim($_POST['message']));

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
    if ($stmt->execute([':name'=>$name, ':email'=>$email, ':message'=>"[$subject] $message"])) {
        $success = "Your message has been sent successfully! We'll reply within 24 hours.";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}
?>

<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-hero-tag">Get in touch</div>
        <h1>We'd love to hear from you</h1>
        <p>Have a question or suggestion? Drop us a message.</p>
    </div>
</section>

<section class="section">
    <div class="section-inner">
        <div class="contact-grid">
            <div class="contact-info-card">
                <h3>Contact Information</h3>
                <p>Reach us through any of these channels. We typically respond within 24 hours on business days.</p>
                <div class="contact-detail">
                    <div class="contact-detail-icon">📞</div>
                    <div class="contact-detail-text">+216 92 990 320</div>
                </div>
                <div class="contact-detail">
                    <div class="contact-detail-icon">✉️</div>
                    <div class="contact-detail-text">contact@glowhabit.com</div>
                </div>
                <div class="contact-detail">
                    <div class="contact-detail-icon">📍</div>
                    <div class="contact-detail-text">Nabeul, Tunisia</div>
                </div>
                <div style="margin-top:28px;padding-top:20px;border-top:1px solid rgba(255,255,255,.1)">
                    <div style="font-size:.75rem;color:rgba(255,255,255,.4);font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:10px">Response time</div>
                    <div style="font-size:.85rem;color:rgba(255,255,255,.65)">⏱ Usually within 24 hours</div>
                </div>
            </div>

            <div class="card-box">
                <h3 class="card-box-title">✉️ Send a message</h3>
                <?php if ($success): ?><div class="form-success-msg">✓ <?= $success ?></div><?php endif; ?>
                <?php if ($error):   ?><div class="form-error-msg">⚠ <?= $error ?></div><?php endif; ?>
                <form method="POST" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">First name</label>
                            <input class="form-input" type="text" name="name" placeholder="Sara" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email address</label>
                            <input class="form-input" type="email" name="email" placeholder="sara@email.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <select class="form-input" name="subject">
                            <option>General inquiry</option>
                            <option>Technical support</option>
                            <option>Partnership</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea class="form-input" name="message" rows="5" placeholder="Tell us how we can help…" required style="resize:vertical;min-height:110px"></textarea>
                    </div>
                    <button type="submit" class="btn-full">Send message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
