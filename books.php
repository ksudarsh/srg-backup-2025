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
    $sizes = [200, 400, 600, 800, 1000, 1200, 1600, 2400]; // eight sizes you keep
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

        .meta {
            font-size: .9rem;
            color: #555
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
                $price = number_format($b['price_cents'] / 100, 2); // Rupees & Paise
                ?>
                <div class="book-card">
                    <img src="<?= htmlspecialchars($img) ?>" srcset="<?= htmlspecialchars($srcset) ?>"
                        sizes="(max-width: 600px) 50vw, 220px" alt="Cover of <?= htmlspecialchars($b['title']) ?>">
                    <h4><?= htmlspecialchars($b['title']) ?></h4>
                    <p class="price">₹<?= $price ?></p>
                    <?php if (!empty($b['description'])): ?>
                        <p><?= nl2br(htmlspecialchars($b['description'])) ?></p>
                    <?php endif; ?>
                    <p class="meta"><?= htmlspecialchars($b['categories']) ?></p>
                    <p class="meta"><?= htmlspecialchars($b['tags']) ?></p>
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