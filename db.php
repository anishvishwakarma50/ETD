<?php
// Start session for admin auth across the app
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db_file = __DIR__ . '/data.sqlite';
$needs_setup = !file_exists($db_file);

try {
    // We use PDO so it's very easy to switch to MySQL later!
    // To switch to MySQL, you would just change this string to: 'mysql:host=localhost;dbname=your_db'
    // and pass the username and password as the 2nd and 3rd arguments.
    $pdo = new PDO('sqlite:' . $db_file);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if ($needs_setup) {
        // Create Users table
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Create Settings table
        $pdo->exec("CREATE TABLE IF NOT EXISTS settings (
            key TEXT PRIMARY KEY,
            value TEXT
        )");

        // Create Partners table
        $pdo->exec("CREATE TABLE IF NOT EXISTS partners (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            role TEXT,
            bio TEXT,
            image TEXT,
            linkedin TEXT,
            email TEXT,
            display_order INTEGER DEFAULT 0
        )");

        // Seed default admin (admin / password123)
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute(['admin', password_hash('password123', PASSWORD_DEFAULT)]);

        // Seed default settings
        $stmt = $pdo->prepare("INSERT INTO settings (key, value) VALUES (?, ?)");
        $stmt->execute(['hero_video_portrait', 'assets/hero-portrait.mp4']);
        $stmt->execute(['hero_video_landscape', 'assets/v2.mp4']);

        // Seed initial partners data
        $partners = [
            ['T.I.G.E.R. SANTOSH NAIR', 'MENTOR AND TRANSFORMATION EXPERT', 'T.I.G.E.R. Santosh Nair is one of India’s most inspiring Business Transformation Coaches and the visionary behind smmart Training & Consultancy Services and the Santosh Nair Online Academy (SNOA). With over four decades of experience, he has impacted the lives of more than 30 lakh individuals, guided over 4,000 entrepreneurs, and transformed 700+ organizations across India and abroad. His forte lies in instilling the roots of transformation in the psyche of individuals and organizations, carving out a unique niche in this field. Known for his fearless energy, sharp insights, and futuristic approach, T.I.G.E.R. Santosh Nair empowers individuals to become self-led, high-performance leaders. At the heart of his work is a powerful mission, to build a bold new future for Indian enterprise, driven by visionary minds and unstoppable action.', 'assets/TM1.jpg', 'https://linkedin.com', 'mailto:santosh@smmart.in', 1],
            ['PRITAM SAVE', 'VICE PRESIDENT - ENTERPRISE TRANSFORMATION', 'Pritam Save is a Vice President, Enterprise Transformation with over 14 years of experience leading enterprise-wide change, business scale-up initiatives, and execution-led transformation across complex, multi-location organizations. He operates at the intersection of enterprise strategy, operating model design, and performance execution supporting organizations in converting strategic priorities into sustained business outcomes. His work spans business and revenue model optimization, sales and marketing effectiveness, organizational effectiveness, and process reengineering, delivering measurable improvements in growth, productivity, and return on investment. Pritam brings strong expertise in enterprise diagnostics, transformation roadmap design, and execution governance, ensuring clarity of priorities, disciplined execution, and outcome ownership. He is recognized for building alignment across leadership teams, embedding robust performance management and review mechanisms, and leading teams through ambiguity and change with structure and intent. A hands-on yet strategic leader, he develops internal leadership capability, strengthens decision-making through data and insights, and institutionalizes scalable systems and processes that enable long-term enterprise value creation.', 'assets/TM2.jpg', 'https://linkedin.com', 'mailto:pritam@smmart.in', 2],
            ['GEETA NAIDU KHAN', 'VICE PRESIDENT - ENTERPRISE TRANSFORMATION EXECUTION', 'Result-oriented, Award-winning Customer Experience Leader with over 16 Years of Experience in BFSI, Travel & Hospitality. Proven Expertise in Setting up Back-office Operations, Building Service Frameworks, Driving SLAs, and Managing Large Teams across Global Markets. Known for Strategic Thinking, People Leadership, Process Innovation, and Consistently Exceeding Customer and Stakeholder Expectations.', 'assets/TM3.jpg', 'https://linkedin.com', 'mailto:geeta@smmart.in', 3],
            ['JANHAVI BHAVKE', 'SYSTEMS AUDITOR & TECHNOLOGY ENABLER', 'Janhavi leads organizational diagnostic and research projects at smmart, and drives stakeholder alignment. She is proficient in coordinating product/process innovation projects, research studies, and software delivery from concept to execution. She specializes in converting raw research and data analysis into clear, actionable insights through client-ready reports and presentations for senior management.', 'assets/TM5.jpeg', 'https://linkedin.com', 'mailto:janhavi@smmart.in', 4]
        ];
        
        $stmt = $pdo->prepare("INSERT INTO partners (name, role, bio, image, linkedin, email, display_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
        foreach ($partners as $p) {
            $stmt->execute($p);
        }
    }
} catch (PDOException $e) {
    die("Database Connection failed: " . $e->getMessage());
}
?>
