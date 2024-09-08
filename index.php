<?php
require_once './config.php'; // Use require_once to ensure it’s included only once

// Fetch course data for current page
$db = getDbInstance();
$courses = $db->orderBy('id', 'ASC')->get('courses');


    // Assuming $courses is an array of course data with a 'category' key
    $categorizedCourses = [];

    foreach ($courses as $course) {
        $category = htmlspecialchars($course['label']);
        if (!isset($categorizedCourses[$category])) {
            $categorizedCourses[$category] = [];
        }
        $categorizedCourses[$category][] = $course;
    }

// Debugging
file_put_contents('debug.log', "config.php included at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

include 'includes/header.php';
?>

<article>
    <section class="section hero has-bg-image" id="home" aria-label="home"
        style="background-image: url('./public/frontend/images/hero-bg.svg')">
        <div class="container">

            <div class="hero-content">

                <h1 class="h1 section-title">
                    The Best Program to <span class="span">Enroll</span> for Exchange
                </h1>

                <p class="hero-text">
                    Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.
                </p>

                <a href="#" class="btn has-before">
                    <span class="span">Find courses</span>

                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                </a>

            </div>

            <figure class="hero-banner">

                <div class="img-holder one" style="--width: 270; --height: 300;">
                    <img src="./public/frontend/images/hero-banner-1.jpg" width="270" height="300" alt="hero banner" class="img-cover">
                </div>

                <div class="img-holder two" style="--width: 240; --height: 370;">
                    <img src="./public/frontend/images/hero-banner-2.jpg" width="240" height="370" alt="hero banner" class="img-cover">
                </div>

                <img src="./public/frontend/images/hero-shape-1.svg" width="380" height="190" alt="" class="shape hero-shape-1">

                <img src="./public/frontend/images/hero-shape-2.png" width="622" height="551" alt="" class="shape hero-shape-2">

            </figure>

        </div>
    </section>

    <section class="section about" id="about" aria-label="about">
        <div class="container">

            <figure class="about-banner">

                <div class="img-holder" style="--width: 520; --height: 370;">
                    <img src="./public/frontend/images/about-banner.jpg" width="520" height="370" loading="lazy" alt="about banner"
                        class="img-cover">
                </div>

                <img src="./public/frontend/images/about-shape-1.svg" width="360" height="420" loading="lazy" alt=""
                    class="shape about-shape-1">

                <img src="./public/frontend/images/about-shape-2.svg" width="371" height="220" loading="lazy" alt=""
                    class="shape about-shape-2">

                <img src="./public/frontend/images/about-shape-3.png" width="722" height="528" loading="lazy" alt=""
                    class="shape about-shape-3">

            </figure>

            <div class="about-content">

                <p class="section-subtitle">About Us</p>

                <h2 class="h2 section-title">
                    Over 10 Years in <span class="span">Distant Learning</span> for Skill Development
                </h2>

                <p class="section-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Enim ad minim veniam.
                </p>

                <ul class="about-list">

                    <li class="about-item">
                        <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                        <span class="span">Expert Trainers</span>
                    </li>

                    <li class="about-item">
                        <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                        <span class="span">Online Remote Learning</span>
                    </li>

                    <li class="about-item">
                        <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                        <span class="span">Lifetime Access</span>
                    </li>

                </ul>

                <img src="./public/frontend/images/about-shape-4.svg" width="100" height="100" loading="lazy" alt=""
                    class="shape about-shape-4">

            </div>

        </div>
    </section>

    <?php
    ?>

<section class="section course" id="courses" aria-label="course">
    <div class="container">
        <?php if (!empty($categorizedCourses)) : ?>
            <?php foreach ($categorizedCourses as $category => $courses) : ?>
                <p class="section-subtitle"> <b><?php echo htmlspecialchars($category); ?></b></p>
                <ul class="grid-list">
                    <?php foreach ($courses as $course) : ?>
                        <li>
                            <div class="course-card">
                                <figure class="card-banner img-holder" style="--width: 370; --height: 220;">
                                    <img src="./online-learning-system-php/<?php echo htmlspecialchars($course['thumbnail']); ?>" width="370" height="220" loading="lazy"
                                        alt="<?php echo htmlspecialchars($course['title']); ?>" class="img-cover">
                                </figure>

                                <div class="abs-badge">
                                    <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                                    <span class="span"><?php echo htmlspecialchars($course['no_of_weeks']); ?> Weeks</span>
                                </div>

                                <div class="card-content">
                                    <span class="badge"><?php echo htmlspecialchars($course['title']); ?></span>

                                    <h3 class="h3">
                                        <a href="#" class="card-title"><?php echo htmlspecialchars($course['description']); ?></a>
                                    </h3>

                                    <div class="wrapper">
                                        <div class="rating-wrapper">
                                            <?php
                                            // Display star ratings
                                            $rating = intval($course['no_of_star']);
                                            for ($i = 0; $i < 5; $i++) {
                                                $starClass = $i < $rating ? 'star' : 'star-outline';
                                                echo '<ion-icon name="' . $starClass . '"></ion-icon>';
                                            }
                                            ?>
                                        </div>
                                        <p class="rating-text">(<?php echo htmlspecialchars($course['no_of_star']); ?>/5 Rating)</p>
                                    </div>

                                    <data class="price" value="<?php echo htmlspecialchars($course['amount']); ?>">
    <span class="original-price">
        $<?php echo number_format(htmlspecialchars($course['amount']), 2); ?> <!-- Formats price with two decimal places -->
    </span>
    <?php if (!empty($course['discount_with_amount'])): ?>
        <span class="discount">
            <?php echo htmlspecialchars($course['discount_with_amount']); ?>
        </span>
    <?php endif; ?>
</data>


                                    <ul class="card-meta-list">
                                        <li class="card-meta-item">
                                            <ion-icon name="library-outline" aria-hidden="true"></ion-icon>
                                            <span class="span"><?php echo htmlspecialchars($course['no_of_lessons']); ?> Lessons</span>
                                        </li>
                                        <li class="card-meta-item">
                                            <ion-icon name="people-outline" aria-hidden="true"></ion-icon>
                                            <span class="span"><?php echo htmlspecialchars($course['no_of_students']); ?> Students</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No courses available at the moment.</p>
            <?php endif; ?>
    </div>
</section>


    
    <section class="section stats" aria-label="stats">
        <div class="container">

            <ul class="grid-list">

                <li>
                    <div class="stats-card" style="--color: 170, 75%, 41%">
                        <h3 class="card-title">29.3k</h3>
                        <p class="card-text">Total Students</p>
                    </div>
                </li>

                <li>
                    <div class="stats-card" style="--color: 351, 83%, 61%">
                        <h3 class="card-title">32.4K</h3>
                        <p class="card-text">Total Courses</p>
                    </div>
                </li>

                <li>
                    <div class="stats-card" style="--color: 260, 100%, 67%">
                        <h3 class="card-title">100%</h3>
                        <p class="card-text">Trending Courses</p>
                    </div>
                </li>

                <li>
                    <div class="stats-card" style="--color: 42, 94%, 55%">
                        <h3 class="card-title">354+</h3>
                        <p class="card-text">New Courses</p>
                    </div>
                </li>

            </ul>

        </div>
    </section>
</article>

<?php
include 'includes/footer.php';
?>
