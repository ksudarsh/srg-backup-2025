<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>SRG Vedanta School</title>
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/themify-icons.css" />
    <link rel="stylesheet" type="text/css" href="css/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="revolution/css/rs6.css">
    <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
    <link rel="stylesheet" type="text/css" href="css/shortcodes.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />

</head>

<body>

    <!--HEADER STARTS-->
    <?php include 'header.php' ?>
    <!--HEADER ENDS-->


    <!-- INNER BG STARTS -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box text-left">
                        <div class="page-title-heading">
                            <h1>Books</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- INNER BG ENDS -->



    <!--site-main start-->
    <?php
    /* ------------------  BOOK LIST  ------------------ */
    /* Configuration */
    $csvFile = __DIR__ . '/books/books.csv';   // path to the metadata file
    $coverDir = 'books/covers';                 // web-visible folder
    // $sizes = [200, 400, 600, 800, 1000, 1200, 1600, 2400]; // eight sizes you keep
    $sizes = [400]; // eight sizes you keep
    $defaultW = 400;                            // which size to show in <img src=...>
    
    /* Read CSV into $books */
    /* Read CSV into $books */
    $books = [];
    if (($handle = fopen($csvFile, 'r')) !== false) {
        // ⇩ add size, delimiter, enclosure, escape
        $header = fgetcsv($handle, 0, ',', '"', '\\');
        while (($row = fgetcsv($handle, 0, ',', '"', '\\')) !== false) {
            $books[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    ?>

    <style>
        /* minimal styling – tweak / move to your stylesheet later */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem
        }

        .book-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            text-align: center
        }

        .book-card img {
            max-width: 100%;
            height: auto;
            border-radius: 4px
        }

        .price {
            font-weight: bold;
            margin: 0.5rem 0
        }

        .book-card h4 {
            /* make title modest but bold */
            font-size: 1rem;
            /* roughly normal-text size (16 px) */
            font-weight: 700;
            /* bold */
            margin: 0.4rem 0;
            /* a bit of breathing room */
        }

        .meta {
            font-size: .9rem;
            color: #555
        }

        /* --- prettier details panel --- */
        .details p {
            margin: 0 0 .6rem 0;
        }

        .badge {
            display: inline-block;
            background: #e8eefc;
            color: #3856a7;
            font-size: .75rem;
            font-weight: 600;
            border-radius: 12px;
            padding: .15rem .55rem;
            margin: .15rem .25rem .15rem 0;
        }

        .badge.tag {
            background: #f5e9d8;
            color: #a45a00;
        }

        /* ---------- floating details panel ---------- */
        .book-card {
            position: relative;
        }

        .book-card .details {
            position: absolute;
            top: 8px;
            left: 8px;
            right: 8px;
            background: #fff;
            border: 1px solid #aaa;
            border-radius: 6px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .2);
            padding: 0.8rem;
            font-size: 0.9rem;
            line-height: 1.35;
            text-align: left;

            /* Example conceptual improvements */
            .book-card {
                border: 1px solid #e0e0e0;
                /* Lighter border */
                border-radius: 8px;
                padding: 1rem;
                text-align: center;
                display: flex;
                /* Use flexbox for internal layout */
                flex-direction: column;
                /* Stack content vertically */
                justify-content: space-between;
                /* Distribute space */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                /* Subtle shadow */
                transition: transform 0.2s ease-in-out;
                /* Add hover effect */
            }

            .book-card:hover {
                transform: translateY(-5px);
                /* Lift card slightly on hover */
            }

            .book-card img {
                max-width: 100%;
                height: auto;
                /* Maintain aspect ratio */
                border-radius: 4px;
                margin-bottom: 0.8rem;
                /* Space below image */
            }

            .book-card h4 {
                font-size: 1.1rem;
                /* Slightly larger title */
                font-weight: 700;
                margin: 0 0 0.4rem 0;
                color: #333;
                /* Darker title color */
            }

            .book-card .price {
                font-weight: bold;
                margin: 0.5rem 0;
                color: #007bff;
                /* Highlight price */
            }

            .book-card .meta {
                font-size: .85rem;
                /* Slightly smaller meta */
                color: #777;
                /* Lighter meta color */
                margin-bottom: 0.8rem;
                /* Space below meta */
            }

            /* Refine details panel appearance */
            .book-card .details {
                /* Existing styles */
                background: #fff;
                border: 1px solid #ccc;
                box-shadow: 0 8px 25px rgba(0, 0, 0, .25);
                /* Stronger shadow for visibility */
                /* Ensure it fits within the card or overlays cleanly */
                /* Consider adding a close button for touch */
            }

            .badge {
                /* Existing styles */
                padding: .2rem .6rem;
                /* Slightly more padding */
                margin: .2rem .3rem .2rem 0;
                font-size: .8rem;
                /* Slightly larger badge text */
            }

            .badge.tag {
                /* Existing styles */
            }

            opacity: 0;
            pointer-events: none;
            transition: opacity .25s;
            z-index: 10;
        }

        .book-card:hover .details {
            /* desktop hover */
            opacity: 1;
            pointer-events: auto;
        }

        @media (hover: none) {

            /* phones & iPads */
            .book-card:active .details {
                opacity: 1;
                pointer-events: auto;
            }
        }
    </style>

    <div class="container"> <!-- NEW wrapper -->

        <div class="books-grid">
            <?php foreach ($books as $b): ?>
                <?php
                $slug = trim($b['cover_basename']);           // e.g. Divya-Prabandha-Mala-Kusuma
                $img = "{$coverDir}/{$slug}_{$defaultW}.jpg";
                $srcset = implode(', ', array_map(
                    fn($w) => "{$coverDir}/{$slug}_{$w}.jpg {$w}w",
                    $sizes
                ));
                $price = number_format($b['price_paise'] / 100, 2); // Rupees & Paise
                ?>
                <div class="book-card">
                    <img src="<?= htmlspecialchars($img) ?>" srcset="<?= htmlspecialchars($srcset) ?>"
                        sizes="(max-width: 600px) 50vw, 220px" alt="Cover of <?= htmlspecialchars($b['title']) ?>">

                    <h4><?= htmlspecialchars($b['title']) ?></h4>
                    <p class="price">₹<?= $price ?></p>

                    <!-- hidden panel that shows on hover / tap -->
                    <div class="details">
                        <?php if (!empty($b['description'])): ?>
                            <p><?= nl2br(htmlspecialchars($b['description'])) ?></p>
                        <?php endif; ?>
                        <?php
                        // split on | or , then trim each fragment
                        $cats = array_filter(array_map('trim', preg_split('/[|,]/', $b['categories'])));
                        $tags = array_filter(array_map('trim', preg_split('/[|,]/', $b['tags'])));
                        ?>
                        <p>
                            <?php foreach ($cats as $c): ?>
                                <span class="badge"><?= htmlspecialchars($c) ?></span>
                            <?php endforeach; ?>
                        </p>
                        <p>
                            <?php foreach ($tags as $t): ?>
                                <span class="badge tag"><?= htmlspecialchars($t) ?></span>
                            <?php endforeach; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div> <!-- /container -->

    <?php /* -------------- END BOOK LIST -------------- */ ?>

    <!--site-main end-->



    <!--FOOTER STARTS-->
    <?php include 'footer.php' ?>
    <!--FOOTER ENDS-->


    <!--back-to-top start-->
    <a id="totop" href="#top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!--back-to-top end-->

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.js"></script>
    <script src="js/jquery-waypoints.js"></script>
    <script src="js/jquery-validate.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/numinate.min6959.js?ver=4.9.3"></script>
    <script src="js/lazysizes.min.js"></script>
    <script src="js/main.js"></script>
    <script src="revolution/js/revolution.tools.min.js"></script>
    <script src="revolution/js/rs6.min.js"></script>
    <script src="revolution/js/slider.js"></script>
    <!-- Javascript end-->

</body>

</html>