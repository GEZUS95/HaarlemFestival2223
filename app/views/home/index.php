<?php
include_once __DIR__ . '/../header.php';
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Styled Page with Image and Text</title>
        <style>
            /* Reset default margin and padding */
            body, figure, h1, p {
                margin: 0;
                padding: 0;
            }

            /* Set up container */
            .container {

            }

            /* Set up image section */
            .image-section {
                width: 100%;
                height: 350px;
                overflow: hidden;
            }

            .image-section img {
                width: 100%;
                object-fit: cover;
                object-position: center top;
                height: 100%;
            }

            /* Set up text section */
            .text-section {
                display: flex;
                justify-content: center; /* Center align text sections horizontally */
                flex-wrap: wrap;
                margin-top: 20px;
            }

            .text-section .column {
                flex-basis: calc(33.33% - 20px); /* Calculate flex basis to evenly distribute columns */
                margin-right: 20px;
                margin-bottom: 20px;
                text-align: center; /* Center align text within each text section */
            }

            .text-section .column:last-child {
                margin-right: 0;
            }

            .text-section img {
                width: 100%;
                max-height: 240px; /* Set maximum height for the images */
                object-fit: cover;
                object-position: center top;
                margin-bottom: 10px;
            }

            /* Set up general text section */
            .general-text-section {
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="image-section">
            <img src="/images/pages/NogEenGroteKerk.jpg" alt="Image">
        </div>
        <hr>
        <div class="text-section">
            <div class="column">
                <img src="/images/pages/JazzSmallImage.jpg" alt="Image 1">
                <h4>Jazz</h4>
                <p>Immerse Yourself in the Soulful Tunes of the World's Finest Jazz Musicians
                    Get ready to be transported to the golden era of jazz at Haarlem Festival! This year's festival promises to be a feast for jazz lovers as renowned musicians from around the world converge in the picturesque city of Haarlem to deliver soulful performances that will captivate your senses. From smooth blues to upbeat swing, the festival will showcase a diverse range of jazz styles that will leave you mesmerized.

                    As you stroll through the historic streets of Haarlem, you'll be serenaded by the smooth melodies of saxophones, the intricate rhythms of drums, and the soulful crooning of vocalists. With multiple stages scattered across the city, you'll have the opportunity to catch both established jazz legends and emerging talents in intimate settings, creating a unique and immersive experience.

                    Whether you're a seasoned jazz aficionado or new to the genre, Haarlem Festival's jazz lineup promises to enthrall and entertain you with its rich musical heritage, welcoming atmosphere, and unforgettable performances that will leave you craving for more.</p>
            </div>
            <div class="column">
                <img src="/images/pages/EDMSmallImage.jpg" alt="Image 2">
                <h4>EDM</h4>
                <p> Haarlem Festival's Electrifying Dance Experience
                    Let your body move to the rhythm of Haarlem Festival's electrifying dance beats! The festival is set to be a pulsating celebration of dance, featuring an array of dance styles that will get your feet tapping and your heart racing. From contemporary to hip-hop, Latin to ballroom, the festival promises to be a captivating spectacle that will ignite your passion for dance.

                    With performances by renowned dance troupes and choreographers from around the world, the festival will showcase the diversity and dynamism of the art of dance. From open-air stages in picturesque squares to cozy indoor venues, the festival will come alive with jaw-dropping dance routines, mesmerizing acrobatics, and captivating storytelling through movement.

                    Join in the celebration and let yourself be swept away by the energy, creativity, and emotion of dance at Haarlem Festival. Get ready to groove to the infectious beats, witness breathtaking performances, and experience the joy of dance like never before!k</p>            </div>
            <div class="column">
                <img src="/images/pages/Culinary.jpg" alt="Image 3">
                <h4>Culinary</h4>
                <p> A Gastronomic Journey for Food Enthusiasts
                    Indulge your taste buds in a gastronomic journey at Haarlem Festival, where the city's rich culinary heritage takes center stage. From traditional Dutch delicacies to international gourmet delights, the festival promises to be a treat for food enthusiasts and culture lovers alike.

                    As you explore the festival's food stalls and vendors, you'll be greeted with the aroma of sizzling meats, the sizzle of frying pans, and the tantalizing sight of mouth-watering dishes being prepared right before your eyes. From freshly caught seafood to artisanal cheeses, from exotic spices to delectable desserts, there's something for every palate at Haarlem Festival.

                    In addition to the delicious food, the festival will also feature cooking demonstrations, workshops, and tastings that will allow you to learn about the culinary traditions of Haarlem and beyond. Immerse yourself in the local flavors, interact with talented chefs, and embark on a culinary adventure that will awaken your senses and leave you with unforgettable memories.

                    Haarlem Festival is a true haven for foodies, where you can savor the best of local and international cuisine in a vibrant and festive atmosphere. Don't miss this opportunity to tantalize your taste buds and experience the culinary delights of Haarlem!</p>            </div>
        </div>
        <hr>
        <div class="general-text-section">
            <h2>About the festival</h2>
            <p><?= $home->getBody() ?></p>
        </div>
        <hr>
    </div>

    <div class="container">
        <div class="row">
            <h1> Dance Highlights</h1>
            <p>&nbsp;</p>
            <?php foreach ($danceHighlights as $highlight): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2><?= $highlight['title'] ?></h2>
                        </div>
                        <div class="card-body">
                            <h4><?= $highlight['name'] ?></h4>
                            <p><?= $highlight['description'] ?></p>
                            <h5>With: <?= $highlight['special_guest_name'] ?></h5>
                            <p><?= $highlight['special_guest_description'] ?></p>
                            <p>Starts at: <?= $highlight['start_time'] ?></p>
                            <a href="/item/<?= $highlight['id'] ?>" class="btn btn-primary">Go to</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr>
        <div class="row">
            <h1> Jazz Highlights </h1>
            <p>&nbsp;</p>
            <?php foreach ($jazzHighlights as $highlight): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2><?= $highlight['title'] ?></h2>
                        </div>
                        <div class="card-body">
                            <h4><?= $highlight['name'] ?></h4>
                            <p><?= $highlight['description'] ?></p>
                            <h5>With: <?= $highlight['special_guest_name'] ?></h5>
                            <p><?= $highlight['special_guest_description'] ?></p>
                            <p>Starts at: <?= $highlight['start_time'] ?></p>
                            <a href="/item/<?= $highlight['id'] ?>" class="btn btn-primary">Go to</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr>
        <div class="row">
            <h1>Food Highlights</h1>
            <p>&nbsp;</p>
            <?php foreach ($foodHighlights as $highlight): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2><?= $highlight->getName() ?></h2>
                        </div>
                        <div class="card-body">
                            <p><?= $highlight->getDescription() ?></p>
                            <p>Stars: <?= $highlight->getStars() ?></p>
                            <a href="/restaurant/<?= $highlight->getId() ?>" class="btn btn-primary">Go to</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php
include_once __DIR__ . '/../footer.php';
